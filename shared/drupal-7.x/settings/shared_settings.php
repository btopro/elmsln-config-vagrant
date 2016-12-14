<?php

// fastest way to get tincan integration across the network
// $conf['tincanapi_endpoint'] = '';
// $conf['tincanapi_auth_user'] = '';
// $conf['tincanapi_auth_password'] = '';

// Provide an exit function to prevent WSOD scenarios.
// This ensures you always see an error message if you get one
// which is incredibly useful when pushing code into a Vagrant instance
// for testing and development.
function __the_end(){
    if(($err=error_get_last()))
        die('<pre>'.print_r($err,true).'</pre>');
}
register_shutdown_function('__the_end');

# env indicator - useful when working on multiple environments
$conf['environment_indicator_overwrite'] = TRUE;
$conf['environment_indicator_overwritten_name'] = 'Vagrant';
$conf['environment_indicator_overwritten_color'] = '#42b96a';

// enable this to support the legacy zurb foundation components
//$conf['foundation_access_legacy'] = TRUE;

// settings for mariadb with APDQC
//$databases['default']['default']['mysql_db_type'] = 'mariadb';
