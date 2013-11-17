<?php

/**
 * UserController
 * 
 * Handles user creation, editing, login/logout
 *
 * @project Cocode
 * @author James Socol
 * @copyright 2009
 */

class UserController extends ApplicationController
{
	
	/**
	 * Displays the login screen or does the
	 * login processing
	 */
	public function login()
	{
		// already logged in?
		if($this->current_user->id){
			$this->redirect_to(array('action'=>'view','id'=>$this->current_user->id));
			exit();
		}
		
		$this->title = "Login";
		
		// if there's post data
		if($_POST){

			$user = new User(array('login'=>$_POST['login']));
			
			if (!$user->id) {
				$this->error = "Bad <em>username</em> or password.";
			} else {
				if($user->check_password($_POST['password'])) {
					$_SESSION['user'] = $user;
					$this->redirect_to(array('action'=>'view','id'=>$user->id));
				} else {
					$this->error = "Bad username or <em>password</em>.";
				}
			}
		}
	}
	
	/**
	 * Does the logout processing
	 */
	public function logout()
	{
		session_destroy();
		$this->redirect_to(array('action'=>'login'));
	}
	
	/**
	 * Does registration, if it's enabled
	 */
	public function register()
	{
		// already logged in?
		if($this->current_user->id){
			$this->redirect_to(array('action'=>'view','id'=>$this->current_user->id));
			exit();
		}
		
		$this->title = "Register";
		
		// if there's post data
		if($_POST){

			$u = User::find_all(array('login'=>$_POST['login'])); 
			if($u){
				var_dump($u);
				$this->error = 'That username is unavailable.';
			} else {

				$user = new User;
				
				$user->email = $_POST['email'];
				$user->login = $_POST['login'];
				$user->user_level = 1;
				
				if($user->set_password($_POST['password'],$_POST['confirm_password'])){
					$user->save();
					$this->redirect_to(array('action'=>'login','result'=>'success'));
					exit();
				}else{
					$this->error = 'Your passwords did not match!';
				}
			}
		}
	}
	
	/**
	 * View the user's information
	 */
	public function view ()
	{
		
		if(!$this->current_user->can('view_profile')){
			$_SESSION['message'] = "You cannot view users profiles!";
			$this->redirect_to(array('controller'=>'default','action'=>'fourohthree'));
			exit();
		}
		
		if(!$this->params['id']){
			$this->redirect_to(array('controller'=>'default','action'=>'index'));
			exit();
		}
		
		$this->user = new User($this->params['id']);
		
		$this->title = $this->user->nice_name();
		
		$sn = new Snippet;
		$this->snippets = $sn->find_all(array('user_id'=>$this->user->id),array('created'=>'DESC'),'5');
		
		$cm = new Comment;
		$this->comments = $cm->find_all(array('user_id'=>$this->user->id),array('created'=>'DESC'),'5');
	}
	
	public function preferences ()
	{
		if(!$this->current_user->id){
			$this->redirect_to(array('action'=>'login'));
			exit();
		}
		
		$this->title = "User Preferences";
		
		if($_POST){
			$this->current_user->profile = strip_tags($_POST['profile'],'<a><i><em><b><strong><code><pre>');
			$this->current_user->name = strip_tags($_POST['name']);
			$this->current_user->email = strip_tags($_POST['email']);
			
			if($_POST['password']){
				if(!$this->current_user->set_password($_POST['password'],$_POST['confirm'])){
					$this->errors[] = "Passwords did not match!";
				}
			}
			
			if($this->errors){
				$this->errors[] = "Preferences not saved!";
			}else{
				$this->current_user->save();
			}
			
			if(!$this->errors){
				//$this->redirect_to(array());
			}
		}
		
		$this->user = new User($this->current_user->id);
	}
}
