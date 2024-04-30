DROP DATABASE IF EXISTS uts;
CREATE DATABASE uts;
USE uts;

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(20) DEFAULT NULL,
  `unit_price` float(8,2) DEFAULT NULL,
  `unit_quantity` varchar(15) DEFAULT NULL,
  `in_stock` int(10) UNSIGNED DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `sub_category` varchar(50) DEFAULT NULL
);

INSERT INTO `products` (`product_id`, `product_name`, `unit_price`, `unit_quantity`, `in_stock`, `category`, `sub_category`) VALUES
(1000, 'Raspberry Juice', 3.00, '1L', 39, 'Drinks', 'Juices'),
(1001, 'Coula', 1.00, '1.5L', 0, 'Drinks', 'Sodas'),
(1002, 'Vitamin Water', 2.00, '500ml', 145, 'Drinks', 'Water'),
(1003, 'Apple Juice', 3.00, '1L', 79, 'Drinks', 'Juices'),
(1004, 'Orange Juice', 2.00, '2L', 89, 'Drinks', 'Juices'),
(1005, 'Sunflower Tea', 2.00, '500ml', 107, 'Drinks', 'Teas'),
(1006, 'Angel Energy', 3.00, '250ml', 69, 'Drinks', 'Energy'),
(1007, 'Cranberry Juice', 3.00, '1L', 59, 'Drinks', 'Juices'),
(1008, 'Faunta', 1.00, '1.5L', 0, 'Drinks', 'Sodas'),
(1009, 'Sparkling Water', 3.00, '500ml', 99, 'Drinks', 'Water'),
(1010, 'Monsterade', 4.00, '500ml', 74, 'Drinks', 'Energy'),
(1011, 'Mango Juice', 4.00, '2L', 95, 'Drinks', 'Juices'),
(2000, 'Beef Eye Fillet', 23.00, '500g', 10, 'Meat', 'Beef'),
(2001, 'Beef Mince', 11.00, '1kg', 20, 'Meat', 'Beef'),
(2002, 'Beef Rump Steak', 8.00, '250g', 10, 'Meat', 'Beef'),
(2003, 'Pork Chops', 7.00, '500g', 8, 'Meat', 'Pork'),
(2004, 'Lamb Shoulder', 10.00, '500g', 0, 'Meat', 'Lamb'),
(2005, 'Ham', 5.00, '500g', 20, 'Meat', 'Pork'),
(2006, 'Pork Sausage', 5.00, '1kg', 20, 'Meat', 'Pork'),
(3000, 'Granny Smith Apple', 9.00, '250g', 25, 'Fruit', 'Apple'),
(3001, 'Red Apple', 12.00, '250g', 25, 'Fruit', 'Apple'),
(3002, 'Shine Muscat Grape', 50.00, '500g', 5, 'Fruit', 'Grape'),
(3003, 'Black Grapes', 5.00, '250g', 15, 'Fruit', 'Grape'),
(3004, 'Green Grapes', 5.00, '500g', 15, 'Fruit', 'Grape'),
(3005, 'Red Grapes', 5.00, '250g', 15, 'Fruit', 'Grape'),
(3006, 'Asian Pear', 25.00, '500grams', 15, 'Fruit', 'Pear');
