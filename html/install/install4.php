<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2007 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* PHP-Nuke Installer was based on Joomla Installer                     */
/* Joomla is Copyright (c) by Open Source Matters                       */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

// Set flag that this is a parent file
define( "_VALID_MOS", 1 );

// Include common.php
require_once( 'common.php' );
require_once( './includes/database.php' );

$DBhostname = mosGetParam( $_POST, 'DBhostname', '' );
$DBuserName = mosGetParam( $_POST, 'DBuserName', '' );
$DBpassword = mosGetParam( $_POST, 'DBpassword', '' );
$DBname  	= mosGetParam( $_POST, 'DBname', '' );
$sitename  	= mosGetParam( $_POST, 'sitename', '' );
$adminEmail = mosGetParam( $_POST, 'adminEmail', '');
$siteUrl  	= mosGetParam( $_POST, 'siteUrl', '' );
$absolutePath = mosGetParam( $_POST, 'absolutePath', '' );
$adminPassword = mosGetParam( $_POST, 'adminPassword', '');

if ((trim($adminEmail== "")) || (preg_match("/[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}/", $adminEmail )==false)) {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		</form>";
	echo "<script>alert('You must provide a valid admin email address.'); document.stepBack.submit(); </script>";
	return;
}

if($DBhostname && $DBuserName && $DBname) {
	$configArray['DBhostname']	= $DBhostname;
	$configArray['DBuserName']	= $DBuserName;
	$configArray['DBpassword']	= $DBpassword;
	$configArray['DBname']	 	= $DBname;
} else {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		</form>";

	echo "<script>alert('The database details provided are incorrect and/or empty'); document.stepBack.submit(); </script>";
	return;
}

if ($sitename) {
	if (!get_magic_quotes_gpc()) {
		$configArray['sitename'] = addslashes($sitename);
	} else {
		$configArray['sitename'] = $sitename;
	}
} else {
	echo "<form name=\"stepBack\" method=\"post\" action=\"install3.php\">
		<input type=\"hidden\" name=\"DBhostname\" value=\"$DBhostname\" />
		<input type=\"hidden\" name=\"DBuserName\" value=\"$DBuserName\" />
		<input type=\"hidden\" name=\"DBpassword\" value=\"$DBpassword\" />
		<input type=\"hidden\" name=\"DBname\" value=\"$DBname\" />
		<input type=\"hidden\" name=\"DBcreated\" value=\"1\" />
		<input type=\"hidden\" name=\"sitename\" value=\"$sitename\" />
		<input type=\"hidden\" name=\"adminEmail\" value=\"$adminEmail\" />
		<input type=\"hidden\" name=\"siteUrl\" value=\"$siteUrl\" />
		<input type=\"hidden\" name=\"absolutePath\" value=\"$absolutePath\" />
		</form>";

	echo "<script>alert('The sitename has not been provided'); document.stepBack2.submit();</script>";
	return;
}

if (file_exists( '../config.php' )) {
	$canWrite = is_writable( '../config.php' );
} else {
	$canWrite = is_writable( '..' );
}

if ($siteUrl) {
	$configArray['siteUrl']=$siteUrl;
	// Fix for Windows
	$absolutePath= str_replace("\\\\","/", $absolutePath);
	$configArray['absolutePath']=$absolutePath;

	$config = "<?php\n";
	$config .= "\n";
	$config .= "######################################################################\n";
	$config .= "# PHP-NUKE: Advanced Content Management System\n";
	$config .= "# ============================================\n";
	$config .= "#\n";
	$config .= "# Copyright (c) 2007 by Francisco Burzi\n";
	$config .= "# http://phpnuke.org\n";
	$config .= "#\n";
	$config .= "# This program is free software. You can redistribute it and/or modify\n";
	$config .= "# it under the terms of the GNU General Public License as published by\n";
	$config .= "# the Free Software Foundation; either version 2 of the License.\n";
	$config .= "######################################################################\n";
	$config .= "\n";
	$config .= "if (stristr(htmlentities(\$_SERVER['PHP_SELF']), \"config.php\")) {\n";
	$config .= "	   Header(\"Location: index.php\");\n";
	$config .= "    die();\n";
	$config .= "}\n";
	$config .= "\n";
	$config .= "######################################################################\n";
	$config .= "# Database & System Config\n";
	$config .= "#\n";
	$config .= "# dbhost:       SQL Database Hostname\n";
	$config .= "# dbuname:      SQL Username\n";
	$config .= "# dbpass:       SQL Password\n";
	$config .= "# dbname:       SQL Database Name\n";
	$config .= "# \$prefix:      Your Database table's prefix\n";
	$config .= "# \$user_prefix: Your Users' Database table's prefix (To share it)\n";
	$config .= "# \$dbtype:      Your Database Server type. Supported servers are:\n";
	$config .= "#               MySQL, mysql4, sqlite, postgres, mssql, oracle,\n";
	$config .= "#               msaccess, db2 and mssql-odbc\n";
	$config .= "#               Be sure to write it exactly as above, case SeNsItIvE!\n";
	$config .= "# \$sitekey:	Security Key. CHANGE it to whatever you want, as long\n";
	$config .= "#               as you want. Just don't use quotes.\n";
	$config .= "# \$subscription_url: If you manage subscriptions on your site, you\n";
	$config .= "#                    must write here the url of the subscription\n";
	$config .= "#                    information/renewal page. This will send by\n";
	$config .= "#                    email if set.\n";
	$config .= "# \$admin_file: Administration panel filename. \"admin\" by default for\n";
	$config .= "#   		   \"admin.php\". To improve security please rename the file\n";
	$config .= "#              \"admin.php\" and change the \$admin_file value to the\n";
	$config .= "#              new filename (without the extension .php)\n";
	$config .= "######################################################################\n";
	$config .= "\n";
	$config .= "\$dbhost = \"{$configArray['DBhostname']}\";\n";
	$config .= "\$dbuname = \"{$configArray['DBuserName']}\";\n";
	$config .= "\$dbpass = \"{$configArray['DBpassword']}\";\n";
	$config .= "\$dbname = \"{$configArray['DBname']}\";\n";
	$config .= "\$prefix = \"nuke\";\n";
	$config .= "\$user_prefix = \"nuke\";\n";
	$config .= "\$dbtype = \"MySQL\";\n";
	$skey = mosMakePassword(40);
	$config .= "\$sitekey = \"$skey\";\n";
	$config .= "\$subscription_url = \"\";\n";
	$config .= "\$admin_file = \"admin\";\n";
	$config .= "\n";
	$config .= "/**********************************************************************/\n";
	$config .= "/* You finished to configure the Database. Now you can change all     */\n";
	$config .= "/* you want in the Administration Section.   To enter just launch     */\n";
	$config .= "/* your web browser pointing it to http://xxxxxx.xxx/admin.php        */\n";
	$config .= "/* (Change xxxxxx.xxx to your domain name, for example: phpnuke.org)  */\n";
	$config .= "/*                                                                    */\n";
	$config .= "/* Remember to go to Preferences section where you can configure your */\n";
	$config .= "/* new site. In that menu you can change all you need to change.      */\n";
	$config .= "/*                                                                    */\n";
	$config .= "/* Congratulations! now you have an automated news portal!            */\n";
	$config .= "/* Thanks for choose PHP-Nuke: The Future of the Web                  */\n";
	$config .= "/**********************************************************************/\n";
	$config .= "\n";
	$config .= "// DO NOT TOUCH ANYTHING BELOW THIS LINE UNTIL YOU KNOW WHAT YOU'RE DOING\n";
	$config .= "\n";
	$config .= "\$prefix = empty(\$user_prefix) ? \$prefix : \$user_prefix;\n";
	$config .= "\$reasons = array(\"As Is\",\"Offtopic\",\"Flamebait\",\"Troll\",\"Redundant\",\"Insighful\",\"Interesting\",\"Informative\",\"Funny\",\"Overrated\",\"Underrated\");\n";
	$config .= "\$badreasons = 4;\n";
	$config .= "/* If you want to use the IMG tag in your HTML code, to include images in News for example you must use the following line and comment out the old \$AllowableHTML */\n";
	$config .= "/* \$AllowableHTML = array(\"img\"=>2,\"b\"=>1,\"i\"=>1,\"strike\"=>1,\"div\"=>2,\"u\"=>1,\"a\"=>2,\"em\"=>1,\"br\"=>1,\"strong\"=>1,\"blockquote\"=>1,\"tt\"=>1,\"li\"=>1,\"ol\"=>1,\"ul\"=>1); */\n";
	$config .= "/* or just include \"img\"=>2 in the \$AllowableHTML array bellow. This feature isn't included by default due to possible security issues */\n";
	$config .= "\$AllowableHTML = array(\"b\"=>1,\"i\"=>1,\"strike\"=>1,\"div\"=>2,\"u\"=>1,\"a\"=>2,\"em\"=>1,\"br\"=>1,\"strong\"=>1,\"blockquote\"=>1,\"tt\"=>1,\"li\"=>1,\"ol\"=>1,\"ul\"=>1);\n";
	$config .= "\$CensorList = array(\"fuck\",\"cunt\",\"fucker\",\"fucking\",\"pussy\",\"cock\",\"c0ck\",\"cum\",\"twat\",\"clit\",\"bitch\",\"fuk\",\"fuking\",\"motherfucker\");\n";
	$config .= "\$tipath = \"images/topics/\";\n";
	$config .= "\n";
	$config .= "//***************************************************************\n";
	$config .= "// IF YOU WANT TO LEGALY REMOVE ANY COPYRIGHT NOTICES PLAY FAIR AND CHECK: http://phpnuke.org/modules.php?name=Commercial_License\n";
	$config .= "// COPYRIGHT NOTICES ARE GPL SECTION 2(c) COMPLIANT AND CAN'T BE REMOVED WITHOUT PHP-NUKE'S AUTHOR WRITTEN AUTHORIZATION\n";
	$config .= "// THE USE OF COMMERCIAL LICENSE MODE FOR PHP-NUKE HAS BEEN APPROVED BY THE FSF (FREE SOFTWARE FOUNDATION)\n";
	$config .= "// YOU CAN REQUEST INFORMATION ABOUT THIS TO GNU.ORG REPRESENTATIVE. THE EMAIL THREAD REFERENCE IS #213080\n";
	$config .= "// YOU'RE NOT AUTHORIZED TO CHANGE THE FOLLOWING VARIABLE'S VALUE UNTIL YOU ACQUIRE A COMMERCIAL LICENSE\n";
	$config .= "// (http://phpnuke.org/modules.php?name=Commercial_License)\n";
	$config .= "//***************************************************************\n";
	$config .= "\n";
	$config .= "\$commercial_license = 0;\n";
	$config .= "\n";
	$config .= "?>";

	if ($canWrite && ($fp = fopen("../config.php", "w"))) {
		fputs( $fp, $config, strlen( $config ) );
		fclose( $fp );
	} else {
		$canWrite = false;
	}

	$database = new database( $DBhostname, $DBuserName, $DBpassword, $DBname );
	$nullDate = $database->getNullDate();

	// create the admin user
	$cryptpass = md5( $adminPassword );
	$query = "INSERT INTO nuke_authors VALUES ('admin', 'God', 'http://', '$adminEmail', '$cryptpass', 0, 1, '')";
	$database->setQuery( $query );
	$database->query();

	// touch config table
	$date = date("F Y");
	$query = "UPDATE nuke_config SET sitename='$sitename', nukeurl='$siteUrl', startdate='$date', adminmail='$adminEmail', backend_title='$sitename', notify_email='$adminEmail'";
	$database->setQuery( $query );
	$database->query();

} else {
?>
	<form action="install3.php" method="post" name="stepBack3" id="stepBack3">
	  <input type="hidden" name="DBhostname" value="<?php echo $DBhostname;?>" />
	  <input type="hidden" name="DBusername" value="<?php echo $DBuserName;?>" />
	  <input type="hidden" name="DBpassword" value="<?php echo $DBpassword;?>" />
	  <input type="hidden" name="DBname" value="<?php echo $DBname;?>" />
	  <input type="hidden" name="DBcreated" value="1" />
	  <input type="hidden" name="sitename" value="<?php echo $sitename;?>" />
	  <input type="hidden" name="adminEmail" value="$adminEmail" />
	  <input type="hidden" name="siteUrl" value="$siteUrl" />
	  <input type="hidden" name="absolutePath" value="$absolutePath" />
	</form>
	<script>alert('The site url has not been provided'); document.stepBack3.submit();</script>
<?php
}
echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PHP-Nuke - Installer</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="install.css" type="text/css" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="phpnuke"><img src="header_install.png" alt="PHP-Nuke Installation" /></div>
	</div>
</div>
<div id="ctr" align="center">
	<form action="dummy" name="form" id="form">
	<div class="install">
		<div id="stepbar">
			<div class="step-off">pre-installation check</div>
			<div class="step-off">license</div>
			<div class="step-off">step 1</div>
			<div class="step-off">step 2</div>
			<div class="step-off">step 3</div>
			<div class="step-on">step 4</div>
		</div>
		<div id="right">
			<div id="step">step 4</div>
			<div class="far-right">
				<input class="button" type="button" name="runSite" value="View Site"
<?php
				if ($siteUrl) {
					echo "onClick=\"window.location.href='$siteUrl/index.php' \"";
				} else {
					echo "onClick=\"window.location.href='".$configArray['siteURL']."/index.php' \"";
				}
?>/>
				<input class="button" type="button" name="Admin" value="Administration"
<?php
				if ($siteUrl) {
					echo "onClick=\"window.location.href='$siteUrl/admin.php' \"";
				} else {
					echo "onClick=\"window.location.href='".$configArray['siteURL']."/admin.php' \"";
				}
?>/>
			</div>
			<div class="clr"></div>
			<h1>Congratulations! PHP-Nuke is installed</h1>
			<div class="install-text">
				<p>Click the "View Site" button to start PHP-Nuke site or "Administration"
					to take you to administrator login.</p>
			</div>
			<div class="install-form">
				<div class="form-block">
					<table width="100%">
						<tr><td class="error" align="center">PLEASE REMEMBER TO COMPLETELY<br/>REMOVE THE INSTALLATION DIRECTORY</td></tr>
						<tr><td align="center"><h5>Administration Login Details</h5></td></tr>
						<tr><td align="center" class="notice"><b>Username : admin</b></td></tr>
						<tr><td align="center" class="notice"><b>Password : <?php echo $adminPassword; ?></b></td></tr>
						<tr><td>&nbsp;</td></tr>
						<tr><td align="right">&nbsp;</td></tr>
<?php						if (!$canWrite) { ?>
						<tr>
							<td class="small">
							<font color="FF0000"><b>WARNING:</b></font> Your configuration file or directory is not writeable,
								or there was a problem creating the configuration file. You'll have to
								upload the following code by hand. Click in the textarea to highlight
								all of the code. Create a new file called <b>config.php</b> and upload
								it to your server root folder (overwrite the old config.php file present
								on your server.
							</td>
						</tr>
						<tr>
							<td align="center">
								<textarea rows="20" cols="60" name="configcode" onclick="javascript:this.form.configcode.focus();this.form.configcode.select();" ><?php echo htmlspecialchars( $config );?></textarea>
							</td>
						</tr>
<?php						} ?>
						<tr><td class="small"><?php /*echo $chmod_report*/; ?></td></tr>
					</table>
				</div>
			</div>
			<div id="break"></div>
		</div>
		<div class="clr"></div>
	</div>
	</form>
</div>
<div class="clr"></div>
<div class="ctr">
	<a href="http://phpnuke.org" target="_blank">PHP-Nuke</a> is Free Software released under the GNU/GPL License.
</div>
</html>