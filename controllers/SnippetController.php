<?php

/**
 * SnippetController
 *
 * @project Cocode
 * @author James Socol
 * @copyright 2009
 */

require_once PATH_HELPERS.'geshi/geshi.php';

class SnippetController extends ApplicationController
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	/**
	 * View all (recent, whatever) snippets
	 */
 	public function index(){}
	
	/**
	 * View a snippet
	 */
 	public function view()
 	{
 		if(!$this->current_user->can('view')){
 			$this->redirect_to(array('controller'=>'user','action'=>'login'));
 			exit();
 		}
 		
		if(!$this->params['id']){
			$this->redirect_to(array('action'=>'index'));
			exit();
		}
		
		$this->snippet = new Snippet($this->params['id']);
		
		$this->title = $this->snippet->name;
		
		$geshi = new GeSHi($this->snippet->body, $this->snippet->language);
		$geshi->set_overall_id('geshi-line');
		$geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
		$geshi->enable_ids(true);
		
		$this->highlight = $geshi->parse_code();
		
		// get the diff
		if($this->snippet->parent)
		{
			$diff = new Setting('diff_util');
			$diff_path = $diff->value;
			
			if ($diff_path) {
				// write temp files
				$pfile = PATH_TEMP.$this->snippet->parent->id;
				$tfile = PATH_TEMP.$this->snippet->id;
				
				file_put_contents($pfile, $this->snippet->parent->body);
				
				file_put_contents($tfile, $this->snippet->body);
				
				$this->diff = `$diff_path -u $pfile $tfile`; 
			}
		}
		
		$langs = new Setting('languages');
		
		$this->languages = unserialize($langs->value);
 	}
 	
 	public function create()
 	{
 		$this->title = "Create a new Snippet";

		if(!$this->current_user->can('create')){
			$_SESSION['message'] = "You do not have permission to create snippets";
			$this->redirect_to(array('controller'=>'default','action'=>'fourohthree'));
			exit();
		}
 		
 		if($_POST){

	 		$snip = new Snippet;
	 		
	 		if($_POST['name']) {
	 			$snip->name = $_POST['name'];
 			} else {
 				$lines = preg_split('/[\r\n]+/',$_POST['body']);
 				$lines = array_map('trim',$lines);
 				while(!$lines[0]) array_shift($lines);
 				$snip->name = str_replace(array("\r","\n"),' ',substr($lines[0],0,30));
			}
			
	 		$snip->language = $_POST['language'];
	 		$snip->body = $_POST['body'];
	 		
	 		if(ctype_digit($_POST['parent_id'])){
	 			$snip->parent = new Snippet($_POST['parent_id']);
	 		}
	 		
	 		$snip->user = new User(1);
	 		
	 		$snip->save();
	 		
	 		if($snip->is_saved){
	 			$this->redirect_to(array('action'=>'view','id'=>$snip->id));
	 			exit();
	 		}
 		} // end if _POST
 		
 		$langs = new Setting('languages');
		
		$this->languages = unserialize($langs->value);
 	}
 	
 	public function comment ()
 	{
 		
		if(!$this->current_user->can('comment')){
			$_SESSION['message'] = "You do not have permission to comment on snippets.";
			$this->redirect_to(array('controller'=>'default','action'=>'fourohthree'));
			exit();
		}
 		
 		if($_POST){
 			$com = new Comment;
 			
 			$com->snippet = new Snippet($_POST['snippet_id']);
 			
 			$com->user = new User(1);
 			
 			$com->body = $_POST['comment-body'];
 			
 			$com->save();
 			
 			$this->redirect_to(array('action'=>'view', 'id'=>$com->snippet->id));
 		}
 		
 	}
 	
}