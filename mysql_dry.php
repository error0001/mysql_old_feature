<?php

/**
* Оптимизация
- Избегать а лучше не выполнять запросы в цикле.
- Пытаться делать меньшее кол-во запросов в базу.
*/
//Вставки

// INSERT
$log = parse_log();
while($record = next($log))
query('INSERT INTO logs SET value = '. $log['value']);
// Проще
// INSERT INTO logs (value) VALUES (...), (...)

// UPDATE
// if use
UPDATE news SET title='test' WHERE id IN (1, 2, 3)
// =>
UPDATE news SET
title = CASE
WHEN news_id = 1 THEN 'aa'
WHEN news_id = 2 THEN 'bb' END
WHERE news_id IN (1, 2)

/**
 * Факты:
 - TIMESTAMP совпадает с DATETIME,
*/

/**
* Хэширование
*/

$str = 'яблоко';
if (md5($str) === '1afa148eb41f2e7103f21410bf48346c') {
    echo "Вам зеленое или красное яблоко?";
}



/**
 * Работа с с таблицами.
*/
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

/**
 * Обработка с исключениями и ошибками.
 */

// 1. connection
// Попытка установить соединение с MySQL:
if (!mysql_connect($server, $user, $ password)) {
        echo "Ошибка подключения к серверу MySQL";
        // echo "ERROR ".mysql_errno()." ".mysql_error()."\n"; // Детальный осмотр ошибок
        exit;
}
@mysql_query ("SET NAMES 'cp1251'");    // руский текст будет появляться не понятными знаками
// Соединились, теперь выбираем базу данных:
mysql_select_db($db);

/** 
Обработка запроса.
mysql_result() - получить необходимый элемент из набора записей;
mysql_fetch_array() - занести запись в массив;
mysql_fetch_row() - занести запись в массив;
mysql_fetch_assoc() - занести запись в ассоциативный массив;
mysql_fetch_object() - занести запись в объект.
*/     
$q = mysql_query("SELECT * FROM mytable");
echo "В таблице mytable ".mysql_num_rows($q)." записей";

$q = mysql_query("SELECT * FROM mytable");
echo "В таблице mytable ".mysql_num_fields($q)." полей ";
        

/**
 * Работа с кодировками
 */
//. Оператор CREATE TABLE для создания таблицы test

$query = "CREATE TABLE test (
  dos_name TEXT CHARACTER SET cp866 COMMENT `Кодировка DOS`,
  win_name TEXT CHARACTER SET cp1251 COMMENT `Кодировка Windows`,
  koi8r_name TEXT CHARACTER SET koi8r COMMENT `Кодировка KOI8-R`,
  utf8_name TEXT CHARACTER SET utf8 COMMENT `Юникод`
)";

//  Создание таблицы, для хранения русского текста в кодировке cp1251

$query = "CREATE TABLE catalogs (
  id_catalog INT(11) NOT NULL,
  name TINYTEXT NOT NULL
) ENGINE=MyISAM CHARACTER SET cp1251";

?>
