jQuery(document).ready(function () {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "positionClass": "toast-center-center",
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
               // "timeOut": "5000",
                "timeOut": "1000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
          //  toastr.<?php echo $type; ?>('<?php echo $message; ?>');
        });