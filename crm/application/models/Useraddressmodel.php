<?php
//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
/**
 * 商品表数据模型类
 * @author Dangqi Ma
 * @time 2017/4/24
 */
class Useraddressmodel extends CI_Model{
    
    /**
     * 用户添加新的地址
     * @param array $data 地址信息
     * @return boolean true表示添加成功,否则失败
     */
    public function add(&$data=[]){
        if(empty($data['userid'])){
            return false;
        }
        return $this->master->insert('user_address', $data) ? $this->master->insert_id() : false;
    }
    
    /**
     * 获取当前用户收货地址
     * @param int $userid 当前用户id
     * @return array 用户加密地址信息
     */
    public function getMd5Address($userid=0){
        if(empty($userid)){
            return [];
        }
        $md5sql = 'SELECT '
                    . 'MD5(CONCAT(full_name,telphone,address)) AS md5res '
                . 'FROM '
                    . 'user_address '
                . 'WHERE userid='.$userid;
        $res = $this->slave->query($md5sql)->result_array();
        return empty($res) ? [] : $res;
    }
    
    /**
     * 根据指定排序获取用户地址列表
     * @param int $userid 当前用户id
     * @param int $isdefault 0:不按照默认地址排序,1:按照默认地址排序
     * @return array 地址信息
     */
    public function getAddressList($userid=0,$isdefault=0){
        if(empty($userid)){
            return [];
        }
        // 排序
        $sort= $isdefault ? 'isdefault desc,`id` desc' : '`id` desc';
        // SQL语句
        $sql = 'SELECT '
                . '`id` AS addressid,full_name AS recname,telphone AS recphone,address,'
                . 'isdefault,province_id AS provid,city_id AS cityid,county_id AS counid '
             . 'FROM '
                . 'user_address '
             . 'WHERE userid='.$userid.' '
             . 'ORDER BY '.$sort;
        $res = $this->slave->query($sql)->result_array();
        return empty($res) ? [] : $res;
    }
    
    /**
     * 根据地址id删除用户收货地址
     * @param int $userid 用户id
     * @param int $addressid 收货地址id
     * @return boolean true表示删除成功,否则失败
     */
    public function deleteAddressById($userid=0,$addressid=0){
       if(empty($userid) || empty($addressid)){
           return false;
       }
       $deleteSql = 'DELETE FROM user_address WHERE `id`='.$addressid.' AND userid='.$userid;
       $delflag = $this->master->simple_query($deleteSql);
       if(!empty($delflag)){
           // 设置默认地址(无论默认地址是否删除)
           $defaultSql = 'UPDATE user_address SET isdefault=1 WHERE userid='.$userid.' ORDER BY isdefault DESC,`id` DESC LIMIT 1';
           $updflag = $this->master->simple_query($defaultSql);
           if(!empty($updflag)){
               return true;
           }
       }
       return false;
    }
    
    /**
     * 更新用户收货地址
     * @param type $data
     * @return boolean
     */
    public function update(&$data=[]){
        if(empty($data['id']) || empty($data['userid'])){
            return false;
        }
        $this->master->where('id',$data['id']);
        $this->master->where('userid',$data['userid']);
        if($this->master->update('user_address', $data)){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * 设置默认地址
     * @param int $userid 用户id
     * @param int $addressid 地址id
     * @return boolean true设置成功,否则失败
     */
    public function setDefaultAddress($userid=0,$addressid=0){
        if(empty($userid) || empty($addressid)){
            return false;
        }
        // 取消已有的默认地址
        $defaultSql = 'UPDATE user_address SET isdefault=0 WHERE isdefault=1 AND userid='.$userid;
        $this->master->simple_query($defaultSql);
        // 设置新的默认地址
        $defaultSql = 'UPDATE user_address SET isdefault=1 WHERE userid='.$userid.' AND `id`='.$addressid;
        if($this->master->simple_query($defaultSql)){
            return true;
        }else{
            return false;
        }
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
}
