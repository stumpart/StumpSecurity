<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */

namespace SecurityTest\Util;
use PHPUnit_Framework_TestCase;
use StumpSecurity\Util\Arrays;


class ArraysTest extends PHPUnit_Framework_TestCase
{
    public function testGetRecursive()
    {
       $arr = array(
           'xss'=>array(
               'csp'=>array(
                   'sdf'
               ),
               'cors'=>array(
                   'reports'=> 'http://somesite'
               )
           )
       );

        $res = Arrays::getRecursive($arr, 'xss.cors.reports');

        $this->assertEquals($res, "http://somesite");
    }
} 