<div id="content">

	<h1>User Preferences</h1>

	<?php if($this->errors):?>
	<div class="errors">
		<ul>
		<?php foreach($this->errors as $err):?>
			<li><?php echo $err; ?></li>
		<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>

	<form action="<?php echo $this->base; ?>/user/preferences" method="post" class="user-preferences">
	
	<label for="name">Name: <input type="text" name="name" id="name" value="<?php echo $this->user->name; ?>"/></label>
	
	<label for="email">Email: <input type="text" name="email" id="email" value="<?php echo $this->user->email; ?>"/>
	<span class="note">Never shown, used to reset passwords.</span></label>
	
	
	<label for="profile">Bio:
	<textarea name="profile" id="profile" rows="8" cols="46"><?php echo $this->user->profile; ?></textarea>
	</label>
	
	<label for="password">New Password: <input type="password" name="password" id="password"/>
	<span class="note">Leave blank for no change.</span></label>
	
	<label for="confirm">Confirm Password: <input type="password" name="confirm" id="confirm" /></label>
	
	<input type="submit" value="Save"/>
	</form>
</div>