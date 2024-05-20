<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////

/**
 * Created by  YongBo Lu
 * Email: BoothLu@163.com
 * Date: 2017/9/18
 * Time: 15:11
 * Introduction:地址模块
 */
class Addressmodel extends CI_Model
{


    // 判断是否存在相同地址SQL文
    private $md5_field = 'MD5(CONCAT(full_name,telphone,address)) AS mresult,id AS addressid ';

    private $address_filed = 'id as addr_id,full_name as addr_name,telphone as addr_phone,area ,province_id,city_id,county_id,address,isdefault';
    /**
     * 根据用户id获取用户当前默认地址信息
     * @param string $userid 用户id
     * @return array 返回地址信息
     */
    public function getDefaultAddress($userid=''){
        if(empty($userid)){
            return [];
        }
        $sql = "SELECT * FROM user_address";
        $sql .= " WHERE userid='".$userid."'";
        $query = $this->slave->query($sql);
        $data = $query->row_array();
        return $data ? $data : [];
    }


    /**
     * 获取全国省市数据方法
     * @return array 返回省市数据
     */
    public function getProvince(){
        $sql = 'SELECT region_id as areaid,region_name as areaname FROM region '
            . 'WHERE region_type=1 '
            .'ORDER BY region_id asc';
        $query = $this->slave->query($sql);
        $data = $query->result_array();
        return empty($data) ? [] : $data ;
    }

    /**
     * 获取区域信息
     * @param int $areaid 区域信息id
     * @param boolean $flag 默认获取子区域,true是获取当前id区域信息
     * @return type
     */
    public function getArea($areaid='',$flag=false){
        if(empty($areaid)){
            return [];
        }
        $where = $flag ? ('WHERE region_id='.$areaid.'') : ('WHERE parent_id='.$areaid.'');
        $where .= ' AND region_type<4 ORDER BY region_id asc';
        $sql = ' SELECT region_id as areaid,region_name as areaname FROM region '
            . $where;
        $query = $this->slave->query($sql);
        $data = $query->result_array();
        if($flag){
            return empty($data[0]['areaname']) ? '' : $data[0]['areaname'] ;
        }else{
            return empty($data) ? [] : $data ;
        }
        
    }

    /**
     * 检查地址名称是否和地址id匹配
     * @param string $name 地址名称
     * @param string $id 地址id
     * @return boolean true表示匹配,false表示不匹配
     */
    public function checkAddressIsRight($name='',$id=''){
        if(empty($name) || empty($id)){
            return false;
        }
        $sql = 'SELECT region_id as areaid,region_name as areaname FROM region '
            . 'WHERE region_id = '.$id
            .' LIMIT 1';
        $query = $this->slave->query($sql);
        $data = $query->result_array();
        if(empty($data[0])){
            return false;
        }
        if(in_array($name, $data[0])){
            return true;
        }
        return false;
    }


    /**
     * 根据用户id获取当前用户地址详情
     * @param string $userid 用户id
     * @return array 地址详情数据
     */
    public function getAddressDetailByUserid($userid='',$topdefault=0){
        if(empty($userid)){ //用户id是空时
            return [];
        }
        // 排序
        $sort= $topdefault ? 'isdefault desc,id desc' : 'id desc';
        // 查询数据
//        $data = $this->where(array('rid'=>$userid))->field($this->address_filed)->order($sort)->select();

        $sql = "SELECT ".$this->address_filed;
        $sql .=" FROM user_address WHERE userid=".$userid;
        $sql .=" ORDER BY ".$sort;
        $query = $this->slave->query($sql);
        $data = $query->result_array();
        return $data ? : [];
    }

    /**
     * 获取指定用户地址MD5后的字串
     * @param string $userid 用户id
     * @return array 返回加密后的地址字串<br>地址加密顺序:收货人,联系电话,收货地址
     */
    public function getMd5Address($userid=''){
        if(empty($userid)){
            return [];
        }
        $sql = "SELECT ".$this->md5_field;
        $sql .=" FROM user_address WHERE userid=".$userid;
        $query = $this->slave->query($sql);
        $data = $query->result_array();
        return $data ? : [];
    }

    /**
     * 添加新的地址
     */
    public function addNewAddress($data=[]){
        if(empty($data)){
            return [];
        }
        $this->master->insert('user_address',$data);
        $id = $this->master->insert_id();
        if($id){
            return $id;
        }else{
            return FALSE;
        }
    }
    
    /**
     *  获取用户默认地址信息
     * @param int $userid 用户id
     * @return array 地址信息
     */
    public function getUserDefaultAddress($userid=0){
        if(empty($userid)){
            return [];
        }
        $sql = 'SELECT '
                . '`id` AS addressid,full_name AS recname,telphone AS recphone,address,area AS shortaddress,'
                . 'province_id AS provid,city_id AS cityid,county_id AS counid '
             . 'FROM '
                . 'user_address '
             . 'WHERE isdefault=1 AND userid='.$userid;
        $res = $this->slave->query($sql)->result_array();
        return empty($res[0]) ? [] : $res[0];
    }

    /**
     * 更新指定地址
     */
    public function updateAddress($addrid,$data=[]){
        if(empty($data) || empty($addrid)){
            return [];
        }
        $this->master->where('id', $addrid);
        $rst = $this->master->update('user_address',$data);
        if($rst){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     *  查询当前用户设置的默认地址id
     * @param string $rid 当前用户id
     * @return int 返回默认地址id
     */
    public function getDefaultAddressId($userid=''){
        if(empty($userid)){
            return 0;
        }
//        $result = $this->where(array('isdefault'=>1,'rid'=>$rid))->field('id')->find();

        $sql = "SELECT id";
        $sql .=" FROM user_address WHERE userid=".$userid;
        $sql .=" AND isdefault =1 ";
        $query = $this->slave->query($sql);
        $result = $query->row_array();
        return isset($result['id']) ? $result['id'] :0;
    }

    /**
     * 删除指定用户,指定的地址
     * @param string $userid 用户id
     * @param string $aid 地址id
     * @return boolean true表示删除成功,false表示删除失败
     */
    public function deleteAddress($userid='',$aid=''){
        if(empty($userid) || empty($aid)){
            return false;
        }
//        $flag = $this->where(array('userid'=>$userid,'id'=>$aid))->delete();
        $this->master->where('id', $aid);
        $this->master->where('userid', $userid);
        $flag = $this->master->delete('user_address');
        return $flag ? true : false;
    }

    /**
     * 自动设置默认地址
     * @param string $rid 当前用户id
     * @return boolean true设置成功,false设置失败
     */
    public function autoSetDefaultAddress($userid=''){
        if(empty($userid)){
            return false;
        }
//        $flag = $this->where(array('rid'=>$rid))->order('id desc')->limit(1)->setField(array('isdefault'=>'1'));
        $this->master->where('userid', $userid);
        $this->master->order_by("id", "desc");
        $this->master->limit('1');
        $flag = $this->master->update('user_address',array('isdefault'=>'1'));
        return $flag ? true : false;
    }


    /**
     * 设置或者取消默认收货地址
     * @param string $userid 用户id
     * @param string $aid 地址id $isdefault为0时候可以为空,为1时候不能为空
     * @param string $isdefault 标志,0:取消默认值,1:设置默认值
     * @return boolean 是否设置成功,true:成功,false:失败
     */
    public function setDefaultAddress($userid='', $aid='',$isdefault=1){
        if(empty($userid) || !is_int($isdefault)){
            return false;
        }
        if($isdefault && empty($aid)){ // 设置默认地址的时候 地址id不能为空
            return false;
        }
        // 根据isdefault是否设置或者取消默认值
//        $where = $isdefault ? array('rid'=>$userid,'id'=>$aid) : array('rid'=>$rid,'isdefault'=>1);
//        $field = $isdefault ? array('isdefault'=>1) : array('isdefault'=>0);

        $where = $isdefault ? "id={$aid} and userid={$userid}": "userid={$userid} and isdefault = 1";
        $field = $isdefault ? 'isdefault=1':'isdefault=0';
        $sql = "UPDATE `user_address` SET {$field} ";
        $sql .= " WHERE {$where} ";
        $flag= $this->master->query($sql);
        if($flag){
            return TRUE;
        }else{
            return FALSE;
        }
    }


    //获取城市名字
    public function getRegionNameById($region_id)
    {
        $data = [];
        $this->slave->where('region_id', $region_id);
        $this->slave->from('region');
        $this->slave->select('region_id,region_name,parent_id');
        $query = $this->slave->get();
        $res = $query->row_array();
//        $region=$res['region_name'];
        $data['countyid'] = $res['region_id'];
        $data['countyname'] = $res['region_name'];
        if ($res['parent_id']<>0){
            $this->slave->where('region_id', $res['parent_id']);
            $this->slave->from('region');
            $this->slave->select('region_id,region_name,parent_id');
            $query = $this->slave->get();
            $res = $query->row_array();
//            $region=$res['region_name'].''.$region;
            $data['cityid'] = $res['region_id'];
            $data['cityname'] = $res['region_name'];

            if ($res['parent_id']<>0){
                $this->slave->where('region_id', $res['parent_id']);
                $this->slave->from('region');
                $this->slave->select('region_id,region_name,parent_id');
                $query = $this->slave->get();
                $res = $query->row_array();
//                $region=$res['region_name'].''.$region;
                $data['provinceid'] = $res['region_id'];
                $data['provincename'] = $res['region_name'];
            }
        }

        return !empty($data) && isset($data) ? $data : '';
    }



    /**
     * 根据地址id获取地址信息
     * @param int $userid 用户id
     * @param int $addressid 地址id
     * @return array 地址信息
     */
    public function getAddressById($userid=0,$addressid=0){
        if(empty($userid) || empty($addressid)){
            return [];
        }
        $sql = 'SELECT '
            . '`id` AS addressid,full_name AS recname,telphone AS recphone,address,'
            . 'isdefault,province_id AS provid,city_id AS cityid,county_id AS counid '
            . 'FROM '
            . 'user_address '
            . 'WHERE userid='.$userid.' AND `id`='.$addressid;
        $res = $this->slave->query($sql)->result_array();
        return empty($res[0]) ? [] : $res[0];
    }
















}