<?php
    namespace app\admin\controller;
    use think\Controller;
    use think\Loader;
    use think\Db;
    class Admin extends Controller{
        public function excel(){
            $path = dirname(__FILE__); //找到当前脚本所在路径
            Loader::import('PHPExcel.PHPExcel'); //手动引入PHPExcel.php
            Loader::import('PHPExcel.PHPExcel.IOFactory.PHPExcel_IOFactory'); //引入IOFactory.php 文件里面的PHPExcel_IOFactory这个类
            $PHPExcel = new \PHPExcel(); //实例化。
            $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AB');
            $userbj=db('iclass')->select();
            foreach($userbj as $k=>$use){
//                echo "<pre>";
//                print_r($v);exit;
                $PHPExcel->createSheet();//建sheet
                $PHPExcel->setactivesheetindex($k);
                $phpSheet = $PHPExcel->getActiveSheet();//加标记
                $phpSheet->setTitle($use['classname']);//每个的sheet的名称
                $lists=Db::query('SHOW FULL COLUMNS from wx_users');
//                     echo "<pre>";
//                print_r($lists);exit;
                foreach($lists as $k=>$vn) {//获取当前表结构,赋给sheet的第一行
                    $comment=$vn['Comment']?$vn['Comment']:$vn['Field'];
                    $phpSheet->setCellValue($cellName[$k].'1',$comment);
                }
//                $users=db('users')->where("iclass=".$use['id'])->select();
                $users=db('users')->where("iclass='".$use['id']."'")->select();
//                $users=db('users')->where("iclass=2")->select();
//                echo "<pre>";
//
//                print_r($users);exit;
                $i=2;
                foreach($users as $k=>$vs){
                    $j=0;
                    foreach($vs as $k=>$v){
                        $phpSheet->setCellValue($cellName[$j].$i,$v);
                        $j++;
                    }
                        $i++;
                }
            }
            $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, "Excel2007"); //创建生成的格式
            header('Content-Disposition: attachment;filename="第一次调查结果(班级).xlsx"'); //下载下来的表格名
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件

        }
    }
?>     