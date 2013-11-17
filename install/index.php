<?php

/**
 * Cocode Installer
 *
 * @project Cocode
 * @author James Socol
 * @copyright 2009
 */

@session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en" xml:lang="en">
<head>
<title>Install Cocode</title>
<link rel="stylesheet" type="text/css" href="install.css" />
</head>
<body>

<!-- begin #header -->
<div id="header">
	<h1>Install Cocode</h1>
</div>
<!-- end #header -->

<!-- begin #install-step -->
<div id="install-step">

<?php

switch($_SESSION['install_step']) {
	case 1: // collecting database information
?>
<h2>Collecting Information</h2>
<p>Fill in the form below with your database connection
	information and hit &#039;Continue&#039;.</p>

<form method="post">

	<h3>Database Connection</h3>
	<dl>
		<dt><label for="db_type">Database Engine</label></dt>
		<dd><select name="db_type" id="db_type">
			<option value="mysql">MySQL</option>
		</select></dd>
		
		<dt><label for="db_host">Database Host</label></dt>
		<dd><input type="text" name="db_host" id="db_host" value="localhost"/></dd>
		<dd class="note">99/100 you won&#039;t have to change this.</dd>
		
		<dt><label for="db_user">Database User</label></dt>
		<dd><input type="text" name="db_user" id="db_user"/></dd>
		
		<dt><label for="db_pass">Database Password</label></dt>
		<dd><input type="password" name="db_pass" id="db_pass" /></dd>
		
		<dt><label for="db_name">Database Name</label></dt>
		<dd><input type="text" name="db_name" id="db_name" /></dd>
	</dl>
	
	<p><input type="submit" value="Continue"/></p>
</form>
 
<?php
		$_SESSION['install_step'] = 2;
		break;
	case 2: // testing the install environment
?>
<h2>Testing Environment</h2>
<?php
		$_SESSION['install_step'] = 1;
		break;
	default:
?>
<h2>Welcome to Cocode!</h2>

<p>This installer will help you get Cocode up and running. You
	will need a few pieces of information before we can get
	started:</p>
	
<ul>
	<li>Database connection information, the server, username, password, and database name.</li>
	<li>This installer must be able to write to the server.</li>
	<li>You will need cookies enabled to use this installer.</li>
</ul>

<form method="post">
	<p>All set?</p>
	<p><input type="submit" value="Let's Go!"/></p>
</form>
<?php
		$_SESSION['install_step'] = 1;
} // end switch install_step

// Or logic goes here?

?>

</div>
<!-- end #install-step -->

<!-- begin #footer -->
<div id="footer">
</div>
<!-- end #footer -->

</body>
</html>