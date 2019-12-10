<?php
return array(
    'id' =>             'auth:drupal', # notrans
    'version' =>        '0.1',
    'name' =>           /* trans */ 'Drupal 8 Authentication',
    'author' =>         'Fonata',
    'description' =>    /* trans */ 'Provides a configurable authentication
                         backend for authenticating staff and clients using Drupal 8.',
    'url' =>            'https://github.com/Fonata/osTicket-Drupal-Authenticator',
    'plugin' =>         'authentication.php:DrupalAuthPlugin',
    'requires' => array()
);
