<?php
namespace app\common\validate;
use think\Validate;

class Mould extends Validate
{
    protected $rule = [
    	'id' => 'require',
    	'name' => 'require|length:2,25',
    	'row' => 'require',
    	'line' => 'require',
    	'num' => 'require',
    ];
}