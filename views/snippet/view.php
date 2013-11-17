
<!-- begin #snippet -->
<div id="snippet">

	<!-- snippet title -->
	<h1><?php echo htmlspecialchars($this->snippet->name); ?></h1>
	
	<!-- snippet-views -->
	<ul id="snippet-views">
		<li id="view-source" class="tab current"><a href="javascript:;" title="Show highlighted source code." onclick="$('.view').toggleClass('disabled',true).toggleClass('enabled',false);$('#snippet-source').toggleClass('disabled',false);$('.tab').toggleClass('current',false);$('#view-source').toggleClass('current',true);">Source</a></li>
		<li id="view-text" class="tab"><a href="javascript:;" title="Show plain text." onclick="$('.view').toggleClass('disabled',true).toggleClass('enabled',false);$('#snippet-text').toggleClass('disabled',false);$('.tab').toggleClass('current',false);$('#view-text').toggleClass('current',true);">Text</a></li>
		<?php if($this->diff): ?>
		<li id="view-diff" class="tab"><a href="javascript:;" title="Show diff from parent." onclick="$('.view').toggleClass('disabled',true).toggleClass('enabled',false);$('#snippet-diff').toggleClass('disabled',false);$('.tab').toggleClass('current',false);$('#view-diff').toggleClass('current',true);">Diff</a></li>
		<?php else: ?>
		<li id="view-diff" class="tab disabled">Diff</li>
		<?php endif; ?>
	</ul>

	<!-- begin #snippet-source -->
	<div id="snippet-source" class="view">
	<?php echo $this->highlight; ?>
	</div>
	<!-- end #snippet-source -->
	
	<!-- begin #snippet-text -->
	<div id="snippet-text" class="view disabled">
	<pre><?php echo htmlentities($this->snippet->body); ?></pre>
	</div>
	<!-- end #snippet-text -->
	
	<!-- begin #snippet-diff -->
	<div id="snippet-diff" class="view disabled">
	
	<?php if($this->diff): ?>
	<pre><?php 
	
	foreach(explode("\n",$this->diff) as $line) {
		// drop the filenames
		if ('+++' == substr($line, 0, 3) || '---' == substr($line,0,3)) {
			continue;
		}
		else
		// drop the \ No no newline
		if ('\ N' == substr($line, 0, 3)) {
			continue;
		}
		// highlight the diff sections
		if ('@@' == substr($line,0,2)) {
			echo '<span class="diff-lines">'.htmlspecialchars($line)."</span>\n";
		}
		else
		// red for subtracted
		if ('-' == substr($line,0,1)) {
			echo '<span class="diff-subtract">'.htmlspecialchars($line)."</span>\n";
		}
		else
		// green for added
		if ('+' == substr($line,0,1)) {
			echo '<span class="diff-add">'.htmlspecialchars($line)."</span>\n";
		}
		else {
			echo htmlspecialchars($line)."\n";
		}
	}
	
	?></pre>
	<?php endif; ?>
	
	</div>
	<!-- end #snippet-diff -->
	
	<!-- begin #snippet-revise -->
	<div id="snippet-revise" class="view disabled">
	
	<form action="<?php echo $GLOBALS['base_url']; ?>/snippet/create" method="post">
	
		<input type="hidden" name="parent_id" value="<?php echo $this->snippet->id; ?>" />
	
		<label for="name">Name: <input type="text" name="name" id="name" value="Re: <?php echo preg_replace('/^Re:/i', '', $this->snippet->name); ?>" size="60" /></label>
		
		<textarea name="body" id="body" class="tab"><?php echo htmlentities($this->snippet->body); ?></textarea>
		
		<label for="language">Language <select name="language" id="language">
			<?php
			
			foreach ($this->languages as $lang) {
				$sel = '';
				if($lang == $this->snippet->language){
					$sel = ' selected="selected"';
				}
				echo "<option value='$lang'$sel>$lang</option>\n";
			}
			?>
		</select></label>
		
		<input type="submit" value="Post It!" />
	</form>
	</div>
	<!-- end #snippet-revise -->

	<!-- begin #snippet-info -->
	<div id="snippet-info">
		
		<!-- language info -->
		<span id="snippet-language">Language: <?php echo $this->snippet->language; ?></span><br />
		
		<!-- author info -->
		<span id="snippet-author">Author: <?php echo $this->link_to($this->snippet->user->nice_name(), array('controller'=>'user','id'=>$this->snippet->user->id)); ?></span>
	
		<!-- revise button -->
		<span id="snippet-actions">
			<ul>
				<li id="view-revise" class="tab"><a href="javascript:;" title="Revise this source code." onclick="$('.view').toggleClass('disabled',true).toggleClass('enabled',false);$('#snippet-revise').toggleClass('disabled',false);$('.tab').toggleClass('current',false);$('#view-revise').toggleClass('current',true);">Revise</a></li>
			</ul>
		</span>
	</div>
	<!-- end #snippet-info -->

</div>
<!-- end #snippet -->

<!-- begin #comments -->
<div id="comments">

	<h2>Comments</h2>
	
	<?php if($this->snippet->comments): foreach($this->snippet->comments as $comment): ?>
	<!-- begin .comment -->
	<div id="comment-<?php echo $comment->id; ?>" class="comment collapsed">
		<div class="toggle" onclick="$(this).parent().toggleClass('collapsed');">&nbsp;</div>
		<span class="comment-expanded">
		<span class="comment-author"><?php echo $this->link_to($comment->user->name, array('controller'=>'user','id'=>$comment->user->id)); ?> said...</span>
		<?php echo nl2br(preg_replace(
			'/\b(\d+(?:\-\d+)?)\b/',
			'<span class="line-number">$1</span>',
			$comment->body)); ?></span>
		<span class="comment-collapsed" onclick="$(this).parent().toggleClass('collapsed');"><?php echo substr($comment->body,0,50); ?>...
			<span class="comment-author"><?php echo $comment->user->name; ?></span>
		</span>
	</div>
	<!-- end .comment -->
	<?php endforeach; else: ?>
	
	<p>There are no comments yet.</p>
	
	<?php endif; ?>

	<!-- create a new comment -->
	<!-- begin #comment-form -->
	<div id="comment-form">
		<h3>Add a Comment</h3>
		
		<form action="<?php echo $GLOBALS['base_url']; ?>/snippet/comment" method="post">
		
		<input type="hidden" name="snippet_id" value="<?php echo $this->snippet->id; ?>"/>
		
		<textarea id="comment-body" name="comment-body" rows="8" cols="48"></textarea>
		
		<input type="submit" value="Post Comment" />
		
		</form>
	</div>
	<!-- end #comment-form -->

</div>
<!-- end #comments -->

<!-- begin #history -->
<div id="history">

	<h2>History</h2>

	<?php if($this->snippet->parent): ?><ul>
		<li><?php echo $this->link_to(htmlspecialchars($this->snippet->parent->name), array($this->snippet->parent)); ?>
			by <?php echo $this->link_to(htmlspecialchars($this->snippet->parent->user->name), array('controller'=>'user',$this->snippet->parent->user)); ?> <?php endif; ?><ul>
			<li><em><?php echo htmlspecialchars($this->snippet->name); ?></em> <?php if($this->snippet->children): ?><ul>
			<?php foreach($this->snippet->children as $child): ?>
				<li><?php echo $this->link_to(htmlspecialchars($child->name), array($child)); ?>
					by <?php echo $this->link_to(htmlspecialchars($child->user->name), array('controller'=>'user',$child->user)); ?></li>
			<?php endforeach; ?>
			</ul><?php endif; ?></li>
		</ul><?php if ($this->snippet->parent): ?></li>
	</ul><?php endif; ?>
	
</div>
<!-- end #history -->
