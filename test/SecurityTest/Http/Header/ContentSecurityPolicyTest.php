<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */

use StumpSecurity\Http\Header\ContentSecurityPolicy;
use StumpSecurity\Defenses\Verifier;
use Zend\Mvc\Router\Http\RouteMatch;

class ContentSecurityPolicyTest extends PHPUnit_Framework_TestCase
{
  private $securityPolicy;

  public function setUp()
  {
      $config = array(
          'xss' => array(
            'allow'=>array(
                'scripts'=> array('http://barrygong.com', 'include'=>array('Application\Controller\Security')),
                'object' => array('http://catherine.com', 'exclude'=>array('Application\Controller\Security'))
            ),
          ),
      );

      $routeParams = array('__NAMESPACE__' => 'Application\Controller',
                            'controller' => 'Application\Controller\Security',
                            'action' => 'myjson',
                            '__CONTROLLER__'=>'security');

      $routeMatch = new RouteMatch($routeParams);
      $v = new Verifier($config['xss'], $routeMatch);
      $this->securityPolicy = new ContentSecurityPolicy($config['xss']);
      $this->securityPolicy->setVerifier($v);
  }

  public function testBuildDirectiveValues()
  {
    $this->securityPolicy->buildDirectiveValues();
  }
} 