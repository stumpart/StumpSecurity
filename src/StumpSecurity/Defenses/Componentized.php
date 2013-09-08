<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Defenses;


interface Componentized
{
    /**
     * @param string $comp
     * @return void
     */
    public function setComponent($comp);
} 