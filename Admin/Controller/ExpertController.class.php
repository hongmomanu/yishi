<?php
// 本类由系统自动生成，仅供测试用途
namespace Admin\Controller;
use Think\Controller;
class ExpertController extends Controller {
	public function _initialize(){
		$user = session('doctor');
	    if (empty($user)) {
	        $this->error("请先登陆");
	    }
	}
	//框架首页
    public function index(){
    	$this->display();
    }
    //顶部
    public function top(){
    	$this->display();
    }
    
    public function left(){
    	$this->display();
    }
    public function right(){
    	$uid = $_SESSION['doctor']['id'];
		$num1 = D('user')->getNum($uid);
		
		$num2 = D('user')->getNum($uid,2);
		$this->assign('num1',$num1);
		$this->assign('num2',$num2);
    	$this->display();
    }
    public function switchs(){
    	$this->display();
    }
    public function foot(){
    	$this->display();
    }
    function today(){
    	$times = udate();
    	$condition['zhuanjiaid'] = $_SESSION['doctor']['id'];
    	$condition['ordertime'] = array('between',$times['0'].','.$times['1']);
    	$this->_list('user',$condition);
    	$this->display();
    }
    function history(){
    	$times = udate();
    	$time = strtotime(I('get.time1')." 00:00:00");
		$times = strtotime(I('get.time2')." 23:59:59");
    	$condition['zhuanjiaid'] = $_SESSION['doctor']['id'];
    	$condition['ordertime'] = array('between',$time.','.$times);
    	$this->_list('user',$condition);
    	$search['time1'] = I('get.time1')?I('get.time1'):date('Y-m-d',time());
		$search['time2'] = I('get.time2')?I('get.time2'):date('Y-m-d',time());
		$this->assign('search',$search);
    	$this->display();
    }
    function view(){
    	$id = I('id');
    	$data = M('user')->field('content')->find($id);
    	$this->assign('content',$data['content']);
    	$this->display();
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
       // echo $model->getLastsql();
        
         //分页跳转的时候保证查询条件
         $f = '';
        foreach ($map as $key => $val) {
            if (!is_array($val)) {
                $f .= "/$key/" . urlencode($val);
            }else{
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
}