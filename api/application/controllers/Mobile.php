<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends MY_Controller {

	private $staffdb;
	private $mapdb;
    private $sectiondb;
    private $panoramadb;
    private $showdb;
    private $seatsdb;
    private $pricedb;

	public function __construct() {
		parent::__construct();
		$this -> load -> model('Staffmodel');
		$this -> staffdb = $this->Staffmodel;
        $this -> load -> model('Eventmodel');
		$this -> eventdb = $this->Eventmodel;
        $this -> load -> model('Mapmodel');
		$this -> mapdb = $this->Mapmodel;
        $this -> load -> model('Showmodel');
		$this -> showdb = $this->Showmodel;
        $this -> load -> model('Sectionmodel');
		$this -> sectiondb = $this->Sectionmodel;
        $this -> load -> model('Panoramamodel');
		$this -> panoramadb = $this->Panoramamodel;
        $this -> load -> model('Pricemodel');
		$this -> pricedb = $this->Pricemodel;
        require($this->config->item('Seatsmode').'Seatsmodel.php');
	}
        
	//选座demo
	public function GetEvent() {
	   if (isset($_REQUEST['EventId']) && !empty($_REQUEST['EventId'])) {
            $datasel['id']=$_REQUEST['EventId'];
            $datasel['ismenu']='1';
            $eventInfo=$this->eventdb->getEventById($datasel);
            if (isset($eventInfo) && !empty($eventInfo)) {
                $map_id=$eventInfo['map_id'];
                $mapInfo= $this->mapdb->getMapById($map_id);
                $panoramaJson=$this->panoramadb->panoramaJson($map_id);
                $data['panorama']=json_encode($panoramaJson);
                $this->seatsdb = new Seatsmodel("event_".$eventInfo['id']."_map_".$eventInfo['map_id']."_seats");
                $select['where']['map_id']=$map_id;
                $data['area']="0";
                if (isset($_REQUEST['area']) && !empty($_REQUEST['area'])) {
                    $select['where']['section_name']=$_REQUEST['area'];
                    $data['area']=$_REQUEST['area'];
                }
                $seatsInfo= $this->seatsdb->seatsList($select);
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
                if ($mapInfo['ismenu']=="1"){
                    $data['showInfo']=$showInfo=$this->showdb->getShowById($mapInfo['show_id']);
                    if ($showInfo['ismenu']=="1"){
	                    $data['EventId']=$_REQUEST['EventId'];
                        $data['UserId']=$_REQUEST['UserId'];
                        $data['AppId']=$_REQUEST['AppId'];
                        $data['seatsInfo']=$seatsInfo['rows'];
                        $mobile=$_REQUEST['m'];
                        $this -> load -> view('index_mobile/ticket',$data);
                            
                            
                        
                    }else{
                        echo "表演 失效!";
                    }
                }else{
                    echo "座位图 失效!";
                }
            }else{
                    echo "场次 失效!";
                }
        }else{
                    echo "选座 失效!";
                }
    }
	   
    
    public function panorama(){
        $data['id']=$this->input->get('id');
        $data['section_id']=$this->input->get('section_id');
        $data['section_name']=$this->input->get('section_name');
        if (isset($data['section_name']) && !empty($data['section_name'])) {
            $data['section_name']=$this->input->get('section_name');
            $sectionInfo=$this->sectiondb->getSectionLikeName($data['section_name']);
            $panoramaInfo=$this->panoramadb->getPanoramaBySectionId($sectionInfo[0]['id']);
            if ($panoramaInfo)
                $data['id']=$panoramaInfo['id'];
        }
        if (isset($data['section_id']) && !empty($data['section_id'])) {
            $data['section_id']=$this->input->get('section_id');
            $panoramaInfo=$this->panoramadb->getPanoramaBySectionId($data['section_id']);
            if ($panoramaInfo)
                $data['id']=$panoramaInfo['id'];
        }
        if ($data['id']){
            $data['panoramaInfo']=$this->panoramadb->getPanoramaById($data['id']);
            if(stripos($_SERVER['HTTP_USER_AGENT'],"android")==true || stripos($_SERVER['HTTP_USER_AGENT'],"iPhone")==true || stripos($_SERVER['HTTP_USER_AGENT'],"webchat")==true){
                $this -> load -> view('index_mobile/panorama',$data);
            }else{
                $this -> load -> view('index/panorama',$data);
            }
        }else{
            echo "无该区的全景效果!";
        }
    }
	
    public function xml(){
        $data['id']=$this->input->get('id');
        $data['panoramaInfo']=$this->panoramadb->getPanoramaById($data['id']);
        $data['panorama_url']=$this->config->item('panorama_url');
        header("Content-type: text/xml; Charset=utf-8");
        $this -> load -> view('index/xml',$data);
    }
    
    public function memcache(){
        $this->load->driver('cache');
        $array = Array("cart"=>Array(123, 345, 567));
        $this->cache->memcached->save('cart',$array,600);
        $b = $this->cache->memcached->get('cart');
        print_r(json_encode($b));
    }
    
    public function redis(){
        // 框架的redis库  
        $this->load->driver('cache'); 
        $array = Array("cart"=>Array(123, 345, 567));
        $this->cache->redis->save('cart',$array,60);//这里注意，第三个参数是时间，在自定义redis库会说明  
        $b = $this->cache->redis->get('cart');
        print_r(json_encode($b)); 
    }
    
    public function addCart(){
        //print_r($_REQUEST);
        $data['EventId']=$_REQUEST['EventId'];
        $data['UserId']=$_REQUEST['UserId'];
        $data['AppId']=$_REQUEST['AppId'];
        $data['seatNo']=$_REQUEST['seatNo'];
        
        $this->load->driver('cache');
        $carts = $this->cache->memcached->get($data['UserId']);
        if ($carts[$data['EventId']]){
            if (count($carts[$data['EventId']])<6){
                array_push($carts[$data['EventId']],$data['seatNo']);
            }else{
                $datas['code']="201";
                $datas['alert']="大于 6张票!";
                print_r(json_encode($datas));
                return;
            }
        }else{
            $carts[$data['EventId']]=array();
            array_push($carts[$data['EventId']],$data['seatNo']);
        }
        $this->cache->memcached->save($data['UserId'],$carts,600);
        $datas['code']="200";
        $datas['alert']="Success!";
        $datas['EventId']=$_REQUEST['EventId'];
        $carts=$this->cache->memcached->get($data['UserId']);
        $datas['cart'] = $carts[$data['EventId']];
        print_r(json_encode($datas));
    }
    public function delCart(){
        
        $data['EventId']=$_REQUEST['EventId'];
        $data['UserId']=$_REQUEST['UserId'];
        $data['AppId']=$_REQUEST['AppId'];
        $data['seatNo']=$_REQUEST['seatNo'];
        
        $this->load->driver('cache');
        $carts = $this->cache->memcached->get($data['UserId']);
        if ($carts[$data['EventId']]){
            $delseats=array();
            foreach( $carts[$data['EventId']] as $k=>$v) {
             if($data['seatNo'] != $v) array_push($delseats,$v);
            }
            $carts[$data['EventId']]=$delseats;
            $this->cache->memcached->save($data['UserId'],$carts,600);
        }
        $datas['code']="200";
            $datas['EventId']=$_REQUEST['EventId'];
        $datas['alert']="Success!";
        $carts=$this->cache->memcached->get($data['UserId']);
        $datas['cart'] = $carts[$data['EventId']];
        print_r(json_encode($datas));
    }
    public function editCart($data){
        
    }
    public function getCart(){
        if ((isset($_REQUEST['EventId']) && !empty($_REQUEST['EventId']))  && (isset($_REQUEST['UserId']) && !empty($_REQUEST['UserId'])) && (isset($_REQUEST['AppId']) && !empty($_REQUEST['AppId']))){
            $data['EventId']=$_REQUEST['EventId'];
            $data['UserId']=$_REQUEST['UserId'];
            $data['AppId']=$_REQUEST['AppId'];
        
            
            $sel['id']=$data['EventId'];
            $eventInfo=$this->eventdb->getEventById($sel);
            $this->seatsdb = new Seatsmodel("event_".$eventInfo['id']."_map_".$eventInfo['map_id']."_seats");
            $this->load->driver('cache');
            $carts = $this->cache->memcached->get($data['UserId']);
            $seats=array();
            if (isset($carts[$data['EventId']]) && !empty($carts[$data['EventId']])) {
                foreach( $carts[$data['EventId']] as $k=>$v) {
                    $seatsInfo=$this->seatsdb->getSeatsLikeName($v);
                    $priceInfo=$this->pricedb->getPriceById($seatsInfo[0]['price_id']);
                    $sectionInfo=$this->sectiondb->getSectionById($seatsInfo[0]['section_id']);
                    $mapInfo=$this->mapdb->getMapById($seatsInfo[0]['map_id']);
                    $seats[$v]=array("seat_no"=>$seatsInfo[0]['seat_no'],"seat_id"=>$seatsInfo[0]['id'],"map_name"=>$mapInfo['map_name'],"section_name"=>$sectionInfo['section_name'],"price_name"=>$priceInfo['price_name'],"unit_price"=>$priceInfo['unit_price'],"row"=>$seatsInfo[0]['row'],"column"=>$seatsInfo[0]['column']);
                }
            }else{
                $carts=array();
                $carts[$data['EventId']]=array();
            }
            $datas['code']="200";
            $datas['EventId']=$_REQUEST['EventId'];
            $datas['alert']="Success!";
            $datas['cart']=$carts[$data['EventId']];
            $datas['seats']=$seats;
            print_r(json_encode($datas));
        }else{
            $datas['code']="201";
            $datas['alert']="参数缺失!";
            print_r(json_encode($datas));
        }
    }
    
    public function getCartP(){
        if ((isset($_REQUEST['EventId']) && !empty($_REQUEST['EventId']))  && (isset($_REQUEST['UserId']) && !empty($_REQUEST['UserId'])) && (isset($_REQUEST['AppId']) && !empty($_REQUEST['AppId']))){
            $data['EventId']=$_REQUEST['EventId'];
            $data['UserId']=$_REQUEST['UserId'];
            $data['AppId']=$_REQUEST['AppId'];
        
            
            $sel['id']=$data['EventId'];
            $eventInfo=$this->eventdb->getEventById($sel);
            $this->seatsdb = new Seatsmodel("event_".$eventInfo['id']."_map_".$eventInfo['map_id']."_seats");
            $this->load->driver('cache');
            $carts = (array)$this->cache->memcached->get($data['UserId']);
            $seats=array();
            if (isset($carts[$data['EventId']]) && !empty($carts[$data['EventId']])) {
                foreach( $carts[$data['EventId']] as $k=>$v) {
                    $seatsInfo=$this->seatsdb->getSeatsLikeName($v);
                    $priceInfo=$this->pricedb->getPriceById($seatsInfo[0]['price_id']);
                    $sectionInfo=$this->sectiondb->getSectionById($seatsInfo[0]['section_id']);
                    $mapInfo=$this->mapdb->getMapById($seatsInfo[0]['map_id']);
                    $seats[$v]=array("seat_no"=>$seatsInfo[0]['seat_no'],"seat_id"=>$seatsInfo[0]['id'],"map_name"=>$mapInfo['map_name'],"section_name"=>$sectionInfo['section_name'],"price_name"=>$priceInfo['price_name'],"unit_price"=>$priceInfo['unit_price'],"row"=>$seatsInfo[0]['row'],"column"=>$seatsInfo[0]['column']);
                }
                $datas['cart']=$carts[$data['EventId']];
            }else{
                $cart=array();
                $datas['cart']=$cart;
            }
            $datas['code']="200";
            $datas['EventId']=$_REQUEST['EventId'];
            $datas['alert']="Success!";
            $datas['seats']=$seats;
            print_r("carts=".json_encode($datas).";");
        }else{
            $datas['code']="201";
            $datas['alert']="参数缺失!";
            print_r("carts=".json_encode($datas).";");
        }
    }
    
    public function js(){
        $data['seat_no']=$_REQUEST['seatNo'];
        $this -> load -> view('index/js',$data);
    }
    
    public function map(){
        if (isset($_REQUEST['EventId']) && !empty($_REQUEST['EventId'])) {
            $datasel['id']=$_REQUEST['EventId'];
            $datasel['ismenu']='1';
            $eventInfo=$this->eventdb->getEventById($datasel);
            if (isset($eventInfo) && !empty($eventInfo)) {
                $map_id=$eventInfo['map_id'];
                $mapInfo= $this->mapdb->getMapById($map_id);
                
                $panoramaJson=$this->panoramadb->panoramaJson($map_id);
                $data['panorama']=$panoramaJson;
                $this->seatsdb = new Seatsmodel("event_".$eventInfo['id']."_map_".$eventInfo['map_id']."_seats");
                $select['where']['map_id']=$map_id;
                $seatsInfo= $this->seatsdb->seatsList($select);
                $data['mapInfo']['seatsInfo']=$seatsInfo['rows'];
                if (isset($mapInfo['background']) && !empty($mapInfo['background'])) {
                    //判断一下图片是否存在
                    if (file_exists($this->config->item('mapBackground_path') . $mapInfo['background'])) {
                        $data['mapInfo']['background_url'] = $this->config->item('mapBackground_url') . $mapInfo['background'];
                    }
                }
                if (isset($mapInfo['mini']) && !empty($mapInfo['mini'])) {
                    //判断一下图片是否存在
                    if (file_exists($this->config->item('mapMini_path') . $mapInfo['mini'])) {
                        $data['mapInfo']['mini_url'] = $this->config->item('mapMini_url') . $mapInfo['mini'];
                    }
                }
                $data['mapInfo']['area']=$mapInfo['area'];
                $data['mapInfo']['price']=$mapInfo['price'];
                $data['mapInfo']['id']=$mapInfo['id'];
                if ($mapInfo['ismenu']=="1"){
                    $showInfo=$this->showdb->getShowById($mapInfo['show_id']);
                    $data['showInfo']['id']=$showInfo['id'];
                    $data['showInfo']['startdate']=$showInfo['startdate'];
                    if ($showInfo['ismenu']=="1"){
                        $data['panorama_url']=$this->config->item('panorama_url');
                        $panoramas=$this->panoramadb->getPanoramaByMapId($mapInfo['id']);
                        foreach( $panoramas as $k=>$v) {
                            $panoramaInfo[$k]=$this->panoramadb->getPanoramaById($v['id']);
                        }
	                    $data['panoramaInfo']=$panoramaInfo;
	                    $data['EventId']=$_REQUEST['EventId'];
                        $data['UserId']=$_REQUEST['UserId'];
                        $data['AppId']=$_REQUEST['AppId'];
                        $data['code']="200"; 
                        $data['alert']="Success!";
                        print_r(json_encode($data));
                    }else{
                        echo "表演 失效!";
                    }
                }else{
                    echo "座位图 失效!";
                }
            }else{
                    echo "场次 失效!";
                }
        }else{
                    echo "选座 失效!";
                }
    }
}
