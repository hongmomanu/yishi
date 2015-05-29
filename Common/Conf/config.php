<?php
return array(
/* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'robin',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'ys_',    // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
    'DB_SLAVE_NO'           =>  '', // 指定从服务器序号
    'DB_SQL_BUILD_CACHE'    =>  true, // 数据库查询的SQL创建缓存
    'DB_SQL_BUILD_QUEUE'    =>  'file',   // SQL缓存队列的缓存方式 支持 file xcache和apc
    'DB_SQL_BUILD_LENGTH'   =>  20, // SQL缓存的队列长度
    'DB_SQL_LOG'            =>  true, // SQL执行日志记录
    'DB_BIND_PARAM'         =>  false, // 数据库写入数据自动参数绑定
	'DEFAULT_CHARSET'       =>  'utf-8', // 默认输出编码
	'MODULE_ALLOW_LIST'     =>  array('Home','Admin'),
	'DEFAULT_MODULE'        =>  'Home',  // 默认模块
	'DEFAULT_TIMEZONE'      =>  'PRC',	// 默认时区
    'DEFAULT_AJAX_RETURN'   =>  'JSON',  // 默认AJAX 数据返回格式,可选JSON XML ...
    'DEFAULT_JSONP_HANDLER' =>  'jsonpReturn', // 默认JSONP格式返回的处理方法
    'DEFAULT_FILTER'        =>  '', // 默认参数过滤方法 用于I函数...
	'ERROR_MESSAGE'         =>  '页面错误！请稍后再试～',//错误显示信息,非调试模式有效
    'ERROR_PAGE'            =>  '',	// 错误定向页面
    'SHOW_ERROR_MSG'        =>  false,    // 显示错误信息
    'TRACE_EXCEPTION'       =>  false,   // TRACE错误信息是否抛异常 针对trace方法 
    'TRACE_MAX_RECORD'      =>  100,    // 每个级别的错误信息 最大记录数
 	/* URL设置 */
    'URL_CASE_INSENSITIVE'  =>  false,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'             =>  1,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_PATHINFO_DEPR'     =>  '/',	// PATHINFO模式下，各参数之间的分割符号
    'URL_PATHINFO_FETCH'    =>  'ORIG_PATH_INFO,REDIRECT_PATH_INFO,REDIRECT_URL', // 用于兼容判断PATH_INFO 参数的SERVER替代变量列表
    'URL_REQUEST_URI'       =>  'REQUEST_URI', // 获取当前页面地址的系统变量 默认为REQUEST_URI
    //'URL_HTML_SUFFIX'       =>  'html',  // URL伪静态后缀设置
    'URL_DENY_SUFFIX'       =>  'ico|png|gif|jpg', // URL禁止访问的后缀设置
    'URL_PARAMS_BIND'       =>  true, // URL变量绑定到Action方法参数
    'URL_PARAMS_BIND_TYPE'  =>  0, // URL变量绑定的类型 0 按变量名绑定 1 按变量顺序绑定
    'URL_404_REDIRECT'      =>  '', // 404 跳转页面 部署模式有效
	'DEFAULT_THEME'         =>  'default',	// 默认模板主题名称
	'weburl'				=> 'http://robin.com',
    'AUTH_CONFIG'=>array(
            'AUTH_ON' => false, //认证开关
            'AUTH_TYPE' => 1, // 认证方式，1为时时认证；2为登录认证。
            'AUTH_GROUP' => 'sxpfs_auth_group', //用户组数据表名
            'AUTH_GROUP_ACCESS' => 'sxpfs_auth_group_access', //用户组明细表
            'AUTH_RULE' => 'sxpfs_auth_rule', //权限规则表
            'AUTH_USER' => 'sxpfs_admin'//用户信息表
        ),
    'USER_ADMINISTRATOR' => 3,
		/* 支付设置 */
		'payment' => array(
				'tenpay' => array(
						// 加密key，开通财付通账户后给予
						'key' => 'e82573dc7e6136ba414f2e2affbe39fa',
						// 合作者ID，财付通有该配置，开通财付通账户后给予
						'partner' => '1900000113'
				),
				'alipay' => array(
						// 收款账号邮箱
						'email' => '97294505@qq.com',
						// 加密key，开通支付宝账户后给予
						'key' => '',
						// 合作者ID，支付宝有该配置，开通易宝账户后给予
						'partner' => ''
				),
				'palpay' => array(
						'business' => 'zyj@qq.com'
				),
				'yeepay' => array(
						'key' => '69cl522AV6q613Ii4W6u8K6XuW8vM1N6bFgyv769220IuYe9u37N4y7rI4Pl',
						'partner' => '10001126856'
				),
				'kuaiqian' => array(
						'key' => '1234567897654321',
						'partner' => '1000300079901'
				),
				'unionpay' => array(
						'key' => '88888888',
						'partner' => '105550149170027'
				)
		)
);