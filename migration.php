<?php
include("assest/_db.php");


$createTableSql = "CREATE TABLE IF NOT EXISTS `tasks` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `task` TEXT NOT NULL,
    `user_id` INT(11) NOT NULL,
    `fromtime` DATETIME NOT NULL,
    `totime` DATETIME NOT NULL,
    `status` varchar(11) Default('pending'), 
    `dt` DATETIME NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
)";

if ($conn->query($createTableSql) === TRUE) {
    echo "Table `tasks` created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}