<?php
// CREATE TABLE goods (
//  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
//    name VARCHAR(255),
//    price DECIMAL(5),
//    description TEXT
// );

// Хотим вставить вот такую строку:

$data = array(
        "name" => "Cup",
        "price" => 5000,
        "description" => "Good reach cup."
    );
   
echo mysql_write_row('goods', $data); // return 1
?>
