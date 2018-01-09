<?php
namespace app\pages\controller;
	use think\Controller;
	class Index extends Controller
	{
		public function index()
		{
		return $this->fetch();
		}
		public function do_add()
		{
			$data = input();			
			$info=request()->file('photo');
			$fileinfo=$info->move(PUBLIC_PATH.'uploads');
			$data['photo']=$fileinfo->getSavename();
			$table=db('userss');
			$ifo=$table->insert($data);
			if($ifo)
			{
				return $this->success('添加成功');
			}
			else
			{
				return $this->error('添加失败');
			}
		}
		public function userlist()
		{
			$table=db('userss');
			$list=$table->paginate(config('paginate,list_rows'));
			$this->assign('list',$list);
			$this->assign('page',$list);
			return $this->fetch();
		}
		public function updat()
		{
			$data = input('Id');
			$table=db('userss');
			$info=$table->where('Id='.$data)->delete();
			if($info)
			{
				return $this->success('删除成功');
			}
			else
			{
				return $this->error('删除失败');
			}
		}
		public function delet()
		{
			$table=db('userss');
			$data=input('Id');
			$info=$table->where('Id='.$data)->find();
			$this->assign('info',$info);
			return $this->fetch();
		}
		
	}

?>