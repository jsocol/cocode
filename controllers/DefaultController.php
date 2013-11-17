<?php
/**
 * DefaultController
 * 
 * @project Cocode
 * @author James Socol
 * @copyright 2009
 */

class DefaultController extends ApplicationController
{
	public function index() {}
	
	public function fourohfour() {}
	
	public function fourohthree ()
	{
		$this->message = $_SESSION['message'];
		unset($_SESSION['message']);
	}
}
