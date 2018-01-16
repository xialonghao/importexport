<?php
	namespace app\login\controller;
	use think\Controller;
	class Login extends Controller
	{
		public function index()
		{
			if(session('userid')!='')
			{
				$this->redirect('Index/index');
			}
			else
			{
				return $this->fetch();
			}
			
		}
		public function do_login()
		{
			$telephone=input('post.telephone');
			$password=input('post.password');
			$table=db('member');
			$info=$table->where("telephone='".$telephone."'")->find();
			if($info)
			{
				session('userid',$info['Id']);
				session('telephone',$telephone);
				if($info['password']==$password)
				{
					return $this->success('登陆成功','Index/index');
				}
				else
				{
					return $this->error('登录失败');
				}
			}
			else
			{
				return $this->error('用户名不存在');
			}
		}
		public function register()
		{
			return $this->fetch();
		}
		public function do_adds()
		{
			$data=input('post.');
			$table=db('member');
			$info=$table->insert($data);
			if($info)
			{
				$this->success('添加成功','Login/index');
			}
			else
			{
				$this->success('添加失败');
			}
		}
	}
?>