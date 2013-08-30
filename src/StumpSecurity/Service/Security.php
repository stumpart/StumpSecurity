<?php
/**
 * Created by JetBrains PhpStorm.
 * User: barringtonhenry
 * Date: 7/7/13
 * Time: 1:31 PM
 * To change this template use File | Settings | File Templates.
 */

namespace StumpSecurity\Service;

use StumpSecurity\Http\Header\ContentSecurityPolicy;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        $this->setConfig($serviceLocator);

        $dir = $this->getRequestDirectives();


        return $this;
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
        if(array_key_exists('xss', $this->config))
        {
            $con = new ContentSecurityPolicy($this->config);
            $response = $this->serviceLocator->get('Response');
            $response->getHeaders()->addHeader($con);
        }
    }
}