<?php
declare(strict_types=1);

/****************************************************************************************
 **
 **      GLPI Plugin for TacticalRMM - Developed by JP Ros
 **
 ****************************************************************************************/


/**
 * Install plugin TacticalRMM
 * @return bool
 */
{
    Plugin::setConfigurationValues('tacticalrmm', ['url' => '', 'field' => 'serial']);
    return true;
}

/**
 * Uninstall plugin TacticalRMM
 * @return bool
 */
function plugin_tacticalrmm_uninstall(): bool
{
    Plugin::deleteConfigurationValues('tacticalrmm', ['url']);
    Plugin::deleteConfigurationValues('tacticalrmm', ['field']);
    return true;
}