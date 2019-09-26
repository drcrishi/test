<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WagesReport extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isLogin())
            redirect(base_url());
        $this->data = array();
        $this->data['title'] = "";
        $this->data['description'] = "";
        $this->data['user'] = $this->session->userdata('userData');
        $this->data['notification'] = webNotification();
        $this->load->model('wages_model','model');
    }

    public function index() {
        $this->data['title'] = "HAP Wages Report";
        $data['js'] = array(
            'global/plugins/select2/js/select2.full.min.js',
            'global/plugins/jquery-validation/js/jquery.validate.min.js',
            'global/plugins/jquery-validation/js/additional-methods.min.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
            'global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
            'pages/scripts/toaster/toaster.js',
            'global/scripts/datatable.js',
            'global/plugins/datatables/datatables.min.js',
            'global/scripts/app.min.js',
            'layouts/layout/scripts/layout.min.js',
            'layouts/global/scripts/quick-sidebar.min.js',
            'custom/js/custom.js'
        );
        $data['jsTPFooter'] = array(
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js'
        );
        $data['jsFooter'] = array(
            'custom/js/form-wagesreport.js'
        );
        $data['css'] = array(
            'global/plugins/select2/css/select2.min.css',
            'global/plugins/select2/css/select2-bootstrap.min.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css',
            'global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css',
            'global/plugins/datatables/datatables.min.css',
            'custom/css/custom.css'
        );


        $data['cssTP'] = array(
            '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'
        );
        $sessionId = $this->session->userdata('admin_id');
        if ($sessionId != 1) {
            show_404();
        }
        
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('wagesReport_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function getWageReport($downloadType="") {

        $fromDate = $this->input->post('servicedatefrom');
        $toDate = $this->input->post('servicedateto');
        $data['result']=$this->model->getWageReport();
        $output['response']=$this->load->view('ajax_wages_report',$data,TRUE);
        
        if($downloadType == "pdf"){
            $filename = rand() . ".pdf";
            $this->load->library('m_pdf');
            $pdf = $this->m_pdf->load();
            $pdf->SetHTMLHeader('<h2>Wages Report</h2>From ' . $fromDate . ' to ' . $toDate);
            $pdf->SetHTMLFooter('<hr/>{PAGENO}/{nbpg} Report Generated:' . date('d-m-Y H:i:s'));
            $pdf->AddPage('', // L - landscape, P - portrait 
            '', '', '', '', 5, // margin_left
            5, // margin right
            25, // margin top
            30, // margin bottom
            0, // margin header
            0); // margin footer
            $pdf->WriteHTML($output['response']);
            $pdf->Output('./pdf/' . $filename, "F");
            ?><script>window.location.assign('<?php echo base_url() . 'pdf/' . $filename; ?>');</script><?php
        }
        else if($downloadType == "xls"){

            $titleEnq = 'Wages Report';
            require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
            require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

            $objPHPExcel = new PHPExcel();
            $objPHPExcel->getActiveSheet()->setTitle($titleEnq);
            $objPHPExcel->setActiveSheetIndex(0);   

            // tittles
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Packer Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Service Date');
            $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Client Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'State');
            $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Packer Total Hours');

            // set title bold 
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);

            if(count($data['result'])>0){
                $rowCount = 2;
                $packerName="";
                $serviceDate="";
                $state="";
                $totalHours=0;
                $loopCounter=0;
                $totalJobHours=0;
                foreach ($data['result'] as $row) {

                    if($packerName != $row['packer_name']){
                        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $row['packer_name']);
                        $packerName = $row['packer_name'];
                        $serviceDate="";
                        $totalHours= $row['packer_total_hours'];
                    }
                    else{
                        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                        $totalHours+= $row['packer_total_hours'];
                    }

                    if($serviceDate != $row['en_servicedate']){
                        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, date("d-m-Y", strtotime($row['en_servicedate'])));
                        $serviceDate = $row['en_servicedate'];
                    }
                    else{
                        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                    }

                    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $row['client_name']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $row['en_movetype']=='4'? $row['en_movingfrom_state']:$row['en_movingto_state']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $row['packer_total_hours']);

                    // echo $data['result'][$loopCounter + 1]['packer_name'];
                    // die;
                    if($packerName != $data['result'][$loopCounter + 1]['packer_name']){
                        $rowCount++;
                        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'Total Hours Worked');
                        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $totalHours);

                        // bold
                        $objPHPExcel->getActiveSheet()->getStyle('D' . $rowCount)->getFont()->setBold(true);
                        $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);

                    }
                    $loopCounter++;
                    $totalJobHours+=$row['packer_total_hours'];
                    $rowCount++;
                }
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'Grand Total');
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $totalJobHours);
                $objPHPExcel->getActiveSheet()->getStyle('D' . $rowCount)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                $rowCount++;
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'Wages');
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, round($totalJobHours * 30,2));

                $objPHPExcel->getActiveSheet()->getStyle('D' . $rowCount)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                $rowCount++;
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, 'Super');
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, round($totalJobHours * 2.85,2));

                $objPHPExcel->getActiveSheet()->getStyle('D' . $rowCount)->getFont()->setBold(true);
                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
            }
            $nCols = 5; //set the number of columns
            foreach (range(0, $nCols) as $col) {
                $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
            }
            $sheetname = $titleEnq.rand() . '.xlsx';
            $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            ?>
            <script type="text/javascript">window.location.assign('<?php echo base_url() . '/' . $sheetname; ?>');</script>
            <?php
            $object_writer->save($sheetname);

            //
            echo $output['response'];
        }
        else{
        	echo json_encode($output);
        }

    }

}
