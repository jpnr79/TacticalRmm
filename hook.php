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





class PluginTacticalrmmInstall
{
    public static function install(Migration $migration): bool
    {
        // All schema and default data migration is handled by the migration SQL file.
        return true;
    }

    public static function uninstall(Migration $migration): bool
    {
        $table = "glpi_plugin_tacticalrmm_configs";
        $migration->dropTable($table);
        return true;
    }
}

/**
 * Uninstall plugin TacticalRMM
 * @return bool
 */




// Legacy uninstall kept for compatibility, but should not be used in GLPI 11+
function plugin_tacticalrmm_uninstall(): bool
{
    $migration = new Migration('tacticalrmm');
    return PluginTacticalrmmInstall::uninstall($migration);
}

/**
 * Handle plugin database schema and data migrations
 * REQUIRED for GLPI 11+
 *
 * @return array
 */
function plugin_version_tacticalrmm_modifications() {
    return [
        // Example: [ 'version' => '1.0.0', 'query' => 'CREATE TABLE ...' ]
        // Add migration steps here as needed for future versions
    ];
}