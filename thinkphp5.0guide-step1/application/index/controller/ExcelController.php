<?php
namespace app\index\controller;
require_once dirname(__FILE__)."/Classes/PHPExcel.php";
use Env;
use PHPExcel_IOFactory;
use PHPExcel;
use app\common\model\Score;
use app\common\model\Student;
use app\common\model\Course;
class ExcelController
{
	public function readExcel($file)
	{
		$reader = PHPExcel_IOFactory::createReader('Excel5');
		$excel = PHPExcel_IOFactory::load('/readfile/www/upload/'.$file);
		$data=$excel->getActiveSheet()->toArray();
		return $data;
	}
	public function exportExcel($list)
	{
		$objPHPExcel=new \PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);
        //5.设置表格头（即excel表格的第一行）
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', '姓名')
                ->setCellValue('B1', '学号')
                ->setCellValue('C1', '课程')
                ->setCellValue('D1', '平时成绩')
                ->setCellValue('E1', '考试成绩')
                ->setCellValue('F1','总成绩');
        //水平居中
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('B')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('C')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0)->getStyle('F')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //6.循环刚取出来的数组，将数据逐一添加到excel表格。
        if(!is_null($list)){
        	for($i=0;$i<count($list);$i++){
	        	if(is_null($Student=Student::get($list[$i]->id))){
	        		//return $this->error('不存在id为'.$list[$i]->id.'课程');
	        	}
	        	if(is_null($Course=Course::get($list[$i]->course_id))){
	        		//return $this->error('不存在id为'.$list[$i]->course_id.'课程');
	        	}
	            $objPHPExcel->getActiveSheet()->setCellValue('A'.($i+2),$Student->name);
	            $objPHPExcel->getActiveSheet()->setCellValue('B'.($i+2),$Student->number);
	            $objPHPExcel->getActiveSheet()->setCellValue('C'.($i+2),$Course->name);
	            $objPHPExcel->getActiveSheet()->setCellValue('D'.($i+2),$list[$i]->usual_score);
	            $objPHPExcel->getActiveSheet()->setCellValue('E'.($i+2),$list[$i]->exam_score); 
	            $objPHPExcel->getActiveSheet()->setCellValue('F'.($i+2),$list[$i]->sum_score); 
	        }
        }
        //7.设置保存的Excel表格名称
        $filename = '学生成绩'.date('ymd',time()).'.xls';
        //8.设置当前激活的sheet表格名称；
        $objPHPExcel->getActiveSheet()->setTitle('学生成绩');
        //9.设置浏览器窗口下载表格
        header("Content-Type: application/force-download");  
        header("Content-Type: application/octet-stream");  
        header("Content-Type: application/download");  
        header('Content-Disposition:inline;filename="'.$filename.'"');  
        //生成excel文件
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        //下载文件在浏览器窗口
        $objWriter->save('php://output');
        exit;
	}

}