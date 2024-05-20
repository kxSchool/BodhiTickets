<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ticketscategory 区域管理控制器
 */
class TicketsCategory extends MY_Controller
{
    private $categorydb;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TicketsCategorymodel');
        $this->categorydb = $this->TicketsCategorymodel;
        $this->load->model('TicketsCategoryShowmodel');
        $this->categoryshowdb = $this->TicketsCategoryShowmodel;
        //$this->categoryshowdb = new CategoryShowmodel();
    }
    
    //分类-列表
    public function manage(){
        
            //(1)调用下面分类（无限极排序后的数据）的方法
            $result = $this->getSortedCategory();
            
        if($result !== FALSE){
            $data['showcategory'] = $result;
            //(2)查询所有底层分类
            foreach($result as $v){
                if(array_key_exists('nochild', $v)){
                    $LastLevelDate[] = $v;
                }
            }
            if(!empty($LastLevelDate)){
                $catids = array();
                foreach($LastLevelDate as $vv){
                    $catids[] = $vv['cat_id'];
                }
                $data['catids'] = $catids;
            }
            //(3)获取所有的分类

        }
        
        $this->load->view('TicketsCategory/manage',$data);
    }
    /**
     * 获取品牌和分类对应关系
     */
    public function getShow(){
        if(!IS_POST){
            echo json_encode(array( 'info' => 0, 'tip' => '请求方式有误!' ));
            exit;
        }
        if(empty($this->input->post('categoryid')) || !is_numeric($this->input->post('categoryid'))){
            echo json_encode(array( 'info' => 0, 'tip' => '分类id有误!' ));
            exit;
        }
        $categoryid = $this->input->post('categoryid');
        $existflag = $this->categorydb->isExistChildrenNodes($categoryid);
        if($existflag){
            echo json_encode(array( 'info' => 0, 'tip' => '只有最底层分类可以操作品牌!'));
            exit;
        }else{
            //获取品牌
            $show = $this->categorydb->getAllShowData();
            // 获取已选择品牌
            $selected = $this->categorydb->getCategorySelectedShowDataByCategoryId($categoryid);
            foreach ($show as $bkey=>$bval){
                if(in_array($bval['id'],$selected)){
                    $show[$bkey]['selected'] = ' checked="checked" ';
                }else{
                    $show[$bkey]['selected'] = '';
                }
            }
            // 是否已经存在品牌类型关系
            $existrelative = empty($selected) ? 'false' : 'true';
            echo json_encode(
                    array( 
                            'info' => 1,
                            'tip' =>$show,
                            'relative'=>$existrelative,
                            'existshow'=> implode(',',$selected).','
                        )
                    );
        }
    }
    /**
     * 设置分类品牌关系
     */
    public function setShow(){
        if(!IS_POST){
            echo json_encode(array( 'info' => 0,'tip' => '请求方式有误!' ));
            exit;
        }
        if(empty($this->input->post('categoryid')) || !is_numeric($this->input->post('categoryid'))){
            echo json_encode(array( 'info' => 0,'tip' => '分类id有误!' ));
            exit;
        }
        if(empty($this->input->post('showids'))){
            echo json_encode(array( 'info' => 0,'tip' => '品牌选择信息有误或者重新选择!' ));
            exit;
        }
        if(empty($this->input->post('relative')) || !in_array($this->input->post('relative'),['true','false'])){
            echo json_encode(array( 'info' => 0,'tip' => "异常操作,请关闭弹框重新操作!"));
            exit;
        }
        // 组装数据
        $data = array(
            'cat_id' => $this->input->post('categoryid'),
            'show_ids' => trim($this->input->post('showids'),',')
        );
        if($this->categorydb->saveCategoryAndShowRelative($data,($this->input->post('relative')=='false') ? false : true )){
            echo json_encode(array( 'info' => 1,'tip' => "操作成功!"));
            exit;
        }else{
            echo json_encode(array( 'info' => 0,'tip' => "操作失败!请关闭弹框重试!"));
            exit;
        }
    }
    //分类-添加
    public function category_add()
    {
        //调用下面分类（无限极排序后的数据）的方法
        if(($this->getSortedCategory()) !== FALSE){
            $result = $this->getSortedCategory();
            $this->load->vars('showcategory',$result);
        }
        $this->load->view('TicketsCategory/categoryAdd');
    }

    //分类-保存：处理添加或修改提交的信息
    public function category_save(){
        if(IS_POST){
            //是否存在categoryid,存在则修改，不存在则添加
            if (null !== $this->input->post('categoryid')  && !empty($this->input->post('categoryid'))){
                $savedata['categoryid'] = $this->input->post('categoryid');
            }
            if (null !== $this->input->post('desc')  && !empty($this->input->post('desc'))){
                $savedata['cat_desc'] = $this->input->post('desc');
            }
            $savedata['cat_pid'] = $this->input->post('parentid');
            $savedata['cat_name'] = $this->input->post('categoryname');
            $result = $this->categorydb->savecategory($savedata);
            if($result){
                redirect('TicketsCategory/manage');
            }else{
                $data['msg'] = '保存分类失败';
                $data['url'] = $_SERVER['HTTP_REFERER'];
                $this -> load -> view('common/error', $data);
            }
        }
    }


    //分类-编辑
    public function category_edit(){
        $categoryid = $this->input->get('categoryid');
        $CategoryInfo =$this->categorydb->getCategoryById($categoryid);
        if(!empty($CategoryInfo)){
            //调用下面分类（无限极排序后的数据）的方法
            if(($this->getSortedCategory()) !== FALSE){
                $result = $this->getSortedCategory();
                $this->load->vars('showcategory',$result);
            }
            $this->load->view('TicketsCategory/categoryEdit',$CategoryInfo);
        }else{
            $dataTip['msg'] = '传递参数错误';
            $dataTip['url'] = $_SERVER['HTTP_REFERER'];
            $this->load->view('common/error', $dataTip);
        }
    }


    //分类-删除
    public function category_del(){
        if(IS_AJAX){
            $categoryid = $this->input->post('categoryid');
            //首先判断一下，该区域下是否有下级区域
            $childCategory = $this->categorydb->getChildCategoryById($categoryid);
            if(!empty($childCategory)){
                $data = array(
                    'info' => 0,
                    'tip' => '该分类下有子分类不可删除'
                );
            }else{
                $result = $this->categorydb->delCategoryById($categoryid);
                if($result){
                    $data = array(
                        'info' => 1,
                        'tip' => '操作成功'
                    );
                }else{
                    $data = array(
                        'info' => 0,
                        'tip' => '操作失败'
                    );
                }
            }
            echo json_encode($data);
        }
    }


    public function categoryShow(){
        //(1)分类ID
        $cat_id = $this->input->get('categoryid');
        $data['cat_id'] = $cat_id;

        //(2)取出分类名
        $catname = $this->categorydb->getCatNameByCid($cat_id);
if(!empty($catname)){
            $data['catname'] = $catname['cat_name'];
        }

        //(3)通过分类连表查询关联的品牌
        $categoryShows = $this->categoryshowdb->getCategoryShowInfo($cat_id);
        if(!empty($categoryShows)){
            $data['showsinfo'] = $categoryShows;
        }
        $this->load->view('TicketsCategory/categoryShow',$data);
    }

    public function updateSort()
    {
        if(IS_AJAX){
            $sorts = $this->input->post('sorts');
            $shows = $this->input->post('shows');
            $cat_id = $this->input->post('cat_id');
            //将字符串->数组
            $sort_arr = explode(',',$sorts);
            $show_arr = explode(',',$shows);
            $data = array();
            if(count($sort_arr) == count($show_arr)){
                foreach($sort_arr as $key=>$val){
                    $data[] = array(
                        'cat_id' => $cat_id,
                        'show_id' => $show_arr[$key],
                        'sort' => $sort_arr[$key]
                    );
                }
            }
            //批量更新数据库里面的权重
            if(!empty($data)){
                foreach($data as $v){
                    $updateResult = $this->categoryshowdb->updateSort($v);
                    if(!$updateResult){
                        $returnData = array(
                            'info' => 0,
                            'tip' => '操作失败'
                        );
                        echo json_encode($returnData);exit;
                    }
                }
            }
            $returnData = array(
                'info' => 1,
                'tip' => '更新成功'
            );
            echo json_encode($returnData);exit;
        }
    }

    /********************************以下为本类的公共方法*********************************/
    //属性-调用分类数据（无限级分类）
    //获取排序后的分类
    public function getSortedCategory()
    {
        $allCategory = $this->categorydb->getAllCategory();
        if(is_array($allCategory) && !empty($allCategory)){
            foreach($allCategory as $k=>&$v){
                $cat_id = $v['cat_id'];
                $cat_pid = $v['cat_pid'];
                $allCategory[$k]['id'] = $cat_id;
                $allCategory[$k]['parentid'] = $cat_pid;
            }
            $Category = formatTreeLevel($allCategory,0);
            $result = array_multi2single($Category);
            return $result;
        }else{
            return FALSE;
        }
    }

    //分类关联属性
    public function categoryAttribute(){
        //(1)分类ID
        $cat_id = $this->input->get('categoryid');
        $data['cat_id'] = $cat_id;

        //(2)取出分类名
        $catname = $this->categorydb->getCatNameByCid($cat_id);
        if(!empty($catname)){
            $data['catname'] = $catname['cat_name'];
        }

        //(3)通过分类连表查询关联的品牌
        $categoryAttributes = $this->categorydb->getCategoryAttributeInfo($cat_id);
        $categoryAttributes = formatTreeLevel($categoryAttributes,0);
        $result = array_multi2single($categoryAttributes);
        if(!empty($result)){
            $data['attributeinfo'] = $result;
        }
        $this->load->view('TicketsCategory/categoryAttribute',$data);
    }



















}
