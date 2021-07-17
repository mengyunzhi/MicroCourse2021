<?php
namespace app\common\validate;
use think\Validate;

class Score  extends Validate
{
    protected $rule = [
    	'id' => 'require'
    ];
}