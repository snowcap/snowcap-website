<?php
namespace Snowcap\SiteBundle\DataFixtures\ORM;

use Snowcap\YamlFixturesBundle\YamlFixtures\AbstractYamlFixture;

class LoadGlobalData extends AbstractYamlFixture {

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param object $manager
     */
    public function loadYamlFiles()
    {
        $this->loadYaml(__DIR__ . '/technologies.yml', 'SnowcapSiteBundle:Technology');
        $this->loadYaml(__DIR__ . '/images.yml', 'SnowcapSiteBundle:Image');
        $this->loadYaml(__DIR__ . '/agencies.yml', 'SnowcapSiteBundle:Agency');
    }

    public function getOrder() {
        return 10;
    }

}
