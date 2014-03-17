<?php
/**
 * @file
 * vagrant_piwik.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function vagrant_piwik_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}
