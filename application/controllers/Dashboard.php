<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
        $this->data['title'] = "CRM User Dashboard";
        
        
        $this->load->model("enquiry_model");
        $this->data['jsTPFooter'] = array('https://www.gstatic.com/charts/loader.js');
        $this->data['jsFooter'] = array('pages/scripts/dashboard.js');      
        $data['todayNewEnquiry']=$this->enquiry_model->getCountTodayNewEnquiry();
        $data['todayNewBooking']=$this->enquiry_model->getCountTodayNewBooking();
        $data['tomorrowNewBooking']=$this->enquiry_model->getCountTomorrowNewBooking();
        $data['yesterDayNewEnquiry']=$this->enquiry_model->getCountYesterDayNewEnquiry();
        $data['yesterDayNewBooking']=$this->enquiry_model->getCountYesterDayNewBooking();
        $data['thismonthBookings']=$this->enquiry_model->getThismonthBookings();//For current month all bookings
        $data['getEnquiryChartDataByMonth']=$this->enquiry_model->getChartDataByYearNew();//For Enquiry
         $data['getChartForFiveMonth']=$this->enquiry_model->getChartDataByFiveMonth();//For Booking-enquiry 5 month's data on graph
         // prd($data);

//        $data['getEnquiryChartDataByYear']=$this->enquiry_model->getChartDataByYearNew();//For Enquiry
        
//        echo "<pre>";
//        print_r($data);
//        die;
     
//        die;
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('dashboard_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function profile() {
        $this->data['title'] = "User Profile";
        $data['css'] = array(
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
            'pages/css/profile-2.min.css',
        );
        $data['jsTPFooter'] = array(
            'http://maps.google.com/maps/api/js?sensor=false'
        );
        $data['jsFooter'] = array(
            'global/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
            'global/plugins/gmaps/gmaps.min.js'
        );
        $this->load->view("template/header", $this->data);
        $this->load->view("template/css", $data);
        $this->load->view("template/js", $data);
        $this->load->view('profile_view.php', $this->data);
        $this->load->view("template/footer", $this->data);
    }

    public function infophp(){
        phpinfo();
    }
    public function testEmail() {
#        echo "<pre>";
        die;
#        print_r(stream_get_transports());
#        die;
        $email = $this->config->item('QuoteLP');
//        echo "<pre>";
//        print_r($email);
//        die;
        $this->email->initialize($email);
        $this->email->from('info@luxepackers.com.au');
        $this->email->to('darshak.shah@drcinfotech.com');
        $this->email->subject('Test email from CI and Gmail');
        ob_start();
        ?>
        <style type="text/css">
            body {
                font-family: Tahoma, Verdana, Arial;
                margin: 0px;
                position: absolute;
                height: 95%;
                width: 95%;
                font-size: 12px;
            }

            pre.mscrmpretag {
                word-wrap: break-word;
                white-space: pre-wrap;
            }
        </style>
        <div>
            <style>
                @font-face {
                    font-family: Calibri;
                }

                @font-face {
                    font-family: Lato-Regular;
                }

                p.MsoNormal,
                li.MsoNormal,
                div.MsoNormal {
                    margin: 0cm;
                    margin-bottom: .0001pt;
                    font-size: 11.0pt;
                    font-family: Calibri, sans-serif;
                }
            </style>
            <style>
                html,
                body {
                    color: #393939;
                    margin: 0px;
                    padding: 0px;
                    background: #e9e9e9;
                }

                html,
                body,
                p,
                td {
                    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                    color: #393939;
                }

                p {
                    margin-bottom: 15px;
                    color: #393939;
                }
            </style>
            <div style="margin: 0px auto" align="center">
                <table width="600" cellspacing="0" cellpadding="0" border="0" align="center">
                    <tbody>
                        <tr>
                            <td style="background-color: #e9e9e9;" valign="top" bgcolor="#e9e9e9;" align="center">
                                <br>
                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                        <tr>
                                            <td valign="top" align="left">
                                                <table width="100%" cellspacing="15" cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                    <tbody>
                                                                        <tr border="0" cellspacing="0" cellpadding="0">
                                                                            <td colspan="4" border="0" cellspacing="0" cellpadding="0">
                                                                                <a href="tel:1300366522"><img src="http://hireamover.com.au/wp-content/themes/Avada-Child-Theme/images/hap-email-header.jpg" alt="Hire A Packer" style="float: left; display: inline-block;"></a>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="background-color:#ffffff;" border="0" cellspacing="0" cellpadding="0">
                                                                            <td border="0" cellspacing="0" cellpadding="0" colspan="4" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 18px; color: #525252; line-height: 1.4; text-align:center;padding: 0 30px;" valign="top" align="center">
                                                                                <p style="font-size: 18px;margin: 30px 0; color:#393939;">Thanks for requesting a quote from Hire A Packer.
                                                                                    <br>We are available at {{datetime}}.</p>
                                                                                <table style="border-top: 1px solid #f58220;border-bottom: 1px solid #f58220;" width="100%" bgcolor="#fff5ec">
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td style="padding: 0 80px; text-align: center;">
                                                                                                <h2 style="font-size: 38px; color:#f58220 !important; margin-bottom: 20px;line-height:1.2; text-align: center;">{{noofmover}} professional packers for {{noofhrs}} hours</h2>
                                                                                                <p><span style="font-size: 40px; color:#39383B !important;">${{amt}}</span> (incl. GST)
                                                                                                    <br>
                                                                                                </p>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <h3 style="font-size: 30px; color:#f58220;font-weight: normal; margin-bottom: 20px;line-height:1.2;">Secure your booking within 24 hours by making payment!</h3></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width:100%;text-align:center;color:#fff;font-weight:bold;font-size:30px;padding:20px 0;background:#f58220;border-bottom: 4px solid #b4621a;text-decoration:none;"><a href="https://www.hireamover.com.au/hire-a-packer-payment?amt={{amt}}&amp;id={{uuid}}" style="color:#fff;text-decoration:none;">SECURE MY BOOKING &gt;</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4" height="15"></td>
                                                                        </tr>
                                                                        <tr style="background: #ffffff">
                                                                            <td colspan="4" height="15"></td>
                                                                        </tr>
                                                                        <tr style="background: #ffffff">
                                                                            <td colspan="4" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size:18px; color:#393939;text-align:left;padding:15px;" valign="top" align="center">
                                                                                <h3 style="font-weight:normal;text-align: center;font-size: 30px;color: #393939;">Frequently Asked Questions</h3>
                                                                                <p><strong>Why should I use Hire A Packer?</strong>
                                                                                    <br>Our packing service reduces the risk of damage to your belongings, saves you time and helps ensure you are organised. You don't move every day so why not help reduce the stress of moving. Our mature female packers are experienced, police-checked and friendly.</p>
                                                                                <p><strong>How much will be packed in the 4 hour period?</strong>
                                                                                    <br>Generally, each packer packs 4-5 boxes per hour. In a standard 4 hour booking for 2 packers, you can expect 30-40 boxes to be packed which covers a typical kitchen and 1-2 other rooms.</p>
                                                                                <p><strong>What happens if I need additional hours?</strong>
                                                                                    <br>If you know upfront you will require additional hours, please let us know prior to booking. On the day if you require additional hours, please let the packers know as they can generally extend.</p>
                                                                                <p><strong>Does the quote include boxes and packaging materials?</strong>
                                                                                    <br>The price does not include boxes or packaging materials. You can hire or buy these items through our sister company Hire A Box and enjoy a 10% discount. For every 4 hours of packing we recommend having 40 boxes and 10kg of butchers paper.</p>
                                                                                <p><strong>Can you help with the unpack too?</strong>
                                                                                    <br>Hire A Packer also offers a professional unpack service to ensure you settle in as quickly as possible. If you require a quote for this, please fill out your details and date for the service <a href="http://www.hireapacker.com.au/quote/">here</a>.</p>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width:100%;text-align:center;color:#fff;font-weight:bold;font-size:30px;padding:20px 0;background:#f58220;border-bottom: 4px solid #b4621a;text-decoration:none;"><a href="http://www.hireapacker.com.au/faq/" style="color:#fff;text-decoration:none;">READ MORE FAQs &gt;</a></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; font-size:18px; color:#393939;" valign="top" align="center">
                                                                                <h3 style="font-size: 30px; font-weight: normal;margin-bottom:15px;margin-top:50px;color: #393939;">Why not take advantage of our other professional moving services</h3>
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td height="15"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr border="0" cellspacing="0" cellpadding="0">
                                                                                            <td border="0" cellspacing="0" cellpadding="0"><img src="http://hireamover.com.au/wp-content/themes/Avada-Child-Theme/images/hire-a-box-1.jpg" alt="Hire A Box" style="float:left"></td>
                                                                                            <td bgcolor="#ffffff">
                                                                                                <h4 style="font-size: 22px; color:#1f3e97;width:85%;margin: 0 auto 15px;">Hire or buy your Boxes and Packing Materials with Hire A Box</h4>
                                                                                                <p style="width:85%; margin: 0 auto 15px;"><strong>Hire your boxes from $1.96 each, includes a 10% rebate when you move with<br>Hire A Mover!</strong></p>
                                                                                                <p style="width:85%;margin: 0 auto 15px;"><a href="https://www.hireabox.com.au/" style="text-decoration:none;text-transform: uppercase; color:#f58220;"><strong>Order Your Boxes &gt;</strong></a></p>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td height="15"></td>
                                                                                        </tr>
                                                                                        <tr border="0" cellspacing="0" cellpadding="0">
                                                                                            <td bgcolor="#ffffff">
                                                                                                <h4 style="font-size: 22px; color:#1f3e97;width:85%;margin: 0 auto 15px;">Hire professional removalist services with Hire A Mover</h4>
                                                                                                <p style="width:85%;margin: 0 auto 15px;">From $120 / hour for 2 men and a truck. Friendly, cost effective and fully insured.</p>
                                                                                                <p style="width:85%;margin: 0 auto 15px;"><a href="https://www.hireamover.com.au/" style="text-decoration:none;text-transform: uppercase; color:#f58220;"><strong>GET A QUOTE &gt;</strong></a></p>
                                                                                            </td>
                                                                                            <td border="0" cellspacing="0" cellpadding="0"><img src="http://hireamover.com.au/wp-content/themes/Avada-Child-Theme/images/hire-a-mover-1.jpg" alt="Hire A Mover" style="float:left"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4" height="15"></td>
                                                                        </tr>
                                                                        <tr border="0" cellspacing="0" cellpadding="0">
                                                                            <td colspan="4" style="padding: 30px 0px 0 30px;" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
                                                                                <p style="color:#393939; font-size: 18px;margin-bottom: 15px;">We look forward to working with you soon!</p>
                                                                                <p style="color:#393939; font-size: 18px;margin-bottom: 15px;">Kind regards,</p>
                                                                                <p style="color:#393939; font-size: 18px;margin-bottom: 15px;">The Customer Service Team, Hire A Packer</p>
                                                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                                                    <tbody>
                                                                                        <tr border="0" cellspacing="0" cellpadding="0">
                                                                                            <td border="0" cellspacing="0" cellpadding="0" valign="top" align="left">
                                                                                                <table cellspacing="0" cellpadding="0" border="0">
                                                                                                    <tbody>
                                                                                                        <tr border="0" cellspacing="0" cellpadding="0">
                                                                                                            <td border="0" cellspacing="0" cellpadding="0">
                                                                                                                <p style="font-family: " helvetica="" neue ",helvetica,arial,sans-serif;=" " font-size:18px;=" " color:#1f3e97;font-weight:bold;margin-bottom:5px;=" " margin-top:8px;"="">Ph 1300 366 522</p>
                                                                                                                <p style="font-family: " helvetica="" neue ",helvetica,arial,sans-serif;=" " font-size:18px;=" " color:#1f3e97;font-weight:bold;margin-bottom:0px;=" " margin-top:8px;"=""><a href="mailto:info@hireapacker.com.au" style="font-family: " helvetica="" neue ",helvetica,arial,sans-serif;=" " font-size:18px;=" " color:#1f3e97;font-weight:bold;text-decoration:none;"="">info@hireapacker.com.au</a></p>
                                                                                                                <p style="font-family: " helvetica="" neue ",helvetica,arial,sans-serif;=" " font-size:18px;=" " color:#1f3e97;font-weight:bold;margin-bottom:0px;=" " margin-top:8px;"=""><a href="http://www.hireapacker.com.au" style="font-family: " helvetica="" neue ",helvetica,arial,sans-serif;=" " font-size:18px;=" " color:#1f3e97;font-weight:bold;text-decoration:none;"="">www.hireapacker.com.au</a></p>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </td>
                                                                                            <td align="center"></td>
                                                                                            <td border="0" cellspacing="0" cellpadding="0" align="right">
                                                                                                <a href="http://www.hireapacker.com.au"><img style="float:right;" src="http://hireamover.com.au/wp-content/themes/Avada-Child-Theme/images/packing-top.png" alt="Hire A Packer Top"></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr border="0" cellspacing="0" cellpadding="0">
                                                                            <td colspan="4" border="0" cellspacing="0" cellpadding="0" style="border-bottom: solid 3px #004A93;" align="right"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4" height="50"></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="4" style="font-family: " helvetica="" neue ",helvetica,arial,sans-serif;=" " font-size:12px;=" " color:#393939;text-align:center;padding:0=" " 7%;"="" valign="top" align="left">
                                                                                <p style="font-family: " helvetica="" neue ",helvetica,arial,sans-serif;=" " font-size:=" " 12px;=" " color:=" " #393939;margin-bottom:15px;line-height:1.5;"="">Hire A Packer Operations Centre, 36 James Craig Road, Rozelle NSW 2039.
                                                                               <br>© 2017 Hire A Packer Pty Ltd.</p>
                                                                                <p style="font-family: " helvetica="" neue ",helvetica,arial,sans-serif;=" " font-size:=" " 12px;=" " color:=" " #393939;margin-bottom:15px;line-height:1.5;"="">This email and any attachments are confidential. If you are not the intended recipient, you must not disclose or use the information contained in it. If you have received this email in error, please notify Hire A Packer immediately by return email and delete the document.</p>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        $aaa = ob_get_contents();
        //$aaa="darshak";
        ob_clean();
        $this->email->message($aaa);
        var_dump($this->email->send());
        echo $this->email->print_debugger();
    }

}
