<?php

trait DrupalBackendTrait {

    public function getName() {
        $host = parse_url($this->config->get('drupal-login-url'), PHP_URL_HOST);
        return $host . ' (Drupal)';
    }

}
