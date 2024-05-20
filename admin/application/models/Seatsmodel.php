<?php

class Seatsmodel extends CI_Model
{
    public $slave, $master,$table;
    public function __construct($param)
    {
        parent::__construct();
        $this->slave = $this->load->database('tickets_slave', true);
        $this->master = $this->load->database('tickets_master', true);
        $this->table=$param;
    }

    /************************** 增 *****************************/
    //保存品牌（适用于 “添加+修改” 操作）
    public function saveSeats($data){
        //判断是否有id值，来确定是添加还是修改
        $id = isset($data['id']) ? $data['id'] : 0;
        if(isset($data['id'])){
            unset($data['id']);
        }
        if (isset($data['cy']))
        $data['cy'] = $data['cy']  ;
        if (isset($data['cx']))
        $data['cx'] = $data['cx']  ;
        if (isset($data['seats_no']))
        $data['seats_no'] = $data['seats_no'];
        if (isset($data['row']))
        $data['row'] = $data['row'];
        if (isset($data['column']))
        $data['column'] = $data['column'];
        if (isset($data['status']))
        $data['status'] = $data['status'];
        if($id){
            //问题：
            $this->master->where('id',$id);
            if($this->master->update($this->table, $data)){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->master->insert($this->table, $data)){
                return true;
            }else{
                return false;
            }
        }
    }


    /************************** 删 *****************************/
    //根据id，删除剧院列表
    public function delSeatsById($id){
        $this->master->where('id',$id);
        $this->master->from($this->table);
        $result = $this->master->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /************************** 查 *****************************/
    //剧院列表
    public function seatsList($data){
        $result = array();
        if(isset($data['where'])){
            if(isset($data['where']['map_id']))
            $this->slave->where('map_id',$data['where']['map_id']);
            if(isset($data['where']['section_id']))
            $this->slave->where('section_id',$data['where']['section_id']);
        }
        if(isset($data['order']))
        $this->slave->order_by($data['order']);
        if(isset($data['limit']) && isset($data['offset']))
        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from($this->table);
        $query = $this->slave->get();
        $result['rows'] = $query->result_array();
        $query->free_result();
        if(isset($data['where'])){
            if(isset($data['where']['map_id']))
            $this->slave->where('map_id',$data['where']['map_id']);
            if(isset($data['where']['section_id']))
            $this->slave->where('section_id',$data['where']['section_id']);
        }
        $this->slave->from($this->table);
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }

    // $id 通过 id值去查找某条记录的信息
    public function getSeatsById($id)
    {
        $this->slave->where('id',$id);
        $this->slave->from($this->table);
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }
    
    // $id 通过 id值去查找某条记录的信息
    public function getPanoramaBySectionId($id)
    {
        $this->slave->where('section_id',$id);
        $this->slave->from('panorama');
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }


    //通过品牌名模糊匹配所有的剧院 
    public function getSeatsLikeName($name){
        $sql = "SELECT * FROM ".$this->table." WHERE seat_no like '".$name."'";
        $query = $this->slave->query($sql);
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }


    //查询所有的剧院
    public function getAllVenues($data){
        //（1）查询指定数据
        $result = array();
        if(isset($data['fields'])  && isset($data['like'])){
            $this->slave->like($data['fields'], $data['like'], 'both');
        }

        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from('venue');
        $query = $this->slave->get();

        $result['rows'] = $query->result_array();
        $query->free_result();

        //(2)查询总条数
        if(isset($data['fields'])  && isset($data['like'])){
            $this->slave->like($data['fields'], $data['like'], 'both');
        }
        $this->slave->from('venue');
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }


    //检验重复值得问题
    public function isCommonData($data){
        if(!empty($data)){
            $sql = "SELECT id FROM venue WHERE `venue_name`='".$data['venue_name']."' and Province='".$data['Province']."' and City='".$data['City']."' and Village='".$data['Village']."' and address='".$data['address']."'";
            $query =  $this->slave->query($sql);
            $result = $query->result_array();
            if($result){
                return $result;
            }else{
                return FALSE;
            }
        }
    }




}