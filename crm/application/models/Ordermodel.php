<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////

class Ordermodel extends CI_Model {
    /*
     * 订单列表
     */
   public $slave, $master;
   public function __construct()
   {
       parent::__construct();
       $this->slave = $this->load->database();
       //$this->master = $this->load->database('tickets_master', true);
   }
    public function getAllVenues($data){
        //（1）查询指定数据
        $result = array();
        if(isset($data['fields'])  && isset($data['like'])){
            $this->db->like($data['fields'], $data['like'], 'both');
        }
        $this->db->limit($data['limit'],$data['offset']);
        $this->db->from('order_action');
        $query = $this->db->get();
        $result['rows'] = $query->result_array();
        $query->free_result();

        //(2)查询总条数
        if(isset($data['fields'])  && isset($data['like'])){
            $this->db->like($data['fields'], $data['like'], 'both');
        }
        $this->db->from('order_action');
        $query = $this->db->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }
    /* public function  __construct()
      {
          parent::__construct();
          $this->load->database();
    }
     public function  gettotal()
      {
          $query=$this->db->query("SELECT count(action_id) total FROM order_action");

          return $query->result();
      }
     public function get_books($num, $offset, $searchtext)
      {
          $db = $this->db;
          if(!empty($searchtext)){
            $db = $this->db->where('action_user like', '%' . $searchtext . '%');
          }
          $query = $db->get('order_action',$num,$offset);
          return $query->result();
      }*/

}
