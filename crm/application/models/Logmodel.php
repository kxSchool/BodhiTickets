<?php
/**
 * Created by PhpStorm.
 * User: as
 * Date: 2018/4/28
 * Time: 10:21
 */
class Logmodel extends CI_Model
{
   // protected $db;
    /*
     * 订单列表
     */
    /*public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('log', true);
    }*/
    public $slave, $master;
    public function __construct()
    {
        parent::__construct();
        $this->slave = $this->load->database('log', true);
        //$this->master = $this->load->database('tickets_master', true);
    }

  /*public function gettotal()
    {
        $query = $this->db->query("SELECT count(id) total FROM log_201804");
        return $query->result();
    }

      public function get_books($num, $offset, $searchtext)
    {
        $db = $this->db;
        if (!empty($searchtext)) {
            $db = $this->db->where('createtime like', '%' . $searchtext . '%');
        }
        $query = $db->get('log_201804', $num, $offset);
        return $query->result();
    }*/
    public function getAllVenues($data){
        //（1）查询指定数据
        $result = array();
        if(isset($data['fields'])  && isset($data['like'])){
            $this->slave->like($data['fields'], $data['like'], 'both');
        }
        //$db = $this->db;
        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from('log_201804');
        $query = $this->slave->get();

        $result['rows'] = $query->result_array();
        $query->free_result();

        //(2)查询总条数
        if(isset($data['fields'])  && isset($data['like'])){
            $this->slave->like($data['fields'], $data['like'], 'both');
        }
        $this->slave->from('log_201804');
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }

}