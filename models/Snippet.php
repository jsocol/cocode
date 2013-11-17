<?php

/**
 * SnippetModel
 *
 * @project Cocode
 * @author James Socol
 * @copyright 2009
 */


class Snippet extends Model
{
	protected $belongs_to = array(
		'user',
		'parent' => array('model' => 'snippet')
	);
	
	protected $has_many = array(
		'comments',
		'children' => array('model' => 'snippet', 'foreign_key' => 'parent_id')
	);
}