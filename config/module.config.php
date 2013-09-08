<?php

return array(
    'clickjacking' => array(
        'allowed-frame' => array(
            'http://barrygong.com/'
        )
    ),
    'force-https'  => array(
        'expire-time'=>17280
    ),
    'cross-origin'=> array(
        'allow'=>array(
            'headers'=>'X-PINGOTHER',
            'methods'=>'POST,GET,OPTIONS',
            'max-age'=>''
        ),
        'include' => array(
            'Application\Controller\Security'
        ),
    ),
    'xss' => array(
        'allow'=>array(
            'scripts' => array('http://barrygong.com/js','http://localhost:10088/js/','http://ajax.googleapis.com', 'inline', 'eval'),
            'object'  => array('http://barrygong.com'),
            'style'   => array('http://micoballer2003.com', 'http://localhost:10088/css/', 'inline')
        ),
        'include' => array(
            'Application\Controller\Security'
        ),
    ),
    'violation-reports' => array(
        'csp' => array(
            'uri'=>'http://barrygong.com/application/security/violation'
        )
    )
);