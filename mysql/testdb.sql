

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `users` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `admin` BOOLEAN DEFAULT false,
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `port` int DEFAULT 0 
);

CREATE TABLE `storeData` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `data` VARCHAR(300) NOT NULL 
);


CREATE TABLE `challenges`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `check` BOOLEAN DEFAULT false,
    `user_id` int NOT NULL,
    foreign key challenges(user_id) references users(id) on delete cascade on update cascade

);

CREATE TABLE `user_data`(
`USERID` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
`FIRST_NAME`VARCHAR(255), 
`LAST_NAME` VARCHAR(255), 
`CC_NUMBER` VARCHAR(255), 
`CC_TYPE` VARCHAR(255), 
`COOKIE` VARCHAR(255), 
`LOGIN_COUNT` INT
);


CREATE TABLE `employees` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `department` VARCHAR(100) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `salary` INT(10) NOT NULL
);

CREATE TABLE `news` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    `context` VARCHAR(1000) NOT NULL,
    `view` BOOLEAN DEFAULT true
);




INSERT INTO `user_data`(`USERID`, `FIRST_NAME`, `LAST_NAME`, `CC_NUMBER`, `CC_TYPE`, `COOKIE`, `LOGIN_COUNT`) VALUES
(101, 'Pedro',  'Carter', '4916 5361 9422 8944', 'VISA','' , 1),
(102, 'Katharine',  'Morales', '4556 7957 2283 1232', 'VISA','' , 1),
(103, 'John',  'Cagle', '4532 3058 0550 1402', 'VISA','' , 2),
(104, 'Everett',  'Hale', '4916 4793 8469 2027', 'VISA','' , 4),
(105, 'Joseph',  'Hines', '4485 5971 2095 7825', 'VISA','' , 6);


CREATE TABLE `user_system_data` (
    `userid` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_name` VARCHAR(12),
    `password` VARCHAR(10),
    `cookie` VARCHAR(30)
);

INSERT INTO `user_system_data` (`userid`, `user_name`, `password`, `cookie`) VALUES 
(101, 'Pedro' , '123four56', '' ),
(102, 'Katharine','1qaz@wsx', '' ),
(103, 'John','qweRty', '' ),
(104, 'Everett', '12qwAszx', '' ),
(105, 'Joseph', 'asdFgh', '' );



CREATE TABLE `user_salary_data` (
    `userid` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `user_name` VARCHAR(12),
    `salary` int
);

INSERT INTO `user_salary_data` (`userid`, `user_name`, `salary`) VALUES 
(101, 'Pedro' , 600000),
(102, 'Katharine',760000),
(103, 'John',23000),
(104, 'Everett', 53000),
(105, 'Joseph', 45000 );


INSERT INTO `news` (`id`, `title`,`context`,`view`) VALUES
(1, 'Good News','the good box',true),
(2, 'Happy','aaasd',false),
(3, 'No_you_see','flag{IDOR_meow}',false),
(4, 'News','The hacker is here',false),
(5, 'News','no body care',false);




INSERT INTO `users` (`id`, `username`,`password`,`admin`,`port`) VALUES
(1, 'admin','62c528ed4849ae5c5e3a54c88e05405b',true,49996),
(2, 'flag','flag{SQL_SSSSSSSS}',false,49997),
(3, 'herry','password',false,49998),
(4, 'root','e35c9e19691be326d7b30f68548ed498',false,49999);

INSERT INTO `employees` (`id`, `name`,`department`,`address`,`salary`) VALUES
(1, 'Mandy','Accounting','Taiwan','5000000'),
(2, 'Tobi','Development','Japan','2500000'),
(3, 'Paulina','Marketing','Taiwan','3600000'),
(4, 'Abraham','Development','America','540000'),
(5, 'Bob','Marketing','Korea','580000');



CREATE TABLE `xss_data` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(255),
    `context` VARCHAR(255),
    `user_id` int NOT NULL,
    foreign key xss_data(user_id) references users(id) on delete cascade on update cascade
);

CREATE TABLE `myDb`.`products` ( 
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
    `name` VARCHAR(50) NOT NULL , 
    `category` VARCHAR(20) NOT NULL , 
    `released` BOOLEAN NOT NULL
);

INSERT INTO `products`(`id`, `name`, `category`, `released`) VALUES 
(1,'chocolate','Gifts','1'),
(2,'candy','Gifts','1'),
(3,'diamonds','Gifts','0'),
(4,'chicken','meat','1'),
(5,'pork','meat','1'),
(6,'beef','meat','1');


CREATE TABLE `myDb`.`ctfnews` ( 
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
    `name` VARCHAR(20) NOT NULL , 
    `text` VARCHAR(50) NOT NULL 
);


CREATE TABLE `myDb`.`secret` ( 
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
    `THIS_IS_FLAG` VARCHAR(50) NOT NULL
);

CREATE USER 'newsuser'@'%' IDENTIFIED BY 'happyhacking';
grant SELECT ON `myDb`.`ctfnews` TO 'newsuser'@'%' IDENTIFIED BY 'happyhacking';
grant SELECT ON `myDb`.`secret` TO 'newsuser'@'%' IDENTIFIED BY 'happyhacking';
FLUSH PRIVILEGES;

CREATE TABLE `myDb`.`ctfuser` ( 
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL
);

CREATE USER 'ctfuser'@'%' IDENTIFIED BY 'happyhacking';
grant SELECT ON `myDb`.`ctfuser` TO 'ctfuser'@'%' IDENTIFIED BY 'happyhacking';
FLUSH PRIVILEGES;


INSERT INTO `myDb`.`ctfnews`(`id`, `name`, `text`) VALUES 
(1,'Th1s is SQL game','you can try it!'),
(2,'check id','id is good'),
(3,'you can use union','union select');

INSERT INTO `myDb`.`secret`(`id`, `THIS_IS_FLAG`) VALUES 
(1,'Flag{you_get_fl@g_g00d_job!}');

INSERT INTO `myDb`.`ctfuser`(`id`, `username`, `password`) VALUES 
(1,'admin','gdyuifqhifqwklejqwlfmflkasjg');



CREATE TABLE `myDb`.`moneypig` ( 
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
    `money` INT NOT NULL,
    `date` VARCHAR(50) NOT NULL,
    `who` VARCHAR(50) NOT NULL,
    `reason` VARCHAR(50) NOT NULL
);

INSERT INTO `moneypig` (`id`, `money`, `date`, `who`, `reason`) VALUES (NULL, '10', '20220103', 'brother', 'housework');
INSERT INTO `moneypig` (`id`, `money`, `date`, `who`, `reason`) VALUES (NULL, '1000', '20220105', 'brother', 'lucky money');
INSERT INTO `moneypig` (`id`, `money`, `date`, `who`, `reason`) VALUES (NULL, '10', '20220103', 'sister', 'housework');
INSERT INTO `moneypig` (`id`, `money`, `date`, `who`, `reason`) VALUES (NULL, '10', '20220104', 'sister', 'housework');
INSERT INTO `moneypig` (`id`, `money`, `date`, `who`, `reason`) VALUES (NULL, '10', '20220105', 'sister', 'housework');
INSERT INTO `moneypig` (`id`, `money`, `date`, `who`, `reason`) VALUES (NULL, '10', '20220106', 'sister', 'housework');
INSERT INTO `moneypig` (`id`, `money`, `date`, `who`, `reason`) VALUES (NULL, '10', '20220107', 'sister', 'housework');
INSERT INTO `moneypig` (`id`, `money`, `date`, `who`, `reason`) VALUES (NULL, '10', '20220103', 'brother', 'housework');
INSERT INTO `moneypig` (`id`, `money`, `date`, `who`, `reason`) VALUES (NULL, '10', '20220104', 'brother', 'housework');
INSERT INTO `moneypig` (`id`, `money`, `date`, `who`, `reason`) VALUES (NULL, '10', '20220105', 'brother', 'housework');
INSERT INTO `moneypig` (`id`, `money`, `date`, `who`, `reason`) VALUES (NULL, '10', '20220106', 'brother', 'housework');


CREATE USER 'selectuser'@'%' IDENTIFIED BY 'happyhacking';
grant SELECT ON `myDb`.`moneypig` TO 'selectuser'@'%' IDENTIFIED BY 'happyhacking';

grant SELECT ON `myDb`.`employees` TO 'selectuser'@'%' IDENTIFIED BY 'happyhacking';
grant SELECT ON `myDb`.`user_data` TO 'selectuser'@'%' IDENTIFIED BY 'happyhacking';
grant SELECT ON `myDb`.`products` TO 'selectuser'@'%' IDENTIFIED BY 'happyhacking';
grant SELECT ON `myDb`.`user_system_data` TO 'selectuser'@'%' IDENTIFIED BY 'happyhacking';
grant SELECT ON `myDb`.`user_salary_data` TO 'selectuser'@'%' IDENTIFIED BY 'happyhacking';
FLUSH PRIVILEGES;

CREATE USER 'xssuser'@'%' IDENTIFIED BY 'happyxsshacking';
grant SELECT,INSERT ON `myDb`.`xss_data` TO 'xssuser'@'%' IDENTIFIED BY 'happyxsshacking';
FLUSH PRIVILEGES;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;