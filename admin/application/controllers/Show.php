<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Show extends MY_Controller
{
    private $showdb;
    private $categorydb;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Showmodel');
        $this->showdb = $this->Showmodel;
        $this->load->model('TicketsCategorymodel');
        $this->categorydb = $this->TicketsCategorymodel;

        $this->load->model('TicketsCategoryShowmodel');
        $this->categoryshowdb = $this->TicketsCategoryShowmodel;

    }

    //品牌-列表
    public function manage()
    {
        //是否存在传值
        $show = $this->input->post('show_select');
        if(isset($show) && !empty($show)){
            $data['where']['namelike'] = $show;
            $this->load->vars('show_select',$show);
        }
        $data['order'] = "id ASC";
        $data['limit'] = PAGESIZE;
        $page = $this->input->get('page');
        $currentPage = $page = isset($page) ? intval($page) : 1;
        $offset = ($page - 1) * PAGESIZE;
        $data['offset'] = $offset;
        $result = $this->showdb->showList($data);
        foreach($result['rows'] as &$v){
            if(isset($v['logoimg']) && !empty($v['logoimg'])){
                $v['logoimg'] = $this->config->item('show_url') . $v['logoimg'];
            }
        }
        $this->load->library('Page');
        if(isset($parameter)){
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage,$parameter);
        }else{
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage);
        }
        $pageObject->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $pages = $pageObject->show();
        $dataShow = array('pages' => $pages, 'datas' => $result['rows']);
        $this->load->view('show/manage', $dataShow);
    }

    //品牌-添加
    public function show_add(){
        $this->load->view('show/showAdd');
    }
    
    //表演开关
    public function ismenuShow(){
		if(IS_AJAX){
			$catid = $this->input->post('showid');
			$ismenu = $this->input->post('ismenu');
			$showInfo = $this->showdb->getShowById($catid);
			if(!empty($showInfo)){
				$saveData['id'] = $catid;
				$saveData['ismenu'] = $ismenu;
				$result = $this->showdb->saveShow($saveData);
				if($result){
					$data = array(
						'info' => 1,
						'tip' => '更新成功'
					);
				}else{
					$data = array(
						'info' => 0,
						'tip' => '更新失败'
					);
				}
			}else{
				$data = array(
					'info' => 0,
					'tip' => '传递参数错误'
				);
			}
			echo json_encode($data);
		}
	}


    //品牌-修改
    public function show_edit()
    {
        $id = $this->input->get('id');
        $showInfo = $this->showdb->getShowById($id);
        if (isset($showInfo['logoimg']) && !empty($showInfo['logoimg'])) {
            //判断一下图片是否存在
            if (file_exists($this->config->item('show_path') . $showInfo['logoimg'])) {
                $showInfo['logoimgurl'] = $this->config->item('show_url') . $showInfo['logoimg'];
            }
            $this->load->view('show/showEdit', $showInfo);
        } else {
            $this->load->view('show/showEdit', $showInfo);
        }
    }

    //品牌-保存
    public function show_save(){
        if(IS_POST){
            //是否存在attributeid,存在则修改，不存在则添加
            if (null !== $this->input->post('id')  && !empty($this->input->post('id'))){
                $saveData['id'] = $this->input->post('id');
            }
            $saveData['name'] = $this->input->post('name');
            $saveData['logoimg'] = $type = $this->input->post('show_img_name');
            $saveData['desc'] = $this->input->post('desc');
            $saveData['startdate'] = $this->input->post('startdate');
            $saveData['enddate'] = $this->input->post('enddate');
            $result = $this->showdb->saveShow($saveData);
            if($result){
                redirect('show/manage');
            }else{
                $data['msg'] = '保存品牌失败';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this -> load -> view('common/error', $data);
            }
        }
    }


    //品牌-删除
    public function show_del(){
        if(IS_AJAX){
            $id = $this->input->post('id');
            //(1).通过id查找图片名称，并进行图片的删除操作
            $query = $this->showdb->getShowById($id);
            if(isset($query['logoimg']) && !empty($query['logoimg'])) {
                $imgdir = $this->config->item('show_path').$query['logoimg'];
                if(file_exists($imgdir)){
                    unlink($imgdir);
                }
            }
            //(2).删除图片后进行数据库该条数据库删除操作
            $result = $this->showdb->delShowById($id);
            if($result){
                $data = array(
                    'info' => 1,
                    'tip' => '操作成功'
                );
            }else{
                $data = array(
                    'info' => 0,
                    'tip' => '操作失败'
                );
            }
            echo json_encode($data);
        }
    }

    //品牌-品类
    public function show_category(){
        //(1)品牌id
        $id = $this->input->get('id');
        $data['id'] = $id;
        //(2)无限极分类取出最后一级分类
        $LastLevelData = $this->getSortedCategory();
        if(!empty($LastLevelData)){
            $data['LastLevelData'] = $LastLevelData;
        }
        //(3)取出该品牌下的所有分类
        $showcategorys =  $this->categoryshowdb->getBCById($id);
        if(!empty($showcategorys)){
            foreach($showcategorys as $v){
                $ids[] = $v['cat_id'];
            }
            $data['ids'] = $ids;
        }
        //(4)通过品牌id，获取品牌的名称
        $getShowName = $this->showdb->getShowById($id);
        if(!empty($getShowName['name'])){
            $data['name'] = $getShowName['name'];
        }
        $this->load->view('show/showCategory',$data);
    }

    //处理提交值
    public function updateShowCategory(){
        //用户更新
        if(IS_AJAX){
            $catids = $this->input->post('cat_id');//会员userids
            $showid = $this->input->post('show_id');//会员userids
            $query = $this->categoryshowdb->getBCById($showid);
            $cat_ids = explode(',',$catids);
            //echo json_encode($cat_ids);exit;
            //(1)删除操作
            if(!empty($query)){
                //进行删除操作
                $delQuery = $this->categoryshowdb->delBCById($showid);
                if(!$delQuery){
                    $data = array(
                        'info' => 0,
                        'tip' => '数据更新失败！'
                    );
                    echo json_encode($data);exit;
                }
            }
            //(2)添加操作
            $data = array();
            foreach($cat_ids as $v){
                $datas = array(
                   'cat_id' => $v,
                   'show_id' => $showid,
                   'sort' => ''
                );
                //循环插入数据
                $data[] = $datas;
            }
            $addQuery = $this->categoryshowdb->addShowCategory($data);
            if($addQuery){
                $data = array(
                    'info' => 1,
                    'tip' => '更新成功'
                );
            }else{
                $data = array(
                    'info' => 0,
                    'tip' => '操作失败'
                );
            }
            echo json_encode($data);exit;
        }
    }




    /********************************以下为本类的公共方法*********************************/
    //属性-调用分类数据（无限级分类）
    //获取排序后的分类
    public function getSortedCategory()
    {
        $allCategory = $this->categorydb->getAllCategory();
        if(is_array($allCategory) && !empty($allCategory)){
            foreach($allCategory as $k=>&$v){
                $cat_id = $v['cat_id'];
                $cat_pid = $v['cat_pid'];
                $allCategory[$k]['id'] = $cat_id;
                $allCategory[$k]['parentid'] = $cat_pid;
            }
            $Category = formatTreeLevel($allCategory,0);
            $result = array_multi2single($Category);
            foreach($result as &$vv){
                if(array_key_exists('nochild', $vv)){
                    $LastLevelDate[] = $vv;
                }
            }
            return $LastLevelDate;
        }else{
            return FALSE;
        }
    }

    public function getAllShows(){
        $showsrst = $this->showdb->getAllShows();
        $allshows = array();
        if(!empty($showsrst)) {
            foreach ($showsrst as $v) {
                $allshows[] = $v['name'];
            }
        }
        if(!empty($allshows)){
            $data = array(
                'info' => 1,
                'shows' => $allshows
            );
            echo json_encode($data);
        }
    }


    //通过名称去模糊匹配品牌名
    public function getShowLikeName(){
        $showname = $this->input->post("show");
        $showsrst = $this->showdb->getShowsLikeName($showname);
        $shows = array();
        if(!empty($showsrst)){
            foreach($showsrst as $v){
                $shows[] = $v['name'];
            }
        }
        if(!empty($shows)){
            $data = array(
                'info' => 1,
                'shows' => $shows
            );
            echo json_encode($data);
        }

    }
}