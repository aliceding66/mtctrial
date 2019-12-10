<?php

/* Ex.: 'datagrid/' or '../datagrid/' */
define ('DATAGRID_DIR', '');                             
require_once(DATAGRID_DIR.'datagrid.class.php'); 
 
## +---------------------------------------------------------------------------+
## | 1. Creating & Calling:                                                    |
## +---------------------------------------------------------------------------+
##  *** define a relative (virtual) path to datagrid.class.php file
##  *** directory (relatively to the current file)
##  *** RELATIVE PATH ONLY ***
define ("DATAGRID_DIR", "datagrid/");                    
require_once(DATAGRID_DIR."datagrid.class.php");
 
##  *** creating variables that we need for database connection    
require 'properties.config';   
 
##  *** set needed options and create a new class instance
$debug_mode = false;        /* display SQL statements while processing */    
$messaging = true;          /* display system messages on a screen */
$unique_prefix = "f_";      /* prevent overlays - must be started with a letter */
$dgrid = new DataGrid($debug_mode, $messaging, $unique_prefix);
 
##  *** put a primary key on the first place
$sql=" SELECT "
 ."demo_countries.uuid, "
 ."demo_countries.county as county_name, "
 ."demo_regions.country as country_name, "
 ."demo_countries.town as town_name, "
 ."demo_countries.postcode as postcode_name, "
 ."demo_countries.description, "
 ."demo_countries.address as address_name, "
 ."demo_countries.image_full as picture_url, "
 ."demo_countries.bedroom as num_bedrooms, "
 ."demo_countries.bathroom as num_bathrooms, "
 ."demo_countries.price as price_value, "
 ."demo_countries.property_type as property_type, "  
 ."demo_countries.sale_rent as sale_rent "
 ."FROM Properties";
 
##  *** set data source with needed options
$default_order = array("id"=>"DESC");
$dgrid->DataSource("PDO", "mysql", $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS, $sql, $default_order);            
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
$dg_caption = "<b>Simple ApPHP DataGrid</b>";
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
$filtering_option = true;
$dgrid->AllowFiltering($filtering_option);
##  *** set aditional filtering settings
$fill_from_array = array("10000"=>"10000", "250000"=>"250000", "5000000"=>"5000000", "25000000"=>"25000000", "100000000"=>"100000000");
$sel_region = isset($_POST['sel_region']) ? $_POST['sel_region'] : "";
$country_condition = (!empty($sel_region)) ? "region_id=".(int)$sel_region : "";      
$filtering_fields = array(
  "Region" => array("type"=>"enum", "view_type"=>"dropdownlist", "table"=>"Properties",   "field"=>"id", "field_view"=>"name", "source"=>"self", "order"=>"DESC", "default_operator"=>"=", "default"=>$sel_region, "on_js_event"=>"onchange='".$unique_prefix."_doPostBack(\"reset\", 0, \"&sel_region=\"+this.value)'"),
  "Country" => array("type"=>"enum", "view_type"=>"dropdownlist", "table"=>"demo_countries", "field"=>"id", "field_view"=>"name", "source"=>"self", "order"=>"DESC", "default_operator"=>"=", "condition"=>$country_condition),
  "Date" => array("type"=>"textbox", "table"=>"demo_countries", "field"=>"independent_date", "source"=>"self", "operator"=>true, "case_sensitive"=>false,  "comparison_type"=>"string"),      
  "Population" => array("type"=>"enum", "view_type"=>"dropdownlist", "table"=>"demo_countries", "field"=>"population", "source"=>$fill_from_array, "order"=>"DESC", "operator"=>true, "case_sensitive"=>false, "comparison_type"=>"numeric")
);
$dgrid->SetFieldsFiltering($filtering_fields);
 
## +---------------------------------------------------------------------------+
## | 6. View Mode Settings:                                                    |
## +---------------------------------------------------------------------------+
##  *** set columns in view mode
$vm_columns = array(
  "county_name" => array("header"=>"County", "type"=>"label", "width"=>"130px", "align"=>"left", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
  "country_name" => array("header"=>"Country", "type"=>"linktoedit", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
  "town_name" => array("header"=>"Town", "type"=>"linktoedit", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
  "postcode_name" => array("header"=>"Postcode", "type"=>"linktoedit", "align"=>"left", "width"=>"130px", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>""),
  "description" => array("header"=>"Description","type"=>"label", "align"=>"left", "wrap"=>"nowrap", "text_length"=>"25", "case"=>"lower"),
  "address_name" => array("header"=>"Displayable Address","type"=>"label", "align"=>"left", "wrap"=>"nowrap", "text_length"=>"25", "case"=>"lower"),
  "picture_url" => array("header"=>"Picture", "type"=>"image", "align"=>"center", "width"=>"", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal", "summarize"=>false, "on_js_event"=>"", "target_path"=>"uploads/", "default"=>"", "image_width"=>"17px", "image_height"=>"17px"),
  "num_bedrooms" => array("header"=>"Number of bedrooms", "type"=>"label", "summarize"=>true, "align"=>"right", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
  "num_bathrooms" => array("header"=>"Number of bathrooms", "type"=>"label", "summarize"=>true, "align"=>"right", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
  "price_value" => array("header"=>"Price", "type"=>"label", "width"=>"130px", "align"=>"left", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
  "property_type" => array("header"=>"Property Type", "type"=>"label", "summarize"=>true, "align"=>"right", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
  "sale_rent" => array("header"=>"For Sale / For Rent", "type"=>"label", "summarize"=>true, "align"=>"right", "wrap"=>"nowrap", "text_length"=>"-1", "case"=>"normal"),
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
$primary_key = "uuid";
$condition   = "";
$dgrid->SetTableEdit($table_name, $primary_key, $condition);
##  *** set columns in edit mode
$fill_from_array = array("10000"=>"10000", "250000"=>"250000", "5000000"=>"5000000", "25000000"=>"25000000", "100000000"=>"100000000");
$em_columns = array(
  "county_name" => array("header"=>"County", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"County Name", "unique"=>true),
  "country_name" => array("header"=>"Country", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"Country Name", "unique"=>true),
  "town_name" => array("header"=>"Town", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"Town Name", "unique"=>true),
  "postcode_name" => array("header"=>"Postcode", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"Postcode", "unique"=>true),
  "description" => array("header"=>"Description", "type"=>"textarea", "width"=>"210px", "req_type"=>"rt", "title"=>"Description", "edit_type"=>"wysiwyg", "rows"=>"7", "cols"=>"50"),
  "address_name" => array("header"=>"Displayable Address", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"Address", "unique"=>true),
  "picture_url" => array("header"=>"Image", "type"=>"image", "req_type"=>"st", "width"=>"210px", "title"=>"Image", "readonly"=>false, "maxlength"=>"-1", "default"=>"", "unique"=>false, "unique_condition"=>"", "on_js_event"=>"", "target_path"=>"uploads/", "max_file_size"=>"100K", "image_width"=>"100px", "image_height"=>"100px", "file_name"=>"", "host"=>"local"),
  "num_bedrooms" => array("header"=>"Number of bedrooms", "type"=>"enum", "source"=>$fill_from_array, "view_type"=>"dropdownlist", "width"=>"", "req_type"=>"ri", "title"=>"Number (Bedrooms)"),
  "num_bathrooms" => array("header"=>"Number of bathrooms", "type"=>"enum", "source"=>$fill_from_array, "view_type"=>"dropdownlist", "width"=>"", "req_type"=>"ri", "title"=>"Number (Bathrooms)"),
  "price_value" => array("header"=>"Price", "type"=>"textbox", "width"=>"210px", "req_type"=>"ry", "title"=>"Price", "unique"=>true),
  "property_type" => array("header"=>"Property Type", "type"=>"enum", "source"=>$fill_from_array, "view_type"=>"dropdownlist", "width"=>"", "req_type"=>"ri", "title"=>"Type (Properties)"),
   "sale_rent"   =>array("header"=>"For Sale / For Rent", "type"=>"enum", "req_type"=>"rr", "width"=>"210px", "title"=>"For Sale / For Rent", "readonly"=>"false", "maxlength"=>"-1", "default"=>"", "unique"=>"false", "unique_condition"=>"", "visible"=>"true", "on_js_event"=>"", "source"=>"self", "view_type"=>"radiobutton", "elements_alignment"=>"horizontal", "multiple"=>"false", "multiple_size"=>"4"),
);
$dgrid->SetColumnsInEditMode($em_columns);
##  *** set foreign keys for add/edit/details modes (if there are linked tables)
##$foreign_keys = array(
##  "region_id" => array("table"=>"{Properties", "field_key"=>"uuid","field_name"=>"name","view_type"=>"dropdownlist", "order_by_field"=>"name", "order_type"=>"ASC")
## );
## $dgrid->SetForeignKeysEdit($foreign_keys);

 
?>