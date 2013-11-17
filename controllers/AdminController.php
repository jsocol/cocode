<?php

/**
 * AdminController
 *
 * @project Cocode
 * @author James Socol
 * @copyright 2009
 */

class AdminController extends ApplicationController
{

	public function _prefilter()
	{
		if(!$this->current_user->can('admin')){
			return false;
		}
		return true;
	}
	
	public function index()
	{
		$this->title = 'Administration';
	}
	
}