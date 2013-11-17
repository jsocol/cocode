<div id="snippet">

	<h1>Login</h1>

	<?php if($this->error): ?>
	<div class="error">
		<?php echo $this->error; ?>
	</div>
	<?php endif; ?>

	<form accept="<?php echo $GLOBALS['base_url']; ?>/user/login" method="post">
	
	<label for="login">Username: <input type="text" name="login" id="login"/></label><br />
	<label for="password">Password: <input type="password" name="password" id="password" /></label><br />
	
	<input type="submit" value="Login" />
	
	</form>

</div>