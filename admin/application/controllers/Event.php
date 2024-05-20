<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends MY_Controller
{
    private $eventdb;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Eventmodel');
        $this->eventdb = $this->Eventmodel;
        $this->load->model('Showmodel');
        $this->showdb = $this->Showmodel;

        $this->load->model('Venuemodel');
        $this->venuedb = $this->Venuemodel;
        $this->load->model('Mapmodel');
        $this->mapdb = $this->Mapmodel;


    }

    //场次-列表
    public function manage()
    {
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
        $result = $this->eventdb->eventList($data);
        //print_r($result);exit;
        foreach($result['rows'] as &$v){
             if(isset($v['show_id']) && !empty($v['show_id'])){
                $showInfo=$this->showdb->getShowById($v['show_id']);
                $v['show_pic'] = $this->config->item('show_url') . $showInfo['logoimg'];
             }
             if(isset($v['venue_id']) && !empty($v['venue_id'])){
                $venueInfo=$this->venuedb->getVenueById($v['venue_id']);
                $v['venue_pic'] = $this->config->item('venue_url') . $venueInfo['picname'];
                $v['venue_name'] = $venueInfo['venue_name'];
                $dataShow['map_id']=$v['map_id'];
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
        $this->load->view('event/manage', $dataShow);
    }

    //场次-添加
    public function event_add(){
        $data['limit'] = 0;
        $data['offset'] = 1000;
        $result = $this->venuedb->getAllVenues($data);
        $venue['show_id']=$this->input->get('show_id');
        $venue['map_id']=$this->input->post('map_id');
        $venue['show'] = $this->showdb->getShowById($venue['show_id']);
        $venue['venues']=$result['rows'];
        $this->load->view('event/eventAdd',$venue);
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
    public function event_edit()
    {
        $id = $this->input->get('id');
        $datasel['id']=$id;
        $data['eventInfo'] = $this->eventdb->getEventById($datasel);
        if(isset($data['eventInfo']['show_id']) && !empty($data['eventInfo']['show_id'])) 
        $data['showInfo'] = $this->showdb->getShowById($data['eventInfo']['show_id']);
        if(isset($data['eventInfo']['venue_id']) && !empty($data['eventInfo']['venue_id'])) 
        $data['venueInfo'] = $this->venuedb->getVenueById($data['eventInfo']['venue_id']);
        if(isset($data['eventInfo']['map_id']) && !empty($data['eventInfo']['map_id']))
        $data['mapInfo'] = $this->mapdb->getMapById($data['eventInfo']['map_id']);
        
        
        
        $data1['limit'] = 0;
        $data1['offset'] = 1000;
        $result = $this->venuedb->getAllVenues($data1);
        $data['show_id']=$data['eventInfo']['show_id'];
        $data['show'] = $this->showdb->getShowById($data['show_id']);
        $data['venues']=$result['rows'];
        
        $this->load->view('event/eventEdit', $data);
    }

    //场次-保存
    public function event_save(){
        if(IS_POST){
            //是否存在attributeid,存在则修改，不存在则添加
            if (null !== $this->input->post('id')  && !empty($this->input->post('id'))){
                $saveData['id'] = $this->input->post('id');
            }
            $saveData['venue_id'] = $this->input->post('venue_id');
            $saveData['show_id'] = $this->input->get('show_id');
            $saveData['map_id'] = $this->input->post('map_id');
            $saveData['show_date'] = $this->input->post('show_date');
            $saveData['order'] = $this->input->post('order');
            $result = $this->eventdb->saveEvent($saveData);
            if($result){
                header('Location: '.site_url('event/manage')."?show_id=".$this->input->get('show_id'),true);
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
            $datasel['id']=$id;
            //(1).通过id查找图片名称，并进行图片的删除操作
            $query = $this->eventdb->getEventById($datasel);
            //(2).删除图片后进行数据库该条数据库删除操作
            $result = $this->eventdb->delEventById($id);
            
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