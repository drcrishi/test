<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    var $MODEL = 'Notify_model';

    public function __construct() {
        parent::__construct();
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        if (!isLogin())
            echo json_encode(array("expired" => "1"));
        $this->data = array();
        $this->load->model($this->MODEL, 'model');
    }

    public function index() {
        $notification = webNotification();
        if (count($notification) > 0) {
            ob_start();
            ?>
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="true">
                <i class="icon-bell"></i>
                <span class="badge badge-default"> <?php echo count($notification); ?> </span>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                        <?php foreach ($notification as $noti) {
                            ?>
                            <li>
                                <a href="javascript:;">
                                    <span class="time"><?php echo $noti['time']; ?></span>
                                    <span class="details">
                                        <span class="label label-sm label-icon label-danger">
                                            <i class="fa fa-bolt"></i>
                                        </span> <?php echo $noti['description']; ?> </span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
            <?php
            $result = ob_get_contents();
            ob_clean();
//            echo json_encode(array("result" => $result));
            echo json_encode(array("success" => count($notification)));
        } else {
            echo json_encode(array("error" => 1));
        }
    }

    /**
     * Get not showed records
     */
    public function getunreadNotification(){
        $enquiryArr=array();
        $res=$this->model->getunreadNotification();
        $eCounter=0;
        foreach ($res as $row) {
            $enquiryArr[$eCounter]=$row;
            $enquiryArr[$eCounter]['type']="enquiry";
            $eCounter++;
        }
        $depositNotification=$this->model->getDepositNotification();
        foreach ($depositNotification as $row) {
            $enquiryArr[$eCounter]=$row;
            $enquiryArr[$eCounter]['type']="deposit";
            $eCounter++;
        }
        $data['finalResult']=$enquiryArr;
        echo json_encode($data);    
    }

    /**
     * updates shown notification
     */
    public function updateShownNotification(){
        $this->model->updateShownNotification();
        $data['response']="updated";
        echo json_encode($data);
    }

}
