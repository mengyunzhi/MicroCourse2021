<?php
namespace app\common\validate;
use think\Validate;

class Student extends Validate
{
    protected $rule = [
    	'name'  => 'require|length:2,25',
    	'number' => 'require|unique:teacher|length:2,11',
        'email' => 'email'
    ];
}