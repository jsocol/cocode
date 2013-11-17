<?php

/**
 * SettingModel
 *
 * @project Cocode
 * @author James Socol
 * @copyright 2009
 */

class Setting extends Model
{
	public function __construct($name=false)
	{
		if(is_array($name)){
			parent::__construct($name);
		}else if(is_string($name)){
			parent::__construct(array('name'=>$name));
		}else{
			parent::__construct();
		}
	}

	public function load ($name)
	{
		$this->find(array('name'=>$name));
	}	

}