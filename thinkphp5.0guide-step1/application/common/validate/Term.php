<?php
namespace app\common\validate;
use think\Validate;

class Term extends Validate
{
    protected $rule = [
    	'name'  => 'require|length:2,25',
<<<<<<< HEAD
    	'create_time' => 'require',
    	'end_time' => 'require',
=======
>>>>>>> origin
    ];
}