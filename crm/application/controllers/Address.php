<?php

//////////////////////////////////////////////////////////////////////
// 章爱军(永远的大牛)                                               //
// Trial License: For evaluation only!                              //
// (c) 2018, ZhangAijun, http://www.mydeershow.com                  //
//////////////////////////////////////////////////////////////////////
/**
 * Created by  YongBo Lu
 * Email: BoothLu@163.com
 * Date: 2017/9/20
 * Time: 17:08
 * Introduction:公共地址类:省市县
 */
class Address extends MY_Controller
{
    // 定义地址模型属性
    private $addressmodel = null;
    /**
     * 地址操作构造方法
     */
    public function __construct() {
        parent::__construct();
        // 初始化数据库连接
        $this->master=$this -> load -> database('master',true);
        $this->slave=$this -> load -> database('slave',true);
        // 加载地址数据模型
        $this->load->model('Addressmodel');
        $this->addressmodel = $this->Addressmodel;
    }
    /**
     * 获取全国省市信息
     * @return array 返回省市数据
     */
    public function getProvince(){
        $data = $this->addressmodel->getProvince();
        if(empty($data)){
            echo json_encode(['flag'=>0,'message'=>'数据不存在地址数据库或者数据异常!']);
            return;
        }else{
            echo json_encode(['flag'=>1,'message'=>$data]);
            return;
        }
    }
    
    
    /**
     * 获取全国市区县信息
     * @return array 返回全国市区县
     */
    public function getArea(){
        // 检查用户输入邮政id
        if(empty($this->input->post('areaid')) || !is_numeric($this->input->post('areaid'))){
            echo json_encode(['flag'=>0,'message'=>'区域id值无效!']);
            return;
        }
        $data = $this->addressmodel->getArea($this->input->post('areaid'));
        if(empty($data)){
            echo json_encode(['flag'=>0,'message'=>'数据不存在地址数据库或者数据异常!']);
            return;
        }else{
            echo json_encode(['flag'=>1,'message'=>$data]);
            return;
        }
    }




}