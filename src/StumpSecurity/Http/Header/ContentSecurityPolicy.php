<?php

namespace StumpSecurity\Http\Header;

use Zend\Http\Header\HeaderInterface;
use StumpSecurity\Http\Header\Values\ValuesInterface;
use Zend\Stdlib\ArrayObject;

/**
 * Class ContentSecurityPolicy
 * @package Zend\Http\Header
 *
 * @method void setDefaultSrc()
 * @link http://www.w3.org/TR/CSP/
 *
 */
class ContentSecurityPolicy implements HeaderInterface,ValuesInterface
{
    const HEADER_FIELD = 'Content-Security-Policy';

    const KEYWORD_SELF          = "'self'";
    const KEYWORD_UNSAFE_INLINE = "'unsafe-inline'";
    const KEYWORD_UNSAFE_EVAL   = "'unsafe-eval'";

    const INLINE                = 'inline';
    const E_EVAL                = 'eval';
    const E_SELF                = 'self';

    private $keyMapping     = array(
        self::INLINE => self::KEYWORD_UNSAFE_INLINE,
        self::E_EVAL => self::KEYWORD_UNSAFE_EVAL,
        self::E_SELF => self::KEYWORD_SELF
    );

    private $data = array();

    private $config = array();

    public function __construct( array $array = array())
    {
        $this->setConfig($array);
        $this->buildDirectiveValues();
    }

    public static function fromString($headerLine)
    {
        $header = new static();
        return $header;
    }

    public function buildDirectiveValues()
    {
        if(array_key_exists('xss', $this->config))
        {
            if(array_key_exists('allow', $this->config['xss']))
            {
                $config = $this->config['xss']['allow'];
                //$config['default'] = array('self');

                foreach($config as $key=>$value)
                {
                    $keyClass = __NAMESPACE__.'\Values\CSP'.ucfirst($key);
                    $valuesInst = new $keyClass($this);
                    $valuesInst->setValues($value)->generate();
                    $this->data[]  = $valuesInst;
                }
            }
        }
    }

    public function getFieldName()
    {
        return static::HEADER_FIELD;
    }

    public function getFieldValue()
    {
        return implode('; ', $this->data);
    }

    public function toString()
    {
        return static::HEADER_FIELD.': ' . $this->getFieldValue();
    }

    public function setConfig($config)
    {
        $this->config = $config;
    }

    public function getKeywordMap()
    {
        return $this->keyMapping;
    }
}