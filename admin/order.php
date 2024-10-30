<?php
class insp_track_order{
    function __construct(){
        add_action("add_meta_boxes", array($this,"add_order_meta_box"));
        add_action( 'admin_enqueue_scripts', array($this,'js_enqueue' ));
        add_action( 'wp_ajax_post_ajax_request',  array($this,'post_ajax_request') );
        add_action( 'wp_ajax_nopriv_post_ajax_request',  array($this,'post_ajax_request') );

    }
    function add_order_meta_box(){
        add_meta_box("track-meta-box", __("Shipment Tracking"), array($this,"track_meta_box_markup"), "shop_order", "side", "high", null);

    }
    function track_meta_box_markup($object)
    {

        $oldmeta = get_post_meta( $object->ID, 'insp_track_number', true );
        ?>

        <div class="updated inline" id="updatedtrack" style="display: none"><p><?php _e('Tracking Number successfully installed');?></p></div>
        <input type="hidden" value="<?php echo $object->ID;?>" name="order_id_for_track" id="order_id_for_track">
        <div id="shipment-tracking-form">
            <p class="form-field tracking_provider_field">
                <label for="carrier_name"><?php _e('Carrier Name');?>:</label>
                <br>
                <input type="text" class="short" style="" name="carrier_name" id="carrier_name" value="<?php if($oldmeta != '' || !empty($oldmeta)){echo $oldmeta['carrier_name'];}?>" placeholder="">
            </p>
            <p class="form-field tracking_number_field " id="custom_tracking_provider_field">
                <label for="service_name">
                    <?php _e('Service Name');?>:
                </label>
                <input type="text" class="short" style="" name="service_name" id="service_name" value="<?php if($oldmeta != '' || !empty($oldmeta)){echo $oldmeta['service_name'];}?>" placeholder="">
            </p>
            <p class="form-field tracking_number_field ">
                <label for="tracking_number">
                    <?php _e('Tracking Number');?>
                </label>
                <input type="text" class="short" style="" name="tracking_number" id="tracking_number" value="<?php if($oldmeta != '' || !empty($oldmeta)){echo $oldmeta['tracking_number'];}?>" placeholder="">
            </p>
            <p class="form-field custom_tracking_link_field " id="custom_tracking_link_field">
                <label for="custom_tracking_link">
                    <?php _e('Tracking link');?>:
                </label>
                <input type="text" class="short" style="" name="custom_tracking_link" id="custom_tracking_link" value="<?php if($oldmeta != '' || !empty($oldmeta)){echo $oldmeta['custom_tracking_link'];}?>" placeholder="http://">
            </p>
            <p class="form-field date_shipped_field ">
                <label for="date_shipped">
                    <?php _e('Date shipped');?>:
                </label>
                <input type="date" class="date-picker-field hasDatepicker" style="width: 95%;" name="date_shipped" id="date_shipped" value="<?php if($oldmeta != '' || !empty($oldmeta)){echo $oldmeta['date_shipped'];}?>" >
            </p>
            <a class="button button-primary button-save-form" id="savetracking"><?php _e('Save Tracking');?></a>
        </div>
        <?php
    }


    function js_enqueue() {
        // Enqueue javascript on the frontend.
        wp_enqueue_script(
            'insp-track-script',
            INSP_TRACK_PLUGIN_URL . '/admin/js/script.js',
            array('jquery'),'',true
        );
        // The wp_localize_script allows us to output the ajax_url path for our script to use.
        wp_localize_script(
            'insp-track-script',
            'insp_track_obj',
            array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ,'ajax_nonce' => wp_create_nonce('insp_nonce'),)
        );
    }


    function post_ajax_request() {
        check_ajax_referer( 'insp_nonce', 'security' );
        if ( isset($_REQUEST) ) {

            $carrier_name               = sanitize_text_field($_REQUEST['carrier_name']);
            $service_name               = sanitize_text_field($_REQUEST['service_name']);
            $tracking_number            = sanitize_text_field($_REQUEST['tracking_number']);
            $custom_tracking_link       = sanitize_text_field($_REQUEST['custom_tracking_link']);
            $date_shipped               = sanitize_text_field($_REQUEST['date_shipped']);
            $order_id_for_track         = sanitize_text_field($_REQUEST['order_id_for_track']);

            if($tracking_number == ''){
                print_r(json_encode(array('success'=>'false','massage'=>__('we have error'))));
                die();
            }

            $newarray = array();
            $newarray['carrier_name']=$carrier_name;
            $newarray['service_name']=$service_name;
            $newarray['tracking_number']=$tracking_number;
            $newarray['custom_tracking_link']=$custom_tracking_link;
            $newarray['date_shipped']=$date_shipped;

            update_post_meta( $order_id_for_track, 'insp_track_number', $newarray );
            print_r(json_encode(array('success'=>'true','massage'=>__('tracking added success'),'data'=>json_encode($newarray))));

        }
        die();
    }



}
new insp_track_order();



