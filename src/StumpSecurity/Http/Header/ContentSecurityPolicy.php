<?php

namespace StumpSecurity\Http\Header;

use StumpSecurity\Defenses\Componentized;
use StumpSecurity\Defenses\Verifier;
use StumpSecurity\Defenses\VerifierAwareInterface;
use StumpSecurity\Util\Arrays;
use StumpSecurity\Http\Header\Values\ValuesInterface;
use Zend\File\Exception\InvalidArgumentException;
use Zend\Http\Header\HeaderInterface;
use Zend\Stdlib\ArrayObject;


/**
 * Class ContentSecurityPolicy
 * @package Zend\Http\Header
 *
 * @method void setDefaultSrc()
 * @link http://www.w3.org/TR/CSP/
 *
 */
class ContentSecurityPolicy implements
    HeaderInterface,
    ValuesInterface,
    Componentized
    //VerifierAwareInterface
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

    /**
     * @var \StumpSecurity\Defenses\Verifier
     */
    private $verifier;

    /**
     * @var string
     */
    private $component;

    public function __construct( array $array = array())
    {
        $this->setConfig($array);
    }

    public static function fromString($headerLine)
    {
        $header = new static();
        return $header;
    }

    public function execute()
    {
        $this->buildDirectiveValues();
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function buildDirectiveValues()
    {
        if(is_null($this->verifier)){
            throw new \InvalidArgumentException('Verifier is null');
        }

        $this->handleDirectiveXSS();
        $this->handleDirectiveViolationReport();
    }

    private function handleDirectiveXSS()
    {
        $allowing = Arrays::getRecursive($this->config, 'allow');

        if(is_array($allowing))
        {
            foreach($allowing as $key=>$value)
            {
                $this->addValue($key, $value);
            }
        }
    }

    private function handleDirectiveViolationReport()
    {
        $allowing = Arrays::getRecursive($this->config, 'violation-reports.csp.uri');

        if(!is_null($allowing))
        {
            $this->addValue('report', array($allowing));
        }
    }

    private function addValue($classKey, $value)
    {
        if($this->verifier->canApply("allow.".$classKey))
        {
            $keyClass = __NAMESPACE__.'\Values\CSP'.ucfirst($classKey);
            $valuesInst = new $keyClass($this);
            $valuesInst->setValues($value)->generate();
            $this->data[]  = $valuesInst;
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

    public function setVerifier(Verifier $v)
    {
        $this->verifier = $v;
    }

    /**
     * @param string $comp
     * @return void
     */
    public function setComponent($comp)
    {
        $this->component = $comp;
    }
}