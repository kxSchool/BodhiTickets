<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////

class Ordermodel extends CI_Model
{
    public $slave, $master;
    public function __construct()
    {
        parent::__construct();
        $this->slave = $this->load->database('tickets_slave', true);
        $this->master = $this->load->database('tickets_master', true);
    }
    
    public function createOrder($data){
        $result = $this->master->insert('order_info',$data);
        if($result){
            $orderInfo['id']=$this->master->insert_id();
            $orderInfo['OrderNo']=$data['order_sn'];
            return $orderInfo;
        }else{
            return false;
        }
    }
    
    public function cancelOrder($data){
        $order_id = isset($data['order_id']) ? $data['order_id'] : 0;
        if(isset($data['order_id'])){
            unset($data['order_id']);
        }
        if($order_id){
            $this->master->where('order_id',$order_id);
            if($this->master->update('order_info', $data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    public function payOrder($data){
        $order_sn = isset($data['order_sn']) ? $data['order_sn'] : 0;
        if(isset($data['order_sn'])){
            unset($data['order_sn']);
            $app_id=$data['app_id'];
            unset($data['app_id']);
        }
        if($order_sn){
            $this->master->where('order_sn',$order_sn);
            $this->master->where('app_id',$app_id);
            if($this->master->update('order_info', $data)){
                return $order_sn;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function insertOrderGood($data,$flag=false){
        $result = $flag ? $this->master->insert_batch('order_goods',$data) : $this->master->insert('order_goods',$data);
        if($result){
            return !$flag ? $this->master->insert_id() : true ;
        }else{
            return false;
        }
    }
    
    public function insertOrderAction($data){
        $result = $this->master->insert('order_action',$data);
        if($result){
            return $this->master->insert_id();
        }else{
            return false;
        }
    }
    
    public function insertOrderVisitor($data){
        $result = $this->master->insert('order_visitor',$data);
        if($result){
            return $this->master->insert_id();
        }else{
            return false;
        }
    }




}