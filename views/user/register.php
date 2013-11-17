<div id="snippet">

	<h1>Login</h1>

	<?php if($this->error): ?>
	<div class="error">
		<?php echo $this->error; ?>
	</div>
	<?php endif; ?>

	<form accept="<?php echo $GLOBALS['base_url']; ?>/user/register" method="post">
	
	<label for="login">Username: <input type="text" name="login" id="login" value="<?php echo $_POST['login']; ?>"/></label><br />
	<label for="email">Email (optional): <input type="text" name="email" id="email" value="<?php echo $_POST['email']; ?>"/></label><br />
	<label for="password">Password: <input type="password" name="password" id="password" /></label><br />
	<label for="confirm_password">Password (again): <input type="password" name="confirm_password" id="confirm_password" /></label>
	
	<input type="submit" value="Register" />
	
	</form>

</div>