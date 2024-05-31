<?php
const BASE_DIR = __DIR__ . '/../';
const APP_DIR = BASE_DIR . 'app/';

require BASE_DIR . '../vendor/autoload.php';

require 'config.php';


try {
    $db = new \Core\DB();

    $action = $db->connection->exec(file_get_contents(APP_DIR . 'migrations.sql'));

    $day = [];
    $today = Carbon\Carbon::today();
    for ($i = 1; $i <= 7; $i++) {
        $day[] = $today->format('Y-m-d');
        $today->addDay();
    }

    $appointments = [
        [3, $day[5], 1],
        [1, $day[0], 2],
        [4, $day[4], 2],
        [10, $day[1], 1],
        [6, $day[3], 1],
        [4, $day[2], 1],
        [6, $day[6], 1],
        [8, $day[3], 1],
        [5, $day[2], 1],
        [3, $day[3], 1],
    ];

    foreach ($appointments as $appointment) {
        $db->insert('INSERT INTO appointments (time_id, date, user_id) VALUES (:timeId, :date, :userId)', [
            ':timeId' => $appointment[0],
            ':date' => $appointment[1],
            ':userId' => $appointment[2],
        ]);
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>