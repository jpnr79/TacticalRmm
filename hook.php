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
    $table = "glpi_plugin_tacticalrmm_configs";
    if (!$DB->tableExists($table)) {
        $query = "CREATE TABLE IF NOT EXISTS $table (
            `id` int(11) NOT NULL auto_increment,
            `url` VARCHAR(255) NOT NULL DEFAULT '',
            `field` VARCHAR(255) NOT NULL DEFAULT 'serial',
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;";
        $DB->query($query) or die($DB->error());
        $DB->query("INSERT INTO $table (id, url, field) VALUES (1, '', 'serial')");
    } else {
        // Ensure row exists
        $res = $DB->request(["FROM" => $table, "WHERE" => ["id" => 1]]);
        if ($res->numrows() == 0) {
            $DB->query("INSERT INTO $table (id, url, field) VALUES (1, '', 'serial')");
        }
    }
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
    if ($DB->tableExists($table)) {
        $DB->query("DROP TABLE $table");
    }
    return true;
}