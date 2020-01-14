<?php

require_once(INCLUDE_DIR.'class.plugin.php');
require_once('config.php');

class DrupalAuthPlugin extends Plugin {
    var $config_class = "DrupalPluginConfig";

    function bootstrap() {
        /** @var \DrupalPluginConfig $config */
        $config = $this->getConfig();

        $enabled = $config->get('drupal-enabled');
        if (in_array($enabled, array('all', 'staff'))) {
            require_once('drupal_connector.php');
            StaffAuthenticationBackend::register(
                new DrupalStaffAuthBackend($config));
        }
        if (in_array($enabled, array('all', 'client'))) {
            require_once('drupal_connector.php');
            UserAuthenticationBackend::register(
                new DrupalClientAuthBackend($config));
        }
    }
}

require_once(INCLUDE_DIR.'UniversalClassLoader.php');
use Symfony\Component\ClassLoader\UniversalClassLoader_osTicket;
$loader = new UniversalClassLoader_osTicket();
$loader->registerNamespaceFallbacks(array(
    dirname(__file__).'/lib'));
$loader->register();
