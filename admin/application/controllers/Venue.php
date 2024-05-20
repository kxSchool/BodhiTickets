<?php
/**
 * User: Administrator
 * Date: 2017/5/10
 * Time: 14:12
 */
class Venue extends MY_Controller {
    private $venuedb;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Venuemodel');
        $this->venuedb =$this->Venuemodel;
    }


    /*
     *车型页面展示
     */
    public function manage(){
        if($this->input->post('dosearch')){
            $fields = $this->input->post('fields');
            $search = $this->input->post('search');
        }else{
            $fields = $this->input->get('fields');
            $search = $this->input->get('search');
        }

        if(!empty($fields) && !empty($search)){
            $this->load->vars('fields',$fields);
            $parameter['fields'] = $fields;

            $this->load->vars('search',$search);
            $parameter['search'] = $search;
            $data['fields'] = $fields;
            if($search == 'venue_name'){
                $data['like'] = strtolower(trim($search));
            }else{
                $data['like'] = trim($search);
            }
        }

        $data['limit'] = PAGESIZE;
        $page = $this->input->get('page');
        $currentPage = $page = isset($page) ? intval($page) : 1;
        $offset = ($page - 1) * PAGESIZE;
        $data['offset'] = $offset;
        $result = $this->venuedb->getAllVenues($data);
        foreach($result['rows'] as &$v){
            if(isset($v['picname']) && !empty($v['picname'])){
                $v['picname'] = $this->config->item('venue_url') . $v['picname'];
            }
        }
        $this->load->library('Page');
        if(isset($parameter)){
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage,$parameter);
        }else{
            $pageObject = new Page($result['total'], PAGESIZE, $currentPage);
        }
        $pageObject->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END%');
        $pages = $pageObject->show();
        $dataShow = array('pages' => $pages, 'datas' => $result['rows']);

        $this->load->view('venue/manage',$dataShow);
    }

    /**
     * 添加车型
     */
     public function addVenues(){
         //固定的26个字符编码
         $data['char'] = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
         $this->load->view('venue/venueAdd',$data);
     }

    /**
     * 修改车型
     */
    public function editVenue(){
        //先判断数据库中有没有该id值，没有的话就直接重定向到车型列表页
        $id = $this->input->get('id');
        //通过id查询所有的值
        $venueinfo = $this->venuedb->getVenueByid($id);
        
        if (isset($venueinfo['picname']) && !empty($venueinfo['picname'])) {
           
            //判断一下图片是否存在
            //if (file_exists($this->config->item('venue_path') . $venueinfo['picname'])) {
            //    $venueinfo['picname'] = $this->config->item('venue_url') . $venueinfo['picname'];
            //}
        }  
         $data['venueinfo']=$venueinfo;
        //字母编码
        $data['char'] = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
        $this->load->view('venue/venueEdit',$data);
    }


    /**
     * 处理添加或修改的数据信息
     */
    public function saveVenues(){
        
        if(IS_POST){
            
            $id = $this->input->post("id");
            $saveData['venue_name'] = $this->input->post("venue_name"); //26个英文字母必然存在其中之一，就不用判断
            $saveData['Province'] = $this->input->post("Province");
            $saveData['City'] = $this->input->post("City");
            $saveData['Village'] = $this->input->post("Village");
            $saveData['address'] = $this->input->post("address");
            $saveData['picname'] = $this->input->post("picname");
            
            
            
                        
                

            if(isset($id) && !empty($id)){
                $saveData['id'] = $this->input->post('id');
            }else{
                //判断是否会出现重复数据
                $rst = $this->venuedb->isCommonData($saveData);
                if($rst){
                    $returnrst = array("info"=>'0','tip'=>'信息重复：场馆已经存在！');
                    echo json_encode($returnrst);
                    return;
                }
            }
            $result = $this->venuedb->saveVenue($saveData);
            if($result){
                $returnrst = array("info"=>'1','tip'=>'场馆添加成功');
            }else{
                $returnrst = array("info"=>'0','tip'=>'场馆添加失败');
            }
            echo json_encode($returnrst);
            return;
        }
    }

 

    //方法三：用id的方式去获取它子类，不用连表，方便
    public function checkAll($fields,$value,$id){
        $parms = $this->venuedb->getAllChildById($id); //根据id值获取constant的所有child
        if(isset($parms) && !empty($parms)){
            $parmarr = array_column($parms,'cat_name');
        }
        if(in_array($value,$parmarr)){
            return TRUE;
        }else{
            return FALSE;
        }
    }

 

}