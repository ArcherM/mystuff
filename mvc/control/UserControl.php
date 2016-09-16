<?php

class UserControl extends Controller{
	
	function beforeroute(){
    }
	
	function login() {
		$template=new Template;
		echo $template->render('login.htm');
	}
	
	function logout() {
		$this->f3->set('SESSION.user', null);
		$this->f3->reroute('/login/out');
		exit;
	}
	
	function about () {
		$template=new Template;
		echo $template->render('about.htm');
		
	}

	function auth() {

        $username = $this->f3->get('POST.username');
        $password = $this->f3->get('POST.password');
		$type = $this->f3->get('POST.subBtn');
		$db = $this->db;
		$user = new UserModel($this->db);
		$userInfo = $user->getUserInfo($db, $username);
		
		if ($type == 'in') {
			if($userInfo == 0) {
				$this->f3->reroute('/login/error');
			}
			if(password_verify($password, $userInfo[0]['pass'])) {
				$this->f3->set('SESSION.user', $userInfo[0]['name']);
				$this->f3->set('SESSION.uid', $userInfo[0]['id']);
				$this->f3->reroute('/');
			} else {
				$this->f3->reroute('/login/error');
			}
		} else if ($type == 'up') {
			$pwHash = password_hash($password, PASSWORD_DEFAULT);
			if(!$userInfo == 0) {
				$this->f3->reroute('/login/exists');
			}
			$user->addUser($db, $username, $pwHash);
			$this->f3->set('SESSION.user', $username);
			$this->f3->reroute('/');
		}
    }
}
