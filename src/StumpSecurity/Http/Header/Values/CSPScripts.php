<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Http\Header\Values;


class CSPScripts extends AValues
{

    const DIRECTIVE  = 'script-src';


    public function __toString()
    {
        return $this->valueString;
    }
}