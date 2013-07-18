<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Http\Header\Values;


class CSPObject extends AValues
{
    const DIRECTIVE  = 'object-src';


    public function __toString()
    {
        return $this->valueString;
    }
}