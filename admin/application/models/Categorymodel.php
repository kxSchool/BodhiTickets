<?php
/**
 * Class Categorytmodel 分类管理模型
 */
class Categorymodel extends CI_Model
{
    public $slave, $master;

    public function __construct()
    {
        parent::__construct();
        $this->slave = $this->load->database('goods_master', true);
        $this->master = $this->load->database('goods_slave', true);
    }


    /************************** 增 *****************************/
    //保存分类（适用于 “添加+修改” 操作）
    public function saveCategory($data){
        //判断是否有id值，来确定是添加还是修改
        $categoryid = isset($data['categoryid']) ? $data['categoryid'] : 0;
        $data['cat_desc'] = isset($data['cat_desc']) ? $data['cat_desc'] : '';
        if(isset($data['categoryid'])){
            unset($data['categoryid']);
        }
        if($categoryid){
            $this->master->where('cat_id',$categoryid);
            if($this->master->update('category', $data)){
                return true;
            }else{
                return false;
            }
        }else{
            if($this->master->insert('category', $data)){
                return true;
            }else{
                return false;
            }
        }
    }
    /**
     * 添加或者保存品牌分类关系到表中
     * @param array $data 要保存的数据
     * @param boolean $flag true表示添加,否则表示更新
     * @return boolean true表示操作成功,否则失败
     */
    public function saveCategoryAndBrandRelative($data=[],$flag=false){
        if(empty($data['cat_id']) || empty($data['brand_ids'])){
            return false;
        }
        if($flag){ //更新数据
            $this->master->where('cat_id',$data['cat_id']);
            if($this->master->update('category_brand', $data)){
                return true;
            }else{
                return false;
            }
        }else{ //新增数据
            if($this->master->insert('category_brand', $data)){
                return true;
            }else{
                return false;
            }
        }
    }


    /************************** 删 *****************************/

    //根据categoryid删除指定分类
    public function delCategoryById($categoryid){
        $this->master->where('cat_id',$categoryid);
        $this->master->from('category');
        $result = $this->master->delete();
        if($result){
            return true;
        }else{
            return false;
        }
    }



    /************************** 查 *****************************/
    //获取所有分类信息
    public function getAllCategory(){
        $this->slave->order_by('cat_desc','ASC');
        $this->slave->order_by('cat_id','ASC');
        $query = $this->slave->get("category");
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }

    //根据categoryid，得到直接下级分类
    public function getChildCategoryById($categoryid){
        $this->slave->where('cat_pid',$categoryid);
        $query = $this->slave->get("category");
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }

    //根据分类ID查询指定分类
    public function getCategoryById($categoryid){
        $this->slave->where('cat_id',$categoryid);
        $query = $this->slave->get("category");
        $result = $query->row_array();
        return !empty($result) ? $result : '';
    }
    /**
     * 查询当前分类是否存在子节点
     * @param int $categoryid 当前分类id
     * @return boolean true表示存在,否则不存在
     */
    public function isExistChildrenNodes($categoryid=0){
        if(empty($categoryid)){
            return false;
        }
        $sql = 'SELECT count(*) AS count FROM category WHERE cat_pid='.$categoryid.' ';
        $result = $this->slave->query($sql)->result_array();
        return empty($result[0]['count']) ? false : true;
    }
    /**
     * 获取所有品牌数据
     * @return array 品牌数据
     */
    public function getAllBrandData(){
        $sql = 'SELECT `id`,`name` FROM brand ORDER BY `id` ';
        $result = $this->slave->query($sql)->result_array();
        return empty($result) ? [] : $result;
    }
    /**
     * 根据分类id获取已经选择的品牌数据
     * @param int $categoryid 分类id
     * @return array 品牌id数据
     */
    public function getCategorySelectedBrandDataByCategoryId($categoryid=0){
        if(empty($categoryid)){
            return [];
        }
        $sql = 'SELECT brand_ids FROM category_brand WHERE cat_id='.$categoryid;
        $result = $this->slave->query($sql)->result_array();
        if(empty($result[0]['brand_ids'])){
            return [];
        }else{
            return explode(',', trim($result[0]['brand_ids'],','));
        }
    }

    /**
     * @param $cat_id 分类id
     * @return mixed  返回查到的分类名
     */
    public function getCatNameByCid($cat_id){
        $sql = "SELECT cat_name
                FROM category WHERE cat_id = ".$cat_id;
        $query = $this->slave->query($sql);
        $result = $query->row_array();
        $query->free_result();
        return $result;

    }

    /*
 * 得到栏目select
 */
    public function getCategorySelect(){
        $this->slave->from('category');
        $this->slave->select('cat_id,cat_name,cat_pid as parent_id');
        $this->slave->order_by('cat_desc','ASC');
        $this->slave->order_by('cat_id','ASC');
        $query = $this->slave->get();
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }

    public function twoLevelCategorySelect(){
        $this->slave->where('cat_pid != ','0');
        $this->slave->from('category');
        $this->slave->select('cat_id,cat_name,cat_pid as parent_id');
        $query = $this->slave->get_where();
        $result = $query->result_array();
        return !empty($result) ? $result : '';
    }

    //分类关联属性信息
    public function getCategoryAttributeInfo($cat_id){
        $sql = "SELECT id,name,pid as parentid
                FROM attribute
                WHERE catid = ".$cat_id;
        $query = $this->slave->query($sql);
        $result = $query->result_array();
        $query->free_result();
        return $result;
    }



}