<?php
namespace Snowcap\SiteBundle\DataFixtures\ORM;

use Snowcap\YamlFixturesBundle\YamlFixtures\AbstractYamlFixture;

class LoadProjectData extends AbstractYamlFixture {
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param object $manager
     */
    public function loadYamlFiles()
    {
        $this->loadYaml(__DIR__ . '/agencies.yml', 'SnowcapSiteBundle:Agency');
        $this->loadYaml(__DIR__ . '/images.yml', 'SnowcapSiteBundle:Image');
        $this->loadYaml(__DIR__ . '/projects.yml', 'SnowcapSiteBundle:Project');
    }

    public function getOrder() {
        return 30;
    }

}
