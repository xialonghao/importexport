<?php
    namespace app\ms\controller;
    use think\Controller;


    class Index extends Controller{
				
        public function index(){
            return $this->fetch();
        }
        public function homes(){
            $names=input('post.username');
//            print_r($names);exit;
            $tel=input('post.tel');
            if($names){
                echo"成功";
            }else {
                $this->success('你为输入用户名','index');
//                echo "<script >alert ('您未输入用户名,请重新输入');location.href='Index/index'</script>";

            }

        }
		public function sj(){
			echo   date("Y-m-d H:i:s", strtotime("-1 day"));			
		}
		public function lala(){
				$a="Heoll World";
				$a=null;
				var_dump($a);
				echo "<pre>";
				$b='Heoll World';
				var_dump($b);
				echo "<pre>";
				$x = 5985;
				var_dump($x);
				echo "<br>"; 
				$x = -345; // 负数 
				var_dump($x);
				echo "<br>"; 
				$x = 0x8C; // 十六进制数
				var_dump($x);
				echo "<br>";
				$x = 047; // 八进制数
				var_dump($x);
				$x = 10.365;
				var_dump($x);
				echo "<br>"; 
				$x = 2.4e3;
				var_dump($x);
				echo "<br>"; 
				$x = 8E-5;
				var_dump($x);
				$cars=array("Volvo","BMW","Toyota");
				var_dump($cars);
				define("GREETING", "Welcome to runoob.com!");
				echo GREETING;
		}
		public function heixui(){
			$txt1="Hello world!";
$txt2="What a nice day!";
echo $txt1 . " " . $txt2; // 字符串连接运算符 .

echo strlen("Hello world!"); //获取字符串长度
echo strpos("Hello world!","world"); //获取子串位置
//字符串中第一个字符的位置是 0

		}
				
    }