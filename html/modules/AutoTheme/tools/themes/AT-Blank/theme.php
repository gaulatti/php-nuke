<?php

$thename = basename(dirname(__FILE__));

if (@file_exists("modules/AutoTheme/autotheme.php")) {
    @include_once("modules/AutoTheme/autotheme.php");
}
else {

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ERROR</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
td {
	font-family: Arial, Helvetica, sans-serif;
	font-size: medium;
	color: #FF0000;
}
a:link {
	color: #000000;
	font-weight: bold;
}
a:active {
	color: #000000;
	font-weight: bold;
}
a:visited {
	color: #000000;
	font-weight: bold;
}
a:hover {
	color: #FFFFFF;
	font-weight: bold;
	background-color: #FF0000;
}
-->
</style>
</head>
<body> 
<table width="75%"  border="0" align="center" cellpadding="8" cellspacing="0"> 
  <tr> 
    <td align="center"><p><strong>ERROR</strong></p>
    <p>This theme makes use of the revolutionary AutoTheme HTML Theme System which must be installed. The GPL and commercial versions of AutoTheme can be obtained from: <A 
      href="http://spidean.mckenzies.net/" target="_blank">http://spidean.mckenzies.net/</A></p></td> 
  </tr> 
  <tr> 
    <td align="center"><p>To reset your theme to a working theme:</p>
      <ul>
        <li>Click the appropriate link below, based upon where you just selected this theme.</li>
        <li>Enter the name of a working theme at the end of the URL in the address bar of the new window. </li>
      </ul>      <p><a href="admin.php?module=NS-Settings&op=main&theme=" target="_blank"><I>Administration -&gt; Settings</I></a><BR> 
        <BR> 
        <I><a href="user.php?op=chgtheme&theme=" target="_blank">My Account -&gt; Select Theme</a></I></p>      </td> 
  </tr> 
</table> 
</body>
</html>
<?php

	die();
}

?>