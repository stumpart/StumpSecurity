<?php
/**
 * Created by JetBrains PhpStorm.
 */

namespace StumpSecurity\Service;

use StumpSecurity\Defenses\Verifier;
use StumpSecurity\Http\Header\ContentSecurityPolicy;
use StumpSecurity\Defenses\Cors;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use StumpSecurity\Util\Arrays;


class Security implements FactoryInterface
{

    /**
     * @var
     */
    private $config;

    /**
     * @var
     */
    private $serviceLocator;


    /**
     * @var RouteMatch
     */
    private $routeMatch;

    /**
     * @var \StumpSecurity\Defenses\Verifier
     */
    private $verifier;

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $this->setConfig($serviceLocator);

        return $this;
    }

    public function triggerDefenses()
    {
        $this->verifier = new Verifier($this->config, $this->routeMatch);
        $dir = $this->getRequestDirectives();
    }
    /**
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setConfig(ServiceLocatorInterface $serviceLocator)
    {
        $this->config = $serviceLocator->get('config');
    }

    /**
     *
     */
    public function getRequestDirectives()
    {
        if($this->verifier->canApply('xss'))
        {
            $xss = (array) Arrays::getRecursive($this->config, 'xss');
            if(!empty($xss))
            {
                $con = new ContentSecurityPolicy($xss);
                $con->setVerifier($this->verifier);
                $con->setComponent('xss');
                $con->execute();
                $response = $this->serviceLocator->get('Response');
                $response->getHeaders()->addHeader($con);
            }
        }

        if(array_key_exists('cross-origin', $this->config))
        {
            $cors = new Cors($this->serviceLocator);
        }
    }

    public function setRouteMatch(RouteMatch $rm)
    {
        $this->routeMatch = $rm;
    }
}