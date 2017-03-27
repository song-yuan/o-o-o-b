<?php
return array(    
    'common' => array(
        'uploads' => array(
            'storage' => 'local',
            'webpath' => './uploads/images',
        ),
        'allow' => array(
            'image/gif', 
            'image/jpg', 
            'image/jpeg', 
            'image/png'
        ),
        'size' => '10000', 
        'has_thrumb' => false,
        'thrumbs' => array(),
    ),
    
    'bills' => array(
        'uploads' => array(
            'storage' => 'local',
            'webpath' => './uploads/bills',
        ),
        'allow' => array(
            'application/vnd.ms-excel',
            'application/vnd.ms-office',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ),
        'size' => '10000',
        'has_thrumb' => false,
        'thrumbs' => array(),
    ),
);