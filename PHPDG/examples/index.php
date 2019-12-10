<?php

    require_once("install/settings.inc");    

	$config_file_exists = false;
    if(file_exists("install/".$config_file_path)) {
		$config_file_exists = true;
	}
	
    ob_start();
    
	if(function_exists('phpinfo')) @phpinfo(-1);
	$phpinfo = array('phpinfo' => array());
	if(preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER))
	foreach($matches as $match){
		$array_keys = array_keys($phpinfo);
		$end_array_keys = end($array_keys);
		if(strlen($match[1])){
			$phpinfo[$match[1]] = array();
		}else if(isset($match[3])){
			$phpinfo[$end_array_keys][$match[2]] = isset($match[4]) ? array($match[3], $match[4]) : $match[3];
		}else{
			$phpinfo[$end_array_keys][] = $match[2];
		}
	}
    
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<title>Installation Guide</title>
	<link rel="stylesheet" type="text/css" href="install/img/styles.css">
</head>
<BODY>
    
<?php if(!$config_file_exists){ ?>
<TABLE align="center" width="70%" cellSpacing=0 cellPadding=2 border=0>
<TBODY>
<TR>
    <TD class=text vAlign=top>
		<H2>Welcome to ApPHP!</H2>
        <H2>This is the installation wizard of <?php echo $application_name;?> examples</H2>
		You have 2 possibilities to install examples: with wizard or manually.
		Please select a type suitable for your.
		<br><br>
        
        <fieldset>
		<legend>Using this installation wizard</legend>
			<h3 id="post-1">Follow the wizard to setup your database.</h3>  
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody>
			<tr>
				<td class="text" align="left">
					Getting Important System Info
				</td>
			</tr>
			<tr><td nowrap='nowrap' height='10px'></td></tr>
			<tr>
				<TD class="text" align="left">
					<?php
						$php_core_index = ((version_compare(phpversion(), '5.3.0', '<'))) ? 'PHP Core' : 'Core';
					
						$system = isset($phpinfo['phpinfo']['System']) ? $phpinfo['phpinfo']['System'] : 'unknown';
						$build_date = isset($phpinfo['phpinfo']['Build Date']) ? $phpinfo['phpinfo']['Build Date'] : 'unknown';
						$database_system = isset($phpinfo['mysql']) ? $phpinfo['mysql']['MySQL Support'] : 'unknown';
						$database_system_version = isset($phpinfo['mysql']) ? $phpinfo['mysql']['Client API version'] : 'unknown';
						$server_api = isset($phpinfo['phpinfo']['Server API']) ? $phpinfo['phpinfo']['Server API'] : 'unknown';
						$vd_support = isset($phpinfo['phpinfo']['Virtual Directory Support']) ? $phpinfo['phpinfo']['Virtual Directory Support'] : 'unknown';
						///$asp_tags 	= isset($phpinfo[$php_core_index]) ? $phpinfo[$php_core_index]['asp_tags'][0] : 'unknown';
						///$safe_mode 	= isset($phpinfo[$php_core_index]) ? $phpinfo[$php_core_index]['safe_mode'][0] : 'unknown';
						$short_open_tag = isset($phpinfo[$php_core_index]) ? $phpinfo[$php_core_index]['short_open_tag'][0] : 'unknown';
						$mbstring_support = (function_exists('mb_detect_encoding')) ? 'enabled' : 'disabled';

						$pdo_support = isset($phpinfo['PDO']['PDO support']) ? $phpinfo['PDO']['PDO support'] : 'unknown';
						$pdo_drivers = isset($phpinfo['PDO']['PDO drivers']) ? $phpinfo['PDO']['PDO drivers'] : '';
						$pdo_mysql_driver = preg_match('/mysql/i', $pdo_drivers);						

						$session_support = isset($phpinfo['session']['Session Support']) ? $phpinfo['session']['Session Support'] : 'unknown';
						$magic_quotes_gpc = ini_get('magic_quotes_gpc') ? 'On' : 'Off';
						$magic_quotes_runtime = ini_get('magic_quotes_runtime') ? 'On' : 'Off';
						$magic_quotes_sybase = ini_get('magic_quotes_sybase') ? 'On' : 'Off';									
					?>
					<ul>
						<li>PHP Version: <i><?php echo phpversion(); ?></i></li>
						<li>Database System: <i>MySQL - <?php echo $database_system.' ('.$database_system_version.')'; ?></i></li>
						<li>Server OS: <i><?php echo $system; ?></i></li>
					</ul>	
					<ul>
						<li>PDO Support: <i><?php echo $pdo_support; ?></i></li>
						<li>PDO Drivers: <i><?php echo $pdo_drivers; ?></i></li>
					</ul>	
					<ul>
						<li>Build Date: <i><?php echo $build_date; ?></i></li>
						<li>Server API: <i><?php echo $server_api; ?></i></li>
						<li>Virtual Directory Support: <i><?php echo $vd_support; ?></i></li>
						<!--<li>Safe Mode: <i><?php /*echo $safe_mode; */?></i></li>-->
					</ul>	
					<ul>
						<!--<li>Asp Tags: <i><?php /*echo $asp_tags; */?></i></li>-->
						<li>Short Open Tag: <i><?php echo $short_open_tag; ?></i></li>
						<li>Session Support: <i><?php echo $session_support; ?></i></li>
						<li>mbString Support: <i><?php echo $mbstring_support; ?></i></li>
						<li>Magic Quotes GPC: <i><?php echo $magic_quotes_gpc; ?></i></li>
						<li>Magic Quotes RunTime: <i><?php echo $magic_quotes_runtime; ?></i></li>
						<li>Magic Quotes SyBase: <i><?php echo $magic_quotes_sybase; ?></i></li>						
					</ul>
				</TD>
			</TR>
			<TR>
				<TD class="text" align="left">
					Click on Start button to continue &nbsp;
					<input type="button" class="form_button" value="Start" name="submit" title="Click to start installation" onclick="window.location.href='install/install.php'">					
				</TD>
			</TR>
			</TBODY>
			</TABLE>
			
		</fieldset>
		
		<fieldset>
		<legend>Manually</legend>
		<div>
			<h3 id="post-1">Installation of PHP DataGrid</h3>  
			<div class="storycontent">
			
			To run these examples:<br><br>
			
			1. Create database and user, and assign this user to the database. Give him permissions
			   all needed permissions: INSERT, SELECT etc.. Write down the name of the database, username,
			   and password for the database installation procedure.<br><br>
			
			2. After the database and user were created, import SQL Dump.sql
				(<span style="color:#a60000">it is here: examples/sql/db_dump.sql</span>) to create 
				example tables in your database.<br><br>
			
			3. Before running any example - change these default parameters on yours 
			   (saved on step 1):<br><br>
				
				$DB_USER='username'; <br>           
				$DB_PASS='password';     <br>      
				$DB_HOST='localhost';      <br> 
				$DB_NAME='database_name';<br><br>
				
			4. Enjoy!!!	<br>
		
			</div>
		
		</div>
		</div>
		</fieldset>
		

        <?php include_once("install/footer.php"); ?>        
    </TD>
</TR>
</TBODY>
</TABLE>
<?php }else{ ?>


<h3 align="center">EXAMPLES INDEX</h3>

<table width="95%">
<tr valign='top'>
	<td width="33%">
		<fieldset class='big'>
			<legend class='big'>Sample 1-1</legend>
			Simplest PHP DG code (<a href="code_1_1_example.php" class="blue">See this Example &raquo;</a>)<br>
			--------------------------------<br>
			1. All modes (Add/Edit/Details/Delete/View).<br>
			2. Auto-Genereted columns.<br>
		</fieldset>
	</td>
	<td width="34%">
		<fieldset class='big'>
			<legend class='big'>Sample 1-2</legend>
			<table width="100%">
			<tr><td colspan="2">Simple PHP DG code (<a href="code_1_2_example.php" class="blue">See this Example &raquo;</a>)</td></tr>
			<tr>
			<td valign="top" wrap>				
				--------------------------------<br>
				1. All modes (Add/Edit/Details/Delete/View).<br>
				2. All features.<br>
				3. Two DataGrids on one page.<br>
				4. Dependent dropdown lists in filtering section.<br>
			</td>
			<td valign="top" align="right">				
				<a href="code_1_2_example.php"><img class='example_img' src='images/sample_1_2.png' alt='' border='0' align='right' /></a>
			</td>
			</tr>
			</table>						
		</fieldset>		
	</td>
	<td width="33%">
		<fieldset class='big'>
			<legend class='big'>Sample 2-1</legend>
			<table width="100%">
			<tr><td colspan="2">Advanced PHP DG code (<a href="code_2_1_example.php" class="blue">See this Example &raquo;</a>)</td></tr>
			<tr>
			<td valign="top" wrap>				
				--------------------------------<br>  
				1. All modes (Add/Edit/Details/View).<br>
				2. All features.<br>
				3. Many types of fields.<br>
				4. Image magnifying feature.<br>
				5. WYSIWYG editor.<br>
			</td>
			<td valign="top" align="right">				
				<a href="code_2_1_example.php"><img class='example_img' src='images/sample_2_1.png' alt='' border='0' align='right' /></a>
			</td>
			</tr>
			</table>						
		</fieldset>				
	</td>
</tr>

<tr valign='top'>
	<td>
		<fieldset class='big'>
			<legend class='big'>Sample 2-2</legend>
			<table width="100%">
			<tr><td colspan="2">Advanced PHP DG code (<a href="code_2_2_example.php" class="blue">See this Example &raquo;</a>)</td></tr>
			<tr>
			<td valign="top" wrap>				
				--------------------------------<br>
				1. All modes (Add/Edit/Details/Delete/View).<br>
				2. All features.<br>
				3. Inline editing.<br>
				4. Filter automplete feature.<br>	
			</td>
			<td valign="top" align="right">				
				<a href="code_2_2_example.php"><img class='example_img' src='images/sample_2_2.png' alt='' border='0' align='right' /></a>
			</td>
			</tr>
			</table>			
		</fieldset>				
	</td>
	<td>
		<fieldset class='big'>
			<legend class='big'>Sample 2-3</legend>
			<table width="100%">
			<tr><td colspan="2">Advanced PHP DG code (<a href="code_2_3_example.php" class="blue">See this Example &raquo;</a>)</td></tr>
			<tr>
			<td valign="top" wrap>				
				--------------------------------<br>
				1. All modes (Add/Edit/Details/View).<br>
				2. All features.<br>
				3. DataGrid divided into parts.<br>
			</td>
			<td valign="top" align="right">				
				<a href="code_2_3_example.php"><img class='example_img' src='images/sample_2_3.png' alt='' border='0' align='right' /></a>
			</td>
			</tr>
			</table>			
		</fieldset>				
	</td>
	<td>
		<fieldset class='big'>
			<legend class='big'>Sample 2-4</legend>
			<table width="100%">
			<tr><td colspan="2">Advanced PHP DG code (<a href="code_2_4_example.php" class="blue">See this Example &raquo;</a>)</td></tr>
			<tr>
			<td valign="top" wrap>				
				--------------------------------<br>  
				1. All modes (Add/Edit/View). <br>
				2. All features.<br>
				3. Two DataGrids on one page.<br>
				4. Customized layout in details mode.<br>
			</td>
			<td valign="top" align="right">				
				<a href="code_2_4_example.php"><img class='example_img' src='images/sample_2_4.png' alt='' border='0' align='right' /></a>
			</td>
			</tr>
			</table>			
		</fieldset>				
	</td>
</tr>

<tr valign='top'>
	<td>
		<fieldset class='big'>
			<legend class='big'>Sample 2-5</legend>
			<table width="100%">
			<tr><td colspan="2">Advanced PHP DG code (<a href="code_2_5_example.php" class="blue">See this Example &raquo;</a>)</td></tr>
			<tr>
			<td valign="top" wrap>				
				--------------------------------<br>
				1. View Mode.<br>
				2. Displaying some statistical data.<br>
			</td>
			<td valign="top" align="right">				
				<a href="code_2_5_example.php"><img class='example_img' src='images/sample_2_5.png' alt='' border='0' align='right' /></a>
			</td>
			</tr>
			</table>
		</fieldset>				
	</td>
	<td>
		<fieldset class='big'>
			<legend class='big'>Sample 2-6</legend>
			<table width="100%">
			<tr><td colspan="2">Advanced PHP DG code (<a href="code_2_6_example.php" class="blue">See this Example &raquo;</a>)</td></tr>
			<tr>
			<td valign="top" wrap>				
				--------------------------------<br>
				1. Master DataGrid in View Mode.<br>
				2. Second Datagrid in all Modes.<br>
			</td>
			<td valign="top" align="right">				
				<a href="code_2_6_example.php"><img class='example_img' src='images/sample_2_6.png' alt='' border='0' align='right' /></a>
			</td>
			</tr>
			</table>
		</fieldset>				
	</td>
	<td>
		<fieldset class='big'>
			<legend class='big'>Sample 2-7</legend>
			<table width="100%">
			<tr><td colspan="2">Advanced PHP DG code (<a href="code_2_7_example.php" class="blue">See this Example &raquo;</a>)</td></tr>
			<tr>
			<td valign="top" wrap>				
				--------------------------------<br>
				1. All modes (Add/Edit/Details/View).<br>
				2. All features.<br>
				3. Dependent dropdown lists.<br>
				4. Tabular(inline) layout for filtering.<br>
				5. AJAX sorting and paging.<br>    
			</td>
			<td valign="top" align="right">				
				<a href="code_2_7_example.php"><img class='example_img' src='images/sample_2_7.png' alt='' border='0' align='right' /></a>
			</td>
			</tr>
			</table>
		</fieldset>				
	</td>
</tr>

<tr valign='top'>
	<td>
		<fieldset class='big'>
			<legend class='big'>Sample 2-8</legend>
			<table width="100%">
			<tr><td colspan="2">Advanced PHP DG code (<a href="code_2_8_example.php" class="blue">See this Example &raquo;</a>)</td></tr>
			<tr>
			<td valign="top" wrap>				
				--------------------------------<br>
				1. Modes: Add/Edit/Details/View.<br>
				2. Customized layout in View Mode.<br>
			</td>
			<td valign="top" align="right">				
				<a href="code_2_8_example.php"><img class='example_img' src='images/sample_2_8.png' alt='' border='0' align='right' /></a>
			</td>
			</tr>
			</table>
		</fieldset>				
	</td>
	<td>
		<fieldset class='big'>
			<legend class='big'>Sample 2-9 (All In One)</legend>
			<table width="100%">
			<tr><td colspan="2">Advanced PHP DG code (<a href="code_2_9_example.php" class="blue">See this Example &raquo;</a>)</td></tr>
			<tr>
			<td valign="top" wrap>				
				--------------------------------<br>
				1. All modes (Add/Edit/Details/View).<br>
				2. All features.<br>
				3. All field types.
			</td>
			<td valign="top" align="right">				
				<a href="code_2_9_example.php"><img class='example_img' src='images/sample_2_9.png' alt='' border='0' align='right' /></a>
			</td>
			</tr>
			</table>
		</fieldset>				
	</td>
	<td>
	</td>
</tr>
</table>


<?php } ?>
</body>
</html>