<?php
namespace Snowcap\YamlFixturesBundle\YamlFixtures;

use Symfony\Component\Yaml\Yaml,
    Symfony\Component\DependencyInjection\Container,
    Doctrine\Common\CommonException as DoctrineException,
    Doctrine\Common\Collections\ArrayCollection,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Check if the passed array is an associative array
 *
 * @param array $value
 * @return bool
 */
function is_assoc($value)
{
    return
        is_array($value) &&
        count(array_filter(array_keys($value), function($key){return is_string($key);})) !== 0;
}

abstract class AbstractYamlFixture extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * @var \Doctrine\ORM\EntityManager
     * 
     */
    protected $manager;
    /**
     * Process a fixture value according to its type and / or format
     *
     * @throws \Exception|DoctrineException
     * @param string $field
     * @param mixed $value
     * @param object $entity
     * @return mixed
     */
    protected function processValue($field, $value, $entity)
    {
        // If $value is an associative array, create a new entity
        if(is_assoc($value)) {
            $metadata = $this->manager->getClassMetadata(get_class($entity))->getAssociationMapping($field);
            $processedValue = new $metadata['targetEntity'];
            $this->saveEntity($processedValue, null, $value);
        }
        // If $value is a regular array, perform recursive call on each of its items
        elseif(is_array($value)) {
            $processedValue = new ArrayCollection();
            foreach($value as $singleValue) {
                $processedValue[]= $this->processValue($field, $singleValue, $entity);
            }
        }
        // If $value starts with a @ character, look for a reference
        elseif(strpos($value, '@') === 0){
            $associatedIdentifier = substr($value, 1);
            if(!$this->getReference($associatedIdentifier)){
                throw new DoctrineException(sprintf('Trying to reference non-existing fixture entity "%s"', $associatedIdentifier));
            }
            $processedValue = $this->getReference($associatedIdentifier);
        }
        // If $value is a valid date
        elseif(strtotime($value) && strlen($value) === 19) {
            $processedValue = new \DateTime($value);
        }
        // Default treatment
        else{
            $processedValue = $this->decodeMarkdown($value);
        }
        return $processedValue;
    }
    /**
     * Save a fixture entity into the database
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param object $entity
     * @param string $entityIdentifier
     * @param array $values
     */
    protected function saveEntity($entity, $entityIdentifier, array $values)
    {
        foreach($values as $field => $value) {
            $processedValue = $this->processValue($field, $value, $entity);
            call_user_func(array($entity, 'set' . Container::camelize($field)), $processedValue);
            if($entityIdentifier !== null) {
                $this->setReference($entityIdentifier, $entity);
            }
            $this->manager->persist($entity);
        }
    }
    /**
     * Parse a YAML file and process its data
     *
     * @param string $path
     * @param string $entityShortcut
     */
    protected function loadYaml($path, $entityShortcut) {
        $entries = Yaml::parse($path);
        foreach($entries as $identifier => $data) {
            $entityName = $this->manager->getClassMetaData($entityShortcut)->getName();
            $entity = new $entityName();
            $this->saveEntity($entity, $identifier, $data);
        }
    }
    /**
     * Decode strings to avoid markdown formatting issues
     *
     * @param $string
     * @return string
     */
    protected function decodeMarkdown($string)
    {
        return preg_replace('/(?<=^|%)%/m', '#', $string);
    }
    /**
     * @param \Doctrine\ORM\EntityManager $manager
     */
    public function load($manager)
    {
        $this->manager = $manager;
        $this->loadYamlFiles();
        $manager->flush();
    }

    abstract public function loadYamlFiles();
}