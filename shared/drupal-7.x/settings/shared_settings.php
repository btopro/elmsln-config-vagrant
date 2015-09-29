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

// Allow RestWS calls to pass through on bakery installs, otherwise webservices
// reroute looking for the bakery login cookie and fail.
// If bakery isn't installed this does nothing and can be ignored.
if (isset($conf['restws_basic_auth_user_regex'])) {
  $conf['bakery_is_master'] = TRUE;
}

// httprl setting to avoid really long timeouts
$conf['httprl_install_lock_time'] = 1;
// make authcache happy with the safer controller if we're using it
$conf['authcache_p13n_frontcontroller_path'] = 'authcache.php';

# env indicator - useful when working on multiple environments
#$conf['environment_indicator_overwrite'] = TRUE;
#$conf['environment_indicator_overwritten_name'] = 'Dev: Local';
#$conf['environment_indicator_overwritten_color'] = '#42b96a';
# APC cache backend
# Comment this back in for apc super fast support, not all systems support this

#$conf['apc_show_debug'] = TRUE;
$conf['cache_backends'][] = 'sites/all/modules/ulmus/apdqc/apdqc.cache.inc';
#$conf['cache_backends'][] = 'sites/all/modules/ulmus/apc/drupal_apc_cache.inc';
$conf['cache_backends'][] = 'sites/all/modules/ulmus/authcache/authcache.cache.inc';
$conf['cache_backends'][] = 'sites/all/modules/ulmus/authcache/modules/authcache_builtin/authcache_builtin.cache.inc';

#$conf['session_inc'] = 'sites/all/modules/ulmus/apdqc/apdqc.session.inc';
#$conf['lock_inc'] = 'sites/all/modules/ulmus/apdqc/apdqc.lock.inc';
/*
# APC as default, so these can be commented out
$conf['cache_class_cache'] = 'DrupalAPCCache';
$conf['cache_class_cache_admin_menu'] = 'DrupalAPCCache';
$conf['cache_class_cache_block'] = 'DrupalAPCCache';
$conf['cache_class_cache_bootstrap'] = 'DrupalAPCCache';
$conf['cache_class_cache_entity_file'] = 'DrupalAPCCache';
$conf['cache_class_cache_entity_og_membership'] = 'DrupalAPCCache';
$conf['cache_class_cache_entity_og_membership_type'] = 'DrupalAPCCache';
$conf['cache_class_cache_field'] = 'DrupalAPCCache';
$conf['cache_class_cache_menu'] = 'DrupalAPCCache';
$conf['cache_class_cache_libraries'] = 'DrupalAPCCache';
$conf['cache_class_cache_token'] = 'DrupalAPCCache';
$conf['cache_class_cache_views'] = 'DrupalAPCCache';
$conf['cache_class_cache_path_breadcrumbs'] = 'DrupalAPCCache';
$conf['cache_class_cache_path'] = 'DrupalAPCCache';
$conf['cache_class_cache_book'] = 'DrupalAPCCache';
*/
# Default DB for the ones that change too frequently and are small
$conf['cache_default_class']    = 'APDQCache';
# THIS MUST BE SERVED FROM DB FOR STABILITY
$conf['cache_class_cache_cis_connector'] = 'APDQCache';
$conf['cache_class_cache_form'] = 'APDQCache';

// this is assuming all databases using this file operate off of default
// this should always be true of ELMSLN connected systems but just be aware
// of this in case your doing any prefixing or crazy stuff like connecting to
// multiple databases
$databases['default']['default']['init_commands']['isolation'] = "SET SESSION tx_isolation='READ-COMMITTED'";
$databases['default']['default']['init_commands']['lock_wait_timeout'] = "SET SESSION innodb_lock_wait_timeout = 20";
$databases['default']['default']['init_commands']['wait_timeout'] = "SET SESSION wait_timeout = 600";

// fast 404 to make advagg happy in the event fast 404 is default
// we may do this in the future, right now just make sure the setting is correct
//$conf['404_fast_paths_exclude'] = '/\/(?:styles)\// to /\/(?:styles|advagg_(cs|j)s)\//';