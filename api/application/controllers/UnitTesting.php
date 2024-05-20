<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
defined('BASEPATH') OR exit('No direct script access allowed');

class UnitTesting extends MY_Controller {

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
	}
        
	//选座demo
	public function getSeatsInfo() {
	    $data=array();
        $data['EventId']="16";
        $data['UserId']="18621153185";
        $data['AppOrderNo']="201803290001";
        $data['AppId']="mydeershow";
        $data['AppSecret']="AdE3xN4eM5o6EfAdE3xN4eM5o6Ef";
        $data['UserTickets']="s_1_12,s_1_13,s_1_14";
        $datas['jsonstring']=json_encode($data);
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, site_url('server/getSeatsInfo')); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas); 
        curl_exec($ch); 
    }
    
    //选座demo
	public function createOrder() {
	    $data=array();
        $data['EventId']="16";
        $data['UserId']="18621153185";
        $data['AppOrderNo']="201803290001";
        $data['AppId']="mydeershow";
        $data['AppSecret']="AdE3xN4eM5o6EfAdE3xN4eM5o6Ef";
        $data['UserTickets']="s_1_12,s_1_13,s_1_14";
        $datas['jsonstring']=json_encode($data);
        $ch = curl_init(); //'http://app.mydeershow.com/server/createOrder'
        curl_setopt($ch, CURLOPT_URL, site_url('server/createOrder')); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas); 
        curl_exec($ch); 
    }
    
    //选座demo
	public function cancelOrder() {
	    $data=array();
        $data['EventId']="16";
        $data['UserId']="18621153185";
        $data['AppOrderNo']="201803290001";
        $data['AppId']="mydeershow";
        $data['AppSecret']="AdE3xN4eM5o6EfAdE3xN4eM5o6Ef";
        $datas['jsonstring']=json_encode($data);
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, site_url('server/cancelOrder')); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas); 
        curl_exec($ch); 
    }
    
    //选座demo
	public function payOrder() {
	    $data=array();
        $data['EventId']="16";
        $data['UserId']="18621153185";
        $data['OrderNo']="201803300944398373955";
        $data['AppId']="mydeershow";
        $data['AppSecret']="AdE3xN4eM5o6EfAdE3xN4eM5o6Ef";
        $datas['jsonstring']=json_encode($data);
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, site_url('server/payOrder')); 
        curl_setopt($ch, CURLOPT_POST, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas); 
        curl_exec($ch); 
    }
    public function delCart(){
        $this -> load -> view('unitTesting/index');
    }
    public function pano2vr(){
        $this -> load -> view('unitTesting/360.php');
    }
}
