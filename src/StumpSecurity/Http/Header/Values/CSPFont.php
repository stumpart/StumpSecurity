<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Http\Header\Values;


class CSPFont extends AValues
{
    const DIRECTIVE    = 'font-src';

    public function __toString()
    {
        return $this->valueString;
    }
}