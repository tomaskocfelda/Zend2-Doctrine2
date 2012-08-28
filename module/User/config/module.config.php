<?php
/**
 * Konfigurace modulu User
 */
namespace User;

return array(
    'controllers' => array(
        'invokables' => array(
            'User\Controller\User' => 'User\Controller\UserController',
            'User\Controller\Sandbox' => 'User\Controller\SandboxController',
        ),
    ),
    
    //Nastaveni rout
    'router' => array(
        'routes' => array(

            // Routes of UserController
              'user' => array(
                'type' => 'segment',
                'options' => array(
                  'route' => '/user[/:action][/:id]',
                  'constraints' => array(
                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'id' => '[0-9]+',
                  ),
                  'defaults' => array(
                    'controller' => 'User\Controller\User',
                    'action' => 'index',
                  ),
                ),
              ),

            // Sandbox action
              'sandbox' => array(
                'type' => 'segment',
                'options' => array(
                  'route' => '/user/sandbox',
                  'defaults' => array(
                    'controller' => 'User\Controller\Sandbox',
                    'action' => 'index',
                  ),
                ),
              ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'user' => __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
          __NAMESPACE__ . '_driver' => array(
            'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
            'cache' => 'array',
            'paths' => array(__DIR__ . '/../src/User/Entity')
          ),
          'orm_default' => array(
            'drivers' => array(
              __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
            )
          )
    )
  )
);