<?php
/**
*author:quanyinzhong
*email��290551872@163.com
*website:http://www.35258.com
**/
namespace Admin\Controller;
use Org\Util\Auth;

use Org\Util\Date;

use Think\Controller;
class CommonController extends Controller {
	public function _initialize(){
		header('Content-Type:text/html;charset=utf-8');

		 //检查登陆
		 if(!is_login()){
			$this->error('您还没有登录，请先登陆',U('Public/login'));
		} 
		/*
		if(is_administrator(session('uid'))){
            return true;//管理员允许访问任何页面
        }
		import('Org.Util.Auth');//加载类库
		$auth = new Auth();
		
		$rule  = strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
		if(!$auth->check($rule,session('uid'),1,'url')){
			  $this->error('你没有权限');
       } */
	}
	/**
      +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * @param Model $model 数据对象
     * @param HashMap $map 过滤条件
     * @param string $sortBy 排序
     * @param boolean $asc 是否正序
      +----------------------------------------------------------
     * @return void
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    protected function _list($model, $map = array(), $sortBy = '', $asc = false,$Rows=15) {
        //排序字段 默认为主键名
        if (isset($_REQUEST['_order'])) {
            $order = $_REQUEST['_order'];
        } else {
            $order = !empty($sortBy) ? $sortBy : 'id';
        }
        //排序方式默认按照倒序排列
        //接受 sost参数 0 表示倒序 非0都 表示正序
        if (isset($_REQUEST['_sort'])) {
            $sort = $_REQUEST['_sort'] ? 'asc' : 'desc';
        } else {
            $sort = $asc ? 'asc' : 'desc';
        }
        $model = M($model);
        //取得满足条件的记录数
        $count = $model->where($map)->count('id');
        //创建分页对象
       	//获取分页数
        $pageId = $_GET['page'];
        $pageId = $pageId == "" ? 1 : $pageId;
        $pageCount = ceil($count / $Rows);
        $url = CONTROLLER_NAME.'/'.ACTION_NAME;
        
        //分页查询数据
        $list = $model->where($map)->order($order . ' ' . $sort)->page($pageId,$Rows)->select();
        //echo $model->getLastsql();
        
         //分页跳转的时候保证查询条件
         $f = '';
      
        foreach ($map as $key => $val) {
            if (!is_array($val)) {
                $f .= "/$key/" . urlencode($val);
            }else{
            	$types = array('applytime','zitime','ordertime');
            	if(in_array($key, $types)){
            		$f .= '/type/'.$key;
            	}
            	if($key == 'phone'){
            		$f .= "/$key/" .str_replace('%', '', $val['1']);
            	}else{
            		$newtime = explode(',', $val['1']);
            		$f .= '/time1/'.date('Y-m-d',$newtime['0']).'/time2/'.date('Y-m-d',$newtime['1']);
            	}
            	
            }
        }
        $page = pagerank($pageCount,$pageId,$count,$url,$f);
		//dump($list);
        //模板赋值显示
        $this->assign('list', $list);
        $this->assign('page',$page);
       // Cookie::set('_currentUrl_', __SELF__);
        return;
    }
    /**
      +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * @param Model $model 数据对象
     * @param HashMap $map 过滤条件
     * @param string $sortBy 排序
     * @param boolean $asc 是否正序
      +----------------------------------------------------------
     * @return void
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    protected function _add($model, $data=array()){
    	$model = M($model);
    	$result = $model->data($data)->add();
    	if(false !== $result){
    		$this->success('添加数据成功');
    	}else{
    		$this->error('添加数据失败');
    	}
    }
    /**
     * 删除记录
     * **/
 protected function _del($model, $id){
    	$model = M($model);
    	$result = $model->delete($id);
    	if(false !== $result){
    		$this->success('不要的垃圾就该丢掉');
    	}else{
    		$this->error('丢弃垃圾失败');
    	}
    }
}