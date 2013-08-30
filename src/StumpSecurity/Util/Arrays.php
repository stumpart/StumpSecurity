<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */

namespace StumpSecurity\Util;

class Arrays
{
    /**
     * @param array $subject
     * @param string $level
     * @return null
     */
    public static function getRecursive(array $subject, $level)
    {
        $levelExplode = explode(".", $level);
        $key = array_shift($levelExplode);

        if(empty($levelExplode))
        {
            return array_key_exists($key, $subject) ? $subject[$key] : null;
        }
        else
        {
           return self::getRecursive($subject[$key], implode('.', $levelExplode));
        }
    }
} 