<?php

class Controller {
	
	protected $f3;
    protected $db;

	function __construct() {
		
		$f3=Base::instance();
		$this->f3=$f3;
		
		$db=new DB\SQL(
	        $f3->get('db'),
	        $f3->get('dbuser'),
	        $f3->get('dbpass')
	    );
		
	    $this->db=$db;
	}
	
	function beforeroute(){
		if($this->f3->get('SESSION.user') === null ) {
				$this->f3->reroute('/login');
				exit;
			}
	}

	function afterroute(){
	}


}
