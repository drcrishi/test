<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

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
        if (!isLogin()) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(array("expired" => "1"));
                exit;
            }
            redirect(base_url());
        }
        $this->data = array();
        $this->data['title'] = "";
        $this->data['description'] = "";
        $this->data['notification'] = webNotification();
        // $this->data['user'] = $this->session->userdata('userData');
    }

    public function index() {
        $this->data['title'] = "CRM Contacts";
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
            'custom/js/form-contact.js'
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
        $this->load->model("contact_model");
        $data['statedata'] = $this->contact_model->getSuburb();

        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('contact_view.php', $data);
        $this->load->view("template/footer", $this->data);
    }

    public function add_contact() {

        if (!$this->input->is_ajax_request()) {
            show_404();
        } else {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class=""><ul><li>', '</li></ul></div>');

            $this->form_validation->set_rules('contact_reltype', 'Relationship type', 'trim|required');
            $this->form_validation->set_rules('contact_fname', 'First name', 'trim|required|max_length[30]');
            $this->form_validation->set_rules('contact_middlename', 'First name', 'trim|max_length[30]');
            $this->form_validation->set_rules('contact_lname', 'Last name', 'trim|required|max_length[30]');
            $this->form_validation->set_rules('contact_email', 'Email', 'trim|required|callback_contactemail_check');
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim');
            $this->form_validation->set_rules('contact_phno', 'Phone', 'trim');

            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array("error" => validation_errors()));
            } else {
                $this->load->model("Contact_model");
                $this->input->method();
                $data = array(
                    'contact_reltype' => $this->input->post("contact_reltype", true),
                    'contact_fname' => ucwords($this->input->post("contact_fname", true)),
                    'contact_middlename' => ucwords($this->input->post("contact_middlename", true)),
                    'contact_lname' => ucwords($this->input->post("contact_lname", true)),
                    'contact_email' => $this->input->post("contact_email", true),
                    'contact_email_2' => $this->input->post("contact_email2", true),
                    'company_name' => $this->input->post("company_name", true),
                    'contact_phno' => $this->input->post("contact_phno", true),
                    'contact_state' => $this->input->post("contact_state", true)
                );

                $adminrpdata = array(
                    'contact_email' => $this->input->post("contact_email", true),
                    'contact_password' => md5($this->input->post("contact_password", true)),
                );
                
               if ($this->Contact_model->getAdminEmail($adminrpdata['contact_email']) !== FALSE) {
                    if ($this->Contact_model->addContactdata($data) !== FALSE) {
                        $this->Contact_model->addAdminRPdata($adminrpdata);
                        //  echo "Insert data successfully";
                        echo json_encode(array("success" => 1));
                    } else {
                        echo json_encode(array("error" => "<p>Data are not inserted.</p>"));
                    }
                }else {
                    echo json_encode(array("error" => "<p>Data are not inserted.</p>"));
                }
            }
        }
    }

    public function contactemail_check($contact_email) {
        if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
            $this->form_validation->set_message('contactemail_check', 'Email address is not valid.');
            return false;
        }
//        else if($contact_email == "") {
//            $this->form_validation->set_message('required', 'Email is required.');
//            return false;
//        }
        else {
            return true;
        }
    }

    public function ajaxData() {
        $this->load->model('Contact_model');
        if (isset($_POST)) {
            $this->Contact_model->getAjaxData();
        }
    }

    /**
     * Multiple delete contacts............
     */
    public function deleteContactList() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        if (isset($_POST)) {
            $this->load->model('contact_model');
            $contact_unique_ids = $this->input->post('ids');
            if (isset($contact_unique_ids)) {
                if ($this->contact_model->getAjaxDeleteFromContactList($contact_unique_ids)) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
            }
        }
    }

    public function editContact($editCid) {
        $this->load->model("contact_model");
        $contactdata = $this->contact_model->getContactData($editCid);
        $statedata = $this->contact_model->getSuburb();
        //echo json_encode($contactdata);
        ?>

        <div class="form-body">
            <input type="hidden" name="contact_id" class="form-control" value="<?php echo $contactdata[0]['contact_id']; ?>" />
             <input type="hidden" name="contact_email" class="form-control" value="<?php echo $contactdata[0]['contact_email']; ?>" />
            <div class="form-group form-md-line-input">
                <select class="form-control contact-rel" name="contact_reltype">

                    <option value="">Select</option>

                    <option value="1"<?php
                    if ($contactdata[0]['contact_reltype'] == 1) {
                        echo "selected";
                    }
                    ?>>Removalist</option>
                    <option value="2"<?php
                    if ($contactdata[0]['contact_reltype'] == 2) {
                        echo "selected";
                    }
                    ?>>Packer</option>
                    <option value="3" <?php
                    if ($contactdata[0]['contact_reltype'] == 3) {
                        echo "selected";
                    }
                    ?>>Client</option>
                </select>
                <label for="form_control_1">Relationship type<span class="required">*</span></label>
            </div>
            <div class="form-group form-md-line-input">
                <input type="text" class="form-control fname" name="contact_fname"  placeholder="Enter your first name" value="<?php echo $contactdata[0]['contact_fname'] ?>">
                <label for="form_control_1">First Name
                    <span class="required">*</span>
                </label>
                <span class="error"></span>
            </div>
            <div class="form-group form-md-line-input hide">
                <input type="text" class="form-control fname" name="contact_middlename"  placeholder="Enter your middle name" value="<?php echo $contactdata[0]['contact_middlename'] ?>">
                <label for="form_control_1">Middle Name
                </label>
                <span class="error"></span>
            </div>
            <div class="form-group form-md-line-input">
                <input type="text" class="form-control lname" name="contact_lname"  placeholder="Enter your last name" value="<?php echo $contactdata[0]['contact_lname'] ?>">
                <label for="form_control_1">Last Name
                    <span class="required">*</span>
                </label>
                <span class="error"></span>
            </div>
            <div class="form-group form-md-line-input">
                <input type="text" class="form-control txtemail email"  name="contact_email" placeholder="Enter your email" value="<?php echo $contactdata[0]['contact_email'] ?>">
                <label class="formLbl" for="form_control_1">Email
                    <span class="required">*</span>
                </label>
            </div>
            <div class="form-group form-md-line-input">
                <input type="text" class="form-control txtemail email" autocomplete="cc-blank" autocorrect="false" autofill="false" name="contact_email2" placeholder="Enter your second email" value="<?php echo $contactdata[0]['contact_email_2'] ?>">
                <label class="formLbl" for="form_control_1">Email 2</label>
            </div>
              <div class="form-group form-md-line-input" id="contactt-password">
                <label class="formLbl" for="form_control_1">Change Password?
                </label>
                <label class="mt-checkbox deposit-checkbox mt-checkbox-outline">
                    <input id="chkpassword" type="checkbox" name="changepassword" value="1">
                    <span></span>
                </label>
                <input type="password" class="form-control password"  name="contact_password" placeholder="Enter your password" value="<?php echo $contactEmaildata[0]['contact_password'] ?>">

            </div>
            <div class="form-group form-md-line-input">
                <input type="text" class="form-control"  name="company_name" placeholder="Enter company name" value="<?php echo $contactdata[0]['company_name'] ?>">
                <label class="formLbl" for="form_control_1">Company Name
                </label>
            </div>
            <div class="form-group form-md-line-input">
                <input type="text" class="form-control txtnumber phno"  name="contact_phno" placeholder="Enter phone number" value="<?php echo $contactdata[0]['contact_phno']; ?>">
                <label class="formLbl" for="form_control_1">Phone</label>
            </div>

            <div class="form-group form-md-line-input">
                <select class="form-control" name="contact_state">
                    <option value=""></option>
                    <?php
                    foreach ($statedata as $st) {
                        ?> <option value="<?php echo $st['State']; ?>"<?php
                        if ($st['State'] == $contactdata[0]['contact_state']) {
                            echo "selected";
                        }
                        ?>><?php echo $st['State']; ?></option>
                            <?php } ?>
                </select>
                <label class="formLbl" for="form_control_1">State
                    <span class="required">*</span>
                </label>
            </div>
        </div>
        <?php
    }

    public function updateContactData($editCid=0) {

        $this->load->model("contact_model");
        $contactId = $this->input->post("contact_id");
         $contactEmail = $this->input->post("contact_email");

        if ($this->input->post("changepassword") == "" && $this->input->post("contact_password") != "") {
            $pass = $this->input->post("contact_password", true);
        } else {
            $pass = md5($this->input->post("contact_password", true));
        }

        $data = array(
            'contact_reltype' => $this->input->post("contact_reltype", true),
            'contact_fname' => ucwords($this->input->post("contact_fname", true)),
            'contact_middlename' => ucwords($this->input->post("contact_middlename", true)),
            'contact_lname' => ucwords($this->input->post("contact_lname", true)),
            'contact_email' => $this->input->post("contact_email", true),
            'contact_email_2' => $this->input->post("contact_email2", true),
            'company_name' => $this->input->post("company_name", true),
            'contact_phno' => $this->input->post("contact_phno", true),
            'contact_state' => $this->input->post("contact_state", true)
        );
        
        $adminrpdata = array(
            'contact_email' => $this->input->post("contact_email", true),
            'contact_password' => $pass,
        );
        
        if ($this->contact_model->updateContactById($contactId, $data)) {
             $this->contact_model->updateAdminRPByEmail($contactEmail, $adminrpdata);
            echo json_encode(array("success" => 1));
        } else {
            echo json_encode(array("error" => "<p>Data are not updated.</p>"));
        }
    }

//     public function getsuburbdata() {
//        $this->load->model('contact_model');
//        if (isset($_GET['term'])) {
//            $q = strtolower($_GET['term']);
//            echo $this->contact_model->getSuburb($q);
//        }
//    }

    public function deleteContact($id) {
//        echo $id;
//        die;
//        if (!$this->input->is_ajax_request()) {
//            show_404();
//        }
        $this->load->model("contact_model");
        $this->contact_model->disableContact($id);
        echo json_encode(array("success" => 1));
    }

    public function contactExport() {

        $this->load->model("contact_model");
        $data["contact_data"] = $this->contact_model->export_contactdata();
//        echo "<pre>";
//        print_r($data);
//        die;
        $titleEnq = 'MyActiveContacts';
        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle($titleEnq);
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Contact Unique Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Full Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Middle Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Company Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Phone');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Move Type');

//        echo "<pre>";
//        print_r($data["contact_data"]);
//        die;

        $rowCount = 2;
        foreach ($data["contact_data"] as $key => $value) {

            $fullname = $value->contact_fname . " " . $value->contact_lname;
            $movetype = $value->contact_reltype;
            if ($movetype == 1) {
                $moveType = "Removalist";
            } else if ($movetype == 2) {
                $moveType = "Packer";
            } else if ($movetype == 3) {
                $moveType = "Client";
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->contact_unique_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $fullname);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->contact_fname);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->contact_middlename);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->contact_lname);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->contact_email);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->company_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $value->contact_phno);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $moveType);
            $rowCount++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:ZZ1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f2f2f2');
        $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->freezePane('A1');
        $nCols = 6; //set the number of columns
        foreach (range(0, $nCols) as $col) {
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
        }
//         echo "<pre>";
//            print_r($sheetname);
//            die;

        $sheetname = $titleEnq. '.xlsx';
       
      
       header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$sheetname.'"');
        header('Cache-Control: max-age=0');
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename="' . $sheetname . '"');
        // header('Cache-Control: max-age=0');
         $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $object_writer->save('php://output');
       
        exit;
    }

    function import_contacts() {

        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $fileName = $_FILES['contactfile']['name'];                     // Sesuai dengan nama Tag Input/Upload
        //$this->upload->do_upload('contactfile');	

        $config = array(
            'upload_path' => "./assets/uploads/contactImport/",
            'allowed_types' => "xls|xlsx",
            'overwrite' => false,
                // 'max_size' => "2048000"
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('contactfile')) {
            $this->load->model("contact_model");


            $filedata = array('upload_data' => $this->upload->data());

            $media = $this->upload->data('file_name');
            $inputFileName = 'assets/uploads/contactImport/' . $media;
//echo $inputFileName;
//die;
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($inputFileName);

            $totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 

            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            //loop from first data untill last data
//            echo $objWorksheet->getCellByColumnAndRow(0, 1)->getValue();
//            die;
            $sheet = $objPHPExcel->getSheet(0);
            $highestColumn = $sheet->getHighestColumn();
            $headings = $sheet->rangeToArray('A1:' . $highestColumn . 1, NULL, TRUE, FALSE);


            if (in_array('Contact Unique Id', $headings[0]) && in_array('Full Name', $headings[0]) && in_array('First Name', $headings[0]) && in_array('Middle Name', $headings[0]) && in_array('Last Name', $headings[0]) && in_array('Email', $headings[0]) && in_array('Company Name', $headings[0]) && in_array('Phone', $headings[0]) && in_array('Move Type', $headings[0]) && in_array('State', $headings[0]) && in_array('Status', $headings[0])) {

                $ContactIdIndex = array_search('Contact Unique Id', $headings[0]);
                $ContactfullNameIndex = array_search('Full Name', $headings[0]);
                $ContactFnameIndex = array_search('First Name', $headings[0]);
                $ContactMnameIndex = array_search('Middle Name', $headings[0]);
                $ContactLnameIndex = array_search('Last Name', $headings[0]);
                $EmailIndex = array_search('Email', $headings[0]);
                $CompanyNameIndex = array_search('Company Name', $headings[0]);
                $PhoneIndex = array_search('Phone', $headings[0]);
                $MoveTypeIndex = array_search('Move Type', $headings[0]);
                $StateIndex = array_search('State', $headings[0]);
                $StatusIndex = array_search('Status', $headings[0]);

                for ($i = 2; $i <= $totalrows; $i++) {

                    $ContactId = $objWorksheet->getCellByColumnAndRow($ContactIdIndex, $i)->getValue();
                    $ContactfullName = $objWorksheet->getCellByColumnAndRow($ContactfullNameIndex, $i)->getValue();
                    $ContactFname = $objWorksheet->getCellByColumnAndRow($ContactFnameIndex, $i)->getValue();
                    $ContactMname = $objWorksheet->getCellByColumnAndRow($ContactMnameIndex, $i)->getValue(); //Excel Column 1
                    $ContactLname = $objWorksheet->getCellByColumnAndRow($ContactLnameIndex, $i)->getValue(); //Excel Column 2
                    $Email = $objWorksheet->getCellByColumnAndRow($EmailIndex, $i)->getValue(); //Excel Column 3
                    $CompanyName = $objWorksheet->getCellByColumnAndRow($CompanyNameIndex, $i)->getValue(); //Excel Column 4
                    $Phone = $objWorksheet->getCellByColumnAndRow($PhoneIndex, $i)->getValue(); //Excel Column 5
                    $MoveType = $objWorksheet->getCellByColumnAndRow($MoveTypeIndex, $i)->getValue(); //Excel Column 6
                    $StateType = $objWorksheet->getCellByColumnAndRow($StateIndex, $i)->getValue(); //Excel Column 7
                    $StatusType = $objWorksheet->getCellByColumnAndRow($StatusIndex, $i)->getValue(); //Excel Column 8

                    if ($MoveType == "Removalist") {
                        $move = 1;
                    } else if ($MoveType == "Packer") {
                        $move = 2;
                    } else if ($MoveType == "Client") {
                        $move = 3;
                    }

                    if ($StatusType == "Active") {
                        $status = 0;
                    } else if ($StatusType == "Inactive") {
                        $status = 1;
                    }

                    if ($ContactId == "") {
                        $data_contact = array('contact_fname' => $ContactFname, 'contact_middlename' => $ContactMname, 'contact_lname' => $ContactLname, 'contact_email' => $Email, 'company_name' => $CompanyName, 'contact_phno' => $Phone, 'contact_reltype' => $move, 'contact_state' => $StateType, 'is_deleted' => $status);

                        $this->contact_model->addContactdata($data_contact);
                    } elseif ($ContactId != "" && $ContactFname != "" && $ContactLname != "" && $Email != "" && $MoveType != "" && $StateType != "" && $StatusType != "") {
                        $data_contact = array('contact_unique_id' => $ContactId, 'contact_fullname' => $ContactfullName, 'contact_fname' => $ContactFname, 'contact_middlename' => $ContactMname, 'contact_lname' => $ContactLname, 'contact_email' => $Email, 'company_name' => $CompanyName, 'contact_phno' => $Phone, 'contact_reltype' => $MoveType, 'contact_state' => $StateType, 'is_deleted' => $status);
                        $this->contact_model->Add_ImportedContactData($data_contact);
                    }

                    /* if ($ContactId == "" || $ContactFname == "" || $ContactLname == "" || $Email == "") {
                      continue;
                      } else {

                      $this->contact_model->Add_ImportedContactData($data_contact);
                      } */
                }

                //File Deleted After uploading in database .
                // print_r($_FILES);die;
                //cho $this->upload->file_type;
                $this->session->set_flashdata('flashSuccess', 'Contact Imported Successfully.');
                unlink('assets/uploads/contactImport/' . $media);
                redirect(base_url() . "contacts");
            } else {
                $this->session->set_flashdata('flashError', 'Fields are not matched in file please check it and reupload.');
                redirect(base_url() . "contacts");
            }
        } else {
            //echo $this->upload->file_type;
            //echo "<br>";
            //print_r($_FILES);die;
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('flashError', strip_tags($error));
            redirect(base_url() . "contacts");
        }

        /* echo "<pre>";
          print_r($data);
          print_r($error);
          die; */
    }

}
