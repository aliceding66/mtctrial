<!doctype html>
<html>
  <head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name='keywords' content='php grid, php datagrid, php data grid, datagrid sample, datagrid php, datagrid, grid php, datagrid in php, data grid in php, free php grid, free php datagrid, datagrid paging' />
    <meta name='description' content='Advanced Power of PHP - using ApPHP DataGrid Pro for displaying some statistical data' />
    <meta name="author" content="ApPHP Company - Advanced Power of PHP">
    <meta name="generator" content="ApPHP DataGrid Pro">
    <title>ApPHP DataGrid :: Sample #1-1 (code)</title>
  </head>
<body style="padding:10px">
<?php

  ################################################################################   
  ## +---------------------------------------------------------------------------+
  ## | 1. Creating & Calling:                                                    | 
  ## +---------------------------------------------------------------------------+
  ##  *** define a relative (virtual) path to datagrid.class.php file
  ##  *** (relatively to the current file)
  ##  *** RELATIVE PATH ONLY ***     
    define('DATAGRID_DIR', '../datagrid/');                     
    require_once(DATAGRID_DIR.'datagrid.class.php');

    // includes database connection parameters
    include_once('install/config.inc.php');
    
    ob_start();      
  ##  *** set needed options
    $debug_mode = false;
    $messaging = true;
    $unique_prefix = "f_";  
    $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix);

  ##  *** set data source with needed options
  ##  *** put a primary key on the first place 
    $sql=" SELECT "  
    ." demo_countries.id, "
    ." demo_countries.name, "
    ." demo_countries.description, "
    ." demo_countries.picture_url, "
    ." FORMAT(demo_countries.population, 0) as population, "   
    ." CASE WHEN demo_countries.is_democracy = 1 THEN 'Yes' ELSE 'No' END as is_democracy "
    ."FROM demo_countries ";     
    $default_order = array("name"=>"ASC");
    $dgrid->DataSource("mysql", $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $sql, $default_order);             

    $dg_caption = '<b>Simplest ApPHP DataGrid</b> - <a href=index.php>Back to Index</a>';
    $dgrid->SetCaption($dg_caption);
    
  ## +---------------------------------------------------------------------------+
  ## | 6. View Mode Settings:                                                    | 
  ## +---------------------------------------------------------------------------+
  ##  *** set columns in view mode
    $dgrid->SetAutoColumnsInViewMode(true);  
    
  ## +---------------------------------------------------------------------------+
  ## | 7. Add/Edit/Details Mode settings:                                        | 
  ## +---------------------------------------------------------------------------+
  ##  ***  set settings for edit/details mode
    $table_name = "demo_countries";
    $primary_key = "id";
    $condition = "";
    $dgrid->SetTableEdit($table_name, $primary_key, $condition);
    $dgrid->SetAutoColumnsInEditMode(true);
      
  ## +---------------------------------------------------------------------------+
  ## | 8. Bind the DataGrid:                                                     | 
  ## +---------------------------------------------------------------------------+
  ##  *** set debug mode & messaging options
    $dgrid->Bind();        
    ob_end_flush();
    
?>
</body>
</html>