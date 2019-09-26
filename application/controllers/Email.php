<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_GET['auth'])) {
            if (!isLogin() && !isLoginUser()) {
                if ($this->input->is_ajax_request()) {
                    echo json_encode(array("expired" => "1"));
                    exit;
                }
                redirect(base_url());
            }
            if (!$this->input->is_ajax_request()) {
                show_404();
            }
        } else if ($_GET['auth'] != "slientEmailAhj") {
            if (!isLogin()) {
                if ($this->input->is_ajax_request()) {
                    echo json_encode(array("expired" => "1"));
                    exit;
                }
                redirect(base_url());
            }
            if (!$this->input->is_ajax_request()) {
                show_404();
            }
        }
//        if (!isLogin())
//            echo json_encode(array("expired" => "1"));exit;

        $this->data = array();
        $this->data['title'] = "";
        $this->data['description'] = "";
        $this->data['notification'] = webNotification();
        $this->load->model("email_template_model");
        $this->load->model("enquiry_model");
        $this->load->model("booking_model");
        $this->load->model("contact_model");
        // $this->data['user'] = $this->session->userdata('userData');
    }

    public function index() {
        $this->data['title'] = "CRM Email Template";
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
            'pages/scripts/edit-enquiries.js'
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

        $data['form_data'] = $this->email_template_model->getEmailTemplateByID($id);
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('email_edit_template_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    function send() {
        $emailAction = $this->input->post('emailAction', true);
        $id = $this->input->post('id', true);

        switch ($emailAction) {
            case "Quote":
                if ($this->sendQuote($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "Followup":
                if ($this->sendQuote($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "JobSheet":
                if ($this->sendJobSheet($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "RemovalistJobSheet":
                if ($this->sendJobSheet($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "BookingConfirmation":
                if ($this->sendBookingConfirmation($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "SendFeedback":
                if ($this->sendFeedback($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "SendReminder":
                if ($this->sendReminder($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "NoAnswerFeedback":
                if ($this->sendNoAnswerFeedback($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "FeedbackReminder":
                if ($this->sendFeedbackReminder($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "WarningJobsheet":
                if ($this->sendWarningJobsheetMail($emailAction ,$id) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            default:
                echo json_encode(array("error" => 1));
                break;
        }
    }

    /* INSTANT QUOTE....@DRCZ */

    function sendAutoInstantQuote($id, $emailAction) {
        //  echo "hiii";
        //  mail("zeel.mavani@drcinfotech.com","Cronjobexecute","Hi Zeel");
        // die;
        //  $handle = fopen("PIQ_LOG", "a");
        //           fwrite($handle, "EnquiryId " . $id);
        //           fwrite($handle, "cronjob ");
        switch ($emailAction) {
            case "Quote":
                if ($this->sendQuote($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "Followup":
                if ($this->sendQuote($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "JobSheet":
                if ($this->sendJobSheet($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "RemovalistJobSheet":
                if ($this->sendJobSheet($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "BookingConfirmation":
                if ($this->sendBookingConfirmation($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "SendFeedback":
                if ($this->sendFeedback($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;
            case "SendReminder":
                if ($this->sendReminder($id, $emailAction) == true) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
                break;

            default:
                echo json_encode(array("error" => 1));
                break;
        }
    }

    /* INSTANT QUOTE....@DRCZ */

    function sendEditQuoteEmail($templateID) {
        $id = $this->input->post('EnquiryId', true);

        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|max_length[100]');
        $this->form_validation->set_rules('from', 'From', 'trim|callback_contactemail_check');
        $this->form_validation->set_rules('to', 'To', 'trim|callback_contactemail_check');
        $this->form_validation->set_rules('cc', 'Cc', 'trim|callback_contactemail_check');
        $this->form_validation->set_rules('bcc', 'Bcc', 'trim|callback_contactemail_check');


        if ($this->form_validation->run() == FALSE) {
            echo json_encode(array("error" => validation_errors()));
        } else {
            $emailType = $this->email_template_model->getEmailTypeByID($templateID);

            if ($emailType === FALSE) {
                echo json_encode(array("error" => 1));
                exit;
            }
            $movetype = $this->input->post('movetype');
//print_r($movetype);
//die;
            $emailData[] = array(
                'email_master_id' => $this->input->post('email_master_id'),
                'email_editor' => $this->input->post('editor2'),
                'email_from' => $this->input->post('from'),
                'email_to' => $this->input->post('to'),
                'email_bcc' => $this->input->post('bcc'),
                'email_cc' => $this->input->post('cc'),
                'email_subject' => $this->input->post('subject'),
            );
            $emailData[0]['email_editor']=html_entity_decode($emailData[0]['email_editor']);
//            print_r($emailData);
//            die;
            if ($this->email_template_model->addEmailLog($emailData, $id) !== FALSE) {

                if ($emailType[0]['template_master_id'] == 1) {
                    $this->booking_model->addQuoteMailLog($id);
                } else if ($emailType[0]['template_master_id'] == 4) {
                    $this->booking_model->addJobsheetMailLog($id);
                } else if ($emailType[0]['template_master_id'] == 5) {
                    $this->booking_model->addBookingConfirmationMailLog($id);
                }

                if ($movetype == 4 || $movetype == 5) {
                    $type11 = "QuoteP";
                } else if ($movetype == 1 || $movetype == 2 || $movetype == 3) {
                    $type11 = "QuoteR";
                } else if ($movetype == 7 || $movetype == 8) {
                    $type11 = "QuoteLP";
                } else {
                    $type11 = "Quote";
                }

                if (sendEmail($emailData, $type11) !== FALSE) {
                    echo json_encode(array("success" => 1));
                } else {
                    echo json_encode(array("error" => 1));
                }
            } else {
                echo json_encode(array("error" => 1));
            }
        }
    }

    private function sendQuote($id, $type) {

        $result = $this->enquiry_model->getEnquiryDataByEnquiryID($id);
//        print_r($result);
//        die;
        $enqId = $result[0]['enquiry_id'];

        if ($result !== FALSE) {
            if ($result[0]['en_additional_charges'] != "0.00" && $result[0]['en_additional_charges'] != NULL) {
                $addcharge = '. There is also a charge of $' . (int) $result[0]["en_additional_charges"] . ' for the ' . $result[0]["en_additional_item"] . '.';
            } else {
                $addcharge = '';
            }
            if ($result[0]["en_no_of_trucks"] == 1) {
                $truck = $result[0]["en_no_of_trucks"] . " truck";
            } else {
                $truck = $result[0]["en_no_of_trucks"] . " trucks";
            }

            $emailTypeArray = $this->email_template_model->getEmailIDByName($type);
            if ($emailTypeArray === FALSE) {
                return false;
            }
            $emailData = $this->email_template_model->getEmailTemplate($result[0]['en_movetype'], $emailTypeArray[0]['template_master_id']);
            if ($emailData !== FALSE) {

                if ($emailData[0]['en_movetype'] == 4 || $emailData[0]['en_movetype'] == 5 || $emailData[0]['en_movetype'] == 7 || $emailData[0]['en_movetype'] == 8) {
                    $emailData[0]['email_editor'] = str_replace("{{amt}}", $result[0]["en_initial_sellprice"], $emailData[0]['email_editor']);
                } else {
                    $emailData[0]['email_editor'] = str_replace("{{amt}}", $result[0]["en_deposit_amt"], $emailData[0]['email_editor']);
                }
//                echo "<pre>";
//                print_r($result[0]['en_servicetime']);
//                die;
                $servicet = strrpos($result[0]['en_servicetime'], "-");


                if ($emailData[0]['en_movetype'] == 1 || $emailData[0]['en_movetype'] == 2) {
                    if ($servicet > 0) {
                        $emailData[0]['email_editor'] = str_replace("{{datetimepre}}", "between ", $emailData[0]['email_editor']);
                       $emailData[0]['email_editor'] = str_replace("{{datetime}}", $result[0]['en_servicetime'] . " on " . date('l d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                        // $emailData[0]['email_editor'] = str_replace("{{datetime}}", $result[0]['en_servicetime'], $emailData[0]['email_editor']);
                    } else {
                        $emailData[0]['email_editor'] = str_replace("{{datetimepre}}", "at ", $emailData[0]['email_editor']);
                        // $emailData[0]['email_editor'] = str_replace("{{datetime}}", $result[0]['en_servicetime'], $emailData[0]['email_editor']);
                        $emailData[0]['email_editor'] = str_replace("{{datetime}}", $result[0]['en_servicetime'] . " on " . date('l d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                    }
                } else {
                    $emailData[0]['email_editor'] = str_replace("{{datetime}}", $result[0]['en_servicetime'] . " on " . date('l d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                }
                $emailData[0]['email_to'] = $result[0]['en_email'];
                // $emailData[0]['email_editor'] = str_replace("{{amt}}", $result[0]["en_deposit_amt"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{uuid}}", $result[0]["en_unique_id"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofmover}}", $result[0]["en_no_of_movers"], $emailData[0]['email_editor']);
                //  $emailData[0]['email_editor'] = str_replace("{{nooftruck}}", $result[0]["en_no_of_trucks"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{nooftruck}}", $truck, $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{hourlyrate}}", (int) $result[0]["en_client_hourly_rate"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialsellprice}}", (int) $result[0]["en_initial_sellprice"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofladiesbooked}}", $result[0]["en_ladies_booked"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $result[0]["en_initial_hours_booked"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{tavelfee}}", (int) $result[0]["en_travelfee"], $emailData[0]['email_editor']);
                $emailData[0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{clientfirstname}}", $result[0]['en_fname'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{emailTo}}", $result[0]['en_email'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{additionalcharges}}", $addcharge, $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{additionalchargeitem}}", $result[0]["en_additional_item"], $emailData[0]['email_editor']);
                if ($result[0]['en_additional_charges'] != 0.00 && $result[0]['en_additional_charges'] != NULL) {
                    $emailData[0]['email_editor'] = str_replace("{{additionalchargeforpacker}}", "and " . $result[0]["en_additional_item"], $emailData[0]['email_editor']);
                } else {
                    $emailData[0]['email_editor'] = str_replace("{{additionalchargeforpacker}}", "", $emailData[0]['email_editor']);
                }

//                print_r($emailData[0]['email_editor']);
//                die;
//                return sendEmail($emailData, $type);
                if ($result[0]['en_movetype'] == 4 || $result[0]['en_movetype'] == 5) {
                    $type11 = "QuoteP";
                } else if ($result[0]['en_movetype'] == 7 || $result[0]['en_movetype'] == 8) {
                    $type11 = "QuoteLP";
                } else if ($result[0]['en_movetype'] == 1 || $result[0]['en_movetype'] == 2 || $result[0]['en_movetype'] == 3) {
                    $type11 = "QuoteR";
                } else {
                    $type11 = $type;
                }
                if ($result[0]['en_servicetime'] == "" || $result[0]['en_servicetime'] == "No preference") {
                    return false;
                }
                if (sendEmail($emailData, $type11) !== false) {
                    if ($this->email_template_model->addEmailLog($emailData, $id) !== FALSE) {
                        $this->booking_model->addQuoteMailLog($enqId);
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function sendJobSheet($id, $type, $newtype = "RemovalistJobSheet") {

        if ($type == "JobSheet") {
            $type = "JobSheet";
            $sub = "";
        } elseif ($newtype == "RemovalistJobSheet") {
            $type = "JobSheet";
            $sub = "REMINDER: ";
        }

        $result = $this->booking_model->getBookingDataByBookingID($id);
        $enqId = $result[0]['enquiry_id'];

        if ($result !== FALSE) {
            $emailTypeArray = $this->email_template_model->getEmailIDByName($type);

            if ($emailTypeArray === FALSE) {
                return false;
            }
            $emailData = $this->email_template_model->getEmailTemplate($result[0]['en_movetype'], $emailTypeArray[0]['template_master_id']);

            if ($emailData !== FALSE) {
                $encodeData = "";
                unset($emailData[0]['email_to']);

                if ($result[0]["en_movingfrom_street"] != "") {
                    $fromadd = $result[0]["en_movingfrom_street"] . ", " . $result[0]['en_movingfrom_suburb'] . ',' . $result[0]['en_movingfrom_state'] . ', ' . $result[0]['en_movingfrom_postcode'];
                } else {
                    $fromadd = $result[0]['en_movingfrom_suburb'] . ',' . $result[0]['en_movingfrom_state'] . ', ' . $result[0]['en_movingfrom_postcode'];
                }
                if ($result[0]["en_movingto_street"] != "") {
                    $toadd = $result[0]["en_movingto_street"] . ", " . $result[0]['en_movingto_suburb'] . ',' . $result[0]['en_movingto_state'] . ', ' . $result[0]['en_movingto_postcode'];
                } else {
                    $toadd = $result[0]['en_movingto_suburb'] . ',' . $result[0]['en_movingto_state'] . ', ' . $result[0]['en_movingto_postcode'];
                }
                $pickupdata = json_decode($result[0]['additional_pickup'], true);
                $deliverydata = json_decode($result[0]['additional_delivery'], true);

                /**
                 * Additional Items in Email
                 */
                $result[0]['en_additional_charges'] = trim($result[0]['en_additional_charges']);
                $result[0]['en_additional_item'] = trim($result[0]['en_additional_item']);
                if ($result[0]['en_additional_charges'] != "" && $result[0]['en_additional_charges'] != NULL && $result[0]['en_additional_charges'] != "NULL" && $result[0]['en_additional_item'] != "" && $result[0]['en_additional_item'] != NULL && $result[0]['en_additional_item'] != "NULL") {
                    $emailData[0]['email_editor'] = str_replace("{{additional-items}}", "Additional item :</span> <span> " . $result[0]['en_additional_item'], $emailData[0]['email_editor']);
                } else {
                    $emailData[0]['email_editor'] = str_replace("{{additional-items}}", "", $emailData[0]['email_editor']);
                }

                /* if ($pickupdata['en_addpickup_postcode'] != "") { */
                if (count($pickupdata['en_addpickup_postcode']) > 0) {
                    $count = count($pickupdata['en_addpickup_postcode']);
                    if ($count > 0) {
                        for ($dd = 0; $dd < $count; $dd++) {
                            $pickuppostcode = $pickupdata['en_addpickup_postcode'][$dd];
                            $pickupsuburb = $pickupdata['en_addpickup_suburb'][$dd];
                            $pickupstate = $pickupdata['en_addpickup_state'][$dd];
                            $pickupstreet = $pickupdata['en_addpickup_street'][$dd];

                            if ($pickupstreet != "") {
                                $Pickup .= "Additional Pickup: " . $pickupstreet . ", " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode . "<br/>";
                                // $Pickup .= '</br>' . $pickupstreet . ", " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode;
                            } else {
                                $Pickup .= "Additional Pickup: " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode . "<br/>";
                                // $Pickup .= '</br>' . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode;
                            }
                        }
                        // $Pickup = "Additional Pickup: " . $Pickup;
                        //  $Pickup = '<p style="font-family: Calibri, Geneva, Helvetica, sans-serif; font-size: 14px; color: rgb(68, 84, 106); line-height: 1.4;"><span title="Moving to state">' . "Additional Pickup: " . $Pickup . '</span></p>';
                        $emailData[0]['email_editor'] = str_replace("{{additionalpickup}}", $Pickup, $emailData[0]['email_editor']);
                    }
                } else {
                    $emailData[0]['email_editor'] = str_replace("{{additionalpickup}}", " ", $emailData[0]['email_editor']);
                }
// Delivery data display in booking........................   
//            print_r($deliverydata);
//            die;
                /* if ($deliverydata['en_adddelivery_postcode'] != "") { */
                if (count($deliverydata['en_adddelivery_postcode']) > 0) {
                    $count1 = count($deliverydata['en_adddelivery_postcode']);
                    if ($count1 > 0) {
                        for ($zz = 0; $zz < $count1; $zz++) {
                            $deliverypostcode = $deliverydata['en_adddelivery_postcode'][$zz];
                            $deliverysuburb = $deliverydata['en_adddelivery_suburb'][$zz];
                            $deliverystate = $deliverydata['en_adddelivery_state'][$zz];
                            $deliverystreet = $deliverydata['en_adddelivery_street'][$zz];

                            if ($deliverystreet != "") {
                                $Delivery .= "Additional Delivery: " . $deliverystreet . ", " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode . "<br/>";
                                // $Delivery .= '</br>' . $deliverystreet . ", " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode;
                            } else {
                                $Delivery .= "Additional Delivery: " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode . "<br/>";
                                // $Delivery .= '</br>' . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode;
                            }
                        }
                        // $Delivery = "Additional Delivery: " . $Delivery;
                        //$Delivery = '<p style="font-family: Calibri, Geneva, Helvetica, sans-serif; font-size: 14px; color: rgb(68, 84, 106); line-height: 1.4;"><span title="Moving to state">' . "Additional Delivery: " . $Delivery . '</span></p>';
                        $emailData[0]['email_editor'] = str_replace("{{additionaldelivery}}", $Delivery, $emailData[0]['email_editor']);
                    }
                } else {
                    $emailData[0]['email_editor'] = str_replace("{{additionaldelivery}}", " ", $emailData[0]['email_editor']);
                }
                if ($result[0]['en_movetype'] != 4 && $result[0]['en_movetype'] != 5 && $result[0]['en_movetype'] != 7 && $result[0]['en_movetype'] != 8) {
                    $movingFromFullAddress = $result[0]['en_movingfrom_street'] . ',' . $result[0]['en_movingfrom_suburb'] . ',' . $result[0]['en_movingfrom_state'] . ',' . $result[0]['en_movingfrom_postcode'];
                    $movingToFullAddress = $result[0]['en_movingto_street'] . ',' . $result[0]['en_movingto_suburb'] . ',' . $result[0]['en_movingto_state'] . ',' . $result[0]['en_movingto_postcode'];
                    $emailData[0]['email_to'][] = $result[0]['removalistEmail'];
                    if ($result[0]['en_no_of_trucks'] > 1) {
                        $truck = "trucks";
                    } else {
                        $truck = "truck";
                    }
                    $pdfArrayData = array(
                        'template' => 'removalist_local_job_sheet',
                        'UUID' => $result[0]['en_unique_id'],
                        'ClientName' => $result[0]['clientFname'] . ' ' . $result[0]['clientLname'],
                        'phonenumber' => $result[0]['en_phone'],
                        'bookeddate' => date('d/m/Y', strtotime($result[0]['en_servicedate'])),
                        'bookedtime' => $result[0]['en_servicetime'],
                        'bookedmovers' => $result[0]['en_no_of_movers'],
                        'bookedtrucks' => $result[0]['en_no_of_trucks'],
                        'bookedtrucksword' => $truck,
                        'movefrom' => $movingFromFullAddress,
                        'moveto' => $movingToFullAddress,
                        'hourlyrate' => $result[0]['en_client_hourly_rate'],
                        'travelfee' => $result[0]['en_travelfee'],
                        'additionalChargeItem' => 'null',
                        'additionalItemsSell' => 'null',
                        'depositamount' => $result[0]['en_deposit_amt'],
                        'JobNotes' => $result[0]['en_note'],
                    );
                    if ($result[0]['en_addpickup_state'] != "") {
                        $pdfArrayData['additionalPickupStreet'] = $result[0]['en_addpickup_street'];
                        $pdfArrayData['additionalPickupSuburb'] = $result[0]['en_addpickup_suburb'];
                    }
                    if ($result[0]['en_adddelivery_state'] != "") {
                        $pdfArrayData['additionalDeliverySuburb'] = $result[0]['en_adddelivery_suburb'];
                        $pdfArrayData['additionalDeliveryStreet'] = $result[0]['en_adddelivery_street'];
                    }
                } else {

                    if ($result[0]['en_movetype'] == 4 || $result[0]['en_movetype'] == 7) {
                        $movingFullAddress = $result[0]['en_movingfrom_street'] . ',' . $result[0]['en_movingfrom_suburb'] . ',' . $result[0]['en_movingfrom_state'] . ',' . $result[0]['en_movingfrom_postcode'];
                    } else if ($result[0]['en_movetype'] == 5 || $result[0]['en_movetype'] == 8) {
                        $movingFullAddress = $result[0]['en_movingto_street'] . ',' . $result[0]['en_movingto_suburb'] . ',' . $result[0]['en_movingto_state'] . ',' . $result[0]['en_movingto_postcode'];
                    }
                    $moveType = array(4 => 'Packing', 5 => 'Unpacking');
                    $packerPaidStatus = $result[0]['en_deposit_received'] == 1 ? "Paid" : "Unpaid";

                    $getPackersEmail = $this->contact_model->getPackerstByUUID($result[0]['en_unique_id']);
                    if ($getPackersEmail != NULL) {
                        foreach ($getPackersEmail as $em) {
                            $emailData[0]['email_to'][] = $em['contact_email'];
                        }
                    } else {
                        return false;
                    }
                    $pdfArrayData = array(
                        'template' => 'packer_job_sheet',
                        'ClientName' => $result[0]['clientFname'] . ' ' . $result[0]['clientLname'],
                        'eUID' => $result[0]['en_unique_id'],
                        'phonenumber' => $result[0]['en_phone'],
                        'bookeddate' => date('d/m/Y', strtotime($result[0]['en_servicedate'])),
                        'packerTimeBooked' => $result[0]['en_servicetime'],
                        'movefrom' => $movingFullAddress,
                        'moveto' => "null",
                        'moveType' => $moveType[$result[0]['en_movetype']],
                        'packerPaidStatus' => $packerPaidStatus,
                    );
                }

                $encodeData = base64_encode(json_encode($pdfArrayData));



                $emailData[0]['email_editor'] = str_replace("{{amt}}", $result[0]["en_deposit_amt"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{uuid}}", $result[0]["en_unique_id"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofmover}}", $result[0]["en_no_of_movers"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{nooftruck}}", $result[0]["en_no_of_trucks"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{jobsheetnotes}}", $result[0]["en_note"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{hourlyrate}}", (int) $result[0]["en_client_hourly_rate"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialsellprice}}", (int) $result[0]["en_initial_sellprice"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofladiesbooked}}", $result[0]["en_ladies_booked"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $result[0]["en_initial_hours_booked"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{datetime}}", "Between " . $result[0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{tavelfee}}", (int) $result[0]["en_travelfee"], $emailData[0]['email_editor']);
                $emailData[0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{date}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{clientfirstname}}", $result[0]['en_fname'], $emailData[0]['email_editor']);
//                if($type == "JobSheet"){
//                    $sub = "";
//                }elseif($newtype == "RemovalistJobSheet") {
//                    $sub = "REMINDER - ";
//                }
                $emailData[0]['email_subject'] = $sub . str_replace("{{clientfirstname}}", $result[0]['clientFname'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{clientfullname}}", $result[0]['clientFname'] . ' ' . $result[0]['clientLname'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{emailTo}}", $result[0]['en_email'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{encodedata}}", $encodeData, $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{fromadd}}", $fromadd, $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{toadd}}", $toadd, $emailData[0]['email_editor']);

//                echo "<pre>";
//                print_r($result);
                if ($result[0]['en_movetype'] == 4 || $result[0]['en_movetype'] == 5) {
                    $type11 = "JobSheetP";
                } else if ($result[0]['en_movetype'] == 7 || $result[0]['en_movetype'] == 8) {
                    $type11 = "JobSheetLP";
                } else if ($result[0]['en_movetype'] == 1 || $result[0]['en_movetype'] == 2 || $result[0]['en_movetype'] == 3) {
                    $type11 = "JobSheetR";
                } else {
                    $type11 = $type;
                }
//                die;
                if (sendEmail($emailData, $type11) !== FALSE) {
                    if ($this->email_template_model->addEmailLog($emailData, $id) !== FALSE) {
                        $this->booking_model->addJobsheetMailLog($enqId);
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function sendBookingConfirmation($id, $type) {
//       echo $id;
//       die;
        $enqId = $this->booking_model->getBookingUUID($id);
        $uuid = $enqId[0]['en_unique_id'];

        $packersId = $this->contact_model->getPackerstByUUID($uuid);
//        echo "<pre>";
//        print_r($packersId);
//        die;
        foreach ($packersId as $packer) {


            if ($packer['contact_fname'] == "") {
                $packers = "null";
            } else {
                $pack[] = $packer['contact_fname'];
                $packers = implode(", ", $pack);
            }
        }


        $result = $this->booking_model->getBookingDataByBookingID($id);
        $enqId = $result[0]['enquiry_id'];
//        echo "<pre>";
//        print_r($result);
//        die;
        if ($result !== FALSE) {
            $emailTypeArray = $this->email_template_model->getEmailIDByName($type);
            if ($emailTypeArray === FALSE) {
                return false;
            }
            $emailData = $this->email_template_model->getEmailTemplate($result[0]['en_movetype'], $emailTypeArray[0]['template_master_id']);
            $packingstatus = $result[0]["en_deposit_received"];
            if ($result[0]["en_deposit_received"] == 0) {
                $packingstatus = "Unpaid";
            } else {
                $packingstatus = "Paid";
            }

            if ($result[0]["en_movingfrom_street"] != "") {
                $fromstreet = $result[0]["en_movingfrom_street"] . ", ";
            } else {
                $fromstreet = "";
            }
            if ($result[0]["en_movingto_street"] != "") {
                $tostreet = $result[0]["en_movingto_street"] . ", ";
            } else {
                $tostreet = "";
            }
            if ($result[0]["en_additional_charges"] != "0.00" && $result[0]['en_additional_charges'] != NULL) {
                $addcharge = '</br> There is also a charge of $' . $result[0]["en_additional_charges"] . ' for ' . $result[0]["en_additional_item"] . '.';
            } else {
                $addcharge = '';
            }
            $pickupdata = json_decode($result[0]['additional_pickup'], true);
            $deliverydata = json_decode($result[0]['additional_delivery'], true);

            if ($pickupdata['en_addpickup_postcode'] != "") {
                $count = count($pickupdata['en_addpickup_postcode']);
                if ($count > 0) {
                    for ($dd = 0; $dd < $count; $dd++) {
                        $pickuppostcode = $pickupdata['en_addpickup_postcode'][$dd];
                        $pickupsuburb = $pickupdata['en_addpickup_suburb'][$dd];
                        $pickupstate = $pickupdata['en_addpickup_state'][$dd];
                        $pickupstreet = $pickupdata['en_addpickup_street'][$dd];

                        if ($pickupstreet != "") {
                            $Pickup .= "Additional Pickup: " . $pickupstreet . ", " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode . "<br/>";
                            // $Pickup .= '</br>' . $pickupstreet . ", " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode;
                        } else {
                            $Pickup .= "Additional Pickup: " . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode . "<br/>";
                            // $Pickup .= '</br>' . $pickupsuburb . ", " . $pickupstate . ", " . $pickuppostcode;
                        }
                    }
                    // $Pickup = "Additional Pickup: " . $Pickup;
                    // $Pickup = '<p style="font-family: Calibri, Geneva, Helvetica, sans-serif; font-size: 14px; color: rgb(68, 84, 106); line-height: 1.4;"><span title="Moving to state"><strong>' . "Additional Pickup: " . $Pickup . '</strong></span></p>';
                    $emailData[0]['email_editor'] = str_replace("{{additionalpickup}}", $Pickup, $emailData[0]['email_editor']);
                }
            } else {
                $emailData[0]['email_editor'] = str_replace("{{additionalpickup}}", " ", $emailData[0]['email_editor']);
            }
// Delivery data display in booking........................   
//            print_r($deliverydata);
//            die;
            if ($deliverydata['en_adddelivery_postcode'] != "") {
                $count1 = count($deliverydata['en_adddelivery_postcode']);
                if ($count1 > 0) {
                    for ($zz = 0; $zz < $count1; $zz++) {
                        $deliverypostcode = $deliverydata['en_adddelivery_postcode'][$zz];
                        $deliverysuburb = $deliverydata['en_adddelivery_suburb'][$zz];
                        $deliverystate = $deliverydata['en_adddelivery_state'][$zz];
                        $deliverystreet = $deliverydata['en_adddelivery_street'][$zz];

                        if ($deliverystreet != "") {
                            $Delivery .= "Additional Delivery: " . $deliverystreet . ", " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode . "<br/>";
                            // $Delivery .= '</br>' . $deliverystreet . ", " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode;
                        } else {
                            $Delivery .= "Additional Delivery: " . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode . "<br/>";
                            // $Delivery .= '</br>' . $deliverysuburb . ", " . $deliverystate . ", " . $deliverypostcode;
                        }
                    }
                    // $Delivery = "Additional Delivery: " . $Delivery;
                    // $Delivery = '<p style="font-family: Calibri, Geneva, Helvetica, sans-serif; font-size: 14px; color: rgb(68, 84, 106); line-height: 1.4;"><span title="Moving to state"><strong>' . "Additional Delivery: " . $Delivery . '</strong></span></p>';
                    $emailData[0]['email_editor'] = str_replace("{{additionaldelivery}}", $Delivery, $emailData[0]['email_editor']);
                }
            } else {
                $emailData[0]['email_editor'] = str_replace("{{additionaldelivery}}", " ", $emailData[0]['email_editor']);
            }


            if ($emailData !== FALSE) {
                if ($emailData[0]['en_movetype'] == 4 || $emailData[0]['en_movetype'] == 5 || $emailData[0]['en_movetype'] == 7 || $emailData[0]['en_movetype'] == 8) {
                    $emailData[0]['email_editor'] = str_replace("{{amt}}", $result[0]["en_initial_sellprice"], $emailData[0]['email_editor']);
                } else {
                    $emailData[0]['email_editor'] = str_replace("{{amt}}", $result[0]["en_deposit_amt"], $emailData[0]['email_editor']);
                }

                $servicet = strrpos($result[0]['en_servicetime'], "-");
                if ($emailData[0]['en_movetype'] == 1 || $emailData[0]['en_movetype'] == 2) {
                    if ($servicet > 0) {
                        //$emailData[0]['email_editor'] = str_replace("{{datetime}}", "between " . $result[0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                    } else {
                        //$emailData[0]['email_editor'] = str_replace("{{datetime}}", "at " . $result[0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                    }
                } else {
                    //$emailData[0]['email_editor'] = str_replace("{{datetime}}", $result[0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                }

                //DRC@DS
                $emailData[0]['email_editor'] = str_replace("{{datetime}}", $result[0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);

                $emailData[0]['email_to'] = $result[0]['en_email'];
                //  $emailData[0]['email_editor'] = str_replace("{{amt}}", $result[0]["en_deposit_amt"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{uuid}}", $result[0]["en_unique_id"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofmover}}", $result[0]["en_no_of_movers"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{nooftruck}}", $result[0]["en_no_of_trucks"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromstate}}", $result[0]["en_movingfrom_state"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromstreet}}", $fromstreet, $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfrompostcode}}", $result[0]["en_movingfrom_postcode"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromsuburb}}", $result[0]["en_movingfrom_suburb"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtostate}}", $result[0]["en_movingto_state"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtostreet}}", $tostreet, $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtopostcode}}", $result[0]["en_movingto_postcode"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtosuburb}}", $result[0]["en_movingto_suburb"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{additionalcharges}}", $addcharge, $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{additionalchargeitem}}", $result[0]["en_additional_item"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{hourlyrate}}", (int) $result[0]["en_client_hourly_rate"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialsellprice}}", (int) $result[0]["en_initial_sellprice"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofladiesbooked}}", $result[0]["en_ladies_booked"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $result[0]["en_initial_hours_booked"], $emailData[0]['email_editor']);
                //  $emailData[0]['email_editor'] = str_replace("{{datetime}}", "between " . $result[0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{tavelfee}}", number_format($result[0]["en_travelfee"], 2), $emailData[0]['email_editor']);
                $emailData[0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{clientfirstname}}", $result[0]['en_fname'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{clientname}}", $result[0]['clientFname'], $emailData[0]['email_editor']);
                $emailData[0]['email_subject'] = str_replace("{{clientfirstname}}", $result[0]['clientFname'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{clientfullname}}", $result[0]['clientFname'] . ' ' . $result[0]['clientLname'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{emailTo}}", $result[0]['en_email'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{status}}", $packingstatus, $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{packers}}", $packers, $emailData[0]['email_editor']);
//                print_r($result[0]['en_movetype']);
//                die;

                if ($result[0]['en_movetype'] == 4 || $result[0]['en_movetype'] == 5) {
                    //   echo "hiiii";
                    $type11 = "BookingConfirmationP";
                    // $type11 = "BP";
                } else if ($result[0]['en_movetype'] == 7 || $result[0]['en_movetype'] == 8) {
                    //   echo "hiiii";
                    $type11 = "BookingConfirmationLP";
                    // $type11 = "BP";
                } else if ($result[0]['en_movetype'] == 1 || $result[0]['en_movetype'] == 2 || $result[0]['en_movetype'] == 3) {
                    $type11 = "BookingConfirmationR";
                } else {
                    $type11 = $type;
                }

                if (sendEmail($emailData, $type11) !== FALSE) {
                    if ($this->email_template_model->addEmailLog($emailData, $id) !== FALSE) {
                        $this->booking_model->addBookingConfirmationMailLog($enqId);
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function sendFeedback($id, $type) {
//       echo $id;
//       die;
        $enqId = $this->booking_model->getBookingUUID($id);
        $uuid = $enqId[0]['en_unique_id'];

        $packersId = $this->contact_model->getPackerstByUUID($uuid);
//        echo "<pre>";
//        print_r($packersId);
//        die;
        if ($packersId[0]['contact_fname'] == "") {
            $packers = "null";
        } else {
            $packers = $packersId[0]['contact_fname'];
        }
        $result = $this->booking_model->getBookingDataByBookingID($id);

        if ($result !== FALSE) {
            $emailTypeArray = $this->email_template_model->getEmailIDByName($type);
            if ($emailTypeArray === FALSE) {
                return false;
            }
            $emailData = $this->email_template_model->getEmailTemplate($result[0]['en_movetype'], $emailTypeArray[0]['template_master_id']);
            $packingstatus = $result[0]["en_deposit_received"];
            if ($result[0]["en_deposit_received"] == 0) {
                $packingstatus = "Unpaid";
            } else {
                $packingstatus = "Paid";
            }
            if ($emailData !== FALSE) {
                $emailData[0]['email_to'] = $result[0]['en_email'];
                $emailData[0]['email_editor'] = str_replace("{{amt}}", $result[0]["en_deposit_amt"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{uuid}}", $result[0]["en_unique_id"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofmover}}", $result[0]["en_no_of_movers"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{nooftruck}}", $result[0]["en_no_of_trucks"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromstate}}", $result[0]["en_movingfrom_state"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromstreet}}", $result[0]["en_movingfrom_street"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfrompostcode}}", $result[0]["en_movingfrom_postcode"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromsuburb}}", $result[0]["en_movingfrom_suburb"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtostate}}", $result[0]["en_movingto_state"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtostreet}}", $result[0]["en_movingto_street"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtopostcode}}", $result[0]["en_movingto_postcode"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtosuburb}}", $result[0]["en_movingto_suburb"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{additionalcharges}}", $result[0]["en_additional_charges"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{additionalchargeitem}}", $result[0]["en_additional_item"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{hourlyrate}}", (int) $result[0]["en_client_hourly_rate"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialsellprice}}", (int) $result[0]["en_initial_sellprice"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofladiesbooked}}", $result[0]["en_ladies_booked"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $result[0]["en_initial_hours_booked"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{datetime}}", "Between " . $result[0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{tavelfee}}", (int) $result[0]["en_travelfee"], $emailData[0]['email_editor']);
                $emailData[0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{clientfirstname}}", $result[0]['en_fname'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{clientname}}", $result[0]['clientFname'], $emailData[0]['email_editor']);
                $emailData[0]['email_subject'] = str_replace("{{clientfirstname}}", $result[0]['clientFname'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{clientfullname}}", $result[0]['clientFname'] . ' ' . $result[0]['clientLname'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{emailTo}}", $result[0]['en_email'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{status}}", $packingstatus, $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{packers}}", $packers, $emailData[0]['email_editor']);
//                print_r($emailData);
//                die;

                if ($result[0]['en_movetype'] == 4 || $result[0]['en_movetype'] == 5) {
                    $type11 = "SendFeedbackP";
                } else if ($result[0]['en_movetype'] == 7 || $result[0]['en_movetype'] == 8) {
                    $type11 = "SendFeedbackLP";
                } else if ($result[0]['en_movetype'] == 1 || $result[0]['en_movetype'] == 2 || $result[0]['en_movetype'] == 3) {
                    $type11 = "SendFeedbackR";
                } else {
                    $type11 = $type;
                }
                if (sendEmail($emailData, $type11) !== FALSE) {
                    if ($this->email_template_model->addEmailLog($emailData, $id) !== FALSE) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function sendReminder($id, $type) {

        $enqId = $this->booking_model->getBookingUUID($id);
        $uuid = $enqId[0]['en_unique_id'];

        $packersId = $this->contact_model->getPackerstByUUID($uuid);

        if ($packersId[0]['contact_fname'] == "") {
            $packers = "null";
        } else {
            $packers = $packersId[0]['contact_fname'];
        }
        $result = $this->booking_model->getBookingDataByBookingID($id);

        if ($result !== FALSE) {
            $emailTypeArray = $this->email_template_model->getEmailIDByName($type);
            if ($emailTypeArray === FALSE) {
                return false;
            }
            $emailData = $this->email_template_model->getEmailTemplate($result[0]['en_movetype'], $emailTypeArray[0]['template_master_id']);
            $packingstatus = $result[0]["en_deposit_received"];
            if ($result[0]["en_deposit_received"] == 0) {
                $packingstatus = "Unpaid";
            } else {
                $packingstatus = "Paid";
            }

            $servicet = strrpos($result[0]['en_servicetime'], "-");
            if ($servicet > 0) {
                $emailData[0]['email_editor'] = str_replace("{{datetime}}", "Your move is estimated to start between " . $result[0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ". The guys will give you a call if they are running late.", $emailData[0]['email_editor']);
            } else {
                $emailData[0]['email_editor'] = str_replace("{{datetime}}", "Your move is booked in for " . date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_editor']);
            }

            if ($emailData !== FALSE) {
                $emailData[0]['email_to'] = $result[0]['en_email'];
                $emailData[0]['email_editor'] = str_replace("{{amt}}", $result[0]["en_deposit_amt"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{uuid}}", $result[0]["en_unique_id"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofmover}}", $result[0]["en_no_of_movers"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{nooftruck}}", $result[0]["en_no_of_trucks"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromstate}}", $result[0]["en_movingfrom_state"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromstreet}}", $result[0]["en_movingfrom_street"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfrompostcode}}", $result[0]["en_movingfrom_postcode"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromsuburb}}", $result[0]["en_movingfrom_suburb"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtostate}}", $result[0]["en_movingto_state"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtostreet}}", $result[0]["en_movingto_street"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtopostcode}}", $result[0]["en_movingto_postcode"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtosuburb}}", $result[0]["en_movingto_suburb"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{additionalcharges}}", $result[0]["en_additional_charges"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{additionalchargeitem}}", $result[0]["en_additional_item"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{hourlyrate}}", (int) $result[0]["en_client_hourly_rate"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialsellprice}}", (int) $result[0]["en_initial_sellprice"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofladiesbooked}}", $result[0]["en_ladies_booked"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $result[0]["en_initial_hours_booked"], $emailData[0]['email_editor']);
                //  $emailData[0]['email_editor'] = str_replace("{{datetime}}", "Between " . $result[0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{tavelfee}}", (int) $result[0]["en_travelfee"], $emailData[0]['email_editor']);
                $emailData[0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{clientfirstname}}", $result[0]['en_fname'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{clientname}}", $result[0]['clientFname'], $emailData[0]['email_editor']);
                $emailData[0]['email_subject'] = str_replace("{{clientfirstname}}", $result[0]['clientFname'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{clientfullname}}", $result[0]['clientFname'] . ' ' . $result[0]['clientLname'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{emailTo}}", $result[0]['en_email'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{status}}", $packingstatus, $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{packers}}", $packers, $emailData[0]['email_editor']);
//                print_r($emailData);
//                die;

                if ($result[0]['en_movetype'] == 4 || $result[0]['en_movetype'] == 5) {
                    $type11 = "SendReminderP";
                } else if ($result[0]['en_movetype'] == 7 || $result[0]['en_movetype'] == 8) {
                    $type11 = "SendReminderLP";
                } else if ($result[0]['en_movetype'] == 1 || $result[0]['en_movetype'] == 2 || $result[0]['en_movetype'] == 3) {
                    $type11 = "SendReminderR";
                } else {
                    $type11 = $type;
                }
                if (sendEmail($emailData, $type11) !== FALSE) {
                    if ($this->email_template_model->addEmailLog($emailData, $id) !== FALSE) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function contactemail_check($contact_email) {
        if (!empty($contact_email) && !filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
            $this->form_validation->set_message('contactemail_check', 'Email address is not valid');
            return false;
        } else {
            return true;
        }
    }

    /* No Answer Feedback email...............@DRCZ 17-5-2018 */

    private function sendNoAnswerFeedback($id, $type) {
//       echo $id;
//       die;
        $enqId = $this->booking_model->getBookingUUID($id);
        $uuid = $enqId[0]['en_unique_id'];

        $packersId = $this->contact_model->getPackerstByUUID($uuid);
//        echo "<pre>";
//        print_r($packersId);
//        die;
        if ($packersId[0]['contact_fname'] == "") {
            $packers = "null";
        } else {
            $packers = $packersId[0]['contact_fname'];
        }
        $result = $this->booking_model->getBookingDataByBookingID($id);

        if ($result !== FALSE) {
            $emailTypeArray = $this->email_template_model->getEmailIDByName($type);
            if ($emailTypeArray === FALSE) {
                return false;
            }
            $emailData = $this->email_template_model->getEmailTemplate($result[0]['en_movetype'], $emailTypeArray[0]['template_master_id']);
            $packingstatus = $result[0]["en_deposit_received"];
            if ($result[0]["en_deposit_received"] == 0) {
                $packingstatus = "Unpaid";
            } else {
                $packingstatus = "Paid";
            }
            if ($emailData !== FALSE) {
                $emailData[0]['email_to'] = $result[0]['en_email'];
                $emailData[0]['email_editor'] = str_replace("{{amt}}", $result[0]["en_deposit_amt"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{uuid}}", $result[0]["en_unique_id"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofmover}}", $result[0]["en_no_of_movers"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{nooftruck}}", $result[0]["en_no_of_trucks"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromstate}}", $result[0]["en_movingfrom_state"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromstreet}}", $result[0]["en_movingfrom_street"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfrompostcode}}", $result[0]["en_movingfrom_postcode"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingfromsuburb}}", $result[0]["en_movingfrom_suburb"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtostate}}", $result[0]["en_movingto_state"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtostreet}}", $result[0]["en_movingto_street"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtopostcode}}", $result[0]["en_movingto_postcode"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{movingtosuburb}}", $result[0]["en_movingto_suburb"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{additionalcharges}}", $result[0]["en_additional_charges"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{additionalchargeitem}}", $result[0]["en_additional_item"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{hourlyrate}}", $result[0]["en_client_hourly_rate"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialsellprice}}", $result[0]["en_initial_sellprice"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{noofladiesbooked}}", $result[0]["en_ladies_booked"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{initialhoursbooked}}", (int) $result[0]["en_initial_hours_booked"], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{datetime}}", "Between " . $result[0]['en_servicetime'] . " on " . date('d/m/Y', strtotime($result[0]['en_servicedate'])), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{tavelfee}}", (int) $result[0]["en_travelfee"], $emailData[0]['email_editor']);
                $emailData[0]['email_subject'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{subjectdatetime}}", date('d/m/Y', strtotime($result[0]['en_servicedate'])) . ' ' . $result[0]['en_servicetime'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{sendername}}", $this->session->userdata('admin_firstname') . ' ' . $this->session->userdata('admin_lastname'), $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{clientfirstname}}", $result[0]['en_fname'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{clientname}}", $result[0]['clientFname'], $emailData[0]['email_editor']);
                $emailData[0]['email_subject'] = str_replace("{{clientfirstname}}", $result[0]['clientFname'], $emailData[0]['email_subject']);
                $emailData[0]['email_editor'] = str_replace("{{clientfullname}}", $result[0]['clientFname'] . ' ' . $result[0]['clientLname'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{emailTo}}", $result[0]['en_email'], $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{status}}", $packingstatus, $emailData[0]['email_editor']);
                $emailData[0]['email_editor'] = str_replace("{{packers}}", $packers, $emailData[0]['email_editor']);
//                print_r($emailData);
//                die;

                if ($result[0]['en_movetype'] == 4 || $result[0]['en_movetype'] == 5) {
                    $type11 = "NoAnswerFeedbackP";
                } else if ($result[0]['en_movetype'] == 7 || $result[0]['en_movetype'] == 8) {
                    $type11 = "NoAnswerFeedbackLP";
                } else if ($result[0]['en_movetype'] == 1 || $result[0]['en_movetype'] == 2 || $result[0]['en_movetype'] == 3) {
                    $type11 = "NoAnswerFeedbackR";
                } else {
                    $type11 = $type;
                }
                if (sendEmail($emailData, $type11) !== FALSE) {
                    if ($this->email_template_model->addEmailLog($emailData, $id) !== FALSE) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function sendFeedbackReminder($id,$type){
        $res=$this->enquiry_model->getEnquiryPartialDataByEnquiryId($id);
        $clientName= $res[0]['en_fname'] . ' ' . $res[0]['en_lname'];
        $subject = $clientName . ', ' . date("d-m-Y", strtotime($res[0]['en_servicedate'])). ' ('.$res[0]['en_movingfrom_state'].')';
        $emaildata[0] = array(
            'email_from' => 'info@hireamover.com.au',
            'email_to' => 'info@hireamover.com.au',
            'email_bcc' => '',
            'email_cc' => '',
            'email_subject' => 'Feedback required for ' . $subject,
            'email_editor' => "Please contact <a href=" . base_url('/booking/viewBooking/' . $res[0]['en_unique_id']) . ">" . $clientName . "</a>" . " to obtain feedback on this job",
        );
        if (sendEmail($emaildata, 'feedbackreminder') !== FALSE) {
            // $this->email_template_model->addAutoEmailLog($emaildata, $res[0]['enquiry_id']);
            return true;
        }
    }

    public function sendWarningJobsheetMail($type,$id){
        $res=$this->enquiry_model->getEnquiryPartialDataByEnquiryId($id);
        $clientName= $res[0]['en_fname'] . ' ' . $res[0]['en_lname'];
        $subject = $clientName . ', ' . date("d-m-Y", strtotime($res[0]['en_servicedate'])). ' ('.$res[0]['en_movingfrom_state'].')';
        $emaildata[0] = array(
            'email_from' => 'info@hireamover.com.au',
            'email_to' => 'brett@hireamover.com.au',
            'email_bcc' => '',
            'email_cc' => '',
            'email_subject' => 'There is no eway reference number or EFT payment date ' . $subject,
            'email_editor' => "Link <a href=" . base_url('/booking/viewBooking/' . $res[0]['en_unique_id']) . ">" . $clientName . "</a>" . " to obtain further details on this booking.",
        );
        if (sendEmail($emaildata, 'feedbackreminder') !== FALSE) {
            // $this->email_template_model->addAutoEmailLog($emaildata, $res[0]['enquiry_id']);
            return true;
        }
    }

    public function getEmailMasterId() {
        $mailLogCount = $this->enquiry_model->getEmailMasterId();
        $responseArr = array();
        if ($mailLogCount > 0) {
            $responseArr['code'] = '1';
            $responseArr['msg'] = 'Please note a quote has already been sent for this client. Are you sure you would like to send another one?';
        } else {
            $responseArr['code'] = '0';
            // $responseArr['msg']="";
        }
        echo json_encode($responseArr);
    }

}
