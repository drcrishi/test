<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!--<style>
td.details-control {
    background: url('http://www.bimbinganalumniui.com/old/assets/datatable/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('http://www.bimbinganalumniui.com/old/assets/datatable/examples/resources/details_close.png') no-repeat center center;
}
</style>-->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <?php include "template/leftmenu.php"; ?>
        <!-- END HEADER -->

        <!-- BEGIN CONTENT -->
        <div class="page-content">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase"> Managed Table</span>
                                </div>                                  
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="example">
                                    <thead>
                                        <tr> 
                                            <th></th>
                                            <th>Move Type</th>
                                            <th>Office</th>
                                            <th>Service Date</th>
                                            <th>Service Time</th>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Phone</th> 
                                        </tr>
                                    </thead>										
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->

    </div>
    <!-- END CONTAINER -->
</div>
<script>
    $(document).ready(function () {
        var table = $('#example').DataTable({
            "ajax": "ajax-data.php",
            "columns": [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {"data": "en_movetype"},
                {"data": "en_home_office"},
                {"data": "en_servicedate"},
                {"data": "en_servicetime"},
                {"data": "en_fname"},
                {"data": "en_lname"},
                {"data": "en_phone"}
            ],
            "order": [[1, 'asc']]
        });
    });
</script>
<div class="quick-nav-overlay"></div>
