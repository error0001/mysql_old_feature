<?php

// 1. Добавить строку

// CREATE TABLE goods (
//  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
//    name VARCHAR(255),
//    price DECIMAL(5),
//    description TEXT
// );

$data = array(
        "name" => "Cup",
        "price" => 5000,
        "description" => "Good reach cup."
    );
   
echo mysql_write_row('goods', $data); // return 1

// 2. Обновлять строку
$set_keys = array(
    'f1'=>11,
    'f2'=>22
);
$where_keys = array(
    'f2'=>2,
    'f3'=>3
);
mysql_write_row('tablename', $set_keys, $where_keys);
// UPDATE tablename SET f1=11, f2=22 WHERE f2=2 AND f3=3

// 3. Экранирование escape последовательностей 
$id = 5;
$name = "O'Reilly";

$sql = "
    SELECT ...
    WHERE id = " . mysql_escape($id) . "
      AND name = " . mysql_escape($name) . ";
    ";
// В результате получится запрос
// SELECT ...
// WHERE id = 5
//   AND name = 'O\'Reilly'

?>
