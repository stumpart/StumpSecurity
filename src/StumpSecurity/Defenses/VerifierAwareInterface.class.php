<?php
/**
 * @author Barrington Henry <stump500@gmail.com>
 */


namespace StumpSecurity\Defenses;


interface VerifierAwareInterface
{
    public function setVerifier( Verifier $v);
} 