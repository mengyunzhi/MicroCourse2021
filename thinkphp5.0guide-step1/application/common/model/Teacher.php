<?php
namespace app\common\model;
use think\Model;

class Teacher extends Model
{	//一对多关联
	public	function courses()
	{
		return $this->hasMany('Course')->field('id,name');
	}
	//获得随机数
	public function dc_rand1($min, $max, $num)
	{
        $count = 0;
        $return = array();
        while ($count < $num) {
            $return[] = mt_rand($min*100, $max*100)/100;
            $count = count($return);
        }
//        //打乱数组，重新赋予数组新的下标
//        shuffle($return);
        return $return;//返回的是一维数组
    }

    //获取学生
    public function getStudent($course_id)
    {
        //获取班级
        $Course=Course::get($course_id);
        $klasses=$Course->Klasses()->select();
        $KlassCourse=new KlassCourse;
        $klassCourses=$KlassCourse->select();
        $number=count($klassCourses);
        $klassIds=array();
        for ($j=0 ,$i=0; $i < $number; $i++) { 
            if($klassCourses[$i]->course_id==$course_id){
                $klassIds[$j]=$klassCourses[$i]->klass_id;
                $j++;
            }
        }
        //获取学生
        $Student=new Student;
        $students=$Student->select();
        $studentIds=array();
        $klassNumber=count($klassIds);
        //随机生成班级
        $klassId=(int)$this->dc_rand1(0,$klassNumber,2)[0];
        //获取学生
        for ($j=0,$i=0; $i <count($students); $i++) { 
            if($students[$i]->klass_id==$klassIds[$klassId]){
                $studentIds[$j]=$students[$i]->id;
                $j++;
            }

        }
        //随机选择学生
        $studentNumber=count($studentIds);
        if ($studentNumber===0) {
        	return $this->error('该班级学生人数为0，请重新点名');
        }
        $studentId=(int)$this->dc_rand1(0,$studentNumber,5)[3];
        $Student=Student::get($studentIds[$studentId]);
             
    }   

}