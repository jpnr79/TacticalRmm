<?php
declare(strict_types=1);
/****************************************************************************************
 **
 **      GLPI Plugin for TacticalRMM - Developed by JP Ros
 **
 ****************************************************************************************/

define('PLUGIN_TACTICALRMM_VERSION', '1.0.0');


/**
 * Initialize TacticalRMM plugin
 * @return void
 */
function plugin_init_tacticalrmm(): void
{
    global $PLUGIN_HOOKS;
    $PLUGIN_HOOKS['csrf_compliant']['tacticalrmm'] = true;
    $PLUGIN_HOOKS['config_page']['tacticalrmm'] = 'front/config.form.php';
    $PLUGIN_HOOKS['pre_item_form']['tacticalrmm'] = ['PluginTacticalrmmController', 'button_open'];
}

/**
 * Get TacticalRMM plugin version info
 * @return array<string, string>
 */
function plugin_version_tacticalrmm(): array
{
    return [
        'name' => 'TacticalRMM',
        'version' => PLUGIN_TACTICALRMM_VERSION,
        'author' => 'JP Ros',
        'license' => 'GPLv2+',
        'minGlpiVersion' => '9.1.2'
    ];
}

/**
 * Check TacticalRMM plugin prerequisites
 * @return bool
 */

function plugin_tacticalrmm_check_prerequisites(): bool
{
    global $CFG_GLPI;
    $glpi_version = $CFG_GLPI['version'] ?? '0.0.0';
    if (version_compare($glpi_version, '9.1.2', 'lt')) {
        if (method_exists('Plugin', 'messageIncompatible')) {
            echo Plugin::messageIncompatible('core', '9.1.2');
        } else {
            echo 'This plugin requires GLPI >= 9.1.2';
        }
        return false;
    }
    return true;
}

/**
 * Check TacticalRMM plugin config
 * @param bool $verbose
 * @return bool
 */
function plugin_tacticalrmm_check_config(bool $verbose = false): bool
{
    return true;
}

?>
/**
 * Return plugin modifications version for migrations
 * @return string
 */
function plugin_version_modifications_tacticalrmm(): string
{
    return PLUGIN_TACTICALRMM_VERSION;
}