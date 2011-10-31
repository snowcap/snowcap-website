<?php
namespace Snowcap\SiteBundle\DataFixtures\ORM;

use Snowcap\YamlFixturesBundle\YamlFixtures\AbstractYamlFixture;

class LoadPostData extends AbstractYamlFixture {
    public function loadYamlFiles()
    {
        $this->loadYaml(__DIR__ . '/postCategories.yml', 'SnowcapSiteBundle:PostCategory');
        $this->loadYaml(__DIR__ . '/posts.yml', 'SnowcapSiteBundle:Post');
    }

    public function getOrder() {
        return 20;
    }

}
