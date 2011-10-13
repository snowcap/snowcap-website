<?php

namespace Snowcap\AdminBundle\Twig\Extension;

/**
 * Created by JetBrains PhpStorm.
 * User: edwin
 * Date: 28/08/11
 * Time: 21:47
 * To change this template use File | Settings | File Templates.
 */
 
class AdminExtension extends \Twig_Extension {
    /**
     * @var \Twig_Environment
     */
    protected $environment;
    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }
    public function getFunctions()
    {
        return array(
            'column' => new \Twig_Function_Method($this, 'renderColumn', array('pre_escape' => 'html', 'is_safe' => array('html'))),
        );
    }

    /*public function getFilters()
    {
        return array(
            'pad' => new \Twig_Filter_Method($this, 'pad')
        );
    }*/
    public function renderColumn($entity, $property, $params)
    {
        $loader = $this->environment->getLoader(); /* @var \Symfony\Bundle\TwigBundle\Loader\FilesystemLoader $loader */
        $loader->addPath(__DIR__ . '/../../Resources/views/');
        $template = $this->environment->loadTemplate('column.html.twig');
        $output = 'notimplemented';
        if(isset($params['callback'])){
            $output = call_user_func($params['callback'], $entity);
        }
        elseif(isset($entity->$property)){
            $output = $entity->$property;
        }
        elseif(method_exists($entity, 'get' . ucfirst($property))){
            $output = call_user_func(array($entity, 'get' . ucfirst($property)));
        }
        ob_start();
        $template->displayBlock('column', array('output' => $output));
        $html = ob_get_clean();
        return $html;
    }

    public function getName()
    {
        return 'snowcap_admin';
    }
}
