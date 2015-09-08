<?php
namespace Apps;

return array(
    'controllers' => array(
        'invokables' => array(
            
            'Apps\Controller\Apps' => 'Apps\Controller\AppsController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'apps' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/apps[/:action][/:id][/page/:page][/order_by/:order_by][/:order][/search_by/:search_by]',
                    'constraints' => array(
                        'action'    => '(?!\bpage\b)(?!\border_by\b)(?!\bsearch_by\b)[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                        'page' => '[0-9]+',
                        'order_by' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'order' => 'ASC|DESC',
                    ),
                    'defaults' => array(
                        'controller' => 'Apps\Controller\Apps',
                        'action'     => 'home',
                    ),
                ),
            ),
            
        ),
        // set welcome route
        'details' => array(
            'type' =>'literal',
                'options' => array(
                    'route' =>'/apps/details',
                        'defaults' => array(
                            'controller' =>'Apps\Controller\Apps',
                                'action' =>'details'
                        )
                )
        )// successfull route ends here
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            
            'apps' => __DIR__ . '/../view',
        ),
        'template_map' => array(
            'paginator-slide' => __DIR__ . '/../view/layout/slidePaginator.phtml',
        ),
    ),

);
