        public static function canView()
        {
            return Session::haveRight('config', READ);
        }

        public static function canUpdate()
        {
            return Session::haveRight('config', UPDATE);
        }
    public static function getTable()
    {
        return 'glpi_plugin_tacticalrmm_configs';
    }

    public function getFromDB($id)
    {
        global $DB;
        $table = self::getTable();
        $res = $DB->request(["FROM" => $table, "WHERE" => ["id" => $id]]);
        if ($row = $res->next()) {
            $this->fields = $row;
            return true;
        }
        return false;
    }

    public function getEmpty()
    {
        $this->fields = ["id" => 1, "url" => '', "field" => 'serial'];
    }
<?php
declare(strict_types=1);
/****************************************************************************************
 **
 **      GLPI Plugin for TacticalRMM - Developed by JP Ros
 **
 ****************************************************************************************/


require_once(GLPI_ROOT . '/inc/commondbtm.class.php');
/**
 * Config handler for TacticalRMM plugin
 */



class PluginTacticalrmmConfig extends CommonDBTM
{
    private static $_instance = null;

    public static function getTable()
    {
        return 'glpi_plugin_tacticalrmm_configs';
    }

    public function getFromDB($id)
    {
        global $DB;
        $table = self::getTable();
        $res = $DB->request(["FROM" => $table, "WHERE" => ["id" => $id]]);
        if ($row = $res->next()) {
            $this->fields = $row;
            return true;
        }
        return false;
    }

    public function getEmpty()
    {
        $this->fields = ["id" => 1, "url" => '', "field" => 'serial'];
    }

    public function __construct()
    {
        global $DB;
        if ($DB->tableExists(self::getTable())) {
            $this->getFromDB(1);
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
            if (!self::$_instance->getFromDB(1)) {
                self::$_instance->getEmpty();
            }
        }
        return self::$_instance;
    }

    public static function getUrl(): ?string
    {
        $config = self::getInstance();
        return $config->fields["url"] ?? null;
    }

    public static function setUrl(string $value): void
    {
        $config = self::getInstance();
        $config->update(['id' => 1, 'url' => $value]);
    }

    public static function getField(): ?string
    {
        $config = self::getInstance();
        return $config->fields["field"] ?? null;
    }

    public static function setField(string $value): void
    {
        $config = self::getInstance();
        $config->update(['id' => 1, 'field' => $value]);
    }
}

?>