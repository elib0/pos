ALTER TABLE `ospos_items`
MODIFY COLUMN `deleted`  tinyint(1) NOT NULL DEFAULT 0 AFTER `is_serialized`,
ADD COLUMN `is_service`  tinyint(1) NOT NULL AFTER `is_serialized`,
ADD COLUMN `is_locked`  tinyint(1) NOT NULL AFTER `is_service`;
