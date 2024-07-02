<?php
class GetListofModules{
    
      public function execute(){
        $getListModules = array(
                        'modules' => array(
                                            'deals' => array(
                                                        'creatable' => 1,
                                                        'deletable' => 1,
                                                        'api_name' =>  'deals',
                                                        'plural_label' =>  'Deals',
                                                        ),
                                            // 'leads' => array(
                                            //             'creatable' => 1,
                                            //             'deletable' => 1,
                                            //             'api_name' =>  'leads',
                                            //             'plural_label' =>  'Leads',
                                            //             ),
                                            'activities' => array(
                                                        'creatable' => 1,
                                                        'deletable' => 1,
                                                        'api_name' =>  'activities',
                                                        'plural_label' =>  'Activities',
                                                        ),
                                            'persons' => array(
                                                        'creatable' => 1,
                                                        'deletable' => 1,
                                                        'api_name' =>  'persons',
                                                        'plural_label' =>  'Persons',
                                                        ),
                                            // 'organizations' => array(
                                            //             'creatable' => 1,
                                            //             'deletable' => 1,
                                            //             'api_name' =>  'organizations',
                                            //             'plural_label' =>  'Organizations',
                                            //             ),
                                            'products' => array(
                                                        'creatable' => 1,
                                                        'deletable' => 1,
                                                        'api_name' =>  'products',
                                                        'plural_label' =>  'Products',
                                                        ),
                                            // 'projects' => array(
                                            //             'creatable' => 1,
                                            //             'deletable' => 1,
                                            //             'api_name' =>  'projects',
                                            //             'plural_label' =>  'Projects',
                                            //             ),
                                        )
        );
        return $getListModules;
    }
}