
<!-- begin #content -->
<div id="content">
	<h1>Welcome to Cocode</h1>
	
	<?php if (!$this->current_user->id): ?>
	<div class="login-form">
		<form action="<?php echo $this->base; ?>/user/login" method="post">
		<dl>
			<dt><label for="login">Login:</label></dt>
			<dd><input type="text" name="login" id="login" /></dd>
			<dt><label for="password">Password:</label></dt>
			<dd><input type="password" name="password" id="password"/></dd>
		</dl>
		<input type="submit" value="Log In!"/>
		</form>
	</div>
	<?php else: ?>
	<?php endif; ?>
</div>
<!-- end #content -->
