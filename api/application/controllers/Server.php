<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends MY_Controller {

	private $staffdb;
	private $mapdb;
    private $sectiondb;
    private $panoramadb;
    private $showdb;
    private $seatsdb;
    private $orderdb;

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
        $this -> load -> model('Ordermodel');
		$this -> orderdb = $this->Ordermodel;
        $this -> load -> model('Pricemodel');
		$this -> pricedb = $this->Pricemodel;
        require($this->config->item('Seatsmode').'Seatsmodel.php');
	}
        
	//选座demo
	public function eventList() {
	   if ((isset($_REQUEST['ShowId']) && !empty($_REQUEST['ShowId']))  && (isset($_REQUEST['AppSecret']) && !empty($_REQUEST['AppSecret'])) && (isset($_REQUEST['AppId']) && !empty($_REQUEST['AppId']))){
            $data['AppId']=$_REQUEST['AppId'];
            $data['AppSecret']=$_REQUEST['AppSecret'];
            $data['where']['show_id']=$_REQUEST['ShowId'];
            $data['where']['ismenu']="1";
            $eventInfo=$this->eventdb->eventList($data);
            $datas['code']="200";
            $datas['result']=$eventInfo['rows'];
            print_r(json_encode($datas));
      }else{
            $datas['code']="201";
            $datas['alert']='参数缺失!';
            print_r(json_encode($datas));
      }    
    }
    
    public function createOrder(){ 
        if (isset($_REQUEST['jsonstring']) && !empty($_REQUEST['jsonstring'])){
            $jsonstring=json_decode($_REQUEST['jsonstring']);
            $data['EventId']=$jsonstring->EventId;
            $data['AppId']=$jsonstring->AppId;
            $data['AppSecret']=$jsonstring->AppSecret;
            $data['UserId']=$jsonstring->UserId;
            $data['AppOrderNo']=$jsonstring->AppOrderNo;
            $data['UserTickets']=explode(",",$jsonstring->UserTickets);
            $dataOrder=array();
            $dataOrder['order_sn']=get_order_sn();
            $dataOrder['mobile']=$data['UserId'];
            $dataOrder['order_sn_shop']=$data['AppOrderNo'];
            $dataOrder['app_id']=$data['AppId'];
            $dataOrder['event_id']=$data['EventId'];
            $dataOrder['order_status']='0';
            $dataOrder['pay_status']='0';
            $createOrder=$this->orderdb->createOrder($dataOrder);
            $dataOrder=array();
            $goods=array();
            $dataOrder['order_id']=$createOrder['id'];
            foreach( $data['UserTickets'] as $k=>$v) {
                $goods[]=array("order_id"=>$createOrder['id'],"goods_sn"=>$v);
            }
            $this->orderdb->insertOrderGood($goods,true);
            $sel['id']=$data['EventId'];
            $eventInfo=$this->eventdb->getEventById($sel);
            $this->seatsdb = new Seatsmodel("event_".$eventInfo['id']."_map_".$eventInfo['map_id']."_seats");
            $total=0;
            $seats=array();
            foreach( $data['UserTickets'] as $k=>$v) {
                $seatsInfo=$this->seatsdb->getSeatsLikeName($v);
                $seat['id']=$seatsInfo[0]['id'];
                $seat['seat_no']=$seatsInfo[0]['seat_no'];
                $seat['status']='0';
                $priceInfo=$this->pricedb->getPriceById($seatsInfo[0]['price_id']);
                $seats[$v]=array("unit_price"=>$priceInfo['unit_price']);
                $total=$total+$priceInfo['unit_price'];
                $this->seatsdb->saveSeats($seat);
            }
            //$this->orderdb->insertOrderVisitor($vistor,true);
            //$this->orderdb->insertOrderAction($action,true);
            $datas['code']="200";
            $datas['alert']='Success!';
            $datas['total']=$total;
            $datas['seats']=$seats;
            $datas['OrderNo']=$createOrder['OrderNo'];
            print_r(json_encode($datas));
        }else{
            $datas['code']="201";
            $datas['alert']='error!';
            print_r(json_encode($datas));
        }   
    }
    public function cancelOrder(){
        if (isset($_REQUEST['jsonstring']) && !empty($_REQUEST['jsonstring'])){
            $jsonstring=json_decode($_REQUEST['jsonstring']);
            $data['EventId']=$jsonstring->EventId;
            $data['AppId']=$jsonstring->AppId;
            $data['AppSecret']=$jsonstring->AppSecret;
            $data['UserId']=$jsonstring->UserId;
            $data['AppOrderNo']=$jsonstring->AppOrderNo;
            $dataOrder['order_sn']=get_order_sn();
            $cancelOrder=$this->orderdb->cancelOrder($dataOrder);
            $datas['code']="200";
            $datas['alert']='Success!';
            $datas['result']=$cancelOrder;
            print_r(json_encode($datas));
        }else{
            $datas['code']="201";
            $datas['alert']='error!';
            print_r(json_encode($datas));
        }
    }
    public function payOrder(){
        if (isset($_REQUEST['jsonstring']) && !empty($_REQUEST['jsonstring'])){
            $jsonstring=json_decode($_REQUEST['jsonstring']);
            $data['EventId']=$jsonstring->EventId;
            $data['AppId']=$jsonstring->AppId;
            $data['AppSecret']=$jsonstring->AppSecret;
            $data['UserId']=$jsonstring->UserId;
            $data['OrderNo']=$jsonstring->OrderNo;
            $dataOrder['order_sn']=$data['OrderNo'];
            $dataOrder['app_id']=$data['AppId'];
            $dataOrder['order_status']='1';
            $dataOrder['pay_status']='1';
            $payOrder=$this->orderdb->payOrder($dataOrder);
            $datas['code']="200";
            $datas['alert']='Pay Success!';
            $datas['result']=$payOrder;
            print_r(json_encode($datas));
        }else{
            $datas['code']="201";
            $datas['alert']='error!';
            print_r(json_encode($datas));
        }
    }
    public function getSeatsInfo(){
        if (isset($_REQUEST['jsonstring']) && !empty($_REQUEST['jsonstring'])){
            $jsonstring=json_decode($_REQUEST['jsonstring']);
            $data['EventId']=$jsonstring->EventId;
            $data['AppId']=$jsonstring->AppId;
            $data['AppSecret']=$jsonstring->AppSecret;
            $data['UserTickets']=explode(",",$jsonstring->UserTickets);
            
            $sel['id']=$data['EventId']; 
            $eventInfo=$this->eventdb->getEventById($sel);
            $this->seatsdb = new Seatsmodel("event_".$eventInfo['id']."_map_".$eventInfo['map_id']."_seats");
            $this->load->driver('cache');
            $carts =$data['UserTickets'];
            $seats=array();
            if (isset($carts) && !empty($carts)) {
                $total=0;
                foreach( $carts as $k=>$v) {
                    if ($k==1){
                        
                    }
                        
                    $seatsInfo=$this->seatsdb->getSeatsLikeName($v);
                    $priceInfo=$this->pricedb->getPriceById($seatsInfo[0]['price_id']);
                    $sectionInfo=$this->sectiondb->getSectionById($seatsInfo[0]['section_id']);
                    $mapInfo=$this->mapdb->getMapById($seatsInfo[0]['map_id']);
                    $seats[$v]=array("unit_price"=>$priceInfo['unit_price']);
                    $total=$total+$priceInfo['unit_price'];
                    
                }
                
            }else{
                $cart=array();
            }
            $datas['code']="200";
            $datas['total']=$total;
            $datas['EventId']=$jsonstring->EventId;
            $datas['alert']="Success!";
            $datas['cart']=$carts;
            $datas['seats']=$seats;
            print_r(json_encode($datas));
        }else{
            $datas['code']="201";
            $datas['alert']="error!";
            print_r(json_encode($datas));
        }
    }
}
