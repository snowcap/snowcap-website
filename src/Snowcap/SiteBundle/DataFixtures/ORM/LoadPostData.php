<?php
namespace Snowcap\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\CommonException as DoctrineException;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Snowcap\SiteBundle\Entity\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

use \Symfony\Component\Yaml\Yaml;

class LoadPostData extends AbstractFixture implements OrderedFixtureInterface {
    protected $entities;
    public function __construct() {
        $this->entities = new ArrayCollection();
    }
    protected function createEntity($manager, $entity, $entityIdentifier, array $values)
    {
        /* Populate entity fields */
        foreach($values as $key => $value) {
            if($key === "technologies") {
                $newvalue = new ArrayCollection();
                foreach($value as $tagName) {
                    $associatedEntity = $manager->getRepository('Snowcap\SiteBundle\Entity\Technology')->findOneByName($tagName);
                    if(!$associatedEntity){
                        $associatedEntity = new \Snowcap\SiteBundle\Entity\Technology();
                        $associatedEntity->setName($tagName);
                        $associatedEntity->setDescription('TO BE DEFINED');
                        $manager->persist($associatedEntity);
                        $manager->flush();
                    }
                    $newvalue[] = $associatedEntity;
                    call_user_func(array($entity, 'set' . Container::camelize($key)), $newvalue);
                }
            } elseif(!is_array($value)){
                if(strpos($value, '@', 0) !== false && strpos($value, '@', 0) === 0){
                    $associatedIdentifier = substr($value, 1);
                    if(!$this->entities->containsKey($associatedIdentifier)){
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
                call_user_func(array($entity, 'set' . Container::camelize($key)), $value);
            }
        }
        if($this->entities->containsKey($entityIdentifier)){
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
        $categories = Yaml::parse(__DIR__ . '/postCategories.yml');
        foreach($categories as $categoryIdentifier => $categoryData) {
            $category = new \Snowcap\SiteBundle\Entity\PostCategory();
            $this->createEntity($manager, $category, $categoryIdentifier, $categoryData);
        }

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

    public function getOrder()
    {
        return 10;
    }

}
