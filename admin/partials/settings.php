<?php
	
	$wpspi_smart_pipedrive 				= get_option( 'wpspi_smart_pipedrive' );
	$wpspi_smart_pipedrive_settings 		= get_option( 'wpspi_smart_pipedrive_settings' );

	$apitoken 						=  isset($wpspi_smart_pipedrive_settings['psn-token']) ? $wpspi_smart_pipedrive_settings['psn-token'] : "";

	$wpspi_smart_pipedrive_data_center 	= ( $wpspi_smart_pipedrive_data_center ? $wpspi_smart_pipedrive_data_center : 'https://oauth.pipedrive.com' );
?>

<div class="wrap">                
	
	<h1><?php echo esc_html__( 'Pipedrive CRM Settings and Authorization' ); ?></h1>
	<hr>

	<form method="post">
		<?php 
			$tab = isset( $_REQUEST['tab'] ) ? $_REQUEST['tab'] : 'general';
		?>

		<nav class="nav-tab-wrapper woo-nav-tab-wrapper">
			<a href="<?php echo admin_url('admin.php?page=wpspi-smart-pipedrive-integration&tab=general'); ?>" class="nav-tab <?php if($tab == 'general'){ echo 'nav-tab-active';} ?>"><?php echo esc_html__( 'General', 'wpspi-smart-pipedrive' ); ?></a>
			<a href="<?php echo admin_url('admin.php?page=wpspi-smart-pipedrive-integration&tab=synch_settings'); ?>" class="nav-tab <?php if($tab == 'synch_settings'){ echo 'nav-tab-active';} ?>"><?php echo esc_html__( 'Synch Settings', 'wpspi-smart-pipedrive' ); ?></a>
		</nav>
		
		<input type="hidden" name="tab" value="<?php echo esc_html($tab); ?>">

		<?php if( isset($tab) && 'general' == $tab ){ ?>
			
			<table class="form-table general_settings">
				<tbody>

					<tr>
						<th scope="row">
							<label><?php echo esc_html__( 'API Token', 'wpspi-smart-pipedrive' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" name="wpspi_smart_pipedrive_settings[psn-token]" value="<?php echo esc_attr($apitoken); ?>" required />
							<br>
							<a href="https://app.pipedrive.com/settings/api">Get API key</a>
						</td>
					</tr>				
				</tbody>
			</table>

			<div class="inline">
				<p>
					<input type='submit' class='button-primary' name="submit" value="<?php echo esc_html__( 'Save & Authorize', 'wpspi-smart-pipedrive' ); ?>" />
				</p>
			</div>

		<?php }else if( isset($tab) && 'synch_settings' == $tab ){ ?>
			<?php 
				$smart_pipedrive_obj   = new WPSPI_Smart_Pipedrive();
		        $wp_modules 	= $smart_pipedrive_obj->get_wp_modules();
		        $getListModules = $smart_pipedrive_obj->get_pipedrive_modules();
			?>
			<table class="form-table synch_settings">
				<tbody>
					<?php
						if($getListModules['modules']){
					        foreach ($getListModules['modules'] as $key => $singleModule) {
					            if( $singleModule['deletable'] &&  $singleModule['creatable'] ){
					            	foreach ($wp_modules as $wp_module_key => $wp_module_name) {
					            		?>
						            		<tr>
												<th scope="row"><label><?php echo esc_html__( "Enable {$wp_module_key} to Pipedrive {$singleModule['api_name']} Sync", 'wpspi-smart-pipedrive' ); ?></label></th>
												<td>
													<fieldset>
														<label>
															<input 
																type="checkbox" 
																name="wpspi_smart_pipedrive_settings[synch][<?php echo $wp_module_key.'_'.$singleModule['api_name']; ?>]" 
																<?php @checked( $wpspi_smart_pipedrive_settings['synch']["{$wp_module_key}_{$singleModule['api_name']}"], 1 ); ?>
																value="1" />
																Enable
														</label>
													</fieldset>
												</td>
											</tr>
						            	<?php	
					            	}
					            }
					        }
					    }
					?>    
    				
				</tbody>
			</table>
			<p><input type='submit' class='button-primary' name="submit" value="<?php echo esc_html__( 'Save', 'wpspi-smart-pipedrive' ); ?>" /></p>
		
		<?php }?>	
		
	</form>
</div>