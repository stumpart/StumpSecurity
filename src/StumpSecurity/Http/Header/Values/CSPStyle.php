<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Http\Header\Values;


class CSPStyle extends AValues
{

    const DIRECTIVE = 'style-src';


    public function __toString()
    {
        return $this->valueString;
    }
}