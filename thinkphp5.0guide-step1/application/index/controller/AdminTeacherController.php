<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Teacher;

class AdminTeacherController extends Controller
{
    public function index()
    {
         // 获取查询信息
        $name = Request::instance()->get('name');

        $pageSize = 5; // 每页显示5条数据

        // 实例化Teacher
        $Teacher = new Teacher; 

        // 按条件查询数据并调用分页
        $teachers = $Teacher->where('name', 'like', '%' . $name . '%')->paginate($pageSize, false, [
            'query'=>[
                'name' => $name,
                ],
            ]); 

        // 向V层传数据
        $this->assign('teachers', $teachers);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }

    public function edit()
    {
    	$htmls = $this->fetch();
    	return $htmls;
    }

    public function add()
    {
    	$htmls = $this->fetch();
    	return $htmls;
    }
}