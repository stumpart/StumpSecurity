<?php
/**
 * Created by JetBrains PhpStorm.
 * User: barringtonhenry
 * Date: 7/4/13
 *
 * @link
 */

namespace StumpSecurity\Http\Header;
namespace Zend\Http\Header;

use StumpSecurity\Defenses\Verifier;
use StumpSecurity\Defenses\VerifierAwareInterface;

class ContentSecurityPolicyReport implements HeaderInterface, VerifierAwareInterface
{
    const HEADER_FIELD = 'Content-Security-Policy-Report-Only';


    public static function fromString($headerLine)
    {

    }

    public function getFieldName()
    {

    }

    public function getFieldValue()
    {

    }

    public function toString()
    {

    }

    public function setVerifier(Verifier $v)
    {
        // TODO: Implement setVerifier() method.
    }
}