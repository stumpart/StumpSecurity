<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Http\Header\Values;


class CSPFrame extends AValues
{
    const DIRECTIVE   = 'frame-src';

    public function __toString()
    {
        return $this->valueString;
    }
}