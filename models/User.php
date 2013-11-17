<?php

/**
 * UserModel
 *
 * @project Cocode
 * @author James Socol
 * @copyright 2009
 */

class User extends Model
{
	protected $has_many = array (
		'snippets',
		'comments'
	);
	
	protected $password;

	/**
	 * Return the name, if it's set, else the login
	 * 
	 * @return string
	 */
 	public function nice_name ()
 	{
 		return ($this->name)?$this->name:$this->login;
 	}

	/**
	 * Check a supplied password against the user's stored password.
	 * 
	 * @return bool
	 */
	public function check_password ( $pass )
	{
		return (crypt($pass,$this->password) == $this->password);
	}

	/**
	 * Check that two supplied strings match, then use them
	 * to set the user's password. Return true on match,
	 * false on fail.
	 * 
	 * @param string $password
	 * @param string $confirm_password
	 * @return bool
	 */
	public function set_password ( $pass, $confirm )
	{
		if($pass == $confirm){
			$this->password = crypt($pass);
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Check the user's privileges to see if the supplied
	 * action is allowed. Returns true for yes, false for
	 * no.
	 * 
	 * @param string $permission
	 * @return bool
	 */
	public function can ( $perm )
	{
		// get the permissions setting, if necessary
		if(!self::$permissions){
			$t = new Setting('permissions');
			self::$permissions = unserialize($t->value);
		}
		return ($this->user_level >= self::$permissions[$perm]);
	}
	
	/**
	 * Used to prevent re-lookups of the permissions setting
	 */
	protected static $permissions;
}