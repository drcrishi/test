<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RevenueReport extends CI_Controller {

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
    public function __construct() {
        parent::__construct();
        if (!isLogin())
            redirect(base_url());
        $this->data = array();
        $this->data['title'] = "";
        $this->data['description'] = "";
        $this->data['user'] = $this->session->userdata('userData');
        $this->data['notification'] = webNotification();
    }

    public function index() {
        $this->data['title'] = "HAM Revenue Report";
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
            'custom/js/form-revenuereport.js'
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
        $this->load->model("enquiry_model");
        $data['move_type'] = $this->enquiry_model->getMoveType();
        $this->load->model("contact_model");
        $data['statedata'] = $this->contact_model->getSuburb();

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('revenueReport_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    function viewRevenueReport() {

        $this->load->model("booking_model");
        $this->input->method();

        $data = array(
            'servicedatefrom' => date('Y-m-d', strtotime($this->input->post("servicedatefrom", true))),
            'servicedateto' => date('Y-m-d', strtotime($this->input->post("servicedateto", true))),
            'enmovetype' => $this->input->post("enmovetype", true),
            'state' => $this->input->post("state", true),
            'removalist' => $this->input->post("removalist", true),
            'pdforxls' => $this->input->post("pdforxls", true),
            'bookingstatus' => $this->input->post("bookingstatus", true),
        );
        $revenueReport = $this->booking_model->revenueReportData($data);
        $data['revenueReport'] = $revenueReport;

        if ($revenueReport) {

            $xlspdfData = $this->load->view('reports/reportviewer.php', $data, true);

            $xlspdfbutton = '<div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12"> 
                                        <input type="hidden" name="pdforxls" id="pdforxls">
                                        
                                        <input type="submit" class="btn red" value="Export PDF" id="exportPDFviewer">                                        
                                        <input type="submit" class="btn green filter-submit" value="Export XLS" id="exportXLSviewer">  
                                        
                                </div>
                             </div>';
            echo $xlspdfData . $xlspdfbutton;

            if ($_POST['pdforxls'] != "") {

                if ($_POST['pdforxls'] == "xls") {
//        echo "<pre>";
//        print_r($data);
//        die;
                    $titleEnq = 'Revenue Report';
                    require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
                    require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

                    $objPHPExcel = new PHPExcel();
                    $objPHPExcel->getActiveSheet()->setTitle($titleEnq);
                    $objPHPExcel->setActiveSheetIndex(0);


                    $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'State');
                    $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Service');
                    $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Removalist');
                    $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Client');
                    $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Move Date');
                    $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Total Cost');
                    $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Total Revenue');
                    $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Margin');

                    // echo "<pre>";
                    //  print_r($data["revenueReport"]);
                    // die;
                    $rowCount = 2;
                    $state = "";
                    $services = "";
                    $removal_id = "";
                    $client_id = "";
                    $total_cost = 0;
                    $final_cost = 0;
                    $total_revenue = 0;
                    $final_revenue = 0;
                    $total_margin = 0;
                    $final_margin = 0;
                    $IsNEW = false;
                    $IsNEWRemoval = false;
                    $cntReventRecords = count($revenueReport);
                    $incCNT = 0;
                    $servicesType = array("", "Removal", "Removal", "", "Packing/Unpacking", "Packing/Unpacking", "Storage");
                    foreach ($revenueReport as $revenueReportKey => $revenueReportValue) {
                        $incCNT++;
                        $serdate = date("d-m-Y", strtotime($revenueReportValue['en_servicedate']));
                        $serviceType = $servicesType[$revenueReportValue['en_movetype']];
                        if ($removal_id != $revenueReportValue['removalist_id']) {
                            if ($incCNT > 1) {
                                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Sub-Total');
                                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "$" . number_format($total_cost_re, 2));
                                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "$" . number_format($total_revenue_re, 2));
                                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "$" . number_format($total_margin_re, 2));

                                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $rowCount++;
                                /* removal counts */
                                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Job count');
                                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $total_jobs);
                                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
                                /* removal counts */


                                $rowCount++;



                                $total_cost_re = 0;
                                $total_revenue_re = 0;
                                $total_margin_re = 0;
                                $total_jobs = 0;
                            }
                        }
                        if ($state != $revenueReportValue['movingfrom_state']) {
                            $IsNEW = true;
                            if ($total_cost > 0) {
                                $final_margin += $total_margin;
                                $final_revenue += $total_revenue;
                                $final_cost += $total_cost;

                                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Sub-Total');
                                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "$" . number_format($total_cost, 2));
                                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "$" . number_format($total_revenue, 2));
                                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "$" . number_format($total_margin, 2));

                                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $rowCount++;

                                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Total jobs');
                                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $total_state_jobs);
                                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
                                $rowCount++;

                                $IsNEW = false;
                                $total_cost = 0;
                                $total_revenue = 0;
                                $total_margin = 0;
                                $total_state_jobs = 0;
                            }
                        }
                        if ($services != $serviceType) {
                            $IsNEW = true;
                            if ($total_cost > 0) {
                                $final_margin += $total_margin;
                                $final_revenue += $total_revenue;
                                $final_cost += $total_cost;

                                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Sub-Total');
                                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "$" . number_format($total_cost, 2));
                                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "$" . number_format($total_revenue, 2));
                                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "$" . number_format($total_margin, 2));

                                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                                $rowCount++;

                                $IsNEW = false;
                                $total_cost = 0;
                                $total_revenue = 0;
                                $total_margin = 0;
                            }
                        }

                        if ($state == "" || $state != $revenueReportValue['movingfrom_state']) {
                            $services = "";
                            $state = $revenueReportValue['movingfrom_state'];
                            $removal_id = "";
                            $client_id = "";
                            $total_cost = 0;
                            $total_revenue = 0;
                            $total_margin = 0;


                            $stateA = $revenueReportValue['movingfrom_state'];
                            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $revenueReportValue['movingfrom_state']);
                        } else {
                            $stateA = '';
                            // $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                        }


                        if ($services == "" || $services != $serviceType) {
                            $services = $serviceType;
                            $serviceB = $serviceType;
                            // $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $serviceType);
                        } else {
                            $serviceB = '';
                            // $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                        }

                        $total_cost += $revenueReportValue['en_total_costprice'];
                        $total_revenue += $revenueReportValue['en_total_sellprice'];
                        $total_margin += $revenueReportValue['margin'];
                        $total_state_jobs += count($revenueReportValue['movingfrom_state']);

                        if ($removal_id == "" || $removal_id != $revenueReportValue['removalist_id']) {
                            $removal_id = $revenueReportValue['removalist_id'];
                            $client_id = "";

                            $packerC = str_replace('<br/>', ', ', $revenueReportValue['rp']);
                            // $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, strip_tags($revenueReportValue['rp']));
                        } else {
                            $packerC = '';
                            // $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                        }

                        if ($client_id == "" || $client_id != $revenueReportValue['client_id']) {
                            $client_id = $revenueReportValue['client_id'];
                            $clientD = $revenueReportValue['client'];
                        } else {
                            
                        }
                        $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $stateA);
                        $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $serviceB);
                        $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $packerC);
                        $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $clientD);
                        $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $serdate);
                        $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "$" . $revenueReportValue['en_total_costprice']);
                        $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "$" . $revenueReportValue['en_total_sellprice']);
                        $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "$" . $revenueReportValue['margin']);

                        $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                        $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                        $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                        $rowCount++;
                        $total_cost_re += $revenueReportValue['en_total_costprice'];
                        $total_revenue_re += $revenueReportValue['en_total_sellprice'];
                        $total_margin_re += $revenueReportValue['margin'];
                        $total_jobs += count($revenueReportValue['client']);

                        if ($cntReventRecords == $incCNT) {

                            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
                            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Sub-Total');
                            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "$" . number_format($total_cost_re, 2));
                            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "$" . number_format($total_revenue_re, 2));
                            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "$" . number_format($total_margin_re, 2));

                            $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                            $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
                            $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getFont()->setBold(true);
                            $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getFont()->setBold(true);
                            $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                            $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


                            $rowCount++;
                            /* removal counts */
                            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
                            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Job count');
                            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $total_jobs);
                            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, '');
                            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, '');

                            $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                            $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
                            /* removal counts */


                            $rowCount++;

                            if ($total_cost > 0) {
                                $final_margin += $total_margin;
                                $final_revenue += $total_revenue;
                                $final_cost += $total_cost;

                                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Sub-Total');
                                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "$" . number_format($total_cost, 2));
                                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "$" . number_format($total_revenue, 2));
                                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "$" . number_format($total_margin, 2));

                                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                                $rowCount++;

                                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Total jobs');
                                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $total_state_jobs);
                                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, '');
                                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
                                $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
                                $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
                                $rowCount++;
                            }
                        }
                    }
                    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Grand-Total');
                    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, "$" . number_format($final_cost, 2));
                    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, "$" . number_format($final_revenue, 2));
                    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "$" . number_format($final_margin, 2));


                    $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getFont()->setBold(true);

                    $objPHPExcel->getActiveSheet()->getStyle('A1:ZZ1')->getFont()->setBold(true);
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f2f2f2');
                    $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                    $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                    $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                    $rowCount++;

                    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, 'Total Bookings');
                    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $cntReventRecords);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, 'Average Profit');
                    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, "$" . number_format(($final_margin / $cntReventRecords), 2));

                    $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getFont()->setBold(true);
                    $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getFont()->setBold(true);

                    $objPHPExcel->getActiveSheet()->getStyle('A1:ZZ1')->getFont()->setBold(true);
                    // $objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f2f2f2');
                    $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                    $objPHPExcel->getActiveSheet()->getStyle('G' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                    $objPHPExcel->getActiveSheet()->getStyle('H' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                    $rowCount++;

                    $nCols = 6; //set the number of columns
                    foreach (range(0, $nCols) as $col) {
                        $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
                    }


                    $sheetname = $titleEnq . rand() . '.xlsx';
                    //                    echo $sheetname;
                    //                    die;
                    //                    header('Content-Type: text/html; charset=utf-8');
                    //                    header('Content-Type: application/vnd.ms-excel');
                    //                    header('Content-Disposition: attachment;filename="' . $sheetname . '"');
                    $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
                    ?>
                    <script type="text/javascript">window.location.assign('<?php echo base_url() . '/' . $sheetname; ?>');</script>
                    <?php
                    $object_writer->save($sheetname);
//                    echo $sheetname;
//                    exit;
//                    $filename = rand() . ".xls";
//                    $fp = fopen('xls/' . $filename, 'a+');
//                    $fwrite = fwrite($fp, "," . $xlspdfData);
                    ?>

                    <?php
                } else {
                    // ob_start();

                    $filename = rand() . ".pdf";


                    //load mPDF library
                    $this->load->library('m_pdf');

                    //actually, you can pass mPDF parameter on this load() function
                    $pdf = $this->m_pdf->load();

                    $pdf->SetHTMLHeader('<h2>Revenue Report</h2>From ' . date('d-m-Y', strtotime($data['servicedatefrom'])) . ' to ' . date('d-m-Y', strtotime($data['servicedateto'])));

                    $pdf->SetHTMLFooter('<hr/>{PAGENO}/{nbpg} Report Generated:' . date('d-m-Y H:i:s'));

                    $pdf->AddPage('', // L - landscape, P - portrait 
                            '', '', '', '', 5, // margin_left
                            5, // margin right
                            25, // margin top
                            30, // margin bottom
                            0, // margin header
                            0); // margin footer
                    //generate the PDF!

                    $pdf->WriteHTML($xlspdfData);

                    //offer it to user via browser download! (The PDF won't be saved on your server HDD)
                    // ob_end_flush();
                    $pdf->Output('./pdf/' . $filename, "F");
//                    echo base_url() . 'pdf/' . $filename;
//                    echo rand();die;
                    ?><script>window.location.assign('<?php echo base_url() . 'pdf/' . $filename; ?>');</script><?php
                }
            }
        } else {
            echo "0";
        }
    }

}
