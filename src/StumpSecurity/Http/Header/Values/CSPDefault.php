<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Http\Header\Values;


class CSPDefault extends AValues
{
    const DIRECTIVE = 'default-src';

    public function __toString()
    {
        return $this->valueString;
    }
}