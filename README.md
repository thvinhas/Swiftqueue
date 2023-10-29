
# Swiftqueue Course Manager

The Swiftqueue School of High Tech is embarking on a transformative journey to enhance the management of their courses. They envision an efficient, online solution that ensures seamless access to course information for their students. The "Swiftqueue Course Manager" project is your opportunity to demonstrate your full-stack prowess. As a developer, you will create a web application that empowers the school to manage and showcase their courses with ease.



## Installation

create your database and run this SQL to create the tables

```bash
CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
)
```

```bash
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
)
```
```bash
INSERT INTO `user` VALUES (1,'Admin','admin','$2y$10$mgkouCx8IeYGPI2qY/8O9OwwD0x5806zcOHNU2diffsPqN.gJ0jiG');
```

Into the app/conection/conection.php change the variables to conect into your database
    