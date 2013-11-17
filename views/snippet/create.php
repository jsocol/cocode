<div id="snippet">

	<h1>Create a new Snippet</h1>

	<form action="<?php echo $GLOBALS['base_url']; ?>/snippet/create" method="post">
	
		<label for="name">Name: <input type="text" name="name" id="name" size="60" /></label>
		
		<textarea name="body" id="body" class="tab"></textarea>
		
		<label for="language">Language <select name="language" id="language">
			<option value="c">C</option>
			<option value="cpp">C++</option>
			<option value="java">Java</option>
			<option value="javascript">JavaScript</option>
			<option value="php">PHP</option>
			<option value="python">Python</option>
			<option value="ruby">Ruby</option>
			<option value=""></option>
			<?php
			foreach ($this->languages as $lang) {
				echo "<option value='$lang'>$lang</option>\n";
			}
			?>
		</select></label>
		
		<input type="submit" value="Post It!" />
	</form>

</div>