<?php

require_once INCLUDE_DIR . 'class.plugin.php';

class DrupalPluginConfig extends PluginConfig {

    // Provide compatibility function for versions of osTicket prior to
    // translation support (v1.9.4)
    function translate() {
        if (!method_exists('Plugin', 'translate')) {
            return [
              function ($x) {
                  return $x;
              },
              function ($x, $y, $n) {
                  return $n != 1 ? $y : $x;
              },
            ];
        }
        return Plugin::translate('auth-drupal');
    }

    function getOptions() {
        [$__, $_N] = self::translate();
        return [
          'drupal' => new SectionBreakField([
            'label' => $__('Drupal Authentication'),
          ]),
          'drupal-enabled' => new ChoiceField([
            'label' => $__('Authentication'),
            'default' => "disabled",
            'choices' => [
              'disabled' => $__('Disabled'),
              'staff' => $__('Agents Only'),
              'client' => $__('Clients Only'),
              'all' => $__('Agents and Clients'),
            ],
          ]),
          'drupal-login-url' => new TextboxField([
            'label' => $__('Login page URL'),
            'configuration' => ['size' => 60, 'length' => 100],
          ]),
          'drupal-agent-url' => new TextboxField([
            'label' => $__('URL of a page to which only agents have access'),
            'configuration' => ['size' => 60, 'length' => 100],
            'hint' => $__('This URL should return the HTTP status 403 if not logged in.'),
          ]),
          'drupal-client-url' => new TextboxField([
            'label' => $__('URL of a page to which clients have access'),
            'configuration' => ['size' => 60, 'length' => 100],
            'hint' => $__('This URL should return the HTTP status 403 if not logged in.'),
          ]),
          'drupal-email-domain' => new TextboxField([
            'label' => $__('Domain to remove from email addresses'),
            'validator' => 'domain-lead-by-at',
            'configuration' => ['size' => 60, 'length' => 100],
            'hint' => $__('
                 Optional. In case the login page URL requires an
                 email address as the user name, this config options does two
                 things:<ol style="width: 700px">
                 <li>@domain part will be removed to convert the email address
                 to an osTicket user name.
                 <li>If the user did not type the email address, but only the
                 local part, the @example.com part will be added before it is
                 sent to the login page URL form.</ol>
                 This field should be empty or start with an "@" character.'),
          ]),
        ];
    }
}
