<?php
class GetFieldsMetaData{
    public function execute($module = NULL){

        if ($module == 'deals') {
                    $GetFieldsMetaData = array(
                                                'fields' => array(
                                                                    'title' => array(
                                                                                'system_mandatory' => 1,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Title',
                                                                                'api_name' => 'title'
                                                                            ),
                                                                    'value' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Value',
                                                                                'api_name' => 'value'
                                                                            ),
                                                                    'label' => array(
                                                                                'system_mandatory' => 1,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Label',
                                                                                'api_name' => 'label'
                                                                            ),

                                                                    'user_id' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'User ID',
                                                                                'api_name' => 'user_id'
                                                                            ),
                                                                    'person_id' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Person ID',
                                                                                'api_name' => 'person_id'
                                                                            ),
                                                                    'org_id' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Org ID Number',
                                                                                'api_name' => 'org_id'
                                                                            ),
                                                                    'pipeline_id' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Pipeline ID',
                                                                                'api_name' => 'pipeline_id'
                                                                            ),
                                                             
                                                                    'stage_id' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Stage ID',
                                                                                'api_name' => 'stage_id'
                                                                            ),    

                                                                    'origin_id' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Origin ID',
                                                                                'api_name' => 'origin_id'
                                                                            ),
                                                                    'channel_id' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Channel ID',
                                                                                'api_name' => 'channel_id'
                                                                            ),
                                                                    'add_time' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Add Time',
                                                                                'api_name' => 'add_time'
                                                                            ),
                                                                    'won_time' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Won Time',
                                                                                'api_name' => 'won_time'
                                                                            ),
                                                                    'lost_time' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Lost Time',
                                                                                'api_name' => 'lost_time'
                                                                            ),
                                                             
                                                                    'expected_close_date' => array(
                                                                                'system_mandatory' => 0,
                                                                                'field_read_only' => '',
                                                                                'display_label' => 'Expected Close Date',
                                                                                'api_name' => 'expected_close_date'
                                                                            ),    
                                                                    
                                                    ),
                                            );

                    }elseif ($module == 'leads') {
 
                     $GetFieldsMetaData = array(
                                        'fields' => array(
                                                        'title' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Title',
                                                                    'api_name' => 'title'
                                                                ),
                                                        'owner_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Owner ID',
                                                                    'api_name' => 'owner_id'
                                                                ),
                                                        'label_ids' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Label ID',
                                                                    'api_name' => 'label_ids'
                                                                ),
                                                        
                                                        'person_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Person ID',
                                                                    'api_name' => 'person_id'
                                                                ),
                                                        'organization_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Organization ID',
                                                                    'api_name' => 'organization_id'
                                                                ),
                                                        'channel_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Channel ID',
                                                                    'api_name' => 'channel_id'
                                                                ),
                                                        'expected_close_date' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Expected Close Date',
                                                                    'api_name' => 'expected_close_date'
                                                                ),
                                                         'origin_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Origin ID',
                                                                    'api_name' => 'origin_id'
                                                                ),
                                                      

                                                    ),
                                    );
                }elseif($module == 'activities'){
                     $GetFieldsMetaData = array(
                                    'fields' => array(
                                                        'due_date' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Due Date',
                                                                    'api_name' => 'due_date'
                                                                ),
                                                        'due_time' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Due Time',
                                                                    'api_name' => 'due_time'
                                                                ),
                                                        'deal_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Deal ID ',
                                                                    'api_name' => 'deal_id'
                                                                ),
                                                        'lead_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Lead ID',
                                                                    'api_name' => 'lead_id'
                                                                ),
                                                        'person_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Person ID',
                                                                    'api_name' => 'person_id'
                                                                ),
                                                        'project_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Project ID',
                                                                    'api_name' => 'project_id'
                                                                ),
                                                        'location' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Location',
                                                                    'api_name' => 'location'
                                                                ),
                                                                 ),
                                                        'note' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Note',
                                                                    'api_name' => 'note'
                                                                ),
                                                        'user_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'User ID',
                                                                    'api_name' => 'user_id'
                                                                ),
                                                        'attendees' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Email Attendees',
                                                                    'api_name' => 'attendees'
                                                                ),
                                                        'project_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Project ID',
                                                                    'api_name' => 'project_id'
                                                                ),
                                                        'location' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Location',
                                                                    'api_name' => 'location'
                                                                ),
                                                       
                                                    );

                }elseif($module == 'persons'){
                     $GetFieldsMetaData = array(
                                    'fields' => array(
                                                        'name' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Name',
                                                                    'api_name' => 'name'
                                                                ),
                                                        'owner_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Owner ID',
                                                                    'api_name' => 'owner_id'
                                                                ),
                                                        'org_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Org ID',
                                                                    'api_name' => 'org_id'
                                                                ),
                                                        'email' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Email',
                                                                    'api_name' => 'email'
                                                                ),
                                                        'phone' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Phone',
                                                                    'api_name' => 'phone'
                                                                ),
                                                        'label' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Label',
                                                                    'api_name' => 'label'
                                                                ),
                                                        'add_time' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Add Time',
                                                                    'api_name' => 'add_time'
                                                                ),
                                                        ),
                                                   
                                );   
                 }elseif($module == 'products'){
                     $GetFieldsMetaData = array(
                                    'fields' => array(
                                                        'name' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Name',
                                                                    'api_name' => 'name'
                                                                ),
                                                        'code' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Product Code',
                                                                    'api_name' => 'code'
                                                                ),
                                                        'description' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Description',
                                                                    'api_name' => 'description'
                                                                ),
                                                        'unit' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'unit',
                                                                    'api_name' => 'unit'
                                                                ),
                                                        'tax' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Tax',
                                                                    'api_name' => 'tax'
                                                                ),
                                                        'category' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Category',
                                                                    'api_name' => 'category'
                                                                ),
                                                        'owner_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Owner ID',
                                                                    'api_name' => 'owner_id'
                                                                ),
                                                        'is_linkable' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Is Linkable',
                                                                    'api_name' => 'is_linkable'
                                                                ),
                                                        'prices' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Prices',
                                                                    'api_name' => 'prices'
                                                                ),
                                                        'billing_frequency_cycles' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Billing Frequency Cycles',
                                                                    'api_name' => 'ubilling_frequency_cyclesnit'
                                                                ),
                                                        ),                 
                                );   
                     }
                     elseif($module == 'projects'){
                     $GetFieldsMetaData = array(
                                    'fields' => array(
                                                        'title' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Title',
                                                                    'api_name' => 'title'
                                                                ),
                                                        'board_id' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Board ID',
                                                                    'api_name' => 'board_id'
                                                                ),
                                                        'phase_id' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Phase ID',
                                                                    'api_name' => 'phase_id'
                                                                ),
                                                        'description' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Description',
                                                                    'api_name' => 'description'
                                                                ),
                                                        'status' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Status',
                                                                    'api_name' => 'status'
                                                                ),
                                                        'owner_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Owner ID',
                                                                    'api_name' => 'owner_id'
                                                                ),
                                                        'start_date' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Start Date',
                                                                    'api_name' => 'start_date'
                                                                ),
                                                        'end_date' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'End Date',
                                                                    'api_name' => 'end_date'
                                                                ),
                                                         'deal_ids' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Deal Ids',
                                                                    'api_name' => 'deal_ids'
                                                                ),
                                                        'org_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Org ID',
                                                                    'api_name' => 'org_id'
                                                                ),
                                                        'person_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Person ID',
                                                                    'api_name' => 'person_id'
                                                                ),
                                                        'labels' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Labels',
                                                                    'api_name' => 'labels'
                                                                ),
                                                        ),   
                                );   
                     }elseif($module == 'organizations'){
                     $GetFieldsMetaData = array(
                                    'fields' => array(
                                                        'name' => array(
                                                                    'system_mandatory' => 1,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Name',
                                                                    'api_name' => 'name'
                                                                ),
                                                        'add_time' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Add Time',
                                                                    'api_name' => 'add_time'
                                                                ),
                                                        'owner_id' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Owner ID',
                                                                    'api_name' => 'owner_id'
                                                                ),
                                                        'label' => array(
                                                                    'system_mandatory' => 0,
                                                                    'field_read_only' => '',
                                                                    'display_label' => 'Label',
                                                                    'api_name' => 'label'
                                                                ),
                                                       
                                                       
                                            
                                                    ),
                                ); 
                        }  
                return $GetFieldsMetaData;
            }
        }

