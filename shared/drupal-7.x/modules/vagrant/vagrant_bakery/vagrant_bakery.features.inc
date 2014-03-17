<?php
/**
 * @file
 * vagrant_bakery.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function vagrant_bakery_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}
