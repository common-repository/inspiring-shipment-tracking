



jQuery(document).ready(function($) {
    $( "#savetracking" ).click(function() {
        var carrier_name                = $("#carrier_name").val();
        var service_name                = $("#service_name").val();
        var tracking_number             = $("#tracking_number").val();
        var custom_tracking_link        = $("#custom_tracking_link").val();
        var date_shipped                = $("#date_shipped").val();
        var order_id_for_track          = $("#order_id_for_track").val();

        if(tracking_number == ''){
            alert('please enter tracking number');
            return;
        }
        if(date_shipped == ''){
            alert('please enter date shipped');
            return;
        }
        $(this).attr("disabled",true);
        $.ajax({
            url: insp_track_obj.ajaxurl,
            data: {
                'action'                        : 'post_ajax_request',
                'carrier_name'                  : carrier_name,
                'service_name'                  : service_name,
                'tracking_number'               : tracking_number,
                'custom_tracking_link'          : custom_tracking_link,
                'date_shipped'                  : date_shipped,
                'order_id_for_track'            : order_id_for_track,
                'security'                      : insp_track_obj.ajax_nonce,
            },
            success:function(data) {
                $("#savetracking").attr("disabled",false);

                var datas = JSON.parse(data);

                if(datas.success == 'true'){
                    $("#updatedtrack").show();
                }

            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    });
});