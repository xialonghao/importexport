<?php
namespace app\homes\controller;
use think\Controller;
use think\Loader;
use think\Db;
class Homes extends Controller{
    public function index()
    {
        return "<a href='".url('extcel')."'>导出</a>";
    }
    public function extcel(){
        $path = dirname(__FILE__); //找到当前脚本所在路径
        Loader::import('PHPExcel.PHPExcel'); //手动引入PHPExcel.php
        Loader::import('PHPExcel.PHPExcel.IOFactory.PHPExcel_IOFactory'); //引入IOFactory.php 文件里面的PHPExcel_IOFactory这个
        $PHPExcel = new \PHPExcel(); //实例化
        $class=db('iclass')->select();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AB');
        foreach($class as $key=>$val){
            $PHPExcel->createSheet();//创建Sheet
            $PHPExcel->setactivesheetindex($key);//循环的第几个Sheet;
            $phpSheet = $PHPExcel->getActiveSheet();//加标记；
            $phpSheet->setTitle($val['classname']);//Sheet的名字；
            $jiegou=Db::query('SHOW FULL COLUMNS from wx_users');

            foreach($jiegou as $k=>$jg){
                $Comment=$jg['Comment']?$jg['Comment']:$jg['Field'];
                $phpSheet->setCellValue($cellName[$k].'1',$Comment);
            }

          $neirong=db('users')->where("iclass='".$val['id']."'")->select();
            $i=2;
            foreach($neirong as $k=>$vs){
                $j=0;
                foreach($vs as $v){
                    $phpSheet->setCellValue($cellName[$j].$i,$v);
                    $j++;
                }
                $i++;
            }

        }
        $PHPWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, "Excel2007"); //创建生成的格式
        header('Content-Disposition: attachment;filename="第一次调查结果(班级).xlsx"'); //下载下来的表格名
        header('Content-Type: applicationnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件
    }
    public function daoru() {
        return $this->fetch();
    }
    public function do_excelImport() {
        $file = request()->file('file');
        $pathinfo = pathinfo($file->getInfo()['name']);
        $extension = $pathinfo['extension'];
        $savename = time().'.'.$extension;
        if($upload = $file->move('./upload',$savename)) {
            $savename = './upload/'.$upload->getSaveName();
            Loader::import('PHPExcel.PHPExcel');
            Loader::import('PHPExcel.PHPExcel.IOFactory.PHPExcel_IOFactory');
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($savename,$encode = 'utf8');
            $sheetCount = $objPHPExcel->getSheetCount();
            for($i=0 ; $i<$sheetCount ; $i++) {    //循环每一个sheet
                $sheet = $objPHPExcel->getSheet($i)->toArray();
                unset($sheet[0]);
                foreach ($sheet as $v) {
                    $data['id'] = $v[0];
                    $data['username'] = $v[1];
                    $data['sex'] = $v[2];
                    $data['idcate'] = $v[3];
                    try {
                        db('userss')->insert($data);
                    } catch(\Exception $e) {
                        return '插入失败';
                    }

                }
            }
            echo "succ";
        } else {
            return $upload->getError();
        }

    }


}
?>