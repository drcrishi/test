<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function isLogin() {
    $CI = & get_instance();
    if ($CI->session->userdata('admin_id')) {
        return true;
    }
    return false;
}
function isLoginUser() {
    $CI = & get_instance();
    if ($CI->session->userdata('contact_email') || $CI->session->userdata('contact_id')) {
        return true;
    }
    return false;
}
