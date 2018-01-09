<?php
	namespace app\page\controller;
	use think\Controller;
	class Index extends Controller
	{
		public function index()
		{
		return $this->fetch();
		}
		//添加
		public function do_add()
		{
			//'post.'获取form表单input里的name所有值的；
			$date=input('post.');
			//request()获取,上传file图片值的服去到数组中
            $file=request()->file('photo');
			//move()实现图片上传的,upload_path创建文件夹放图片的;
			$fileinfo=$file->(config('upload_path'));
			//getSavenmae()获取最终路径和名称的;
			 $date['photo']=$fileinfo->getSavename();
			 $date['inputtime']=time();
			 $table=db('users');
			 $info=$table->insert($date);
			 if($info)
			 {
				 $this->success('添加成功');
			 }
			 else
			 {
				 $this->success('添加失败');
			}
		}
		//分页
		public function userlist()
		{
			
			$table=db('users');
			$list=$table->paginate(config('paginate,list_rows'));
			$this->assign('info',$list);
			$this->assign('page',$list->render());
			return $this->fetch();
		}
		//删除
		public function deluser()
		{
			$id=input('Id');			
			$stu=db('users');
			$info = $stu->where('Id='.$id)->delete();
			if($info)
			{
				$this->success('删除成功');
			}
			else
			{
				$this->error("删除失败");
			}
		}
		
		public function updat()
		{
			$stu=db('users');
			$userid=input('Id'); 
			$userinfo=$stu->where('Id='.$userid)->find();
			$this->assign('info',$userinfo);
			return $this->fetch();		
		}
		
		public function do_updats()
		{
			$table=db('users');
			$userid=input('post.Id');
			$data=input('post.');
			$file=request()->file('photo');
			if($file)
			{
				$fileinfo = $file->move(config('upload_path'));
				$data['photo']=$fileinfo->getSavename();
			}
			
			
			$info = $table->where('Id='.$userid)->update($data);
			
			if($info!=false)
			{
				$this->success('修改成功');
			}
			else
			{
				$this->error('修改失败');
			}
		}
		public function indexs(){
			$db=db('users');
			//$page=input('post.currage');
			$list=$db->order('id desc')->select();
			foreach($list as &$v)
			{
				$v['photo']="http://192.168.98.12".$v['photo'];
			}
			return json($list);
		}
		
	}
?>