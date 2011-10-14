<?php
namespace Snowcap\SiteBundle\Event;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
class ControllerListener {
    public function onKernelController(FilterControllerEvent $event)
    {
        $requestParams = $event->getController();
        list($controllerInstance, $invokedMethod) = $requestParams;
        $callback = array($controllerInstance, 'init');
        if(is_callable($callback)){
            call_user_func($callback);
        }
    }
}