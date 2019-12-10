CREATE DATABASE IF NOT EXISTS `api` ;
USE `api`;

CREATE TABLE IF NOT EXISTS `disburse` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `time_served` char(50) DEFAULT NULL,
    `receipt` varchar(250) DEFAULT NULL,
    `status` varchar(250) DEFAULT NULL,
   
    PRIMARY KEY (`id`)
)