<?php
namespace Snowcap\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\CommonException as DoctrineException;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Snowcap\SiteBundle\Entity\Post;
use Snowcap\SiteBundle\Entity\Tag;

use \Symfony\Component\Yaml\Yaml;

class LoadPostData implements FixtureInterface {
    protected $entities = array();
    protected function createEntity($manager, $entity, $entityIdentifier, array $values)
    {
        /* Populate entity fields */
        foreach($values as $key => $value) {
            if($key === "tags") {
                $newvalue = array();
                foreach($value as $tagName) {
                    $associatedEntity = $manager->getRepository('Snowcap\SiteBundle\Entity\Tag')->findOneByName($tagName);
                    if(!$associatedEntity){
                        $associatedEntity = new Tag();
                        $associatedEntity->setName($tagName);
                        $manager->persist($associatedEntity);
                        $manager->flush();
                    }
                    $newvalue[] = $associatedEntity;
                    call_user_func(array($entity, 'set' . $key), $newvalue);
                }
            } elseif(!is_array($value)){
                if(strpos($value, '@', 0) !== false){
                    $associatedIdentifier = substr($value, 1);
                    if(!array_key_exists($associatedIdentifier, $this->entities)){
                        throw new DoctrineException(sprintf('Trying to reference non-existing fixture entity "%s" for entity "%s"', $associatedIdentifier, $entityIdentifier));
                    }
                    $value = $this->entities[$associatedIdentifier];
                }
                elseif(strtotime($value)) {
                    $value = new \DateTime($value);
                }
                else{
                    $value = $this->decodeMarkdown($value);
                }
                call_user_func(array($entity, 'set' . $key), $value);
            }
        }
        if(array_key_exists($entityIdentifier, $this->entities)){
            throw new DoctrineException(sprintf('The fixture identifier "%s" is already used', $entityIdentifier));
        }
        $this->entities[$entityIdentifier] = $entity;

        $manager->persist($entity);
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param object $manager
     */
    public function load($manager)
    {
        $records = Yaml::parse(__DIR__ . '/posts.yml');
        foreach($records as $recordIdentifier => $recordData) {
            $record = new Post();
            $this->createEntity($manager, $record, $recordIdentifier, $recordData);
        }
        $manager->flush();
    }

    public function decodeMarkdown($string)
    {
        return preg_replace('/(?<=^|%)%/m', '#', $string);
    }

}
