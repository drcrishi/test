<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body class=" login">
    <!-- BEGIN LOGO -->
    <div class="logo">
            <span class="logo-slogan">Hire A Mover CRM</span>
            <img src="<?php echo base_url('assets/img/crm-login-logo.png'); ?>" alt="" /> 
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->        
        <form class="login-form">
            <h3 class="form-title font-green">Sign In</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span> Enter any username and password. </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="username" /> </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
            <div class="form-actions">
                <button type="submit" class="btn green uppercase loginBtn  mt-ladda-btn ladda-button" data-style="slide-right">
                    <span class="ladda-label">Login</span>
                </button>
<!--                <label class="rememberme check mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1" />Remember
                    <span></span>
                </label>-->
            </div>
            <div>
                <a href="#" class="forgotpwd" id="forget-password">Forgot your password?</a>
            </div>
        </form>
        <!--        <a href="#" id="forget-password">Forgot your password?</a>-->
        <form class="forget-form">
            <h3 class="form-title font-green">Reset Your Password</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span> </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email<span class="required">*</span></label>
                <span class="error"></span>
                <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="username" required/>
            </div> 
            <div class="form-actions">
                <button type="submit" class="btn green uppercase mt-ladda-btn ladda-button" data-style="slide-right">
                    <span class="ladda-label">Send Email</span>
                </button>
            </div>
        </form>
        <!-- END LOGIN FORM -->        
    </div>
