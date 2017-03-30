<?php

$config = array(
  // URL
  'url_base' => 'https://sean-choi.000webhostapp.com/project3/eshopjan/',

  // database
  'db_host' => 'localhost',
  'db_database' => 'bootcamp_eshop',
  'db_user' => 'root',
  'db_pass' => '',
  'db_charset' => 'utf8',

  // SMARTY
  'smarty_config_dir' => CONFIG_DIR.'/smarty_config',
  'smarty_template_dir' => VIEWS_DIR,
  'smarty_compile_dir' => CACHE_DIR.'/smarty_compile',
  'smarty_cache_dir' => CACHE_DIR.'/smarty_cache',

  // i18n
  'languages' => array(
    'en' => 'English', 
    'cs' => 'Czech'
  ),
  'default_language' => 'en'
);