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
        );
        $revenueReport = $this->booking_model->revenueReportData($data);
        $data['revenueReport'] = $revenueReport;

        if ($revenueReport) {

            $xlspdfData = $this->load->view('reports/reportviewer.php', $data, true);

            $xlspdfbutton = '<div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12"> 
                                        <input type="hidden" name="pdforxls" id="pdforxls">
                                        <input type="submit" class="btn red filter-submit" value="Export PDF" id="exportPDFviewer">                                        
                                        <input type="submit" class="btn green filter-submit" value="Export XLS" id="exportXLSviewer">                                        
                                </div>
                             </div>';
            echo $xlspdfData . $xlspdfbutton;

            if ($_POST['pdforxls'] != "") {
                if ($_POST['pdforxls'] == "xls") {
                    $filename = rand() . ".xls";
                    $fp = fopen('xls/' . $filename, 'a+');
                    $fwrite = fwrite($fp, "," . $xlspdfData);
                    ?>
                    <script>
                        window.open('<?php echo base_url() . 'xls/' . $filename; ?>', '_blank');
                    </script>
                    <?php
                } else {
                    $filename = rand() . ".pdf";

                    //load mPDF library
                    $this->load->library('m_pdf');
                    //actually, you can pass mPDF parameter on this load() function
                    $pdf = $this->m_pdf->load();
                    $pdf->SetHTMLHeader('<h2>Revenue Report</h2>From '.date('d-m-Y', strtotime($data['servicedatefrom'])).' to '.date('d-m-Y', strtotime($data['servicedateto'])));
                    $pdf->SetHTMLFooter('<hr/>{PAGENO}/{nbpg} Report Generated:'.date('d-m-Y H:i:s'));
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
                    $pdf->Output('./pdf/' . $filename, "F");
                    ?>
                    <script>
                        window.open('<?php echo base_url() . 'pdf/' . $filename; ?>', '_blank');
                    </script>
                    <?php
                }
            }
        } else {
            echo "0";
        }
    }

}
