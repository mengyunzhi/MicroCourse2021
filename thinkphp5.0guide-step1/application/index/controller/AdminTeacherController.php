<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Teacher;
/**
 * 管理员端教师管理
 */
class AdminTeacherController extends Controller
{   
    public function index()
    {
        try {
            // 获取查询信息
            $name = Request::instance()->get('name');

            $pageSize = 5; // 每页显示5条数据

            // 实例化Teacher
            $Teacher = new Teacher; 

            // 定制查询信息
            if (!empty($name)) {
                $Teacher->where('name', 'like', '%' . $name . '%');
            }

            // 按条件查询数据并调用分页
            $teachers = $Teacher->paginate($pageSize, false, [
                'query'=>[
                    'name' => $name,
                    ],
                ]);

            // 向V层传数据
            $this->assign('teachers', $teachers);
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

            // 取回打包后的数据
            $htmls = $this->fetch();

            // 将数据返回给用户
            return $htmls;

        // 获取到ThinkPHP的内置异常时，直接向上抛出，交给ThinkPHP处理
        } catch (\think\Exception\HttpResponseException $e) {
            throw $e;

        // 获取到正常的异常时，输出异常
        } catch (\Exception $e) {
            return $e->getMessage();
        } 
    }
    //编辑数据
    public function edit()
    {
    	try{
            $id=Request::instance()->param('id/d');
            if(is_null($id)){
                throw new\Exception('未获取到ID信息',1);
            }
            if(null===$Teacher=Teacher::get($id)){
                $this->error('系统未找到ID为' . $id . '的记录');
            }
            $this->assign('Teacher',$Teacher);
            return $this->fetch();
        }catch(\think\Exception\HttpResponseException $e){
        throw $e;
        }catch(\Exception $e){
        return $e->getMessage();
        }
    }
    //增加数据
    public function add()
    {
    	try {
            $htmls = $this->fetch();
            return $htmls;
        } catch (\Exception $e) {
            return '系统错误' . $e->getMessage();
        }
    }

    public function save()
    {
         $message = '';  // 提示信息

        try {
            // 接收传入数据
            $postData = Request::instance()->post();    

            // 实例化Teacher空对象
            $Teacher = new Teacher();
            // 新增对象至数据表
            $result = $Teacher->validate(true)->save($postData);

            // 反馈结果
            if (false === $result)
            {
                // 验证未通过，发生错误
                $message = '新增失败:' . $Teacher->getError();
            } else {
                // 提示操作成功，并跳转至教师管理列表
                return $this->success('用户' . $Teacher->name . '新增成功。', url('index'));
            }
        }catch(\think\Exception\HttpResponseException $e){
            throw $e;
        }catch (\Exception $e) {
            // 发生异常
            return $e->getMessage();
        }
        return $this->error($message);
    }
    //更新数据
    public function update()
    {   
        $message='';
        try{
            $id=Request::instance()->post('id/d');
            //获取当前对象
            $Teacher=Teacher::get($id);
            if(!is_null($Teacher)){
                $Teacher->name=input('post.name');
                $Teacher->number=input('post.number');
                $Teacher->sex=input('post.sex');
                $Teacher->email=input('post.email');
                    if(false===$Teacher->validate(true)->save()){
                        return $this->error('更新失败' . $Teacher->getError());
                    }
            }else{
                throw new \Exception("所更新的记录不存在", 1);
                
            }
        }catch(\think\Exception\HttpResponseException $e){
            throw $e;
        }catch(\Exception $e){
            return $e->getMessage();
        }
        return $this->success('操作成功',url('index'));
    }
    //删除数据
    public function delete()
    {
        try {
            // 获取get数据
            $Request = Request::instance();
            $id = Request::instance()->param('id/d');
            
            // 判断是否成功接收
            if (0 === $id) {
                throw new \Exception("未获取到ID信息", 1);
            }

            // 获取要删除的对象
            $Teacher = Teacher::get($id);

            // 要删除的对象存在
            if (is_null($Teacher)) {
                throw new \Exception('不存在id为' . $id . '的教师，删除失败', 1);
            }

            // 删除对象
            if (!$Teacher->delete()) {
                $message = '删除失败:' . $Teacher->getError();
            }

            // 进行跳转
            return $this->success('删除成功', $Request->header('referer')); 
        }catch(\think\Exception\HttpResponseException $e){
            throw $e;
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return $this->error($message);
    }
    //重置密码
    public function resentPassword()
    {
        try{
            //接收id
            $id=Request::instance()->param('id/d');
            if(is_null($id)||0===$id){
                throw new \Exception('未获取到ID信息', 1);
            }
            //获取对应的Student
            if (null===$Teacher=Teacher::get($id)) {
                return $this->error('系统未找到ID为' . $id . '的记录');
            }
            //重置密码
            $Teacher->password=$Teacher->number;
            //保存
            $Teacher->save();
            return $this->success('操作成功 密码重置为工号'.$Teacher->number, url('index'));
        }catch(\think\Exception\HttpResponseException $e){
            throw $e;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}