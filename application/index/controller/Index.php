<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        print_r(cookie('email'));
        echo "<br>";
        print_r(session('email'));
        exit;
        if(cookie('email')!=''){
            session('email',cookie('email'));
        }
        if(session('email')==''){
              return $this->fetch();
        }else{
            return $this->redirect('Index/log');
        }
    }
    public function do_login(){
//        $p=123123;
//        $ss=md5(md5($p));
//        echo $ss;
//        $data=input('post.');
//        return $data;
        $email=input('post.email');
        $password=md5(md5(input('post.password')));
//        $ischeck=input('post.ischeck');
//        $ischeck=input('post.');
//        print_r($ischeck);exit;
        $info=db('login')->where("email='".$email."'")->find();
        if($info){
            session('email',$email);
            if($info['password']==$password){
                if(input('post.icheck')){
                    cookie('email',$email,864000);
                }
                $datas=[
                    'msg'=>'登录成功',
                    'status'=>1
                ];
                return $datas;
//                return $this->success('登陆成功','log');
            }else{
                $datas=[
                    'msg'=>'密码错误',
                    'status'=>0
                ];
                return $datas;
//                return $this->error('密码不对','index');
            }
        }else{
            $datas=[
                'msg'=>'用户名错误',
                'status'=>0
            ];
            return $datas;
//            return  $this->error('用户名不存在','index');;
        }

    }
    public function log(){
        print_r(cookie('email'));
        echo "<br>";
        print_r(session('email'));
        $sess=session('username');
        $this->assign('username',$sess);
        return $this->fetch();
    }
}
