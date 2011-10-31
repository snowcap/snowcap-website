<?php
namespace Snowcap\SiteBundle\DataFixtures\ORM;

use Doctrine\Common\CommonException as DoctrineException;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\Container;
use Snowcap\SiteBundle\Entity\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;

use \Symfony\Component\Yaml\Yaml;

class LoadTestData extends AbstractFixture implements OrderedFixtureInterface {
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param object $manager
     */
    public function load($manager)
    {
        $post = $manager->getRepository('SnowcapSiteBundle:Post')->findOneBySlug('why-we-chose-frameworks');
        $image = $manager->getRepository('SnowcapSiteBundle:Image')->findOneByPath('projects/snwcp_front.png');

        $post->setThumb($image);

        $manager->flush();
    }

    public function getOrder()
    {
        return 100;
    }

}
