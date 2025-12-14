<?php
if (!class_exists('Computer')) {
    if (file_exists(GLPI_ROOT . '/inc/computer.class.php')) {
        require_once(GLPI_ROOT . '/inc/computer.class.php');
    }
}
declare(strict_types=1);
/****************************************************************************************
 **
 **      GLPI Plugin for TacticalRMM - Developed by JP Ros
 **
 ****************************************************************************************/

/**
 * Controller for TacticalRMM plugin
 */
class PluginTacticalrmmController
{
    /**
     * Display TacticalRMM button on item form
     * @param array $params
     * @return void
     */
    public static function button_open(array $params): void
    {
        $url = PluginTacticalrmmConfig::getUrl();
        $field = PluginTacticalrmmConfig::getField();
        $item = $params['item'];
        if (empty($url) || empty($field) || $item::getType() !== Computer::class) {
            return;
        }
        $name = $item->fields[$field];
        $encode = urlencode($name);
        $out = "<div class='container right'>
                    <div class='btn btn-primary'>
                        <a href='$url/?search=$encode' target='_blank'>
                        Open in TacticalRMM
                        </a>
                    </div>
                </div>";
        echo $out;
    }
}

?>