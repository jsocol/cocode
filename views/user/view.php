<div id="content">
<h1><?php echo $this->user->nice_name(); ?></h1>

<p><?php echo nl2br($this->user->profile); ?></p>

<div id="recent-snippets">
<h2>Recent Snippets</h2>
<?php if($this->snippets): ?>
<ul>
<?php foreach($this->snippets as $snippet): ?>
	<li><?php echo $this->link_to(htmlspecialchars($snippet->name), array('controller'=>'snippet','id'=>$snippet->id)); ?></li>
<?php endforeach; ?>
</ul>
<?php else: ?>
<p>The user has no snippets!</p>
<?php endif; ?>
</div>

<div id="recent-comments">
<h2>Recent Comments</h2>
<?php if($this->comments): ?>
<ul>
<?php foreach($this->comments as $comment): ?>
	<li><?php echo $this->link_to(htmlspecialchars(substr($comment->body,0,50)), array('controller'=>'snippet','id'=>$comment->snippet->id,'fragment'=>'comment-'.$comment->id)); ?></li>
<?php endforeach; ?>
</ul>
<?php else: ?>
<p>The user has no comments!</p>
<?php endif; ?>
</div>

</div>