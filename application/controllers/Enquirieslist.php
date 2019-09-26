<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Enquirieslist extends CI_Controller {

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
        $this->data['user'] = $this->session->userdata('userData');
        $this->data['notification'] = webNotification();
    }

    public function index() {
        $this->data['title'] = "Current Enquiries";
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
            'pages/scripts/enquirieslist.js',
            'custom/js/custom.js'
        );
        $data['jsTPFooter'] = array(
            'https://code.jquery.com/ui/1.12.1/jquery-ui.js'
        );
        $data['jsFooter'] = array(
            'pages/scripts/form-enquiries.js'
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
        $this->load->model("enquiry_model");
        $data['move_type'] = $this->enquiry_model->getMoveType();
        $this->load->model("contact_model");
        $data['statedata'] = $this->contact_model->getSuburb();
//        $data["enquiry_data"] = $this->enquiry_model->export_enquirydata();
        // $this->load->view("enquiries_list.php", $data);
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('enquiries_list.php', $this->data);
        $this->load->view("template/footer", $this->data);
//         echo "<pre>";
//        print_r($data);
//        die;
    }

    public function enquiryExport() {
        $this->load->model("enquiry_model");
        $data["enquiry_data"] = $this->enquiry_model->export_enquirydata();
//        echo "<pre>";
//        print_r($data);
//        die;
        $titleEnq = 'Current Enquiries';
        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle($titleEnq);
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Enquiry Unique Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Quote Received');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Service Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Phone');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'State');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Move Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Owner');
//        echo "<pre>";
//        print_r($data["enquiry_data"]);
//        die;
        $rowCount = 2;
        foreach ($data["enquiry_data"] as $key => $value) {


            $enq = date("m-d-Y H:i", strtotime($value->en_date));
            $serdate = date("m-d-Y", strtotime($value->en_servicedate));

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->en_unique_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $enq);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $serdate);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->en_fname);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->en_lname);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->en_phone);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->en_movingfrom_state);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $value->movetype_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $value->admin_firstname);
            $rowCount++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:ZZ1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f2f2f2');
        $objPHPExcel->getActiveSheet()->getStyle('F' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $nCols = 6; //set the number of columns
        foreach (range(0, $nCols) as $col) {
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
        }

        $sheetname = $titleEnq . '.xlsx';
        $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $sheetname . '"');
        $object_writer->save('php://output');

        exit;
    }

 function import_enquiry() {

        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $fileName = $_FILES['enquiryfile']['name'];                     // Sesuai dengan nama Tag Input/Upload
        //$this->upload->do_upload('contactfile');	
        $config = array(
            'upload_path' => "./assets/uploads/enquiryImport/",
            'allowed_types' => "xls|xlsx",
            'overwrite' => false,
            'max_size' => "2048000"
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('enquiryfile')) {
            $this->load->model("enquiry_model");


            $filedata = array('upload_data' => $this->upload->data());

            $media = $this->upload->data('file_name');
            $inputFileName = 'assets/uploads/enquiryImport/' . $media;
           
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            $objReader->setReadDataOnly(true);
            $objPHPExcel = $objReader->load($inputFileName);
          
            $totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            //loop from first data untill last data
            //echo $objWorksheet->getCellByColumnAndRow(0, 1)->getValue();
            $sheet = $objPHPExcel->getSheet(0);
            $highestColumn = $sheet->getHighestColumn();
            $headings = $sheet->rangeToArray('A1:' . $highestColumn . 1, NULL, TRUE, FALSE);


            if (in_array('Enquiry Unique Id', $headings[0]) &&
                    in_array('Phone', $headings[0]) &&
                    in_array('Service Time', $headings[0]) &&
                    in_array('Service Date', $headings[0]) &&
                    in_array('Removalist', $headings[0]) &&
                    in_array('Notes', $headings[0]) &&
                    in_array('No. of trucks', $headings[0]) &&
                    in_array('No. of movers', $headings[0]) &&
                    in_array('Move Type', $headings[0]) &&
                    in_array('First Name', $headings[0]) &&
                    in_array('Last Name', $headings[0]) &&
                    in_array('Home/Office', $headings[0]) &&
                    in_array('Email', $headings[0]) &&
                    in_array('Deposit Amount', $headings[0]) &&
                    in_array('Client Hourly Rate', $headings[0]) &&
                    in_array('From Suburb', $headings[0]) &&
                    in_array('From Street', $headings[0]) &&
                    in_array('From State', $headings[0]) &&
                    in_array('From Postcode', $headings[0]) &&
                    in_array('To Suburb', $headings[0]) &&
                    in_array('To Street', $headings[0]) &&
                    in_array('To State', $headings[0]) &&
                    in_array('To Postcode', $headings[0]) &&
                    in_array('D Suburb', $headings[0]) &&
                    in_array('D Street', $headings[0]) &&
                    in_array('D State', $headings[0]) &&
                    in_array('P Suburb', $headings[0]) &&
                    in_array('P Street', $headings[0]) &&
                    in_array('P State', $headings[0]) &&
                    in_array('Referral Source', $headings[0]) &&
                    in_array('Quote Received', $headings[0]) &&
                    in_array('Promotional Code', $headings[0]) &&
                    in_array('Packer Selections', $headings[0]) &&
                    in_array('Number of ladies booked', $headings[0]) &&
                    in_array('Initial Sell Price', $headings[0]) &&
                    in_array('Initial Hours Booked', $headings[0]) &&
                    in_array('EWAY TOKEN', $headings[0]) &&
                    in_array('eway reference no.', $headings[0]) &&
                    in_array('Deposit Received', $headings[0]) &&
                    in_array('Deposit Paid by', $headings[0])) {


                $EnquiryUniqueIdIndex = array_search('Enquiry Unique Id', $headings[0]);
                $PhoneIndex = array_search('Phone', $headings[0]);
                $ServiceTimeIndex = array_search('Service Time', $headings[0]);
                $ServiceDateIndex = array_search('Service Date', $headings[0]);
                $RemovalistIndex = array_search('Removalist', $headings[0]);
                $NotesIndex = array_search('Notes', $headings[0]);
                $NoofTrucksIndex = array_search('No. of trucks', $headings[0]);
                $NoofMoversIndex = array_search('No. of movers', $headings[0]);
                $MovetypeIndex = array_search('Move Type', $headings[0]);
                $FnameIndex = array_search('First Name', $headings[0]);
                $LastnameIndex = array_search('Last Name', $headings[0]);
                $HomeOfficeIndex = array_search('Home/Office', $headings[0]);
                $EmailIndex = array_search('Email', $headings[0]);
                $DepositeAmtIndex = array_search('Deposit Amount', $headings[0]);
                $CHRIndex = array_search('Client Hourly Rate', $headings[0]);
                $FromSuburbIndex = array_search('From Suburb', $headings[0]);
                $FromStreetIndex = array_search('From Street', $headings[0]);
                $FromStateIndex = array_search('From State', $headings[0]);
                $FromPostcodeIndex = array_search('From Postcode', $headings[0]);
                $ToSuburbIndex = array_search('To Suburb', $headings[0]);
                $ToStreetIndex = array_search('To Street', $headings[0]);
                $ToStateIndex = array_search('To State', $headings[0]);
                $ToPostcodeIndex = array_search('To Postcode', $headings[0]);
                $DSuburbIndex = array_search('D Suburb', $headings[0]);
                $DStreetIndex = array_search('D Street', $headings[0]);
                $DStateIndex = array_search('D State', $headings[0]);
                $PSuburbIndex = array_search('P Suburb', $headings[0]);
                $PStreetIndex = array_search('P Street', $headings[0]);
                $PStateIndex = array_search('P State', $headings[0]);
                $ReferralSourceIndex = array_search('Referral Source', $headings[0]);
                $QuoteReceivedIndex = array_search('Quote Received', $headings[0]);
                $PromotionalcodeIndex = array_search('Promotional Code', $headings[0]);
                $PackerSelectionIndex = array_search('Packer Selections', $headings[0]);
                $LadiesIndex = array_search('Number of ladies booked', $headings[0]);
                $SellPriceIndex = array_search('Initial Sell Price', $headings[0]);
                $HrBookedIndex = array_search('Initial Hours Booked', $headings[0]);
                $EwayTokenIndex = array_search('EWAY TOKEN', $headings[0]);
                $EwayrefnoIndex = array_search('eway reference no.', $headings[0]);
                $DepositeReceivedIndex = array_search('Deposit Received', $headings[0]);
                $DepositePaidByIndex = array_search('Deposit Paid by', $headings[0]);

                for ($i = 2; $i <= $totalrows; $i++) {
                    $EnquiryUniqueId = $objWorksheet->getCellByColumnAndRow($EnquiryUniqueIdIndex, $i)->getValue();
                    $Phone = $objWorksheet->getCellByColumnAndRow($PhoneIndex, $i)->getValue();
                    $ServiceTime = $objWorksheet->getCellByColumnAndRow($ServiceTimeIndex, $i)->getValue();
                    $ServiceDate = $objWorksheet->getCellByColumnAndRow($ServiceDateIndex, $i)->getValue();
                    $Removalist = $objWorksheet->getCellByColumnAndRow($RemovalistIndex, $i)->getValue(); //Excel Column 1
                    $Notes = $objWorksheet->getCellByColumnAndRow($NotesIndex, $i)->getValue(); //Excel Column 3
                    $Trucks = $objWorksheet->getCellByColumnAndRow($NoofTrucksIndex, $i)->getValue(); //Excel Column 4
                    $Movers = $objWorksheet->getCellByColumnAndRow($NoofMoversIndex, $i)->getValue(); //Excel Column 5
                    $Movetype = $objWorksheet->getCellByColumnAndRow($MovetypeIndex, $i)->getValue(); //Excel Column 6
                    $FName = $objWorksheet->getCellByColumnAndRow($FnameIndex, $i)->getValue(); //Excel Column 7
                    $LName = $objWorksheet->getCellByColumnAndRow($LastnameIndex, $i)->getValue(); //Excel Column 8
                    $HomeOffice = $objWorksheet->getCellByColumnAndRow($HomeOfficeIndex, $i)->getValue(); //Excel Column 8
                    $Email = $objWorksheet->getCellByColumnAndRow($EmailIndex, $i)->getValue(); //Excel Column 8
                    $DepositeAmt = $objWorksheet->getCellByColumnAndRow($DepositeAmtIndex, $i)->getValue(); //Excel Column 8
                    $CHR = $objWorksheet->getCellByColumnAndRow($CHRIndex, $i)->getValue(); //Excel Column 8
                    $FSuburb = $objWorksheet->getCellByColumnAndRow($FromSuburbIndex, $i)->getValue(); //Excel Column 8
                    $FStreet = $objWorksheet->getCellByColumnAndRow($FromStreetIndex, $i)->getValue(); //Excel Column 8
                    $Fstate = $objWorksheet->getCellByColumnAndRow($FromStateIndex, $i)->getValue(); //Excel Column 8
                    $FPostcode = $objWorksheet->getCellByColumnAndRow($FromPostcodeIndex, $i)->getValue(); //Excel Column 8
                    $TSuburb = $objWorksheet->getCellByColumnAndRow($ToSuburbIndex, $i)->getValue(); //Excel Column 8
                    $TStreet = $objWorksheet->getCellByColumnAndRow($ToStreetIndex, $i)->getValue(); //Excel Column 8
                    $TState = $objWorksheet->getCellByColumnAndRow($ToStateIndex, $i)->getValue(); //Excel Column 8
                    $TPostcode = $objWorksheet->getCellByColumnAndRow($ToPostcodeIndex, $i)->getValue(); //Excel Column 8
                    $DSuburb = $objWorksheet->getCellByColumnAndRow($DSuburbIndex, $i)->getValue(); //Excel Column 8
                    $DStreet = $objWorksheet->getCellByColumnAndRow($DStreetIndex, $i)->getValue(); //Excel Column 8
                    $DState = $objWorksheet->getCellByColumnAndRow($DStateIndex, $i)->getValue(); //Excel Column 8
                    $PSuburb = $objWorksheet->getCellByColumnAndRow($PSuburbIndex, $i)->getValue(); //Excel Column 8
                    $PStreet = $objWorksheet->getCellByColumnAndRow($PStreetIndex, $i)->getValue(); //Excel Column 8
                    $PState = $objWorksheet->getCellByColumnAndRow($PStateIndex, $i)->getValue(); //Excel Column 8
                    $ReferralSource = $objWorksheet->getCellByColumnAndRow($ReferralSourceIndex, $i)->getValue(); //Excel Column 8
                    $QuoteReceived = $objWorksheet->getCellByColumnAndRow($QuoteReceivedIndex, $i)->getValue(); //Excel Column 8
                    $PCode = $objWorksheet->getCellByColumnAndRow($PromotionalcodeIndex, $i)->getValue(); //Excel Column 8
                    $Packers = $objWorksheet->getCellByColumnAndRow($PackerSelectionIndex, $i)->getValue(); //Excel Column 8
                    $Ladies = $objWorksheet->getCellByColumnAndRow($LadiesIndex, $i)->getValue(); //Excel Column 8
                    $SellPrice = $objWorksheet->getCellByColumnAndRow($SellPriceIndex, $i)->getValue(); //Excel Column 8
                    $HrBooked = $objWorksheet->getCellByColumnAndRow($HrBookedIndex, $i)->getValue(); //Excel Column 8
                    $EwayToken = $objWorksheet->getCellByColumnAndRow($EwayTokenIndex, $i)->getValue(); //Excel Column 8
                    $EwayrefNo = $objWorksheet->getCellByColumnAndRow($EwayrefnoIndex, $i)->getValue(); //Excel Column 8
                    $DepositeReceive = $objWorksheet->getCellByColumnAndRow($DepositeReceivedIndex, $i)->getValue(); //Excel Column 8
                    $DepositePaid = $objWorksheet->getCellByColumnAndRow($DepositePaidByIndex, $i)->getValue(); //Excel Column 8


                    if ($DepositePaid == "Bank transfer") {
                        $depositepaidby = 1;
                    } else if ($DepositePaid == "Credit card") {
                        $depositepaidby = 2;
                    }
                    if ($DepositeReceive == "Yes") {
                        $depositereceive = 1;
                    } else if ($DepositeReceive == "No") {
                        $depositereceive = 0;
                    }

                    if ($Movetype == "Removal - Local") {
                        if ($HomeOffice == "Home") {
                            $move = 1;
                        } else if ($HomeOffice == "Office") {
                            $move = 2;
                        }
                    } else if ($Movetype == "Packing") {
                        $move = 4;
                    } else if ($Movetype == "Unpacking") {
                        $move = 5;
                       
                        //enter from entry into to entry.. 
                        $TSuburb = $FSuburb;
                        $TState = $Fstate;
                        $TStreet = $FStreet;
                        $TPostcode = $FPostcode;
                        
                        $FSuburb = "";
                        $Fstate = "";
                        $FStreet = "";
                        $FPostcode = "";
                    }

                    //Booking date format convert excel sheet date format (eg. 17-11-17 into 2017-11-17)
                    $serDate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($ServiceDate));
                    $quoterecDate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($QuoteReceived));
                    $enquiryId = substr($EnquiryUniqueId, 1, -1);
                  
                    if ($Movetype == "Packing" || $Movetype == "Unpacking") {
                        $packersdata = explode("\n", $Packers);
                        $packersIds = "";
                        foreach ($packersdata as $pker) {

                            $packername = explode("=", $pker);

                            if (!empty($packername[0])) {
                                $this->load->model("booking_model");
                                $packersNameData = $this->booking_model->getPackersForImportData(trim($packername[0]));
                                $packersIds .= $packersNameData[0]['contact_id'] . ",";
                                $contact_id = $packersIds;
                            }
                        }
                    }

                    if ($Movetype == "Removal - Local") {
                        $this->load->model("booking_model");
                        $removalistid = $this->booking_model->getRemovalistImportData($Removalist);
                        $contact_id = $removalistid[0]['contact_id'];
                    }
                   
                    if ($enquiryId != "") {
                        $delivery_array = array(
                            'en_adddelivery_street' => $DStreet,
                            'en_adddelivery_suburb' => $DSuburb,
                            'en_adddelivery_state' => $DState,
                        );
                       
                        $pickup_array = array(
                            'en_addpickup_street' => $PStreet,  
                            'en_addpickup_suburb' => $PStreet,  
                            'en_addpickup_state' => $PStreet,  
                        );
                       
                        
                        $data_enq = array(
                            'ms_uuid' => $enquiryId,
                            'en_phone' => $Phone,
                            'en_servicetime' => $ServiceTime,
                            'en_servicedate' => $serDate,
                            'contact_id' => $contact_id,
                            'en_note' => $Notes,
                            'en_no_of_trucks' => $Trucks,
                            'en_no_of_movers' => $Movers,
                            'en_movetype' => $move,
                            'en_fname' => $FName,
                            'en_lname' => $LName,
                            'en_email' => $Email,
                            'en_deposit_amt' => $DepositeAmt,
                            'en_client_hourly_rate' => $CHR,
                            'en_movingfrom_suburb' => $FSuburb,
                            'en_movingfrom_street' => $FStreet,
                            'en_movingfrom_state' => $Fstate,
                            'en_movingfrom_postcode' => $FPostcode,
                            'en_movingto_suburb' => $TSuburb,
                            'en_movingto_street' => $TStreet,
                            'en_movingto_state' => $TState,
                            'en_movingto_postcode' => $TPostcode,
                            'additional_pickup' => json_encode($pickup_array),
                            'additional_delivery' => json_encode($delivery_array),
                            'en_referral_source' => $ReferralSource,
                            'en_date' => $quoterecDate,
                            'en_promotional_code' => $PCode,
                            'en_ladies_booked' => $Ladies,
                            'en_initial_sellprice' => $SellPrice,
                            'en_initial_hours_booked' => $HrBooked,
                            'en_eway_token' => $EwayToken,
                            'en_eway_refno' => $EwayrefNo,
                            'en_deposit_received' => $depositereceive,
                            'en_deposit_paidby' => $depositepaidby,
                        );
                    //   echo "<pre>";
                   //    print_r($data_enq);
                    //    die;
                        $this->enquiry_model->Add_ImportedEnqData($data_enq);
                    }
                }

//                for ($i = 2; $i <= $totalrows; $i++) {
//
//                    $EnquiryId = $objWorksheet->getCellByColumnAndRow($EnquiryIdIndex, $i)->getValue();
//                    $QuoteReceived = $objWorksheet->getCellByColumnAndRow($QuoteReceivedIndex, $i)->getValue();
//                    $ServiceDate = $objWorksheet->getCellByColumnAndRow($ServiceDateIndex, $i)->getValue();
//                    $FName = $objWorksheet->getCellByColumnAndRow($FNameIndex, $i)->getValue(); //Excel Column 1
//                    $Lname = $objWorksheet->getCellByColumnAndRow($LnameIndex, $i)->getValue(); //Excel Column 2
//                    $Phone = $objWorksheet->getCellByColumnAndRow($PhoneIndex, $i)->getValue(); //Excel Column 3
//                    $State = $objWorksheet->getCellByColumnAndRow($StateIndex, $i)->getValue(); //Excel Column 4
//                    $MoveType = $objWorksheet->getCellByColumnAndRow($MoveTypeIndex, $i)->getValue(); //Excel Column 4
//                    $Owner = $objWorksheet->getCellByColumnAndRow($OwnerIndex, $i)->getValue(); //Excel Column 4
//
//                    if($MoveType == "Removalist") {
//                        $move = 1;
//                    } else if($MoveType == "Packer") {
//                        $move = 2;
//                    } else if($MoveType == "Client") {
//                        $move = 3;
//                    }
//                    //            $data_enq = array('en_unique_id' => $EnquniqueId,'en_date' => $Quotereceived, 'en_servicedate' => $Servicedate, 'en_fname' => $Fname, 'en_lname' => $Lname, 'en_phone' => $Phone, 'en_movingfrom_state' => $State, 'movetype_name' => $Movetype, 'admin_firstname' => $Admin);
//
//                    if ($EnquiryId == "" && $FName != "" && $Lname != "" && $State != "" && $MoveType != "") {
//                        $data_enq = array('en_unique_id' => $EnquiryId, 'en_date' => $QuoteReceived, 'en_servicedate' => $ServiceDate, 'en_fname' => $FName, 'en_lname' => $Lname, 'en_phone' => $Phone, 'en_movingfrom_state' => $State, 'movetype_name' => $move, 'admin_firstname' => $Owner);
//                        $this->enquiry_model->addEnquirydata($data_enq);
//                    } elseif ($EnquiryId != "" && $FName != "" && $Lname != "" && $State != "" && $MoveType != "") {
//                        $data_enq = array('en_unique_id' => $EnquiryId, 'en_date' => $QuoteReceived, 'en_servicedate' => $ServiceDate, 'en_fname' => $FName, 'en_lname' => $Lname, 'en_phone' => $Phone, 'en_movingfrom_state' => $State, 'movetype_name' => $move, 'admin_firstname' => $Owner);
//                        $this->enquiry_model->Add_ImportedEnqData($data_enq);
//                    }
//
//                    
//                }
                //File Deleted After uploading in database .
                // print_r($_FILES);die;
                //cho $this->upload->file_type;
                $this->session->set_flashdata('flashSuccess', 'Enquiry Imported Successfully.');
                unlink('assets/uploads/enquiryImport/' . $media);
                redirect(base_url() . "enquirieslist");
            } else {
                $this->session->set_flashdata('flashError', 'Fields are not matched in file please check it and reupload.');
                redirect(base_url() . "enquirieslist");
            }
        } else {
            //echo $this->upload->file_type;
            //echo "<br>";
            //print_r($_FILES);die;
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('flashError', strip_tags($error));
            redirect(base_url() . "enquirieslist");
        }

        /* echo "<pre>";
          print_r($data);
          print_r($error);
          die; */
    }

   /* function import_enquiry() {

        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
        $fileName = $_FILES['enquiryfile']['name'];
        $config['upload_path'] = 'assets/uploads/enquiryImport/';
        $config['file_name'] = $fileName;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $this->load->library('upload', $config);
        $filedata = $this->upload->do_upload('enquiryfile');
//        echo "<pre>";
//        print_r($this->upload->data());
//        die;
        if (!$this->upload->do_upload('enquiryfile'))
            $this->upload->display_errors();
        $media = $this->upload->data('file_name');
        $inputFileName = 'assets/uploads/enquiryImport/' . $media;
//        echo $inputFileName;
//        die;
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($inputFileName);

        $totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        //loop from first data untill last data
        for ($i = 2; $i <= $totalrows; $i++) {
            $EnquniqueId = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
            $Quotereceived = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();

            $Servicedate = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue(); //Excel Column 1

            $Fname = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue(); //Excel Column 2
            $Lname = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue(); //Excel Column 3
            $Phone = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue(); //Excel Column 4
            $State = $objWorksheet->getCellByColumnAndRow(6, $i)->getValue(); //Excel Column 4
            $Movetype = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue(); //Excel Column 4
            $Admin = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue(); //Excel Column 4
            $data_enq = array('en_unique_id' => $EnquniqueId, 'en_date' => $Quotereceived, 'en_servicedate' => $Servicedate, 'en_fname' => $Fname, 'en_lname' => $Lname, 'en_phone' => $Phone, 'en_movingfrom_state' => $State, 'movetype_name' => $Movetype, 'admin_firstname' => $Admin);

//            print_r($data_enq);
//            die;
            $this->load->model("enquiry_model");
            $this->enquiry_model->Add_ImportedEnqData($data_enq);
        }

        //File Deleted After uploading in database .	
        $this->session->set_flashdata('flashSuccess', 'Enquiry Imported Successfully.');
        unlink('assets/uploads/enquiryImport/' . $media);
        redirect(base_url() . "enquirieslist");
    }*/

    public function ajaxData() {

        $this->load->model('enquiry_model');
        if (isset($_POST)) {
            $this->enquiry_model->getAjaxData();
        }
    }

    public function deleteEnquiryList() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        if (isset($_POST)) {
            $en_unique_ids = $this->input->post('ids');
            if (isset($en_unique_ids)) {
                if ($this->enquiry_model->getAjaxDeleteFromEnqueryList($en_unique_ids)) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
            }
        }
    }

    public function getEnquirydataforDuplicate() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        if (isset($_POST)) {
            $en_unique_ids = $this->input->post('ids');
//            print_r($en_unique_ids);
//            die;
            if (isset($en_unique_ids)) {
                $enunique = $this->enquiry_model->getDuplicateEnqueryListData($en_unique_ids);
                if ($enunique!== FALSE) {
                    echo json_encode(array("success" => 1,"id" => $enunique));
                } else {
                    echo json_encode(array("error" => 1));
                }
            }
        }
    }

    // Qualify multiple enquiries.........@DRCZ
    public function qualifyEnquiryList() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        if (isset($_POST)) {

            $en_unique_ids = $this->input->post('ids');
            if (isset($en_unique_ids)) {
                if ($this->enquiry_model->getAjaxQualifyFromEnqueryList($en_unique_ids)) {
                    $this->load->model("contact_model");
                    $data = $this->enquiry_model->getAjaxCustomerQualifedData($en_unique_ids);
                    $cont = array();
                    for ($i = 0; $i < count($en_unique_ids); $i++) {

                        $cont = array(
                            'contact_fname' => $data[$i]['en_fname'],
                            'contact_lname' => $data[$i]['en_lname'],
                            'contact_phno' => $data[$i]['en_phone'],
                            'contact_email' => $data[$i]['en_email'],
                            'contact_reltype' => 3,
                            'contact_state' => $data[$i]['en_movingfrom_state'],
                            //'contact_reltype' => $data[$i]['contact_reltype']
                        );
                        $contId = $this->contact_model->addContactdata($cont);
                        
                        $contactuuid = $this->contact_model->getContactIDFromUUID($contId);
                        $enqId = $this->enquiry_model->getEnquiryIDFromUUID($en_unique_ids[$i]);
                       
                        $this->enquiry_model->getCustomerId($contactuuid, $enqId);
                    }

                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => "<p> Not Quilified</p>"));
                }
            }
        }
    }

}
