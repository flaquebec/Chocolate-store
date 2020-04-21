<?php
$host       = "mysql_app";
$username   = "root";
$password   = "secret";
$dbname     = "app";

try {
    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

// migrate
if (file_exists(__DIR__ . '/migrations/lock') === false) {
    
    $migrations = scandir(__DIR__ . '/migrations');
    foreach ($migrations as $migration) {

        if ($migration === '.' || $migration === '..') {
            continue;
        }
        
        $sql = file_get_contents(__DIR__ . "/migrations/$migration");
        $connection->exec($sql);
    }
    file_put_contents(__DIR__ . '/migrations/lock', '');
}

// seed
if (file_exists(__DIR__ . '/seeders/lock') === false) {
    
    $seeders = scandir(__DIR__ . '/seeders');
    foreach ($seeders as $seeder) {

        if ($seeder === '.' || $seeder === '..') {
            continue;
        }
        
        $sql = file_get_contents(__DIR__ . "/seeders/$seeder");
        $connection->exec($sql);
    }
    file_put_contents(__DIR__ . '/seeders/lock', '');
}
