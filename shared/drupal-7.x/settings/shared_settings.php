<?php

// Provide an exit function to prevent WSOD scenarios.
// This ensures you always see an error message if you get one
// which is incredibly useful when pushing code into a Vagrant instance
// for testing and development.
function __the_end(){
    if(($err=error_get_last()))
        die('<pre>'.print_r($err,true).'</pre>');
}
register_shutdown_function('__the_end');

// forcibly override the connection credentials to be happy w/ vagrant
$cfg = file_get_contents('/var/www/elmsln/config/scripts/drush-create-site/config.cfg');
$lines = explode("\n", $cfg);
// read each line of the config file
foreach ($lines as $line) {
  // make sure this line isn't a comment and has a=
  if (strpos($line, '#') !== 0 && strpos($line, '=')) {
    $tmp = explode('=', $line);
    // ensure we have 2 settings before doing this
    if (count($tmp) == 2) {
      // set user to super
      if ($tmp[0] == 'dbsu') {
        // strip encapsulation if it exists
        $databases['default']['default']['username'] = str_replace('"', '', str_replace("'", '', $tmp[1]));
      }
      // set password to super
      if ($tmp[0] == 'dbsupw') {
        // strip encapsulation if it exists
        $databases['default']['default']['password'] = str_replace('"', '', str_replace("'", '', $tmp[1]));
      }
    }
  }
}

$databases['default']['default']['host'] = 'localhost';
$databases['default']['default']['port'] = '';

# env indicator - useful when working on multiple environments
$conf['environment_indicator_overwrite'] = TRUE;
$conf['environment_indicator_overwritten_name'] = 'Dev: Local';
$conf['environment_indicator_overwritten_color'] = '#42b96a';

// fast 404 to make advagg happy in the event fast 404 is default
// we may do this in the future, right now just make sure the setting is correct
//$conf['404_fast_paths_exclude'] = '/\/(?:styles)\// to /\/(?:styles|advagg_(cs|j)s)\//';
// enable this to support the legacy zurb foundation components
//$conf['foundation_access_legacy'] = TRUE;
