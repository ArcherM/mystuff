<?php

class ItemsControl extends Controller{

	function getItem($f3){
		
		$messages = new Messages($this->db);
		$msg = $messages->all()[0];

		$f3->set('msg',$msg);
        $template=new Template;
        echo $template->render('template.htm');
	}

	function saveItem($f3){
	}
	
	function editItem($f3) {
		
	}
	
	function getItemsOfUser($f3) {
		
	}
}
?>