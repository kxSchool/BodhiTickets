<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cache extends MY_Controller {

    public $addspacedb;
    private $categorydb;
	public function __construct() {
        parent::__construct();
        $this->master=$this -> load -> database('master',true);
        $this->slave=$this -> load -> database('slave',true);
        $this -> load -> model('AdSpacemodel');
        $this -> adspacedb = new AdSpacemodel();
        $this -> load-> model('Categorymodel');
        $this -> categorydb = new Categorymodel();
	}

	//分类广告缓存
    public function ad_category(){
        header("Content-type:text/html;charset=utf-8");
        $this -> load-> model('Admodel');
        $adCategory = $this->Admodel->getAdBySpaceid(23);
        $adCategoryData = [];
        foreach($adCategory as $key =>$val) {
            $setting = string2array($val['setting']);
            $adCategoryData[$key]['ad_link'] = $setting['ad_link'];
            $adCategoryData[$key]['ad_code'] = $setting['ad_code'];
            //假如是图片类型，除去ad_code前的第一个.号
            if($val['type'] == 0){
                //判断一下图片是否存在
                if(file_exists($this->config->item('ad_path').$setting['ad_code']) && !empty($setting['ad_code'])){
                    $adCategoryData[$key]['image'] = $this->config->item('ad_url').$setting['ad_code'];
                }
            }
            $adCategoryData[$key]['name'] = $val['name'];
            $adCategoryData[$key]['startdate'] = $val['startdate'];
            $adCategoryData[$key]['enddate'] = $val['enddate'];
        }

        if(!file_exists($this->config->item('adJson_path'))) {
            mkdir($this->config->item('adJson_path'), 0777, true);
        }
        $file_path = $this->config->item('adJson_path').'guanggao_categoryJson.js';
        $rst = file_put_contents($file_path,'ad_category='.json_encode($adCategoryData).';') ;
        if($rst){
            //当前文件的路径
            $data['info'] = "分类广告缓存生成成功！文件路径：";
            $data['cacheurl'] = $this->config->item('adJson_url').'guanggao_categoryJson.js';
            $this->load->view('common/ok',$data);
        }else{
            $this->load->view('common/no');
        }
    }

    public function news() {
        header("Content-type:text/html;charset=utf-8");
        $this->load->model('Newsmodel');
        $filter['where']['status'] = 1;
        $filter['where']['catid'] = 1;
        $filter['order'] = 'listorder DESC, id DESC';
        $filter['limit'] = 4;
        $filter['offset'] = 0;
        $newsList = $this->Newsmodel->newslist($filter);
        $data = [];
        if (isset($newsList['rows']) && !empty($newsList['rows'])) {
            foreach($newsList['rows'] as $key=>$val) {
                $data[$key]['title'] = $val['title'];
                $data[$key]['id'] = $val['id'];
                if ($val['islink'] == 1) {
                    $data[$key]['url'] = $val['url'];
                } else {
                    $data[$key]['url'] = '';
                }
            }
        }

        if(!file_exists($this->config->item('adJson_path'))) {
            mkdir($this->config->item('adJson_path'), 0777, true);
        }
        $file_path = $this->config->item('adJson_path').'newsJson.js';
        $rst = file_put_contents($file_path,'newsJson='.json_encode($data).';') ;
        if($rst){
            //当前文件的路径
            $data['info'] = "公告缓存生成成功！文件路径：";
            $data['cacheurl'] = $this->config->item('adJson_url').'newsJson.js';
            $this->load->view('common/ok',$data);
        }else{
            $this->load->view('common/no');
        }
    }

    //二级分类广告缓存
    public function ad_two_category(){
        header("Content-type:text/html;charset=utf-8");
        $data = [];
        $this -> load-> model('Admodel');
        $name = "CategoryTwo";
        //规格：spaceid为广告id，description内容存的是cat_id的值
        $spaceinfo = $this -> adspacedb ->getAdSpaceInfoByName($name);
        foreach($spaceinfo as $v){
            $adCategory = $this->Admodel->getAdBySpaceid($v['spaceid']);
            $adCategoryData = [];
            if(!empty($adCategory)){
                foreach($adCategory as $key =>$val) {
                    $setting = string2array($val['setting']);
                    $adCategoryData[$key]['ad_link'] = $setting['ad_link'];
                    $adCategoryData[$key]['ad_code'] = $setting['ad_code'];
                    //假如是图片类型，除去ad_code前的第一个.号
                    if($val['type'] == 0){
                        //判断一下图片是否存在
                        if(file_exists($this->config->item('ad_path').$setting['ad_code']) && !empty($setting['ad_code'])){
                            $adCategoryData[$key]['image'] = $this->config->item('ad_url').$setting['ad_code'];
                        }
                    }
                    $adCategoryData[$key]['name'] = $val['name'];
                    $adCategoryData[$key]['startdate'] = $val['startdate'];
                    $adCategoryData[$key]['enddate'] = $val['enddate'];
                }
    //            var_dump($v['description']);die;
                $data[$v['description']] = $adCategoryData;
            }
        }
        if(!file_exists($this->config->item('adJson_path'))) {
            mkdir($this->config->item('adJson_path'), 0777, true);
        }
        $file_path = $this->config->item('adJson_path').'ad_all_two_categoryJson.js';
        $rst = file_put_contents($file_path,'ad_all_two_category='.json_encode($data).';') ;
        if($rst){
            //当前文件的路径
            $data['info'] = "二级分类广告缓存生成成功！文件路径：";
            $data['cacheurl'] = $this->config->item('adJson_url').'ad_all_two_categoryJson.js';
            $this->load->view('common/ok',$data);
        }else{
            $this->load->view('common/no');
        }
    }





    //二级分类+广告缓存
    public function twocategoryads(){
        header("Content-type:text/html;charset=utf-8");
        $dir = $this->config->item('json_path');
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $data = array();
        $category = $this->categorydb->getCategorySelect();
        foreach($category as $k=>$v){
            $category[$k]['id'] = $v['cat_id'];
            $category[$k]['name'] = $v['cat_name'];
            unset($category[$k]['cat_id']);
            unset($category[$k]['cat_name']);
        }
        $categorys =formatTreeLevels($category,'children');
        foreach($categorys as $val){
            foreach($val['children'] as $v){
                if($v['level'] == 1){
                    $data[] = $v;
                }
            }
        }
        //分类的图片
        $twocatads = $this->ad_two_category_data();
        foreach($data as &$v){
            if(array_key_exists($v['id'],$twocatads)){
                $v['imginfo'] = $twocatads[$v['id']];
            }
        }
        $file_path = $this->config->item('categoryJson_two_ads_path');
        $rst = file_put_contents($file_path,'twocategoryads='.json_encode($data).';') ;
        if($rst){
            //当前文件的路径
            $data['info'] = "二级分类+广告缓存生成成功！文件路径：";
            $data['cacheurl'] = $this->config->item('categoryJson_two_ads_url');
            $this->load->view('common/ok',$data);
        }else{
            $this->load->view('common/no');
        }
    }

    //二级分类的图片
    public function ad_two_category_data(){
        header("Content-type:text/html;charset=utf-8");
        $data = [];
        $this -> load-> model('Admodel');
        $name = "CategoryTwo";
        //规格：spaceid为广告id，description内容存的是cat_id的值
        $spaceinfo = $this -> adspacedb ->getAdSpaceInfoByName($name);
        foreach($spaceinfo as $v){
            $adCategory = $this->Admodel->getAdBySpaceid($v['spaceid']);
            $adCategoryData = [];
            if(!empty($adCategory)){
                foreach($adCategory as $key =>$val) {
                    $setting = string2array($val['setting']);
                    $adCategoryData[$key]['ad_link'] = str_replace('shop/','',$setting['ad_link']);
                    $adCategoryData[$key]['ad_code'] = $setting['ad_code'];
                    //假如是图片类型，除去ad_code前的第一个.号
                    if($val['type'] == 0){
                        //判断一下图片是否存在
                        if(file_exists($this->config->item('ad_path').$setting['ad_code']) && !empty($setting['ad_code'])){
                            $adCategoryData[$key]['image'] = $this->config->item('ad_url').$setting['ad_code'];
                        }
                    }
                    $adCategoryData[$key]['name'] = $val['name'];
                    $adCategoryData[$key]['startdate'] = $val['startdate'];
                    $adCategoryData[$key]['enddate'] = $val['enddate'];
                }
                $data[$v['description']] = $adCategoryData;
            }
        }
        return !empty($data) ? $data : '';
    }

}