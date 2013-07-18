<?php
/**
 * Created by JetBrains PhpStorm.
 * User: barringtonhenry
 * Date: 7/9/13
 * Time: 9:42 PM
 * To change this template use File | Settings | File Templates.
 */

namespace StumpSecurity\Http\Header;
namespace Zend\Http\Header;

class AccessControlMaxAge implements HeaderInterface
{
    const HEADER_FIELD = 'Access-Control-Max-Age';

    public static function fromString($headerLine)
    {
        // TODO: Implement fromString() method.
    }

    public function getFieldName()
    {
        // TODO: Implement getFieldName() method.
    }

    public function getFieldValue()
    {
        // TODO: Implement getFieldValue() method.
    }

    public function toString()
    {
        // TODO: Implement toString() method.
    }
}