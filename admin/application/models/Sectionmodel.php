<?php

class Sectionmodel extends CI_Model
{
    public $slave, $master;
    public function __construct()
    {
        parent::__construct();
        $this->slave = $this->load->database('tickets_slave', true);
        $this->master = $this->load->database('tickets_master', true);
    }

    /************************** 增 *****************************/
    //保存品牌（适用于 “添加+修改” 操作）
    public function saveSection($data){
        //判断是否有id值，来确定是添加还是修改
        $id = isset($data['id']) ? $data['id'] : 0;
        if(isset($data['id'])){
            unset($data['id']);
        }
        if (isset($data['map_id']))
        $data['map_id'] = $data['map_id']  ;
        if (isset($data['fillcolor']))
        $data['fillcolor'] = $data['fillcolor'];
        if (isset($data['section_path']))
        $data['section_path'] = $data['section_path'];
        if($id){
            //问题：
            $this->master->where('id',$id);
            if($this->master->update('map_section', $data)){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->master->insert('map_section', $data)){
                return true;
            }else{
                return false;
            }
        }
    }


    /************************** 删 *****************************/
    //根据id，删除剧院列表
    public function delSectionById($id){
        $this->master->where('id',$id);
        $this->master->from('map_section');
        $result = $this->master->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /************************** 查 *****************************/
    //剧院列表
    public function sectionList($data){
        $result = array();
        if(isset($data['where'])){
            $this->slave->where('map_id',$data['where']['map_id']);
        }
        $this->slave->order_by($data['order']);
        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from('map_section');
        $query = $this->slave->get();
        $result['rows'] = $query->result_array();
        $query->free_result();
        if(isset($data['where'])){
            $this->slave->where('map_id',$data['where']['map_id']);
        }
        $this->slave->from('map_section');
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }

    // $id 通过 id值去查找某条记录的信息
    public function getSectionById($id)
    {
        $this->slave->where('id',$id);
        $this->slave->from('map_section');
        $query = $this->slave->get();
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }


    //通过品牌名模糊匹配所有的剧院 
    public function getEventsLikeName($name){
        $sql = "SELECT id,venue_name FROM event WHERE venue_name like '%".$name."%'";
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