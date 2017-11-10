<?php

namespace app\admin\validate;
use think\Validate;
/**
* 设置模型
*/
class Patient extends Validate{

	protected $rule = array(
		'patient_name'  		=> 'require|length:6,12|unique:patient',
		'patient_password'      	=> 'require',
		'patient_tel'      	=> 'require|length:11|unique:patient',
	);
	protected $message = array(
		'patient_name.require'    	=> '用户名必须填写',
		'patient_name.length'    	=> '用户名长度在6到12位',
		'patient_name.unique'    	=> '用户名已存在',
		'patient_password.require'    	=> '密码必须填写',
        'patient_tel.require'    	=> '手机号码必须填写',
        'patient_tel.length'    	=> '手机号码长度在11位',
        'patient_tel.unique'    	=> '手机号码已存在',
	);
}