TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `store`.`ticket_products_AFTER_INSERT` AFTER INSERT ON `ticket_products` FOR EACH ROW\nBEGIN\n    UPDATE products\n    SET stock = stock - NEW.quantity\n    WHERE id = NEW.product_id;\nEND'
sql_modes=1098907648
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_general_ci'
db_cl_names='utf8mb4_general_ci'
created=1681363273779301
