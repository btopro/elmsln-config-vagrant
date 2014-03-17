<?php
/**
 * @file
 * vagrant_bakery.strongarm.inc
 */

/**
 * Implements hook_strongarm().
 */
function vagrant_bakery_strongarm() {
  $export = array();

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'bakery_domain';
  $strongarm->value = '.elmsln.local';
  $export['bakery_domain'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'bakery_freshness';
  $strongarm->value = '3600';
  $export['bakery_freshness'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'bakery_help_text';
  $strongarm->value = 'Otherwise you can contact the site administrators.';
  $export['bakery_help_text'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'bakery_is_master';
  $strongarm->value = 1;
  $export['bakery_is_master'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'bakery_key';
  $strongarm->value = 'XvdKenJVjZzcdKRo9LsWuDtfXLIlOvnLk9ZWQsUeBt8L9f4Mlq';
  $export['bakery_key'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'bakery_master';
  $strongarm->value = 'http://online.elmsln.local/';
  $export['bakery_master'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'bakery_slaves';
  $strongarm->value = array(
    0 => 'http://courses.elmsln.local/',
    1 => 'http://studio.elmsln.local/',
    2 => 'http://media.elmsln.local/',
    3 => 'http://interact.elmsln.local/',
  );
  $export['bakery_slaves'] = $strongarm;

  $strongarm = new stdClass();
  $strongarm->disabled = FALSE; /* Edit this to true to make a default strongarm disabled initially */
  $strongarm->api_version = 1;
  $strongarm->name = 'bakery_supported_fields';
  $strongarm->value = array(
    'name' => 'name',
    'mail' => 'mail',
    'status' => 'status',
    'picture' => 'picture',
    'language' => 0,
    'signature' => 0,
  );
  $export['bakery_supported_fields'] = $strongarm;

  return $export;
}
