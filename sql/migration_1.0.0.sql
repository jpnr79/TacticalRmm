-- Migration for TacticalRMM plugin v1.0.0
CREATE TABLE IF NOT EXISTS `glpi_plugin_tacticalrmm_configs` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `url` varchar(255) NOT NULL DEFAULT '',
    `field` varchar(255) NOT NULL DEFAULT 'serial',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Ensure id is unsigned autoincrement (idempotent)
ALTER TABLE `glpi_plugin_tacticalrmm_configs` MODIFY COLUMN `id` int(11) unsigned NOT NULL AUTO_INCREMENT;

-- Insert default row if missing
INSERT INTO `glpi_plugin_tacticalrmm_configs` (`id`, `url`, `field`)
SELECT 1, '', 'serial' FROM DUAL WHERE NOT EXISTS (
    SELECT 1 FROM `glpi_plugin_tacticalrmm_configs` WHERE `id` = 1
);
