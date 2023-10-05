<?php
    global $wpdb;
    $fieldlists = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}smart_pipedrive_field_mapping");
?>
    <h2><?php echo esc_html__('Fields Mapping List'); ?></h2>

    <table id="mapping-list-table" class="wp-list-table widefat fixed striped table-view-list display">
        <thead>
            <th><?php echo esc_html__('Id', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('Pipedrive Module', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('Pipedrive Field', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('WP Module', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('WP Field', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('Status', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('Description', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('Action', 'wpspi-smart-pipedrive'); ?></th>
        </thead>

        <tfoot>
            <th><?php echo esc_html__('Id', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('Pipedrive Module', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('Pipedrive Field', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('WP Module', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('WP Field', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('Status', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('Description', 'wpspi-smart-pipedrive'); ?></th>
            <th><?php echo esc_html__('Action', 'wpspi-smart-pipedrive'); ?></th>
        </tfoot>
        <tbody>
            <!-- WP Modules Row -->
            <?php
                if ( $fieldlists ) {
                    foreach ( $fieldlists as $singlelist ) {
                        ?>
                        <tr>
                            <td><?php echo esc_html__($singlelist->id, 'wpspi-smart-pipedrive'); ?></td>
                            <td><?php echo esc_html__($singlelist->pipedrive_module, 'wpspi-smart-pipedrive'); ?></td>
                            <td><?php echo esc_html__($singlelist->pipedrive_field, 'wpspi-smart-pipedrive'); ?></td>
                            <td><?php echo esc_html__($singlelist->wp_module, 'wpspi-smart-pipedrive'); ?></td>
                            <td><?php echo esc_html__($singlelist->wp_field, 'wpspi-smart-pipedrive'); ?></td>
                            <td><?php echo ucfirst( esc_html__($singlelist->status, 'wpspi-smart-pipedrive') ); ?></td>
                            <td><?php echo esc_html__($singlelist->description, 'wpspi-smart-pipedrive'); ?></td>
                            <td>
                                <?php if($singlelist->is_predefined != 'yes' ){ ?>
                                    <a href="<?php echo admin_url('admin.php?page=wpspi-smart-pipedrive-mappings&action=trash&id='.$singlelist->id); ?>">
                                        <button type="submit"><?php echo esc_html__('Delete', 'wpspi-smart-pipedrive'); ?></button>
                                    </a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php
                    }   
                } else {
                    ?>
                    <tr>
                        <td colspan="7">
                            <?php echo esc_html__('No Record Found', 'wpspi-smart-pipedrive'); ?>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>