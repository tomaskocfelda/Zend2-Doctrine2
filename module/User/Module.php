<?php
/**
 * Modul User
 */
namespace User;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
      {
        return array(
          'Zend\Loader\StandardAutoloader' => array(
            'namespaces' => array(
              __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
              __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    'Doctrine' => __DIR__ . '/../../vendor/Doctrine'
            ),
          ),
        );
      }
}