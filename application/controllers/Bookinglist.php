<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bookinglist extends CI_Controller {

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
        $this->data['title'] = "Current Bookings";
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
            'custom/js/form-booking.js'
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
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('booking_list.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function ajaxData() {

        $this->load->model('booking_model');
        if (isset($_POST)) {
            $this->booking_model->getAjaxData();
        }
    }

    public function deleteBookingList() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        if (isset($_POST)) {
            $this->load->model('booking_model');
            $booking_unique_ids = $this->input->post('ids');
            if (isset($booking_unique_ids)) {
                if ($this->booking_model->getAjaxDeleteFromBookingList($booking_unique_ids)) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
            }
        }
    }

    public function getBookingdataforDuplicate() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        if (isset($_POST)) {
            $bk_unique_ids = $this->input->post('ids');
//            print_r($en_unique_ids);
//            die;
            $this->load->model('booking_model');
            if (isset($bk_unique_ids)) {
                $bookid = $this->booking_model->getDuplicateBookingListData($bk_unique_ids);
                if ($bookid !== FALSE) {
                    echo json_encode(array("success" => 1, "id" => $bookid));
                } else {
                    echo json_encode(array("error" => 1));
                }
            }
        }
    }

    public function bookingExport() {

        $this->load->model("booking_model");
        $data["booking_data"] = $this->booking_model->export_bookingdata();

        $titleBooking = 'Current Bookings';
        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getActiveSheet()->setTitle($titleBooking);
        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Enquiry Unique Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Booking Made');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Service Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Client');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Service Time');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'First Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Last Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Phone');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'State');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Move Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Is Deposited?');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Removalist/Packers');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Booking Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Owner');
//        echo "<pre>";
//        print_r($data["booking_data"]);
//        die;
        $rowCount = 2;

        foreach ($data["booking_data"] as $key => $value) {


            $booking = date("m-d-Y", strtotime($value->qualified_date));
            $serdate = date("m-d-Y", strtotime($value->en_servicedate));

            if ($value->en_deposit_received == 1) {
                $isDeposited = 'Yes';
            } else {
                $isDeposited = 'No';
            }
            if ($value->booking_status == 1) {
                $bookingstatus = 'Current';
            } elseif ($value->booking_status == 2) {
                $bookingstatus = 'Other';
            } else {
                $bookingstatus = 'Completed';
            }
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $value->en_unique_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $booking);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $serdate);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->contact_fname);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->en_servicetime);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->en_fname);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->en_lname);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $value->en_phone);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $value->en_movingfrom_state);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $value->movetype_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $isDeposited);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $value->contact_fname);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $bookingstatus);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $value->admin_firstname);
            $rowCount++;
        }
        $objPHPExcel->getActiveSheet()->getStyle('A1:ZZ1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f2f2f2');
        $objPHPExcel->getActiveSheet()->getStyle('E' . $rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $nCols = 6; //set the number of columns
        foreach (range(0, $nCols) as $col) {
            $objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($col)->setAutoSize(true);
        }
//         echo "<pre>";
//            print_r($objPHPExcel);
//            die;

        $sheetname = $titleBooking . '.xlsx';
        $object_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $sheetname . '"');
        $object_writer->save('php://output');

        exit;
    }
    
 function import_booking() {


        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $fileName = $_FILES['bookingfile']['name'];                     // Sesuai dengan nama Tag Input/Upload
        //$this->upload->do_upload('contactfile');	

        $config = array(
            'upload_path' => "./assets/uploads/bookingImport/",
            'allowed_types' => "xls|xlsx",
            'overwrite' => false,
                // 'max_size' => "2048000"
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('bookingfile')) {
            $this->load->model("booking_model");


            $filedata = array('upload_data' => $this->upload->data());

            $media = $this->upload->data('file_name');
            $inputFileName = 'assets/uploads/bookingImport/' . $media;
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


            if (in_array('Enquiry Unique Id', $headings[0]) &&
                    in_array('Additional charge item', $headings[0]) &&
                    in_array('Booking Made', $headings[0]) &&
                    in_array('Booking Status', $headings[0]) &&
                    in_array('Client', $headings[0]) &&
                    in_array('Client Hourly Rate', $headings[0]) &&
                    in_array('Deposit Amount', $headings[0]) &&
                    in_array('Deposit Paid by', $headings[0]) &&
                    in_array('Deposit Received', $headings[0]) &&
                    in_array('EFT received', $headings[0]) &&
                    in_array('Email', $headings[0]) &&
                    in_array('eway reference no.', $headings[0]) &&
                    in_array('EWAY TOKEN', $headings[0]) &&
                    in_array('Final Payment eway reference no.', $headings[0]) &&
                    in_array('Final Payment Received by', $headings[0]) &&
                    in_array('General Notes', $headings[0]) &&
                    in_array('Head Office Paid', $headings[0]) &&
                    in_array('Hire a Mover Margin', $headings[0]) &&
                    in_array('Home/Office', $headings[0]) &&
                    in_array('Initial Hours Booked', $headings[0]) &&
                    in_array('Initial Sell Price', $headings[0]) &&
                    in_array('Move Type', $headings[0]) &&
                    in_array('Moving From Postcode', $headings[0]) &&
                    in_array('Moving From State', $headings[0]) &&
                    in_array('Moving From Street', $headings[0]) &&
                    in_array('Moving From Suburb', $headings[0]) &&
                    in_array('Moving To Postcode', $headings[0]) &&
                    in_array('Moving To State', $headings[0]) &&
                    in_array('Moving To Street', $headings[0]) &&
                    in_array('Moving To Suburb', $headings[0]) &&
                    in_array('No. of movers', $headings[0]) &&
                    in_array('No. of trucks', $headings[0]) &&
                    in_array('Number of ladies booked', $headings[0]) &&
                    in_array('Packer Selections', $headings[0]) &&
                    in_array('Phone', $headings[0]) &&
                    in_array('Promotional Code', $headings[0]) &&
                    in_array('Removalist', $headings[0]) &&
                    in_array('Removalist Paid', $headings[0]) &&
                    in_array('Service Date', $headings[0]) &&
                    in_array('Service Time', $headings[0]) &&
                    in_array('Total Sell Price', $headings[0]) &&
                    in_array('Travel Fee', $headings[0])) {


                $EnquiryUniqueIdIndex = array_search('Enquiry Unique Id', $headings[0]);
                $AdditionalChargeItemIndex = array_search('Additional charge item', $headings[0]);
                // $BookingConfirmIndex = array_search('Booking Confirmation Sent to Customer', $headings[0]);
                $BookingMadeIndex = array_search('Booking Made', $headings[0]);
                $BookingStatusIndex = array_search('Booking Status', $headings[0]);
                $ClientIndex = array_search('Client', $headings[0]);
                // $ClientFeedbackIndex = array_search('Client Feedback', $headings[0]);
                $CHRIndex = array_search('Client Hourly Rate', $headings[0]);
                $DepositeAmtIndex = array_search('Deposit Amount', $headings[0]);
                $DepositePaidIndex = array_search('Deposit Paid by', $headings[0]);
                $DepositeReceiveIndex = array_search('Deposit Received', $headings[0]);
                $EFTIndex = array_search('EFT received', $headings[0]);
                $EmailIndex = array_search('Email', $headings[0]);
                $EWAYRefIndex = array_search('eway reference no.', $headings[0]);
                $EwayTokenIndex = array_search('EWAY TOKEN', $headings[0]);
                $FinalpaymentEwayIndex = array_search('Final Payment eway reference no.', $headings[0]);
                $FinalPaymentReceiveIndex = array_search('Final Payment Received by', $headings[0]);
                $GeneralNotesIndex = array_search('General Notes', $headings[0]);
                $HeadOfficepaidIndex = array_search('Head Office Paid', $headings[0]);
                $HiremovermarginIndex = array_search('Hire a Mover Margin', $headings[0]);
                $HomeOfficeIndex = array_search('Home/Office', $headings[0]);
                $InitialHrBookedIndex = array_search('Initial Hours Booked', $headings[0]);
                $InitialSellPriceIndex = array_search('Initial Sell Price', $headings[0]);
                //  $JobsheetSentRemovalistIndex = array_search('Job Sheet Sent to Removalist?', $headings[0]);
                $MovetypeIndex = array_search('Move Type', $headings[0]);
                $MFPostcodeIndex = array_search('Moving From Postcode', $headings[0]);
                $MFStateIndex = array_search('Moving From State', $headings[0]);
                $MFStreetIndex = array_search('Moving From Street', $headings[0]);
                $MFSuburbIndex = array_search('Moving From Suburb', $headings[0]);
                $MTPostcodeIndex = array_search('Moving To Postcode', $headings[0]);
                $MTStateIndex = array_search('Moving To State', $headings[0]);
                $MTStreetIndex = array_search('Moving To Street', $headings[0]);
                $MTSuburbIndex = array_search('Moving To Suburb', $headings[0]);
                $MoversIndex = array_search('No. of movers', $headings[0]);
                $TrucksIndex = array_search('No. of trucks', $headings[0]);
                $LadiesIndex = array_search('Number of ladies booked', $headings[0]);
                $PackersIndex = array_search('Packer Selections', $headings[0]);

                // $PackingUnpackingServiceIndex = array_search('Packing/unpacking services', $headings[0]);
                //  $PaymentMethodIndex = array_search('Payment method', $headings[0]);
                $PhoneIndex = array_search('Phone', $headings[0]);
                $PromotionalCodeIndex = array_search('Promotional Code', $headings[0]);

                $RemovalistIndex = array_search('Removalist', $headings[0]);
                $RemovalistPaidIndex = array_search('Removalist Paid', $headings[0]);
                $ServicedateIndex = array_search('Service Date', $headings[0]);
                $ServicetimeIndex = array_search('Service Time', $headings[0]);
                $TotalSellPriceIndex = array_search('Total Sell Price', $headings[0]);
                $TravelFeesIndex = array_search('Travel Fee', $headings[0]);


                for ($i = 2; $i <= $totalrows; $i++) {


                    $EnquiryUniqueId = $objWorksheet->getCellByColumnAndRow($EnquiryUniqueIdIndex, $i)->getValue();
                    $AdditionalChargeItem = $objWorksheet->getCellByColumnAndRow($AdditionalChargeItemIndex, $i)->getValue();
                    // $BookingConfirm = $objWorksheet->getCellByColumnAndRow($BookingConfirmIndex, $i)->getValue();
                    
                    $BookingMade = $objWorksheet->getCellByColumnAndRow($BookingMadeIndex, $i)->getValue();
                    $BookingStatus = $objWorksheet->getCellByColumnAndRow($BookingStatusIndex, $i)->getValue();
                    $Client = $objWorksheet->getCellByColumnAndRow($ClientIndex, $i)->getValue(); //Excel Column 1
                    // $ClientFeedback = $objWorksheet->getCellByColumnAndRow($ClientFeedbackIndex, $i)->getValue(); //Excel Column 2
                    $CHR = $objWorksheet->getCellByColumnAndRow($CHRIndex, $i)->getValue(); //Excel Column 3
                    $DepositeAmt = $objWorksheet->getCellByColumnAndRow($DepositeAmtIndex, $i)->getValue(); //Excel Column 4
                    $DepositePaid = $objWorksheet->getCellByColumnAndRow($DepositePaidIndex, $i)->getValue(); //Excel Column 5
                    $DepositeReceive = $objWorksheet->getCellByColumnAndRow($DepositeReceiveIndex, $i)->getValue(); //Excel Column 6
                    $EFT = $objWorksheet->getCellByColumnAndRow($EFTIndex, $i)->getValue(); //Excel Column 7
                    $Email = $objWorksheet->getCellByColumnAndRow($EmailIndex, $i)->getValue(); //Excel Column 8
                    $EWAYRef = $objWorksheet->getCellByColumnAndRow($EWAYRefIndex, $i)->getValue(); //Excel Column 8
                    $EwayToken = $objWorksheet->getCellByColumnAndRow($EwayTokenIndex, $i)->getValue(); //Excel Column 8
                    $FinalpaymentEway = $objWorksheet->getCellByColumnAndRow($FinalpaymentEwayIndex, $i)->getValue(); //Excel Column 8
                    $FinalPaymentReceive = $objWorksheet->getCellByColumnAndRow($FinalPaymentReceiveIndex, $i)->getValue(); //Excel Column 8
                    $GeneralNotes = $objWorksheet->getCellByColumnAndRow($GeneralNotesIndex, $i)->getValue(); //Excel Column 8
                    $HeadOfficepaid = $objWorksheet->getCellByColumnAndRow($HeadOfficepaidIndex, $i)->getValue(); //Excel Column 8
                    $Hiremovermargin = $objWorksheet->getCellByColumnAndRow($HiremovermarginIndex, $i)->getValue(); //Excel Column 8
                    $HomeOffice = $objWorksheet->getCellByColumnAndRow($HomeOfficeIndex, $i)->getValue(); //Excel Column 8
                    $InitialHrBooked = $objWorksheet->getCellByColumnAndRow($InitialHrBookedIndex, $i)->getValue(); //Excel Column 8
                    $InitialSellPrice = $objWorksheet->getCellByColumnAndRow($InitialSellPriceIndex, $i)->getValue(); //Excel Column 8
                    //   $JobsheetSentRemovalist = $objWorksheet->getCellByColumnAndRow($JobsheetSentRemovalistIndex, $i)->getValue(); //Excel Column 8
                    $Movetype = $objWorksheet->getCellByColumnAndRow($MovetypeIndex, $i)->getValue(); //Excel Column 8
                    $MFPostcode = $objWorksheet->getCellByColumnAndRow($MFPostcodeIndex, $i)->getValue(); //Excel Column 8
                    $MFState = $objWorksheet->getCellByColumnAndRow($MFStateIndex, $i)->getValue(); //Excel Column 8
                    $MFStreet = $objWorksheet->getCellByColumnAndRow($MFStreetIndex, $i)->getValue(); //Excel Column 8
                    $MFSuburb = $objWorksheet->getCellByColumnAndRow($MFSuburbIndex, $i)->getValue(); //Excel Column 8
                    $MTPostcode = $objWorksheet->getCellByColumnAndRow($MTPostcodeIndex, $i)->getValue(); //Excel Column 8
                    $MTState = $objWorksheet->getCellByColumnAndRow($MTStateIndex, $i)->getValue(); //Excel Column 8
                    $MTStreet = $objWorksheet->getCellByColumnAndRow($MTStreetIndex, $i)->getValue(); //Excel Column 8
                    $MTSuburb = $objWorksheet->getCellByColumnAndRow($MTSuburbIndex, $i)->getValue(); //Excel Column 8
                    $Movers = $objWorksheet->getCellByColumnAndRow($MoversIndex, $i)->getValue(); //Excel Column 8
                    $Trucks = $objWorksheet->getCellByColumnAndRow($TrucksIndex, $i)->getValue(); //Excel Column 8
                    $Ladies = $objWorksheet->getCellByColumnAndRow($LadiesIndex, $i)->getValue(); //Excel Column 8
                    $Packers = $objWorksheet->getCellByColumnAndRow($PackersIndex, $i)->getValue(); //Excel Column 8
                    //  $PackingUnpackingService = $objWorksheet->getCellByColumnAndRow($PackingUnpackingServiceIndex, $i)->getValue(); //Excel Column 8
                    $Phone = $objWorksheet->getCellByColumnAndRow($PhoneIndex, $i)->getValue(); //Excel Column 8
                    $PromotionalCode = $objWorksheet->getCellByColumnAndRow($PromotionalCodeIndex, $i)->getValue(); //Excel Column 8
                    $Removalist = $objWorksheet->getCellByColumnAndRow($RemovalistIndex, $i)->getValue(); //Excel Column 8
                    $RemovalistPaid = $objWorksheet->getCellByColumnAndRow($RemovalistPaidIndex, $i)->getValue(); //Excel Column 8
                    $Servicedate = $objWorksheet->getCellByColumnAndRow($ServicedateIndex, $i)->getValue(); //Excel Column 8
                    $Servicetime = $objWorksheet->getCellByColumnAndRow($ServicetimeIndex, $i)->getValue(); //Excel Column 8
                    $TotalSellPrice = $objWorksheet->getCellByColumnAndRow($TotalSellPriceIndex, $i)->getValue(); //Excel Column 8
                    $TravelFees = $objWorksheet->getCellByColumnAndRow($TravelFeesIndex, $i)->getValue(); //Excel Column 8

                    if ($BookingStatus == "Current") {
                        $Bstatus = 1;
                    } else if ($BookingStatus == "Other(refer notes)") {
                        $Bstatus = 2;
                    } else if ($BookingStatus == "Client") {
                        $Bstatus = 3;
                    }
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
                    if ($FinalPaymentReceive == "EFT") {
                        $finalpaymentreceive = 1;
                    } else if ($FinalPaymentReceive == "Credit card") {
                        $finalpaymentreceive = 2;
                    } else if ($FinalPaymentReceive == "Cash") {
                        $finalpaymentreceive = 3;
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
                        $MTSuburb = $MFSuburb;
                        $MTState = $MFState;
                        $MTStreet = $MFStreet;
                        $MTPostcode = $MFPostcode;
                        
                        $MFSuburb = "";
                        $MFState = "";
                        $MFStreet = "";
                        $MFPostcode = "";
                    }
                    if ($HeadOfficepaid == "Yes") {
                        $headofficepaid = 1;
                    } else if ($HeadOfficepaid == "No") {
                        $headofficepaid = 0;
                    }
                    if ($RemovalistPaid == "Yes") {
                        $removalistpaid = 1;
                    } else if ($RemovalistPaid == "No") {
                        $removalistpaid = 0;
                    }
                    //Booking date format convert excel sheet date format (eg. 17-11-17 into 2017-11-17)
                    $BookingmadeDate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($BookingMade));
                    $serDate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($Servicedate));
                    
                    $clientID = $this->booking_model->getClientForImportData($Client);
                    $customer = $clientID[0]['contact_id'];
                    
                    if($Movetype == "Packing" || $Movetype == "Unpacking"){
                    $packersdata = explode("\n", $Packers);
                    $packersIds = "";
                    foreach ($packersdata as $pker) {
                        
                        $packername = explode("=", $pker);

                       if (!empty($packername[0])) {

                            $packersNameData = $this->booking_model->getPackersForImportData(trim($packername[0]));
                            $packersIds .= $packersNameData[0]['contact_id'] . ",";
                            $contact_id = $packersIds;
                        }
                        }
                    }
                    
                  if($Movetype == "Removal - Local"){
                    $removalistid = $this->booking_model->getRemovalistImportData($Removalist);
                   $contact_id = $removalistid[0]['contact_id'];
                  }
//
//print_r($removalistid);
//die;
                    
                    if ($EnquiryUniqueId != "") {
                        
                        $data_booking = array(
                            'en_unique_id'=>$EnquiryUniqueId,
                            'en_additional_item' => $AdditionalChargeItem,
                            'qualified_date' => $BookingmadeDate,
                            'booking_status' => $Bstatus,
                            'customer_id' => $customer,
                            'en_client_hourly_rate' => $CHR,
                            'en_deposit_amt' => $DepositeAmt,
                            'en_deposit_paidby' => $depositepaidby,
                            'en_deposit_received' => $depositereceive,
                            'en_eft_receivedon' => $EFT,
                            'en_email' => $Email,
                            'en_eway_refno' => $EWAYRef,
                            'en_eway_token' => $EwayToken,
                            'final_payment_eway_refno' => $FinalpaymentEway,
                            'final_payment_receivedby' => $finalpaymentreceive,
                            'en_note' => $GeneralNotes,
                            'head_office_paid' => $headofficepaid,
                            'en_hireamover_margin' => $Hiremovermargin,
                            'en_initial_hours_booked' => $InitialHrBooked,
                            'en_initial_sellprice' => $InitialSellPrice,
                            'en_movetype' => $move,
                            'en_movingfrom_postcode' => $MFPostcode,
                            'en_movingfrom_state' => $MFState,
                            'en_movingfrom_street' => $MFStreet,
                            'en_movingfrom_suburb' => $MFSuburb,
                            'en_movingto_postcode' => $MTPostcode,
                            'en_movingto_state' => $MTState,
                            'en_movingto_street' => $MTStreet,
                            'en_movingto_suburb' => $MTSuburb,
                            'en_no_of_movers' => $Movers,
                            'en_no_of_trucks' => $Trucks,
                            'en_ladies_booked' => $Ladies,
                            'contact_id' => $contact_id,
                            'en_phone' => $Phone,
                            'en_promotional_code' => $PromotionalCode,
                            'removalist_paid' => $removalistpaid,
                            'en_servicedate' => $serDate,
                            'en_servicetime' => $Servicetime,
                            'en_total_sellprice' => $TotalSellPrice,
                            'en_travelfee' => $TravelFees
                        );
//                       echo "<pre>";
//                       print_r($data_booking);
                        $this->booking_model->addBookingdata($data_booking);
                    }
//                    elseif ($ContactId != "" && $ContactFname != "" && $ContactLname != "" && $Email != "" && $MoveType != "" && $StateType != "" && $StatusType != "") {
//                        $data_booking = array('contact_unique_id' => $ContactId, 'contact_fullname' => $ContactfullName, 'contact_fname' => $ContactFname, 'contact_middlename' => $ContactMname, 'contact_lname' => $ContactLname, 'contact_email' => $Email, 'company_name' => $CompanyName, 'contact_phno' => $Phone, 'contact_reltype' => $MoveType, 'contact_state' => $StateType, 'is_deleted' => $status);
//                        $this->booking_model->Add_ImportedBookingData($data_booking);
//                    }

                    /* if ($ContactId == "" || $ContactFname == "" || $ContactLname == "" || $Email == "") {
                      continue;
                      } else {

                      $this->contact_model->Add_ImportedContactData($data_contact);
                      } */
                }

                //File Deleted After uploading in database .
                // print_r($_FILES);die;
                //cho $this->upload->file_type;
//                die;
                $this->session->set_flashdata('flashSuccess', 'Booking Imported Successfully.');
                unlink('assets/uploads/bookingImport/' . $media);
                redirect(base_url() . "bookinglist");
            } else {
                $this->session->set_flashdata('flashError', 'Fields are not matched in file please check it and reupload.');
                redirect(base_url() . "bookinglist");
            }
        } else {
            //echo $this->upload->file_type;
            //echo "<br>";
            //print_r($_FILES);die;
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('flashError', strip_tags($error));
            redirect(base_url() . "bookinglist");
        }

        /* echo "<pre>";
          print_r($data);
          print_r($error);
          die; */
    }

   /* function import_booking() {


        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $fileName = $_FILES['bookingfile']['name'];                     // Sesuai dengan nama Tag Input/Upload
        //$this->upload->do_upload('contactfile');	

        $config = array(
            'upload_path' => "./assets/uploads/bookingImport/",
            'allowed_types' => "xls|xlsx",
            'overwrite' => false,
                // 'max_size' => "2048000"
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('bookingfile')) {
            $this->load->model("booking_model");


            $filedata = array('upload_data' => $this->upload->data());

            $media = $this->upload->data('file_name');
            $inputFileName = 'assets/uploads/bookingImport/' . $media;
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


            if (in_array('Enquiry Unique Id', $headings[0]) &&
                    in_array('Additional charge item', $headings[0]) &&
                    in_array('Booking Made', $headings[0]) &&
                    in_array('Booking Status', $headings[0]) &&
                    in_array('Client', $headings[0]) &&
                    in_array('Client Hourly Rate', $headings[0]) &&
                    in_array('Deposit Amount', $headings[0]) &&
                    in_array('Deposit Paid by', $headings[0]) &&
                    in_array('Deposit Received', $headings[0]) &&
                    in_array('EFT received', $headings[0]) &&
                    in_array('Email', $headings[0]) &&
                    in_array('eway reference no.', $headings[0]) &&
                    in_array('EWAY TOKEN', $headings[0]) &&
                    in_array('Final Payment eway reference no.', $headings[0]) &&
                    in_array('Final Payment Received by', $headings[0]) &&
                    in_array('General Notes', $headings[0]) &&
                    in_array('Head Office Paid', $headings[0]) &&
                    in_array('Hire a Mover Margin', $headings[0]) &&
                    in_array('Home/Office', $headings[0]) &&
                    in_array('Initial Hours Booked', $headings[0]) &&
                    in_array('Initial Sell Price', $headings[0]) &&
                    in_array('Move Type', $headings[0]) &&
                    in_array('Moving From Postcode', $headings[0]) &&
                    in_array('Moving From State', $headings[0]) &&
                    in_array('Moving From Street', $headings[0]) &&
                    in_array('Moving From Suburb', $headings[0]) &&
                    in_array('Moving To Postcode', $headings[0]) &&
                    in_array('Moving To State', $headings[0]) &&
                    in_array('Moving To Street', $headings[0]) &&
                    in_array('Moving To Suburb', $headings[0]) &&
                    in_array('No. of movers', $headings[0]) &&
                    in_array('No. of trucks', $headings[0]) &&
                    in_array('Number of ladies booked', $headings[0]) &&
                    in_array('Packer Selections', $headings[0]) &&
                    in_array('Phone', $headings[0]) &&
                    in_array('Promotional Code', $headings[0]) &&
                    in_array('Removalist', $headings[0]) &&
                    in_array('Removalist Paid', $headings[0]) &&
                    in_array('Service Date', $headings[0]) &&
                    in_array('Service Time', $headings[0]) &&
                    in_array('Total Sell Price', $headings[0]) &&
                    in_array('Travel Fee', $headings[0])) {


                $EnquiryUniqueIdIndex = array_search('Enquiry Unique Id', $headings[0]);
                $AdditionalChargeItemIndex = array_search('Additional charge item', $headings[0]);
                // $BookingConfirmIndex = array_search('Booking Confirmation Sent to Customer', $headings[0]);
                $BookingMadeIndex = array_search('Booking Made', $headings[0]);
                $BookingStatusIndex = array_search('Booking Status', $headings[0]);
                $ClientIndex = array_search('Client', $headings[0]);
                // $ClientFeedbackIndex = array_search('Client Feedback', $headings[0]);
                $CHRIndex = array_search('Client Hourly Rate', $headings[0]);
                $DepositeAmtIndex = array_search('Deposit Amount', $headings[0]);
                $DepositePaidIndex = array_search('Deposit Paid by', $headings[0]);
                $DepositeReceiveIndex = array_search('Deposit Received', $headings[0]);
                $EFTIndex = array_search('EFT received', $headings[0]);
                $EmailIndex = array_search('Email', $headings[0]);
                $EWAYRefIndex = array_search('eway reference no.', $headings[0]);
                $EwayTokenIndex = array_search('EWAY TOKEN', $headings[0]);
                $FinalpaymentEwayIndex = array_search('Final Payment eway reference no.', $headings[0]);
                $FinalPaymentReceiveIndex = array_search('Final Payment Received by', $headings[0]);
                $GeneralNotesIndex = array_search('General Notes', $headings[0]);
                $HeadOfficepaidIndex = array_search('Head Office Paid', $headings[0]);
                $HiremovermarginIndex = array_search('Hire a Mover Margin', $headings[0]);
                $HomeOfficeIndex = array_search('Home/Office', $headings[0]);
                $InitialHrBookedIndex = array_search('Initial Hours Booked', $headings[0]);
                $InitialSellPriceIndex = array_search('Initial Sell Price', $headings[0]);
                //  $JobsheetSentRemovalistIndex = array_search('Job Sheet Sent to Removalist?', $headings[0]);
                $MovetypeIndex = array_search('Move Type', $headings[0]);
                $MFPostcodeIndex = array_search('Moving From Postcode', $headings[0]);
                $MFStateIndex = array_search('Moving From State', $headings[0]);
                $MFStreetIndex = array_search('Moving From Street', $headings[0]);
                $MFSuburbIndex = array_search('Moving From Suburb', $headings[0]);
                $MTPostcodeIndex = array_search('Moving To Postcode', $headings[0]);
                $MTStateIndex = array_search('Moving To State', $headings[0]);
                $MTStreetIndex = array_search('Moving To Street', $headings[0]);
                $MTSuburbIndex = array_search('Moving To Suburb', $headings[0]);
                $MoversIndex = array_search('No. of movers', $headings[0]);
                $TrucksIndex = array_search('No. of trucks', $headings[0]);
                $LadiesIndex = array_search('Number of ladies booked', $headings[0]);
                $PackersIndex = array_search('Packer Selections', $headings[0]);

                // $PackingUnpackingServiceIndex = array_search('Packing/unpacking services', $headings[0]);
                //  $PaymentMethodIndex = array_search('Payment method', $headings[0]);
                $PhoneIndex = array_search('Phone', $headings[0]);
                $PromotionalCodeIndex = array_search('Promotional Code', $headings[0]);

                $RemovalistIndex = array_search('Removalist', $headings[0]);
                $RemovalistPaidIndex = array_search('Removalist Paid', $headings[0]);
                $ServicedateIndex = array_search('Service Date', $headings[0]);
                $ServicetimeIndex = array_search('Service Time', $headings[0]);
                $TotalSellPriceIndex = array_search('Total Sell Price', $headings[0]);
                $TravelFeesIndex = array_search('Travel Fee', $headings[0]);


                for ($i = 2; $i <= $totalrows; $i++) {


                    $EnquiryUniqueId = $objWorksheet->getCellByColumnAndRow($EnquiryUniqueIdIndex, $i)->getValue();
                    $AdditionalChargeItem = $objWorksheet->getCellByColumnAndRow($AdditionalChargeItemIndex, $i)->getValue();
                    // $BookingConfirm = $objWorksheet->getCellByColumnAndRow($BookingConfirmIndex, $i)->getValue();
                    
                    $BookingMade = $objWorksheet->getCellByColumnAndRow($BookingMadeIndex, $i)->getValue();
                    $BookingStatus = $objWorksheet->getCellByColumnAndRow($BookingStatusIndex, $i)->getValue();
                    $Client = $objWorksheet->getCellByColumnAndRow($ClientIndex, $i)->getValue(); //Excel Column 1
                    // $ClientFeedback = $objWorksheet->getCellByColumnAndRow($ClientFeedbackIndex, $i)->getValue(); //Excel Column 2
                    $CHR = $objWorksheet->getCellByColumnAndRow($CHRIndex, $i)->getValue(); //Excel Column 3
                    $DepositeAmt = $objWorksheet->getCellByColumnAndRow($DepositeAmtIndex, $i)->getValue(); //Excel Column 4
                    $DepositePaid = $objWorksheet->getCellByColumnAndRow($DepositePaidIndex, $i)->getValue(); //Excel Column 5
                    $DepositeReceive = $objWorksheet->getCellByColumnAndRow($DepositeReceiveIndex, $i)->getValue(); //Excel Column 6
                    $EFT = $objWorksheet->getCellByColumnAndRow($EFTIndex, $i)->getValue(); //Excel Column 7
                    $Email = $objWorksheet->getCellByColumnAndRow($EmailIndex, $i)->getValue(); //Excel Column 8
                    $EWAYRef = $objWorksheet->getCellByColumnAndRow($EWAYRefIndex, $i)->getValue(); //Excel Column 8
                    $EwayToken = $objWorksheet->getCellByColumnAndRow($EwayTokenIndex, $i)->getValue(); //Excel Column 8
                    $FinalpaymentEway = $objWorksheet->getCellByColumnAndRow($FinalpaymentEwayIndex, $i)->getValue(); //Excel Column 8
                    $FinalPaymentReceive = $objWorksheet->getCellByColumnAndRow($FinalPaymentReceiveIndex, $i)->getValue(); //Excel Column 8
                    $GeneralNotes = $objWorksheet->getCellByColumnAndRow($GeneralNotesIndex, $i)->getValue(); //Excel Column 8
                    $HeadOfficepaid = $objWorksheet->getCellByColumnAndRow($HeadOfficepaidIndex, $i)->getValue(); //Excel Column 8
                    $Hiremovermargin = $objWorksheet->getCellByColumnAndRow($HiremovermarginIndex, $i)->getValue(); //Excel Column 8
                    $HomeOffice = $objWorksheet->getCellByColumnAndRow($HomeOfficeIndex, $i)->getValue(); //Excel Column 8
                    $InitialHrBooked = $objWorksheet->getCellByColumnAndRow($InitialHrBookedIndex, $i)->getValue(); //Excel Column 8
                    $InitialSellPrice = $objWorksheet->getCellByColumnAndRow($InitialSellPriceIndex, $i)->getValue(); //Excel Column 8
                    //   $JobsheetSentRemovalist = $objWorksheet->getCellByColumnAndRow($JobsheetSentRemovalistIndex, $i)->getValue(); //Excel Column 8
                    $Movetype = $objWorksheet->getCellByColumnAndRow($MovetypeIndex, $i)->getValue(); //Excel Column 8
                    $MFPostcode = $objWorksheet->getCellByColumnAndRow($MFPostcodeIndex, $i)->getValue(); //Excel Column 8
                    $MFState = $objWorksheet->getCellByColumnAndRow($MFStateIndex, $i)->getValue(); //Excel Column 8
                    $MFStreet = $objWorksheet->getCellByColumnAndRow($MFStreetIndex, $i)->getValue(); //Excel Column 8
                    $MFSuburb = $objWorksheet->getCellByColumnAndRow($MFSuburbIndex, $i)->getValue(); //Excel Column 8
                    $MTPostcode = $objWorksheet->getCellByColumnAndRow($MTPostcodeIndex, $i)->getValue(); //Excel Column 8
                    $MTState = $objWorksheet->getCellByColumnAndRow($MTStateIndex, $i)->getValue(); //Excel Column 8
                    $MTStreet = $objWorksheet->getCellByColumnAndRow($MTStreetIndex, $i)->getValue(); //Excel Column 8
                    $MTSuburb = $objWorksheet->getCellByColumnAndRow($MTSuburbIndex, $i)->getValue(); //Excel Column 8
                    $Movers = $objWorksheet->getCellByColumnAndRow($MoversIndex, $i)->getValue(); //Excel Column 8
                    $Trucks = $objWorksheet->getCellByColumnAndRow($TrucksIndex, $i)->getValue(); //Excel Column 8
                    $Ladies = $objWorksheet->getCellByColumnAndRow($LadiesIndex, $i)->getValue(); //Excel Column 8
                    $Packers = $objWorksheet->getCellByColumnAndRow($PackersIndex, $i)->getValue(); //Excel Column 8
                    //  $PackingUnpackingService = $objWorksheet->getCellByColumnAndRow($PackingUnpackingServiceIndex, $i)->getValue(); //Excel Column 8
                    $Phone = $objWorksheet->getCellByColumnAndRow($PhoneIndex, $i)->getValue(); //Excel Column 8
                    $PromotionalCode = $objWorksheet->getCellByColumnAndRow($PromotionalCodeIndex, $i)->getValue(); //Excel Column 8
                    $Removalist = $objWorksheet->getCellByColumnAndRow($RemovalistIndex, $i)->getValue(); //Excel Column 8
                    $RemovalistPaid = $objWorksheet->getCellByColumnAndRow($RemovalistPaidIndex, $i)->getValue(); //Excel Column 8
                    $Servicedate = $objWorksheet->getCellByColumnAndRow($ServicedateIndex, $i)->getValue(); //Excel Column 8
                    $Servicetime = $objWorksheet->getCellByColumnAndRow($ServicetimeIndex, $i)->getValue(); //Excel Column 8
                    $TotalSellPrice = $objWorksheet->getCellByColumnAndRow($TotalSellPriceIndex, $i)->getValue(); //Excel Column 8
                    $TravelFees = $objWorksheet->getCellByColumnAndRow($TravelFeesIndex, $i)->getValue(); //Excel Column 8

                    if ($BookingStatus == "Current") {
                        $Bstatus = 1;
                    } else if ($BookingStatus == "Other(refer notes)") {
                        $Bstatus = 2;
                    } else if ($BookingStatus == "Client") {
                        $Bstatus = 3;
                    }
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
                    if ($FinalPaymentReceive == "EFT") {
                        $finalpaymentreceive = 1;
                    } else if ($FinalPaymentReceive == "Credit card") {
                        $finalpaymentreceive = 2;
                    } else if ($FinalPaymentReceive == "Cash") {
                        $finalpaymentreceive = 3;
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
                    }
                    if ($HeadOfficepaid == "Yes") {
                        $headofficepaid = 1;
                    } else if ($HeadOfficepaid == "No") {
                        $headofficepaid = 0;
                    }
                    if ($RemovalistPaid == "Yes") {
                        $removalistpaid = 1;
                    } else if ($RemovalistPaid == "No") {
                        $removalistpaid = 0;
                    }
                    //Booking date format convert excel sheet date format (eg. 17-11-17 into 2017-11-17)
                    $BookingmadeDate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($BookingMade));
                    $serDate = date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($Servicedate));
                    
                    $clientID = $this->booking_model->getClientForImportData($Client);
                    
                    $packersdata = explode("}", $Packers);
                    $packersIds = "";
                    foreach ($packersdata as $pker) {
                        $packername = explode("=", $pker);
                        if (!empty($packername[0])) {
                            $packersNameData = $this->booking_model->getPackersForImportData($packername[0]);
                            $packersIds .= $packersNameData[0]['contact_id'] . ",";
                        }
                    }
                    $removalistid = $this->booking_model->getRemovalistImportData($Removalist);

//
//print_r($removalistid);
//die;
                    if ($EnquiryUniqueId == "") {
                        $data_booking = array(
                            'en_additional_item' => $AdditionalChargeItem,
                            'qualified_date' => $BookingmadeDate,
                            'booking_status' => $Bstatus,
                            'customer_id' => $clientID[0]['contact_id'],
                            'en_client_hourly_rate' => $CHR,
                            'en_deposit_amt' => $DepositeAmt,
                            'en_deposit_paidby' => $depositepaidby,
                            'en_deposit_received' => $depositereceive,
                            'en_eft_receivedon' => $EFT,
                            'en_email' => $Email,
                            'en_eway_refno' => $EWAYRef,
                            'en_eway_token' => $EwayToken,
                            'final_payment_eway_refno' => $FinalpaymentEway,
                            'final_payment_receivedby' => $finalpaymentreceive,
                            'en_note' => $GeneralNotes,
                            'head_office_paid' => $headofficepaid,
                            'en_hireamover_margin' => $Hiremovermargin,
                            'en_initial_hours_booked' => $InitialHrBooked,
                            'en_initial_sellprice' => $InitialSellPrice,
                            'en_movetype' => $move,
                            'en_movingfrom_postcode' => $MFPostcode,
                            'en_movingfrom_state' => $MFState,
                            'en_movingfrom_street' => $MFStreet,
                            'en_movingfrom_suburb' => $MFSuburb,
                            'en_movingto_postcode' => $MTPostcode,
                            'en_movingto_state' => $MTState,
                            'en_movingto_street' => $MTStreet,
                            'en_movingto_suburb' => $MTSuburb,
                            'en_no_of_movers' => $Movers,
                            'en_no_of_trucks' => $Trucks,
                            'en_ladies_booked' => $Ladies,
                            'contact_id' => $packersIds,
                            'en_phone' => $Phone,
                            'en_promotional_code' => $PromotionalCode,
                            'contact_id' => $removalistid[0]['contact_id'],
                            'removalist_paid' => $removalistpaid,
                            'en_servicedate' => $serDate,
                            'en_servicetime' => $Servicetime,
                            'en_total_sellprice' => $TotalSellPrice,
                            'en_travelfee' => $TravelFees
                        );

                        $this->booking_model->addBookingdata($data_booking);
                    }
//                    elseif ($ContactId != "" && $ContactFname != "" && $ContactLname != "" && $Email != "" && $MoveType != "" && $StateType != "" && $StatusType != "") {
//                        $data_booking = array('contact_unique_id' => $ContactId, 'contact_fullname' => $ContactfullName, 'contact_fname' => $ContactFname, 'contact_middlename' => $ContactMname, 'contact_lname' => $ContactLname, 'contact_email' => $Email, 'company_name' => $CompanyName, 'contact_phno' => $Phone, 'contact_reltype' => $MoveType, 'contact_state' => $StateType, 'is_deleted' => $status);
//                        $this->booking_model->Add_ImportedBookingData($data_booking);
//                    }
                }

             
                $this->session->set_flashdata('flashSuccess', 'Booking Imported Successfully.');
                unlink('assets/uploads/bookingImport/' . $media);
                redirect(base_url() . "bookinglist");
            } else {
                $this->session->set_flashdata('flashError', 'Fields are not matched in file please check it and reupload.');
                redirect(base_url() . "bookinglist");
            }
        } else {
           
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('flashError', strip_tags($error));
            redirect(base_url() . "bookinglist");
        }

        
    }*/
    

    // Disqualify multiple booking.........@DRCZ
    public function disqualifyBookingList() {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        if (isset($_POST)) {

            $en_unique_ids = $this->input->post('ids');
            if (isset($en_unique_ids)) {
                $this->load->model("booking_model");
                if ($this->booking_model->getAjaxDisQualifyFromEnqueryList($en_unique_ids)) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
            }
        }
    }

}
