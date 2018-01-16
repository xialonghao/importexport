<?php
	namespace app\login\controller;
	use app\login\controller\Common;
	class Index extends Common
	{
		public function index()
		{						
			 $table=db('member');
			 $userinfo=$table->where('id='.session('userid'))->find();
			 $this->assign('userinfo',$userinfo);
			return $this->fetch();							
			
		}
		public function do_aa()
		{
			echo "Hellor world";
		}
		//列表页链表
		public function consult(){
			$table1=db('consult');
			$table2=db('member');	
			$table3=db('user');			
			$list1=$table1->paginate(2);
			$this->assign('page',$list1->render());
			//把表一的内容传化为二维数组形式
			$info=$list1->toArray()['data'];
			//echo "<pre>";
			//print_r($info);exit;
			//循环表一的二位数组；fieled查一条内容的
			for($i=0;$i<count($info);$i++){	
				//查表二的单独一个字段条件表二的Id条件表一mid字段find()表二的name；
				$info[$i]['username']=$table2->field('nickname')->where('Id='.$info[$i]['mid'])->find()['nickname'];
				
			}		
			$this->assign('list',$info);											
			return $this->fetch();
		}
		//删除
		public function do_deled(){			
			$id=input('Id');
			$table=db('consult');
			$info=$table->where('Id in( '.$id.' )')->delete();
			if($info)
			{
				$this->success('删除成功','Index/consult');
			}
			else
			{
				$this->error('删除失败');
			}
			
		}
		//添加的页面
		public function do_add(){
			return $this->fetch();
		}
		
		public function do_adds()
		{			
			$data=input('post.');			
			$file=request()->file('photo');
			$fileinfo=$file->move(PUBLIC_PATH.'/uploads');
			$data['photo']=$fileinfo->getSavename();
			$data['pubtime']=date('Y-m-d',time());
			$table=db('consult');
			$info=$table->insert($data);
			if($info)
			{
				$this->success('添加成功','Index/do_add');
			}
			else
			{
				$this->error('添加失败');
			}
		}
	}
?>