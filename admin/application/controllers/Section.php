<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends MY_Controller
{
    private $sectiondb;
    private $eventdb;
    private $mapdb;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Eventmodel');
        $this->eventdb = $this->Eventmodel;
        $this->load->model('Mapmodel');
        $this->mapdb = $this->Mapmodel;
        $this->load->model('Sectionmodel');
        $this->sectiondb = $this->Sectionmodel;
    }
    //场次-列表
    public function manage()
    {
        $map_id = $this->input->get('map_id'); 
        if(isset($map_id) && !empty($map_id)){
            $data['where']['map_id'] = $map_id;
            $mapInfo = $this->mapdb->getMapById($map_id);
        }
        
        $data['order'] = "id ASC";
        $data['limit'] = PAGESIZE;
        $page = $this->input->get('page');
        $currentPage = $page = isset($page) ? intval($page) : 1;
        $offset = ($page - 1) * PAGESIZE;
        $data['offset'] = $offset;
        $result = $this->sectiondb->sectionList($data);
        $this->load->library('Page');
        $parameter = array('map_id' => $map_id);
        if(isset($parameter)){
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage,$parameter);
        }else{
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage);
        }
        $pageObject->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $pages = $pageObject->show();
        $dataShow = array('pages' => $pages, 'datas' => $result['rows']);
        $dataShow['mapInfo']=$mapInfo;
        $this->load->view('section/manage', $dataShow);
    }

    //场次-添加
    public function section_add(){
        $section['map_id']=$_REQUEST['map_id'];
        $section['mapInfo'] = $this->mapdb->getMapById($section['map_id']);
        $this->load->view('section/sectionAdd',$section);
    }
    
    //场次开关
    public function ismenuEvent(){
		if(IS_AJAX){
			$id = $this->input->post('id');
			$ismenu = $this->input->post('ismenu');
            $datasel['id']=$id;
			$eventInfo = $this->eventdb->getEventById($datasel);
			if(!empty($id)){
				$saveData['id'] = $id;
				$saveData['ismenu'] = $ismenu;
				$result = $this->eventdb->saveEvent($saveData);
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
    public function section_edit()
    {
        $id = $this->input->get('id');
        $data['sectionInfo'] = $this->sectiondb->getSectionById($id);
        $data['mapInfo'] = $this->mapdb->getMapById($data['sectionInfo']['map_id']);
        $this->load->view('section/sectionEdit', $data);
    }

    //场次-保存
    public function section_save(){
        if(IS_POST){
            $section_id=$this->input->get('id');
            $map_id=$_REQUEST['map_id'];
            $section=$this->sectiondb->getSectionById($section_id);
            if(isset($section_id) && !empty($section_id)){
                $saveData['id'] = $this->input->get('id');
            }
            if(isset($map_id) && !empty($map_id)){
                $saveData['map_id'] =$map_id ;
            }
            $saveData['section_name'] = $this->input->post('section_name');
            $saveData['fillcolor'] = $this->input->post('fillcolor');
            $saveData['section_path'] = $this->input->post('section_path');
            $result = $this->sectiondb->saveSection($saveData);
            if($result){
                header('Location: '.site_url('section/manage')."?map_id=".$section['map_id'],true);
            }else{
                $data['msg'] = '保存区域失败';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this -> load -> view('common/error', $data);
            }
        }
    }


    //场次-删除
    public function section_del(){
        if(IS_AJAX){
            $id = $this->input->post('id');
            //(2).删除图片后进行数据库该条数据库删除操作
            $result = $this->sectiondb->delSectionById($id);
            
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