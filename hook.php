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
    include_once(GLPI_ROOT . '/inc/migration.class.php');
    $migration = new Migration('1.0.0');
    $table = "glpi_plugin_tacticalrmm_configs";
    if (!$DB->tableExists($table)) {
        $migration->displayMessage("Installing $table");
        $migration->createTable($table);
        $migration->addField($table, 'id', 'autoincrement');
        $migration->addField($table, 'url', 'string', ['default' => '']);
        $migration->addField($table, 'field', 'string', ['default' => 'serial']);
        $migration->addKey($table, 'PRIMARY KEY', ['id']);
        $migration->executeMigration();
        // Insert default row using Migration
        $migration->insertData($table, [
            [
                'id' => 1,
                'url' => '',
                'field' => 'serial'
            ]
        ]);
    } else {
        // Ensure row exists
        $res = $DB->request(["FROM" => $table, "WHERE" => ["id" => 1]]);
        if ($res->numrows() == 0) {
            $migration->insertData($table, [
                [
                    'id' => 1,
                    'url' => '',
                    'field' => 'serial'
                ]
            ]);
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
        include_once(GLPI_ROOT . '/inc/migration.class.php');
        $migration = new Migration('1.0.0');
        $migration->dropTable($table);
        $migration->executeMigration();
    }
    return true;
}