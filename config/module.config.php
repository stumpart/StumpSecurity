<?php

return array(
    'clickjacking' => array(
        'allowed-frame' => array(
            'http://barrygong.com/'
        )
    ),
    'ensurehttps'  => array(

    ),
    'cross-origin '=> array(

    ),
    'xss' => array(
        'allow'=>array(
            'scripts' => array('http://barrygong.com/js', 'http://barrymedia.com/js', 'inline', 'eval'),
            'object' => array('http://barrygong.com'),
            'style'   => array('http://micoballer2003.com', 'http://localhost:10088/css/', 'inline'),
            //'image'   => array(),
        )
    ),
    'violation-reports' =>array(
        'csp'=>array(
            'uri'=>'http://barrygong.com/application/security/violation'
        )
    )
);