<?php

/**
 * CommentModel
 *
 * @project Cocode
 * @author James Socol
 * @copyright 2009
 */

class Comment extends Model
{
	protected $belongs_to = array(
		'user',
		'snippet'
	);


}