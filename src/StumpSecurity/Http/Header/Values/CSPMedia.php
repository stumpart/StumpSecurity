<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Http\Header\Values;


class CSPMedia extends AValues
{
    const DIRECTIVE   = 'media-src';

    public function __toString()
    {
        return $this->valueString;
    }
}