<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\DoctrineBundle\DoctrineBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            //new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
            new Symfony\Bundle\DoctrineFixturesBundle\DoctrineFixturesBundle(),
            new Snowcap\SiteBundle\SnowcapSiteBundle(),
            new Snowcap\YamlFixturesBundle\SnowcapYamlFixturesBundle(),
            new Ornicar\AkismetBundle\OrnicarAkismetBundle(),
            new Snowcap\AdminBundle\SnowcapAdminBundle(),
            new Snowcap\CoreBundle\SnowcapCoreBundle(),
            new Snowcap\BootstrapBundle\SnowcapBootstrapBundle(),
            new Snowcap\ImBundle\SnowcapImBundle(),
            new Snowcap\SiteAdminBundle\SnowcapSiteAdminBundle(),
            new Snowcap\I18nBundle\SnowcapI18nBundle()
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
