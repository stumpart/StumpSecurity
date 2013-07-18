<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Http\Header\Values;


class CSPImage extends AValues
{
    const DIRECTIVE     = 'img-src';

    public function __toString()
    {
        return $this->valueString;
    }
}