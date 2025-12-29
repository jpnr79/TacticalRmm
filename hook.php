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




function plugin_tacticalrmm_install(): bool
{
    global $DB;
if (!defined('GLPI_ROOT')) { define('GLPI_ROOT', realpath(__DIR__ . '/../..')); }

    $table = "glpi_plugin_tacticalrmm_configs";
    // Create table only if it does not exist (GLPI 11+ compatible)
    $res = $DB->request([
        'FROM' => 'information_schema.tables',
        'WHERE' => [
            'table_schema' => $DB->request("SELECT DATABASE() AS dbname")[0]['dbname'],
            'table_name'   => $table
        ]
    ]);
    if (!($res && count($res))) {
        $query = "CREATE TABLE `$table` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `url` varchar(255) NOT NULL DEFAULT '',
            `field` varchar(255) NOT NULL DEFAULT 'serial',
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $DB->request($query);
    }

    // Ensure id is unsigned if table already exists (check column type first)
    $need_alter = false;
    $dbname = '';
    $res = $DB->request("SELECT DATABASE() AS dbname");
    if ($res && count($res) && isset($res[0]['dbname'])) {
        $dbname = $res[0]['dbname'];
    }
    $col = $DB->request(["FROM" => "information_schema.COLUMNS", "WHERE" => [
        "TABLE_SCHEMA" => $dbname,
        "TABLE_NAME" => $table,
        "COLUMN_NAME" => 'id'
    ]]);
    if ($col && count($col) && isset($col[0]['COLUMN_TYPE'])) {
        if (stripos($col[0]['COLUMN_TYPE'], 'unsigned') === false) {
            $need_alter = true;
        }
    }
    if ($need_alter) {
        $alter = "ALTER TABLE `$table` MODIFY COLUMN `id` int(11) unsigned NOT NULL AUTO_INCREMENT;";
        $DB->request($alter);
    }

    // Insert default row if missing
    $insert = "INSERT IGNORE INTO `$table` (`id`, `url`, `field`) VALUES (1, '', 'serial');";
    $DB->request($insert);
    return true;
}

/**
 * Uninstall plugin TacticalRMM
 * @return bool
 */



function plugin_tacticalrmm_uninstall(): bool
{
    global $DB;
    $table = "glpi_plugin_tacticalrmm_configs";
    $DB->request("DROP TABLE IF EXISTS `$table`;");
    return true;
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