<?php
# env indicator - useful when working on multiple environments
$conf['environment_indicator_overwrite'] = TRUE;
$conf['environment_indicator_overwritten_name'] = 'Dev: Vagrant';
$conf['environment_indicator_overwritten_color'] = '#42b96a';

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

# APC cache backend
#$conf['apc_show_debug'] = TRUE;
# EVERYTHING COMMENTED OUT FOR VAGRANT HAPPINESS
/*
$conf['cache_backends'][] = 'sites/all/modules/ulmus/apc/drupal_apc_cache.inc';
# APC as default container, others are targetted per bin
#$conf['cache_default_class'] = 'DrupalAPCCache';
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

# Default DB for the ones that change too frequently and are small
$conf['cache_default_class']    = 'DrupalDatabaseCache';
# THIS MUST BE SERVED FROM DB FOR STABILITY
$conf['cache_class_cache_cis_connector'] = 'DrupalDatabaseCache';
$conf['cache_class_cache_form'] = 'DrupalDatabaseCache';
*/

// this is assuming all databases using this file operate off of default
// this should always be true of ELMSLN connected systems but just be aware
// of this in case your doing any prefixing or crazy stuff like connecting to
// multiple databases
$databases['default']['default']['init_commands'] = array(
  'isolation' => "SET SESSION tx_isolation='READ-COMMITTED'"
);

// fast 404 to make advagg happy in the event fast 404 is default
// we may do this in the future, right now just make sure the setting is correct
//$conf['404_fast_paths_exclude'] = '/\/(?:styles)\// to /\/(?:styles|advagg_(cs|j)s)\//';
