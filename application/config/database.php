<?php defined('SYSPATH') or die('No direct access allowed.');
 

return array
(
    'default' => array
    (
        'type'       => 'MySQL',
        'connection' => array(
            'hostname'   => 'localhost',
            'username'   => 'username',
            'password'   => 'password',
            'persistent' => FALSE,
            'database'   => 'kaltura',
        ),
        'table_prefix' => '',
        'charset'      => 'utf8',
        'profiling'    => TRUE,
    ),
);