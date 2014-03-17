<?php
/**
 * @file
 * vagrant_bakery.features.user_permission.inc
 */

/**
 * Implements hook_user_default_permissions().
 */
function vagrant_bakery_user_default_permissions() {
  $permissions = array();

  // Exported permission: 'administer bakery'.
  $permissions['administer bakery'] = array(
    'name' => 'administer bakery',
    'roles' => array(),
    'module' => 'bakery',
  );

  return $permissions;
}
