<?php
namespace app\common\validate;
use think\Validate;

class Aisle extends Validate
{
    protected $rule = [
    	'x' => 'require',
    	'y' => 'require',
    	'mid' => 'require',
    ];
}