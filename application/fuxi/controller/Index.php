<?php
public function do_excel(){
$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AB');
// echo "<pre>";
        // print_r($lists);exit;
        $path=dirname(__FILE__);//找到当前脚本所在路径
        Loader::import('PHPExcel.PHPExcel');//手动引入PHPExcel.php
        Loader::import('PHPExcel.PHPExcel.IOFactory.PHPExcel_IOFactory'); //引入IOFactory.php 文件里面的PHPExcel_IOFactory这个类
        $phpexcel=new \PHPExcel();//建excel表
        $rowsheet=db('iclass')->select();//查询有几个班级
        foreach($rowsheet as $key=>$row){
            $phpexcel->createSheet();//建sheet
            $phpexcel->setactivesheetindex($key);
            $phpSheet = $phpexcel->getActiveSheet();//加标记
            $phpSheet->setTitle($row['classname']);//每个的sheet的名称
            $lists=Db::query('SHOW FULL COLUMNS from wx_users');
            foreach($lists as $key=>$l){//获取当前表结构,赋给sheet的第一行
               $comment=$l['Comment']?$l['Comment']:$l['Field'];
               $phpSheet->setCellValue($cellName[$key].'1',$comment);
            }
            $users=db('users')->where("iclass=".$row['id'])->select();
            $i=2;
            foreach($users as $key=>$use){
                $j=0;
                foreach($use as $u){
                    $phpSheet->setCellValue($cellName[$j].$i,$u);
                    $j++;
                }
                $i++;
            }

        }
        $PHPWriter = \PHPExcel_IOFactory::createWriter($phpexcel, "Excel2007"); //创建生成的格式
        header('Content-Disposition: attachment;filename="学生列表'.time().'.xlsx"'); //下载下来的表格名
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件

    }
    ?>