<?php

require_once 'defaultautorenew.civix.php';

use CRM_Defaultautorenew_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function defaultautorenew_civicrm_config(&$config): void {
  _defaultautorenew_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function defaultautorenew_civicrm_install(): void {
  _defaultautorenew_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function defaultautorenew_civicrm_enable(): void {
  _defaultautorenew_civix_civicrm_enable();
}

function defaultautorenew_civicrm_alterContent( &$content, $context, $tplName, &$object ) {
Civi::log()->debug('defaultautorenew context '. $context . " tplName " . $tplName);
  if($context == "form") {
    if($tplName == "CRM/Contribute/Form/Contribution/Main.tpl") {
      $content .= <<<HTML
      {if $membershipBlock}
      {literal}
        <script type="text/javascript">
          var _showHideAutoRenew = showHideAutoRenew;
          showHideAutoRenew = function(memTypeAutoId) {
            _showHideAutoRenew(memTypeAutoId);
            var autoRenewC = cj('input[name="auto_renew"]');
            autoRenewC.prop('checked', true);
          };
        </script>
      {/literal}
      {/if} 
      HTML;
    }
  }
}


