<?php
	
	$wpspi_smart_pipedrive 				= get_option( 'wpspi_smart_pipedrive' );
	$wpspi_smart_pipedrive_settings 		= get_option( 'wpspi_smart_pipedrive_settings' );

	$client_id 						=  isset($wpspi_smart_pipedrive_settings['client_id']) ? $wpspi_smart_pipedrive_settings['client_id'] : "";
	$client_secret 					= isset($wpspi_smart_pipedrive_settings['client_secret']) ? $wpspi_smart_pipedrive_settings['client_secret'] : "";
	$wpspi_smart_pipedrive_data_center 	= isset($wpspi_smart_pipedrive_settings['data_center']) ? $wpspi_smart_pipedrive_settings['data_center'] : "";

	$wpspi_smart_pipedrive_data_center 	= ( $wpspi_smart_pipedrive_data_center ? $wpspi_smart_pipedrive_data_center : 'https://accounts.pipedrive.com' );
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
							<label><?php echo esc_html__( 'Client ID', 'wpspi-smart-pipedrive' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" name="wpspi_smart_pipedrive_settings[client_id]" value="<?php echo esc_attr($client_id); ?>" required />
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label><?php echo esc_html__( 'Client Secret', 'wpspi-smart-pipedrive' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" name="wpspi_smart_pipedrive_settings[client_secret]" value="<?php echo esc_attr($client_secret); ?>" required />
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label><?php echo esc_attr( 'Redirect URI', 'wpspi-smart-pipedrive' ); ?></label>
						</th>
						<td>
							<input class="regular-text" type="text" value="<?php echo esc_url(WPSPI_REDIRECT_URI); ?>" readonly />
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label><?php echo esc_html__( 'Access Token', 'wpspi-smart-pipedrive' ); ?></label>
						</th>
						<td>
							
							<?php 
								if(isset($wpspi_smart_pipedrive->access_token)){
									echo esc_html($wpspi_smart_pipedrive->access_token);
								}
							?>
						</td>
					</tr>

					<tr>
						<th scope="row">
							<label><?php echo esc_html__( 'Refresh Token', 'wpspi-smart-pipedrive' ); ?></label>
						</th>
						<td>
							<?php 
								if(isset($wpspi_smart_pipedrive->refresh_token)){
									echo esc_html($wpspi_smart_pipedrive->refresh_token);
								}
							?>
						</td>
					</tr>
					
				</tbody>
			</table>

			<div class="inline">
				<p>
					<input type='submit' class='button-primary' name="submit" value="<?php echo esc_html__( 'Save & Authorize', 'wpspi-smart-pipedrive' ); ?>" />
				</p>

				<?php 
					if(isset($wpspi_smart_pipedrive->refresh_token)){
						echo '<p class="success">'.esc_html__('Authorized', 'wpspi-smart-pipedrive').'</p>';
					}
				?>
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