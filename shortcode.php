<?php
/**
 * Created by PhpStorm.
 * User: agha
 * Date: 3/4/2019
 * Time: 1:20 PM
 */
class insp_track_shortcode{
    function __construct()
    {
        add_action( 'woocommerce_order_details_after_order_table', array($this,'action_woocommerce_before_account_orders'), 10, 1 );
        add_shortcode( 'show_track_number', array($this,'shortcode') );
    }
    function shortcode( $has_orders ) {
        ob_start();
        $oldmeta = get_post_meta( $has_orders['id'], 'insp_track_number', true );

        if($oldmeta != '' || !empty($oldmeta)) {
            ?>

            <h2><?php _e('Shipping Information:');?></h2>
            <table class="shop_table shop_table_responsive my_account_tracking">
                <thead>
                <tr>
                    <th class="tracking-provider"><span class="nobr"><?php _e('Carrier Name'); ?></span></th>
                    <th class="tracking-provider"><span class="nobr"><?php _e('Service Name'); ?></span></th>
                    <th class="tracking-number"><span class="nobr"><?php _e('Tracking Number'); ?></span></th>
                    <th class="date-shipped"><span class="nobr"><?php _e('Shipping Date'); ?></span></th>
                    <th class="order-actions">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr class="tracking">
                    <td class="tracking-provider" data-title="Provider">
                        <?php echo $oldmeta['carrier_name'];?>
                    </td>
                    <td class="tracking-provider" data-title="Provider">
                        <?php echo $oldmeta['service_name'];?>
                    </td>
                    <td class="tracking-number" data-title="Tracking Number">
                        <?php echo $oldmeta['tracking_number'];?>
                    </td>
                    <td class="date-shipped" data-title="Date" style="text-align:left; white-space:nowrap;">
                        <time datetime="<?php echo $oldmeta['date_shipped'];?>" title="<?php echo $oldmeta['date_shipped'];?>"><?php echo $oldmeta['date_shipped'];?></time>
                    </td>
                    <td class="order-actions" style="text-align: center;">
                        <a href="<?php echo $oldmeta['custom_tracking_link'];?>" target="_blank" class="button">Track</a>
                    </td>
                </tr>

                </tbody>
            </table>


            <?php
        }
        return ob_get_clean();
    }
    function action_woocommerce_before_account_orders( $has_orders ) {

        $oldmeta = get_post_meta( $has_orders->get_id(), 'insp_track_number', true );

        if($oldmeta != '' || !empty($oldmeta)) {
            ?>


            <h2><?php _e('Shipping Information:');?></h2>
            <table class="shop_table shop_table_responsive my_account_tracking">
                <thead>
                <tr>
                    <th class="tracking-provider"><span class="nobr"><?php _e('Carrier Name'); ?></span></th>
                    <th class="tracking-provider"><span class="nobr"><?php _e('Service Name'); ?></span></th>
                    <th class="tracking-number"><span class="nobr"><?php _e('Tracking Number'); ?></span></th>
                    <th class="date-shipped"><span class="nobr"><?php _e('Shipping Date'); ?></span></th>
                    <th class="order-actions">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr class="tracking">
                    <td class="tracking-provider" data-title="Provider">
                        <?php echo $oldmeta['carrier_name'];?>
                    </td>
                    <td class="tracking-provider" data-title="Provider">
                        <?php echo $oldmeta['service_name'];?>
                    </td>
                    <td class="tracking-number" data-title="Tracking Number">
                        <?php echo $oldmeta['tracking_number'];?>
                    </td>
                    <td class="date-shipped" data-title="Date" style="text-align:left; white-space:nowrap;">
                        <time datetime="<?php echo $oldmeta['date_shipped'];?>" title="<?php echo $oldmeta['date_shipped'];?>"><?php echo $oldmeta['date_shipped'];?></time>
                    </td>
                    <td class="order-actions" style="text-align: center;">
                        <a href="<?php echo $oldmeta['custom_tracking_link'];?>" target="_blank" class="button">Track</a>
                    </td>
                </tr>

                </tbody>
            </table>
            <?php
        }

    }
}
new insp_track_shortcode();

