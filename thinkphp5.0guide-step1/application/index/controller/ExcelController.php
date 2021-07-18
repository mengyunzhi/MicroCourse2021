<?php
namespace app\index\controller;
require_once dirname(__FILE__)."/Classes/PHPExcel.php";
use Env;
use PHPExcel_IOFactory;
use PHPExcel;

class ExcelController
{
	public function readExcel($file)
	{
		$reader = PHPExcel_IOFactory::createReader('Excel5');
		$excel = PHPExcel_IOFactory::load('/readfile/www/upload/'.$file);
		$data=$excel->getActiveSheet()->toArray();
		return $data;
	}

}
