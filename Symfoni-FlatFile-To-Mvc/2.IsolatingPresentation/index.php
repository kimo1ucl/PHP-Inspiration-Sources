<?php
// index.php
$connection = new PDO("mysql:host=localhost;dbname=blog_db", 'symfony-flatphp-to-mvc', 'start123');

$result = $connection->query('SELECT id, title FROM post');

#var_dump($result);

$posts = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $posts[] = $row;
}

$connection = null;

// include the HTML presentation code
require 'templates/list.php';