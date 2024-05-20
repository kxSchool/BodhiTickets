<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seats extends MY_Controller
{
    private $sectiondb;
    private $eventdb;
    private $mapdb;
    private $seatsdb;
    private $showdb;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Eventmodel');
        $this->eventdb = $this->Eventmodel;
        $this->load->model('Mapmodel');
        $this->mapdb = $this->Mapmodel;
        $this->load->model('Sectionmodel');
        $this->sectiondb = $this->Sectionmodel;
        $this->load->model('Pricemodel');
        $this->pricedb = $this->Pricemodel;
        $this->load->model('Showmodel');
        $this->showdb = $this->Showmodel;
        require($this->config->item('Seatsmode').'Seatsmodel.php');
    }
    //场次-列表
    public function manage()
    {
        $price_id = $this->input->get('price_id'); 
        if(isset($price_id) && !empty($price_id)){
            $priceInfo=$this->pricedb->getPriceById($price_id);
            $sectionInfo=$this->sectiondb->getSectionById($priceInfo['section_id']);
            $mapInfo=$this->mapdb->getMapById($sectionInfo['map_id']);
            $showInfo=$this->showdb->getShowById($mapInfo['show_id']);
            $data['where']['section_id'] = $sectionInfo['id'];
            $data['where']['map_id'] = $mapInfo['id'];
            $data['where']['price_id'] = $priceInfo['price_id'];
        }
        
        $data['order'] = "id ASC";
        $data['limit'] = PAGESIZE;
        $page = $this->input->get('page');
        $currentPage = $page = isset($page) ? intval($page) : 1;
        $offset = ($page - 1) * PAGESIZE;
        $data['offset'] = $offset;
        //$this->load->model('Seatsmodel');
        $this->seatsdb = new Seatsmodel("map".$mapInfo['id']."_seats");
        $result = $this->seatsdb->SeatsList($data);
        $this->load->library('Page');
        $parameter = array('price_id' => $price_id);
        if(isset($parameter)){
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage,$parameter);
        }else{
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage);
        }
        $pageObject->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $pages = $pageObject->show();
        $dataShow = array('pages' => $pages, 'datas' => $result['rows']);
        $dataShow['sectionInfo']=$sectionInfo;
        $dataShow['mapInfo']=$mapInfo;
        $dataShow['seatsInfo']=$seatsInfo;
        $dataShow['priceInfo']=$priceInfo;
        $dataShow['price_id']=$this->input->get('price_id');
        $this->load->view('seats/manage', $dataShow);
    }

    //场次-添加
    public function seats_add(){
        $data['price_id']=$this->input->get('price_id');
        $data['priceInfo']=$priceInfo = $this->pricedb->getPriceById($data['price_id']);
        $data['sectionInfo']=$sectionInfo = $this->sectiondb->getSectionById($priceInfo['section_id']);
        $data['mapInfo']=$mapInfo = $this->mapdb->getMapById($sectionInfo['map_id']);
        unset($data['mapInfo']['seats'],$data['mapInfo']['area'],$data['mapInfo']['price']);
        //print_r($data);exit;
        $this->load->view('seats/seatsAdd',$data);
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
    public function seats_edit()
    {
        $id = $this->input->get('id');
        $this->seatsdb = new Seatsmodel("map".$this->input->get('map_id')."_seats");
        $data['seatsInfo']=$seatsInfo= $this->seatsdb->getSeatsById($id);
        $data['priceInfo']=$priceInfo = $this->pricedb->getPriceById($seatsInfo['price_id']);
        $data['sectionInfo']=$sectionInfo = $this->sectiondb->getSectionById($priceInfo['section_id']);
        $data['mapInfo']=$mapInfo = $this->mapdb->getMapById($sectionInfo['map_id']);
        unset($data['mapInfo']['seats'],$data['mapInfo']['area'],$data['mapInfo']['price']);
        $this->load->view('seats/seatsEdit', $data);
    }

    //场次-保存
    public function seats_save(){
        if(IS_POST){
            $seats_id=$this->input->get('id');
            if (isset($seats_id) && !empty($seats_id)){
                $saveData['id'] = $seats_id;
                $map_id=$this->input->get('map_id');
                $this->seatsdb = new Seatsmodel("map".$this->input->get('map_id')."_seats");
                $seatsInfo= $this->seatsdb->getSeatsById($seats_id);
                $price_id=$seatsInfo['price_id'];
            }else{
                $price_id=$this->input->get('price_id');
                $priceInfo= $this->pricedb->getPriceById($price_id);
                
                $saveData['price_id'] = $price_id;
                $saveData['section_id'] = $priceInfo['section_id'];
                $sectionInfo= $this->sectiondb->getSectionById($priceInfo['section_id']);
                $map_id=$sectionInfo['map_id'];
                $saveData['map_id'] = $map_id;
                $this->seatsdb = new Seatsmodel("map".$map_id."_seats");
            }
            $saveData['cy'] = $this->input->post('cy');
            $saveData['cx'] = $this->input->post('cx');
            $saveData['seat_no'] = $this->input->post('seat_no');
            $saveData['row'] = $this->input->post('row');;
            $saveData['column'] = $this->input->post('column');
            $saveData['status'] = $this->input->post('status');
            $result = $this->seatsdb->saveSeats($saveData);
            if($result){
                header('Location: '.site_url('seats/manage')."?price_id=".$price_id,true);
            }else{
                $data['msg'] = '保存区域失败';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this -> load -> view('common/error', $data);
            }
        }
    }


    //场次-删除
    public function seats_del(){
        if(IS_AJAX){
            $id = $this->input->post('id');
            $map_id = $this->input->post('map_id');
            $this->seatsdb = new Seatsmodel("map".$map_id."_seats");
            //(2).删除图片后进行数据库该条数据库删除操作
            $result = $this->seatsdb->delSeatsById($id);
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