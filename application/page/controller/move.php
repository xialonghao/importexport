<?php
	namespace app\page\controller;
	use think\Controller;
	class Index extends Controller
	{
		public function index()
		{
			return $this->fetch();
		}
		public function do_add()
		{
			$date=input('post.');
			$info=reques()->find('photo');
			$infos=$info->move('upload_path')
			$date['photo']=getSavename();
			$date['inputtime']=time();
			$table=db('users');
			$infoes=$table->insert($date);
			if($infoes)
			{
				return $this->success('��ӳɹ�');
			}
			else
			{
				return $this->erroir('���ʧ��');
			}
			public function userlist()
			{
				$list=$table=db('users');
				$list=$table->paginate(config('paginate,list_rows'));
				$this->assign('list',$list->render());
				$this->assign('page',$list);
				return $this->fetch();
			}
			public function do_delete()
			{
				$id=input('id');
				$table=db('users');
				$info=$table->where('Id',$id)->delete();
				if($info)
				{
					return $this->success('ɾ���ɹ�');;
				}
				else
				{
					return $this->error('ɾ��ʧ��');
				}
				
			}
			public function do_upadet()
			{
				$id=input('Id');
				$table=db('users');
				$fino=$table->where('Id',$id)->find();
				$this->assign('fion',$fino);
				return $this->fethc();
			}
			public function do_update()
			{
				$table=db('user');
				$id=input('post.')
				$Id=input('post.id');
				$info=reques()->find('photo');
				if($info)
				{
				$infos=$info->move('upload_path')
				$date['photo']=getSavename();
				}
				$infos=$table->where('Id=',$id)-update($Id);
				if($infos)
				{
					return $this->success('�޸ĳɹ�');
				}
				elseP
				{
					 return $this->error('�޸ĳɹ�');
				}
				
			}
		}
	}
?>