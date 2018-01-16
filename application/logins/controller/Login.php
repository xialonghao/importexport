<?php
    namespace app\logins\controller;
    use think\Controller;
    class Login extends Controller{
        public function login(){
           return $this->fetch();
        }
        public function do_login(){

                $username=input('post.username');
                $password=input('post.password');
                $
                $info=db('login')->where('username="'.$username.'"')->find();
            if($info){
                if($info['password']==$password)
                {
                    //return '登陆成功';
                    session('username',$username);
                    setcookie(username,$username,36000);
                    $message['msg']="登陆成功";
                    $message['status']=1;
                }
                else{
                    //return "密码不一致";
                    //$message="密码错误";
                    $message['msg']="密码错误";
                    $message['status']=2;
                }
            }else{
                //return "用户名不存在";
                //$message="用户名不存在";
                $message['msg']="用户名不存在";
                $message['status']=2;
            }
            //硬塞
            $this->assign('message',$message);
            return $this->fetch();
        }
        public function log(){
            session(username);
            return $this->fetch();
        }
      
    }
?>