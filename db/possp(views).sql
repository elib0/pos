-- --------------------------------------------------------

--
-- Estructura para la vista `ospos_ci_users`
--
DROP TABLE IF EXISTS `ospos_ci_users`;
DROP VIEW IF EXISTS `ospos_ci_users`;
CREATE VIEW `ospos_ci_users` AS select `ospos_employees`.`person_id` AS `user_id`,`ospos_employees`.`username` AS `user_name`,NULL AS `user_email`,`ospos_employees`.`password` AS `user_password`,NULL AS `registered_date`,1 AS `status`,1 AS `online` from `ospos_employees`;

-- --------------------------------------------------------

--
-- Estructura para la vista `ospos_sales_items_temp`
--
DROP TABLE IF EXISTS `ospos_sales_items_temp`;
DROP VIEW IF EXISTS `ospos_sales_items_temp`;
CREATE VIEW `ospos_sales_items_temp` AS (select cast(`ospos_sales`.`sale_time` as date) AS `sale_date`,`ospos_sales_items`.`sale_id` AS `sale_id`,`ospos_sales`.`comment` AS `comment`,`ospos_sales`.`payment_type` AS `payment_type`,`ospos_sales`.`customer_id` AS `customer_id`,`ospos_sales`.`employee_id` AS `employee_id`,`ospos_items`.`item_id` AS `item_id`,`ospos_items`.`supplier_id` AS `supplier_id`,`ospos_sales_items`.`quantity_purchased` AS `quantity_purchased`,`ospos_sales_items`.`item_cost_price` AS `item_cost_price`,`ospos_sales_items`.`item_unit_price` AS `item_unit_price`,sum(`ospos_sales_items_taxes`.`percent`) AS `item_tax_percent`,`ospos_sales_items`.`discount_percent` AS `discount_percent`,((`ospos_sales_items`.`item_unit_price` * `ospos_sales_items`.`quantity_purchased`) - (((`ospos_sales_items`.`item_unit_price` * `ospos_sales_items`.`quantity_purchased`) * `ospos_sales_items`.`discount_percent`) / 100)) AS `subtotal`,`ospos_sales_items`.`line` AS `line`,`ospos_sales_items`.`serialnumber` AS `serialnumber`,`ospos_sales_items`.`description` AS `description`,round((((`ospos_sales_items`.`item_unit_price` * `ospos_sales_items`.`quantity_purchased`) - (((`ospos_sales_items`.`item_unit_price` * `ospos_sales_items`.`quantity_purchased`) * `ospos_sales_items`.`discount_percent`) / 100)) * (1 + (sum(`ospos_sales_items_taxes`.`percent`) / 100))),2) AS `total`,round((((`ospos_sales_items`.`item_unit_price` * `ospos_sales_items`.`quantity_purchased`) - (((`ospos_sales_items`.`item_unit_price` * `ospos_sales_items`.`quantity_purchased`) * `ospos_sales_items`.`discount_percent`) / 100)) * (sum(`ospos_sales_items_taxes`.`percent`) / 100)),2) AS `tax`,(((`ospos_sales_items`.`item_unit_price` * `ospos_sales_items`.`quantity_purchased`) - (((`ospos_sales_items`.`item_unit_price` * `ospos_sales_items`.`quantity_purchased`) * `ospos_sales_items`.`discount_percent`) / 100)) - (`ospos_sales_items`.`item_cost_price` * `ospos_sales_items`.`quantity_purchased`)) AS `profit` from ((((`ospos_sales_items` join `ospos_sales` on((`ospos_sales_items`.`sale_id` = `ospos_sales`.`sale_id`))) join `ospos_items` on((`ospos_sales_items`.`item_id` = `ospos_items`.`item_id`))) left join `ospos_suppliers` on((`ospos_items`.`supplier_id` = `ospos_suppliers`.`person_id`))) left join `ospos_sales_items_taxes` on(((`ospos_sales_items`.`sale_id` = `ospos_sales_items_taxes`.`sale_id`) and (`ospos_sales_items`.`item_id` = `ospos_sales_items_taxes`.`item_id`) and (`ospos_sales_items`.`line` = `ospos_sales_items_taxes`.`line`)))) group by `ospos_sales_items`.`sale_id`,`ospos_items`.`item_id`,`ospos_sales_items`.`line`);

