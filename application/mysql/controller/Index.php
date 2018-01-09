<?php
	namespace app\mysql\controller;
	use think\Controller;
	class Index extends Controller
	{
		public function index()
		{
			return $this->fetch();
		}
		public function do_add()
		{
			$date = input('post.');
			$info=request()->file('photo');		
			$infoe=$info->move(PUBLIC_PATH.'uploads');			
			$date['photo']=$infoe->getSavename();
			$date['inputtime']=time();
			$table=db('users');
			$query=$table->insert($date);
			if($query)
			{
				return $this->success('添加成功');
			}
			else
			{
				return $this->error('添加失败');
			}
		}
		//分页
		public function userlist()
		{
			$table=db('users');
			$list=$table->paginate(config('paginate,list_rows'));
			$this->assign('list',$list);
			$this->assign('page',$list->render());
			return $this->fetch();
		}
		//删除
		public function delet()
		{
			
			$id=input('Id');
			$table=db('users');
			$ifno=$table->where('Id='.$id)->delete();
			if($ifno)
			{
				return $this->success('删除成功');
			}
			else
			{
				return $this->error('删除失败');
			}
			
		}
		//修改
		public function updat()
		{			
			$stu=db('users');
			$userid=input('Id'); 
			$userinfo=$stu->where('Id='.$userid)->find();
			$this->assign('info',$userinfo);
			return $this->fetch();	
		}
		public function do_updat()
		{
			$table=db('users');
			$id=input('post.Id');
			$data=input('post.');
			$file=request()->file('photo');
			if($file)
			{
				$fileinfo = $file->move(config('upload_path'));
				$data['photo']=$fileinfo->getSavename();
			}
			$fff = $table->where('Id='.$id)->update($data);
			if($fff!=false)
			{
				return $this->success('修改成功');
			}
			else
			{
				return $this->error('修改失败');
			}
		}
		public function userlist()
		{
			return $this->fetch();
		}
	}
?>