<?php
/**
 * ApplicationController
 *
 * The base controller for user controllers. Can
 * contain any custom functions for this application
 * and overrides for the built-in functions. May define
 * a global _prefilter function. Can be used to create
 * objects used by all controllers.
 */

class ApplicationController extends Controller
{
	/**
	 * $input InputHelper
	 */
	protected $input;

	/**
	 * $base global base_url (reference)
	 */
	protected $base;

	/**
	 * is the user logged in?
	 */
 	protected $logged_in = false;

	/**
	 * __construct
	 *
	 * Creates a new InputHelper and creates a
	 * reference to the global $base_url variable.
	 *
	 * Must call parent::__construct
	 */
	public function __construct ()
	{
		$this->input = new InputHelper;
		$this->base =& $GLOBALS['base_url'];
		$this->title = "Welcome";

		$site = new Setting(array('name'=>'site_name'));
		
		$this->site_name = $site->value;
		
		if($_SESSION['user'] instanceof User && $_SESSION['user']->id) {
			$this->current_user = $_SESSION['user'];
			$this->logged_in = true;
		}else{
			$this->current_user = new User;
		}
		
		parent::__construct();
	}
	
	public function _prefilter()
	{
		return true;
	}
}


