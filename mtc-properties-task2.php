<?php

add_action( 'admin_menu', 'register_my_custom_menu_page' );
function register_my_custom_menu_page() {
  // add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
  add_menu_page( 'Properties Page Title', 'Properties Page', 'manage_options','my_custom_menu_page', 'my_custom_menu_page', 'dashicons-welcome-widgets-menus', 90 );
}

/**
 * Display a custom menu page
 */
function my_custom_menu_page(){
  ## +---------------------------------------------------------------------------+
  ## | 1. Creating & Calling:                                                    |
  ## +---------------------------------------------------------------------------+
  ##  *** define a relative (virtual) path to datagrid.class.php file
  ##  *** directory (relatively to the current file)
  ##  *** RELATIVE PATH ONLY ***
  define ("DATAGRID_DIR", "PHPDG/datagrid/");  
  define ("DATAGRID_DIR2",get_template_directory_uri()."/PHPDG/datagrid/");
  
  require_once(get_template_directory()."/".DATAGRID_DIR."datagrid.class.php");
    
  ##  *** creating variables that we need for database connection    
  require get_template_directory().'/properties.config';   
   
  ##  *** set needed options and create a new class instance
  $debug_mode = false;        /* display SQL statements while processing */    
  $messaging = true;          /* display system messages on a screen */
  $unique_prefix = "f_";      /* prevent overlays - must be started with a letter */
  $dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix);
      
  ##  *** put a primary key on the first place
  $sql=" SELECT "
   ."id, "
   ."uuid, "
   ."county, "
   ."country, "
   ."town, "
   ."description, "
   ."address, "
   ."image_full, "
   ."num_bedrooms, "
   ."num_bathrooms, "
   ."price, "
   ."property_type, "  
   ."type "
   ."FROM Properties";
   
  ##  *** set data source with needed options
  $default_order = array("id"=>"DESC");
  $dgrid->DataSourceNew(array("PDO", "mysql", $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $sql, $default_order));
      
  $dgrid->isDemo = true;
   
  ## +---------------------------------------------------------------------------+
  ## | 2. General Settings:                                                      |
  ## +---------------------------------------------------------------------------+
  ##  *** set interface language (default - English)
  $dgrid->SetInterfaceLang("en");
  ##  *** set layouts: 0 - tabular(horizontal) - default, 1 - columnar(vertical)
  $dgrid->SetLayouts(array("view"=>0, "edit"=>1, "filter"=>1));
  ##  *** set modes for operations ("type" => "link|button|image")
  ##  *** "byFieldValue"=>"fieldName" - make the field to be a link to edit mode page
  $modes = array(
    "add" =>array("view"=>true, "edit"=>false, "type"=>"link"),
    "edit" =>array("view"=>true, "edit"=>true,  "type"=>"link", "byFieldValue"=>""),
    "details" =>array("view"=>true, "edit"=>false, "type"=>"link"),
    "delete" =>array("view"=>true, "edit"=>true,  "type"=>"image")
  );
  $dgrid->SetModes($modes);
  ##  *** allow mulirow operations
  $multirow_option = true;
  $dgrid->AllowMultirowOperations($multirow_option);
  $multirow_operations = array(
    "edit"  => array("view"=>false),
    "delete"  => array("view"=>true),
    "details" => array("view"=>true)
  );
  $dgrid->SetMultirowOperations($multirow_operations);  
  ##  *** set CSS class for datagrid
  $dgrid->SetCssClass("default");
  ##  *** set other datagrid/s unique prefixes (if you use few datagrids on one page)
  $anotherDatagrids = array("fp_"=>array("view"=>false, "edit"=>true, "details"=>true));
  $dgrid->SetAnotherDatagrids($anotherDatagrids);  
  ##  *** set DataGrid caption
  $dg_caption = "<b>Properties List</b>";
  $dgrid->SetCaption($dg_caption);
   
  ## +---------------------------------------------------------------------------+
  ## | 3. Printing & Exporting Settings:                                         |
  ## +---------------------------------------------------------------------------+
  ##  *** set printing option: true(default) or false
  $dgrid->AllowPrinting(true);
   
  ## +---------------------------------------------------------------------------+
  ## | 4. Sorting & Paging Settings:                                             |
  ## +---------------------------------------------------------------------------+
  ##  *** set sorting option: true(default) or false
  $dgrid->AllowSorting(true);              
  ##  *** set paging option: true(default) or false
  $paging_option = true;
  $rows_numeration = false;
  $numeration_sign = "N #";      
  $dgrid->AllowPaging($paging_option, $rows_numeration, $numeration_sign);
  ##  *** set paging settings
  $bottom_paging = array("results"=>true, "results_align"=>"left", "pages"=>true, "pages_align"=>"center", "page_size"=>true, "page_size_align"=>"right");
  $top_paging = array();
  $pages_array = array("10"=>"10", "25"=>"25", "50"=>"50", "100"=>"100", "250"=>"250", "500"=>"500", "1000"=>"1000");
  $default_page_size = 10;
  $dgrid->SetPagingSettings($bottom_paging, $top_paging, $pages_array, $default_page_size);

  ## +---------------------------------------------------------------------------+
  ## | 5. Filter Settings:                                                       |
  ## +---------------------------------------------------------------------------+
  ##  *** set filtering option: true or false(default)
  $filtering_option = false;
  $dgrid->AllowFiltering($filtering_option);    
      
      
  ## +---------------------------------------------------------------------------+
  ## | 6. View Mode Settings:                                                    |
  ## +---------------------------------------------------------------------------+
  ##  *** set columns in view mode
  $vm_columns = array(
    "uuid" => array("header"=>"UUID", "type"=>"label", "width"=>"130px", "align"=>"left", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
    "county" => array("header"=>"County", "type"=>"label", "width"=>"130px", "align"=>"left", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
    "country" => array("header"=>"Country", "type"=>"linktoedit", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
    "town" => array("header"=>"Town", "type"=>"linktoedit", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
    "description" => array("header"=>"Description","type"=>"label", "align"=>"left", "wrap"=>"nowrap", "text_length"=>"25", "case"=>"lower"),
    "address" => array("header"=>"Displayable Address","type"=>"label", "align"=>"left", "wrap"=>"nowrap", "text_length"=>"25", "case"=>"lower"),
    "image_full" => array("header"=>"Picture", "type"=>"image", "align"=>"center", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>"", "target_path"=>"uploads/", "default"=>"", "image_width"=>"17px", "image_height"=>"17px"),
    "num_bedrooms" => array("header"=>"Number of bedrooms", "type"=>"label", "summarize"=>true, "align"=>"right", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
    "num_bathrooms" => array("header"=>"Number of bathrooms", "type"=>"label", "summarize"=>true, "align"=>"right", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
    "price" => array("header"=>"Price", "type"=>"label", "width"=>"130px", "align"=>"left", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
    "property_type" => array("header"=>"Property Type", "type"=>"label", "summarize"=>true, "align"=>"right", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
    "type" => array("header"=>"Sale or Rent", "type"=>"label", "summarize"=>true, "align"=>"right", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal")
  );
      

  $dgrid->SetColumnsInViewMode($vm_columns);
      
  ## +---------------------------------------------------------------------------+
  ## | 7. Add/Edit/Details Mode Settings:                                        |
  ## +---------------------------------------------------------------------------+
  ##  *** set add/edit mode table properties
  $em_table_properties = array("width"=>"70%");
  $dgrid->SetEditModeTableProperties($em_table_properties);
  ##  *** set details mode table properties
  $dm_table_properties = array("width"=>"70%");
  $dgrid->SetDetailsModeTableProperties($dm_table_properties);
  ##  ***  set settings for add/edit/details modes
  $table_name  = "Properties";
  $primary_key = "id";
  $condition   = "";
  $dgrid->SetTableEdit($table_name, $primary_key, $condition);
  ##  *** set columns in edit mode
  $fill_from_array = array("1"=>"1", "2"=>"2", "3"=>"3", "4"=>"4", "5"=>"5", "6"=>"6", "7"=>"7", "8"=>"8", "9"=>"9", "10"=>"10");
  $property_type_array = array("Cottage"=>"Cottage", "Bungalow"=>"Bungalow", "Flat"=>"Flat", "Terraced"=>"Terraced", "Detatched"=>"Detatched", "End of Terrace"=>"End of Terrace", "Semi-detached"=>"Semi-detached");
  $rent_sale_array = array("0"=>"rent", "1"=>"sale");
  $em_columns = array(
    "uuid" => array("header"=>"UUID", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"County Name", "unique"=>true),
    "county" => array("header"=>"County", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"County Name", "unique"=>true),
    "country" => array("header"=>"Country", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"Country Name", "unique"=>true),
    "town" => array("header"=>"Town", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"Town Name", "unique"=>true),
    "description" => array("header"=>"Description", "type"=>"textarea", "width"=>"210px", "req_type"=>"rt", "title"=>"Description", "edit_type"=>"wysiwyg", "rows"=>"7", "cols"=>"50"),
    "address" => array("header"=>"Displayable Address", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"Address", "unique"=>true),
    "image_full" => array("header"=>"Image", "type"=>"image", "req_type"=>"st", "width"=>"210px", "title"=>"Image", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "on_js_event"=>"", "target_path"=>"uploads/", "max_file_size"=>"100K", "image_width"=>"100px", "image_height"=>"100px", "file_name"=>"", "host"=>"local"),
    "num_bedrooms" => array("header"=>"Number of bedrooms", "type"=>"enum", "source"=>$fill_from_array, "view_type"=>"dropdownlist", "width"=>"", "req_type"=>"ri", "title"=>"Number (Bedrooms)"),
    "num_bathrooms" => array("header"=>"Number of bathrooms", "type"=>"enum", "source"=>$fill_from_array, "view_type"=>"dropdownlist", "width"=>"", "req_type"=>"ri", "title"=>"Number (Bathrooms)"),
    "price" => array("header"=>"Price", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"Price", "unique"=>true),
    "property_type" => array("header"=>"Property Type", "type"=>"enum", "source"=>$property_type_array, "view_type"=>"dropdownlist", "width"=>"", "req_type"=>"ri", "title"=>"Type (Properties)"),
    "type" => array("header"=>"Sale or Rent", "type"=>"enum", "source"=>$rent_sale_array, "view_type"=>"radiobutton", "default" => 0, "width"=>"", "req_type"=>"ri", "title"=>"Type (Properties)"), 
    
  ##   "type"   =>array("header"=>"For Sale / For Rent", "type"=>"enum", "req_type"=>"rr", "width"=>"210px", "title"=>"For Sale / For Rent", "readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true", "on_js_event"=>"", "source"=>"self", "view_type"=>"radiobutton", "elements_alignment"=>"horizontal", "multiple"=>"false", "multiple_size"=>"4"),
  );
  $dgrid->SetColumnsInEditMode($em_columns);
      
      
      
  $dgrid->Bind();      
}

?>