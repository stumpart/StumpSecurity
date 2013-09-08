<?php
/**
 * User: Barrington Henry <stump500@gmail.com>
 */

namespace StumpSecurity;

use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\ModuleRouteListener;

class Module implements ServiceProviderInterface
{

    public function onBootstrap(\Zend\Mvc\MvcEvent $e)
    {
       $em = $e->getApplication()->getEventManager();
       $em->attach(\Zend\Mvc\MvcEvent::EVENT_DISPATCH, array($this, 'preDispatch'), 100);


        /*$moduleRouteListener = new ModuleRouteListener ();
        $moduleRouteListener->attach ( $eventManager );


        $sharedEvents = $eventManager->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
            $controller = $e->getTarget();
            $route = $controller->getEvent()->getRouteMatch();
            $e->getViewModel()->setVariables(
                array('controllerName'=> $route->getParam('__CONTROLLER__', 'index'),
                    'actionName' => $route->getParam('action', 'index'),
                    'moduleName' => strtolower(__NAMESPACE__))
            );
        }, 100);*/
    }

    /**
     * @param \Zend\Mvc\MvcEvent $e
     * @uses \Zend\Mvc\Application
     */
    public function preDispatch(\Zend\Mvc\MvcEvent $e)
    {
        $application = $e->getTarget();
        $routematch= $e->getRouteMatch();

        $cont = $routematch->getParam('controller');
        $action = $routematch->getParam('action');
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
        );
    }

    public function controllersInit($controllerInstance, ControllerManager $controllerManager)
    {
        $this->injectControllerDependencies($controllerInstance, $controllerManager->getServiceLocator());
    }

    /**
     *
     * @param unknown_type $controller
     * @param ServiceManager $serviceLocator
     */
    public function injectControllerDependencies($controller, ServiceManager $serviceLocator)
    {
        $serviceLocator->get('security');
    }


    public function getControllerConfig()
    {
        return array(
            'initializers'=>array(array($this, 'controllersInit'))
        );
    }

    public function getConfig()
    {
        return array_merge(include __DIR__ . '/config/module.config.php',
            array('modulename'=>strtolower(__NAMESPACE__)));
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return array(
            'factories'=>array(
                'security'=>'StumpSecurity\Service\Security'
            )
        );
    }
}