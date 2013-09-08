<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Barrington Henry <stump500@gmail.com>
 */

namespace StumpSecurity\Http\Header;
namespace Zend\Http\Header;

class StrictTransportSecurity implements HeaderInterface
{
    const HEADER_FIELD = 'Strict-Transport-Security';

    private $data;

    public function __construct()
    {

    }

    public static function fromString($headerLine)
    {

    }

    public function getFieldName()
    {
        return HEADER_FIELD;
    }

    public function getFieldValue()
    {
        return implode('; ', $this->data);
    }

    public function toString()
    {
        return static::HEADER_FIELD.': ' . $this->getFieldValue();
    }

    public function IncludeSubDomains()
    {

    }
}