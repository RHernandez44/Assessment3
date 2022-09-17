-- DROP DATABASE pizza;
-- CREATE DATABASE IF NOT EXISTS pizza;
-- USE pizza;

-- The items/products for the Pizzeria
DROP TABLE IF EXISTS fooditems;
CREATE TABLE IF NOT EXISTS fooditems (
  itemID int unsigned NOT NULL auto_increment,
  pizza varchar(15) NOT NULL, -- name of pizza
  description text default NULL, -- description of the ingredients
  pizzatype character default "S", -- S - standard, V - vegetarian 
  price float NOT NULL, -- what does the pizza cost
  PRIMARY KEY (itemID)
) AUTO_INCREMENT=1;

INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (1,"PIZZA 1","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing","S",10);
INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (2,"PIZZA 2","Lorem ipsum dolor sit amet, consectetuer","S",10);
INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (3,"PIZZA 3","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur","S",6);
INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (4,"PIZZA 4","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam","S",6);
INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (5,"PIZZA 5","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus.","S",8);
INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (6,"PIZZA 6","Lorem ipsum dolor sit amet, consectetuer adipiscing","S",7);
INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (7,"PIZZA 7","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer aliquam adipiscing lacus.","S",8);
INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (8,"PIZZA 8","Lorem ipsum dolor sit amet,","S",9);
INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (9,"PIZZA 9","Lorem ipsum dolor sit","V",9);
INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (10,"PIZZA 10","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed tortor. Integer","V",6);
INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (11,"PIZZA 11","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur","V",6);
INSERT INTO `fooditems` (`itemID`,`pizza`,`description`,`pizzatype`,`price`) VALUES (12,"PIZZA 12","Lorem","V",7);

-- Student code for `orders` table entered here
DROP TABLE IF EXISTS orders;
CREATE TABLE IF NOT EXISTS orders (
  orderID INT UNSIGNED NOT NULL AUTO_INCREMENT,
  orderLineID INT UNSIGNED NOT NULL,
  customerID INT NOT NULL,
  orderDate DATE NOT NULL,
  orderTime TIME NOT NULL,
  extras TEXT NULL,
  totalCost FLOAT(32) NOT NULL,
  PRIMARY KEY (orderID)
) AUTO_INCREMENT=1;

INSERT INTO `orders` (`orderID`, `orderLineID`, `customerID`, `orderDate`, `orderTime`, `extras`, `totalCost`)
VALUES ("90", "2", "39", "2005-01-27", "13:57:14", "recreational sunrise letting lloyd anchor", "47.04");
INSERT INTO `orders` (`orderID`, `orderLineID`, `customerID`, `orderDate`, `orderTime`, `extras`, `totalCost`)
VALUES ("24", "94", "32", "2009-11-03", "07:20:57", "training bacterial listings sick entries", "65.87");
INSERT INTO `orders` (`orderID`, `orderLineID`, `customerID`, `orderDate`, `orderTime`, `extras`, `totalCost`) VALUES ("63", "21", "23", "1980-04-28", "14:09:06", "reprints spain rom ferrari here", "43.92");
INSERT INTO `orders` (`orderID`, `orderLineID`, `customerID`, `orderDate`, `orderTime`, `extras`, `totalCost`) VALUES ("53", "85", "66", "1990-04-08", "22:57:47", "crops mice perfume harris graduated", "67.03");
INSERT INTO `orders` (`orderID`, `orderLineID`, `customerID`, `orderDate`, `orderTime`, `extras`, `totalCost`) VALUES ("8", "17", "29", "2005-08-31", "10:02:12", "done household fascinating watts cordless", "3.86");
INSERT INTO `orders` (`orderID`, `orderLineID`, `customerID`, `orderDate`, `orderTime`, `extras`, `totalCost`) VALUES ("49", "66", "11", "1984-01-25", "09:05:07", "better dining toyota usps obituaries", "15.16");
INSERT INTO `orders` (`orderID`, `orderLineID`, `customerID`, `orderDate`, `orderTime`, `extras`, `totalCost`) VALUES ("41", "57", "83", "1991-09-26", "14:59:45", "presenting liverpool transportation manual portion", "20.2");
INSERT INTO `orders` (`orderID`, `orderLineID`, `customerID`, `orderDate`, `orderTime`, `extras`, `totalCost`) VALUES ("79", "46", "11", "2006-02-22", "09:19:56", "negative boulder adam worcester poems", "76.09");
INSERT INTO `orders` (`orderID`, `orderLineID`, `customerID`, `orderDate`, `orderTime`, `extras`, `totalCost`) VALUES ("26", "25", "81", "1974-04-29", "16:54:24", "thickness sc villages break westminster", "75.5");
INSERT INTO `orders` (`orderID`, `orderLineID`, `customerID`, `orderDate`, `orderTime`, `extras`, `totalCost`) VALUES ("3", "59", "53", "2011-06-09", "04:32:41", "newer provinces bradley relay decisions", "56.27");

-- Student code for `orderLines)` table entered here
-- Fooditems per order 
DROP TABLE IF EXISTS orderlines;
CREATE TABLE IF NOT EXISTS orderlines ( 
    orderLineID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    itemID int unsigned NULL,
    orderID INT UNSIGNED NULL,
    PRIMARY KEY (orderLineID)
)AUTO_INCREMENT=1;

INSERT INTO `orderlines` (`orderLineID`, `itemID`, `orderID`) VALUES ("65", "1","4");
INSERT INTO `orderlines` (`orderLineID`, `itemID`, `orderID`) VALUES ("46", "9", "24");
INSERT INTO `orderlines` (`orderLineID`, `itemID`, `orderID`) VALUES ("43", "2", "90");
INSERT INTO `orderlines` (`orderLineID`, `itemID`, `orderID`) VALUES ("17", "1", "79");
INSERT INTO `orderlines` (`orderLineID`, `itemID`, `orderID`) VALUES ("42", "9", "3");
INSERT INTO `orderlines` (`orderLineID`, `itemID`, `orderID`) VALUES ("13", "6", "8");
INSERT INTO `orderlines` (`orderLineID`, `itemID`, `orderID`) VALUES ("50", "7", "49");
INSERT INTO `orderlines` (`orderLineID`, `itemID`, `orderID`) VALUES ("81", "7", "37");
INSERT INTO `orderlines` (`orderLineID`, `itemID`, `orderID`) VALUES ("33", "8", "64");
INSERT INTO `orderlines` (`orderLineID`, `itemID`, `orderID`) VALUES ("41", "2", "63");


-- Bookings for the resturaunt
DROP TABLE IF EXISTS booking;
CREATE TABLE IF NOT EXISTS booking (
  bookingID int unsigned NOT NULL auto_increment,
  customerID int unsigned NOT NULL,
  telephone varchar(14) NOT NULL,
  bookingdate date,
  bookingtime time,
  people int default 1,
  PRIMARY KEY (bookingID)
) AUTO_INCREMENT=1;

insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (1, 1, "592-232-0521", "2021-12-18",  "17:29:36", 2);
insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (2, 8, "775-120-6785", "2021-05-18",  "06:13:06", 4);
insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (3, 4, "393-916-0672", "2021-02-11",  "08:39:29", 1);
insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (4, 9, "114-541-0005", "2021-11-28",  "12:20:58", 1);
insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (5, 2, "561-687-0825", "2021-06-10",  "03:52:37", 4);
insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (6, 9, "959-512-2639", "2021-03-24",  "17:06:28", 3);
insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (7, 2, "593-781-9360", "2021-03-01",  "04:11:27", 4);
insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (8, 7, "473-595-2768", "2021-11-04",  "08:16:06", 5);
insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (9, 4, "673-132-5499", "2021-01-29",  "16:57:48", 3);
insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (10, 1, "151-149-9447", "2021-05-20",  "14:13:23", 2);
insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (11, 4, "382-125-5641", "2021-01-16",  "17:42:15", 5);
insert into booking (bookingID, customerID, telephone, bookingdate, bookingtime, people) values (12, 7, "507-644-2363", "2021-03-24",  "05:13:46", 3);


-- Customers
DROP TABLE IF EXISTS customer;
CREATE TABLE IF NOT EXISTS customer (
  customerID int unsigned NOT NULL auto_increment,
  firstname varchar(50) NOT NULL,
  lastname varchar(50) NOT NULL,
  email varchar(100) NOT NULL,  
  password varchar(40) NOT NULL default ".",
  PRIMARY KEY (customerID)
) AUTO_INCREMENT=1;

INSERT INTO customer (customerID,firstname,lastname,email) VALUES 
(2,"Desiree","Collier","Maecenas@non.co.uk"),
(3,"Irene","Walker","id.erat.Etiam@id.org"),
(4,"Forrest","Baldwin","eget.nisi.dictum@a.com"),
(5,"Beverly","Sellers","ultricies.sem@pharetraQuisqueac.co.uk"),
(6,"Glenna","Kinney","dolor@orcilobortisaugue.org"),
(7,"Montana","Gallagher","sapien.cursus@ultriciesdignissimlacus.edu"),(8,"Harlan","Lara","Duis@aliquetodioEtiam.edu"),
(9,"Benjamin","King","mollis@Nullainterdum.org"),
(10,"Rajah","Olsen","Vestibulum.ut.eros@nequevenenatislacus.ca"),
(11,"Castor","Kelly","Fusce.feugiat.Lorem@porta.co.uk"),
(12,"Omar","Oconnor","eu.turpis@auctorvelit.co.uk"),
(13,"Porter","Leonard","dui.Fusce@accumsanlaoreet.net"),
(14,"Buckminster","Gaines","convallis.convallis.dolor@ligula.co.uk"),
(15,"Hunter","Rodriquez","ridiculus.mus.Donec@est.co.uk"),
(16,"Zahir","Harper","vel@estNunc.com"),
(17,"Sopoline","Warner","vestibulum.nec.euismod@sitamet.co.uk"),
(18,"Burton","Parrish","consequat.nec.mollis@nequenonquam.org"),
(19,"Abbot","Rose","non@et.ca"),
(20,"Barry","Burks","risus@libero.net");

-- special account for the purposes of this exercise
-- refer to the checksession.php on how it is used
INSERT INTO customer (customerID,firstname,lastname,email,password) VALUES 
(1,"Admin","Admin","admin@pizza.com","password"),
(21,"CustomerFirst","CustomerLast","customer@test.com","password");
