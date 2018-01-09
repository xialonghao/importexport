<?php
    namespace app\page\controller;
    use think\Controller;
    class Path extends Controller{
        public function wenjian(){
            $drr = ROOT_PATH . "templates" ;
            $fle = scandir($drr);
            unset($fle[0]);
            unset($fle[1]);
//            print_r($fle);exit;
            foreach( $fle as $v) {
                //显示文件名称信息
                $b = pathinfo($v);
                print_r($b);exit;
                if (!isset($b['extension'])) {
                    $timls[] = $b['basename'];

                }
            }
            if(is_dir($drr)){
                echo"已存在";
            }else{
                mkdir($drr);
                echo"创建成功";
            }
        }
    }
?>