<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////

class Panoramamodel extends CI_Model
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
    public function savePanorama($data){
        //判断是否有id值，来确定是添加还是修改
        $id = isset($data['id']) ? $data['id'] : 0;
        if(isset($data['id'])){
            unset($data['id']);
        }
        if (isset($data['section_id']))
        $data['section_id'] = $data['section_id']  ;
        if (isset($data['map_id']))
        $data['map_id'] = $data['map_id']  ;
        if (isset($data['mini']))
        $data['mini'] = $data['mini'];
        if (isset($data['front']))
        $data['front'] = $data['front'];
        if (isset($data['back']))
        $data['back'] = $data['back'];
        if (isset($data['left']))
        $data['left'] = $data['left'];
        if (isset($data['right']))
        $data['right'] = $data['right'];
        if (isset($data['top']))
        $data['top'] = $data['top'];
        if (isset($data['bottom']))
        $data['bottom'] = $data['bottom'];
        if($id){
            //问题：
            $this->master->where('id',$id);
            if($this->master->update('panorama', $data)){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->master->insert('panorama', $data)){
                return true;
            }else{
                return false;
            }
        }
    }


    /************************** 删 *****************************/
    //根据id，删除剧院列表
    public function delPanoramaById($id){
        $this->master->where('id',$id);
        $this->master->from('panorama');
        $result = $this->master->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }

    /************************** 查 *****************************/
    //剧院列表
    public function panoramaList($data){
        $result = array();
        if(isset($data['where'])){
            $this->slave->where('section_id',$data['where']['section_id']);
        }
        $this->slave->order_by($data['order']);
        $this->slave->limit($data['limit'],$data['offset']);
        $this->slave->from('panorama');
        $query = $this->slave->get();
        $result['rows'] = $query->result_array();
        $query->free_result();
        if(isset($data['where'])){
            $this->slave->where('section_id',$data['where']['section_id']);
        }
        $this->slave->from('panorama');
        $query = $this->slave->get();
        $result['total'] = $query->num_rows();
        $query->free_result();
        return $result;
    }
    
    
    /************************** 查 *****************************/
    //全景列表
    public function panoramaJson($map_id){
        $result = array();
        $rs = array();
        if(isset($map_id))
            $sql="select s.section_name from panorama as p left JOIN map_section as s on p.section_id=s.id and p.map_id=".$map_id . " order by s.section_name"; 
        $query = $this->slave->query($sql);
        $result = $query->result_array(); 
        foreach ($result as $row)
        {
           $rs[]= $row['section_name'];
        }
        return $rs;
    }

    // $id 通过 id值去查找某条记录的信息
    public function getPanoramaById($id)
    {
        $this->slave->where('id',$id);
        $this->slave->from('panorama');
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
    
    // $id 通过 id值去查找某条记录的信息
    public function getPanoramaByMapId($id)
    {
        $result = array();
        $this->slave->where('map_id',$id);
        $this->slave->from('panorama');
        $query = $this->slave->get();
        $result = $query->result_array();
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