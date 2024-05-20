<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends MY_Controller
{
    private $eventdb;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mapmodel');
        $this->mapdb = $this->Mapmodel;
        $this->load->model('MapSectionmodel');
        $this->mapsectiondb = $this->MapSectionmodel;
        $this->load->model('MapPricemodel');
        $this->mappricedb = $this->MapPricemodel;
        $this->load->model('MapSeatmodel');
        $this->mapseatdb = $this->MapSeatmodel;
        $this->load->model('Showmodel');
        $this->showdb = $this->Showmodel;
        $this -> load -> model('Logmodel');
		$this -> logdb = $this->Logmodel;
		$this -> logdata['uid'] = $this->session->userdata['id'];
		$this -> logdata['url'] = $this -> uri -> uri_string();
		$this -> logdata['ip'] = $this -> input -> ip_address();
    }

    //场次-列表
    public function manage()
    {
        $this -> logdata['remark'] = $this->session->userdata['account'].':座位图请求';
        $this -> logdb -> addLog($this -> logdata);
        $show_select=$this->input->post('show_select');
        if(isset($show_select) && !empty($show_select)){
            $showsrst = $this->showdb->getShowsLikeName($show_select);
            $show_id=$showsrst[0]['id'];
        }else{
            //是否存在传值
            $show_id = $this->input->get('show_id');
        }
        if(isset($show_id) && !empty($show_id)){
            $data['where']['show_id'] = $show_id;
            $showInfo = $this->showdb->getShowById($show_id);
            $this->load->vars('show_select',$showInfo['name']);
        }
        $data['order'] = "order,id ASC";
        $data['limit'] = PAGESIZE;
        $page = $this->input->get('page');
        $currentPage = $page = isset($page) ? intval($page) : 1;
        $offset = ($page - 1) * PAGESIZE;
        $data['offset'] = $offset;
        $result = $this->mapdb->mapList($data);
        foreach($result['rows'] as &$v){
            if(isset($v['mini']) && !empty($v['mini'])){
                $v['mini'] = $this->config->item('mapMini_url') . $v['mini'];
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
        $dataShow['show_id']=$this->input->get('show_id');
        $this->load->view('map/manage', $dataShow);
    }

    //场次-添加
    public function map_add(){
        $data['show_id'] = $this->input->get('show_id');
        $this->load->view('map/mapAdd',$data);
    }
    
    //场次开关
    public function ismenuShow(){
		if(IS_AJAX){
			$mapid = $this->input->post('id');
			$ismenu = $this->input->post('ismenu');
			$mapInfo = $this->mapdb->getMapById($mapid);
			if(!empty($mapInfo)){
				$saveData['id'] = $mapid;
				$saveData['ismenu'] = $ismenu;
				$result = $this->mapdb->saveMap($saveData);
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


    //场次-修改
    public function map_edit()
    {
        $id = $this->input->get('id');
        $mapInfo = $this->mapdb->getMapById($id);
        if (isset($mapInfo['background']) && !empty($mapInfo['background'])) {
            //判断一下图片是否存在
            if (file_exists($this->config->item('mapBackground_path') . $mapInfo['background'])) {
                $mapInfo['background_url'] = $this->config->item('mapBackground_url') . $mapInfo['background'];
            }
        }
        if (isset($mapInfo['mini']) && !empty($mapInfo['mini'])) {
            //判断一下图片是否存在
            if (file_exists($this->config->item('mapMini_path') . $mapInfo['mini'])) {
                $mapInfo['mini_url'] = $this->config->item('mapMini_url') . $mapInfo['mini'];
            }
        }
        $data['mapInfo']=$mapInfo;
        $this->load->view('map/mapEdit', $data);
        
    }

    //场次-保存
    public function map_save(){
        if(IS_POST){
            //是否存在attributeid,存在则修改，不存在则添加
            if (null !== $this->input->post('id')  && !empty($this->input->post('id'))){
                $saveData['id'] = $this->input->post('id');
            }else{
                $saveData['show_id'] = $this->input->get('show_id');
            }
            $saveData['map_name'] = $this->input->post('map_name');
            $saveData['background'] = $this->input->post('background_name');
            $saveData['mini'] = $this->input->post('mini_name');
            $saveData['style'] = $this->input->post('style');
            $saveData['area'] = $this->input->post('area');
            $saveData['price'] = $this->input->post('price');
            $saveData['seats'] = $this->input->post('seats');
            $saveData['cat_left'] = $this->input->post('cat_left');
            $saveData['cat_top'] = $this->input->post('cat_top');
            $saveData['cat_scaleVal'] = $this->input->post('cat_scaleVal');
            $result = $this->mapdb->saveMap($saveData);
            if($result){
                header('Location: '.site_url('map/manage')."?show_id=".$this->input->get('show_id'),true);
            }else{
                $data['msg'] = '保存品牌失败';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this -> load -> view('common/error', $data);
            }
        }
    }


    //场次-删除
    public function event_del(){
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

    //表演-场馆-日期
    public function event_show(){
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

    public function getAllEvents(){
        $eventsrst = $this->eventdb->getAllEvents();
        $allevents = array();
        if(!empty($eventsrst)) {
            foreach ($eventsrst as $v) {
                $allevents[] = $v['name'];
            }
        }
        if(!empty($allshows)){
            $data = array(
                'info' => 1,
                'events' => $allevents
            );
            echo json_encode($data);
        }
    }


    //通过名称去模糊匹配品牌名
    public function getEventsLikeName(){
        $eventname = $this->input->post("event");
        $eventsrst = $this->eventdb->getEventsLikeName($venuename);
        $events = array();
        if(!empty($eventsrst)){
            foreach($eventsrst as $v){
                $events[] = $v['name'];
            }
        }
        if(!empty($events)){
            $data = array(
                'info' => 1,
                'events' => $events
            );
            echo json_encode($data);
        }

    }
}