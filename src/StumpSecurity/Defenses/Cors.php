<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Defenses;

use Zend\Http\Request;
use Zend\ServiceManager\ServiceLocatorInterface;

class Cors
{
    private $serviceLocator;

    public function __construct(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    public function handlePreFlight()
    {
        $request = $this->serviceLocator->get('Request');
    }
} 