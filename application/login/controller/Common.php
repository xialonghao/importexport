<?php
 namespace app\Login\controller;
 use think\Controller;
 class Common extends Controller
 {
	 public function _initialize()
	 {
		 parent::_initialize();
		 if(session('userid')=="")
		 {
			 $this->redirect('Login/index');
		 }
	 }
 }
?>
