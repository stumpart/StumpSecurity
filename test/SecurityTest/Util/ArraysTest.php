<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */

namespace SecurityTest\Util;
use PHPUnit_Framework_TestCase;
use StumpSecurity\Util\Arrays;


class ArraysTest extends PHPUnit_Framework_TestCase
{
    private $arr;

    public function setUp()
    {
        $this->arr = array(
            'xss'=>array(
                'csp'=>array(
                    'sdf'
                ),
                'cors'=>array(
                    'reports'=> 'http://somesite'
                )
            )
        );
    }

    public function testGetRecursive()
    {
        $res = Arrays::getRecursive($this->arr, 'xss.cors.reports');
        $this->assertEquals($res, "http://somesite");
    }

    public function testGetRecursiveKeyNotExists()
    {
        $res = Arrays::getRecursive($this->arr, 'violation-reports.csp.uri');
        $this->assertNull($res);
    }
} 