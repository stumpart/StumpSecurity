<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Defenses;

use Zend\Mvc\Router\Http\RouteMatch;
use StumpSecurity\Util\Arrays;

class Verifier
{
    private $config;

    /**
     * @var RouteMatch
     */
    private $routeMatch;

    public function __construct($config, RouteMatch $rm)
    {
        $this->config     = $config;
        $this->routeMatch = $rm;
    }

    /**
     * @param $component
     * @return bool
     */
    public function canApply($component, $config = null)
    {
        $config = is_null($config) ? $this->config : $config;

        $include = (array) Arrays::getRecursive($config, ((string) $component) . ".include");
        $exclude = (array) Arrays::getRecursive($config, ((string) $component) . ".exclude");

        $controller = $this->routeMatch->getParam('controller');
        $action = $this->routeMatch->getParam('action');

        if(in_array($controller, $include))
        {
            return true;
        }

        if(in_array($controller, $exclude))
        {
            return false;
        }


        return true;
    }
} 