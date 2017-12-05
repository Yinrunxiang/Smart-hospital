<?php
// +----------------------------------------------------------------------
// | Description: 基础框架路由配置文件
// +----------------------------------------------------------------------
// | Author: JensenYin
// +----------------------------------------------------------------------

return [
    // 定义资源路由
    '__rest__'=>[
        'admin/department'		   =>'admin/department',
        'admin/medicine'		   =>'admin/medicine',
        'admin/record'		   =>'admin/record',
        'admin/user'		   =>'admin/user',
        'admin/doctor'		   =>'admin/doctor',
        'admin/nurse'		   =>'admin/nurse',
        'admin/patient'		   =>'admin/patient',
        'admin/rules'		   =>'admin/rules',
        'admin/groups'		   =>'admin/groups',
        'admin/users'		   =>'admin/users',
        'admin/menus'		   =>'admin/menus',
        'admin/structures'	   =>'admin/structures',
        'admin/posts'          =>'admin/posts',
    ],

	// 【基础】登录
	'admin/base/login' => ['admin/base/login', ['method' => 'POST']],
	// 【基础】记住登录
	'admin/base/relogin'	=> ['admin/base/relogin', ['method' => 'POST']],
	// 【基础】修改密码
	'admin/base/setInfo' => ['admin/base/setInfo', ['method' => 'POST']],
	// 【基础】退出登录
	'admin/base/logout' => ['admin/base/logout', ['method' => 'POST']],
	// 【基础】获取配置
	'admin/base/getConfigs' => ['admin/base/getConfigs', ['method' => 'POST']],
	// 【基础】获取验证码
	'admin/base/getVerify' => ['admin/base/getVerify', ['method' => 'GET']],
	// 【基础】上传图片
	'admin/upload' => ['admin/upload/index', ['method' => 'POST']],
	// 保存系统配置
	'admin/systemConfigs' => ['admin/systemConfigs/save', ['method' => 'POST']],
    // 【部门】批量删除
    'admin/department/deletes' => ['admin/department/deletes', ['method' => 'POST']],
    // 【部门】批量启用/禁用
    'admin/department/enables' => ['admin/department/enables', ['method' => 'POST']],
    // 【病历】获取医生工作病历
    'admin/record/getRecordByDoctor' => ['admin/record/getRecordByDoctor', ['method' => 'POST']],
    // 【病历】获取病人病历
    'admin/record/getRecordByPatient' => ['admin/record/getRecordByPatient', ['method' => 'POST']],
    // 【病历】开始就诊的病人
    'admin/record/beginTreatment' => ['admin/record/beginTreatment', ['method' => 'POST']],
    // 【病历】结束就诊的病人
    'admin/record/endTreatment' => ['admin/record/endTreatment', ['method' => 'POST']],
    // 【病历】错过就诊的病人
    'admin/record/missTreatment' => ['admin/record/missTreatment', ['method' => 'POST']],
    // 【病历】获取医生平均就诊时间
    'admin/record/treatmentTime' => ['admin/record/treatmentTime', ['method' => 'POST']],
    // 【病历】批量删除
    'admin/record/deletes' => ['admin/record/deletes', ['method' => 'POST']],
    // 【病历】批量启用/禁用
    'admin/record/enables' => ['admin/record/enables', ['method' => 'POST']],
	// 【用户】批量删除
	'admin/user/deletes' => ['admin/users/deletes', ['method' => 'POST']],
	// 【用户】批量启用/禁用
	'admin/user/enables' => ['admin/users/enables', ['method' => 'POST']],
    // 【医生】批量删除
    'admin/doctor/deletes' => ['admin/doctor/deletes', ['method' => 'POST']],
    // 【医生】批量启用/禁用
    'admin/doctor/enables' => ['admin/doctor/enables', ['method' => 'POST']],
    // 【护士】批量删除
    'admin/nurse/deletes' => ['admin/nurse/deletes', ['method' => 'POST']],
    // 【护士】批量启用/禁用
    'admin/nurse/enables' => ['admin/nurse/enables', ['method' => 'POST']],
    // 【病人】批量删除
    'admin/patient/deletes' => ['admin/patient/deletes', ['method' => 'POST']],
    // 【病人】批量启用/禁用
    'admin/patient/enables' => ['admin/patient/enables', ['method' => 'POST']],
	
	// MISS路由
	'__miss__'  => 'admin/base/miss',
];