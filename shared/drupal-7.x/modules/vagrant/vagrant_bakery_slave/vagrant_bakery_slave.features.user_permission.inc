<?php
/**
 * @file
 * vagrant_bakery_slave.features.user_permission.inc
 */

/**
 * Implements hook_user_default_permissions().
 */
function vagrant_bakery_slave_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'administer bakery'.
  $permissions['administer bakery'] = array(
    'name' => 'administer bakery',
    'roles' => array(
      'administrator' => 'administrator',
    ),
    'module' => 'bakery',
  );

  // Exported permission: 'bypass bakery'.
  $permissions['bypass bakery'] = array(
    'name' => 'bypass bakery',
    'roles' => array(
      'SERVICE ACCOUNT' => 'SERVICE ACCOUNT',
      'administrator' => 'administrator',
    ),
    'module' => 'bakery',
  );

  return $permissions;
}
