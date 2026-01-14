<?php

namespace App\Core;

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $servername = "127.0.0.1";
        $username = "course_user";
        $password = "course_pass";
        $dbname = "online_course_db";
        $port = 3306;

        // Enable error reporting for debugging
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        try {
            $this->connection = mysqli_connect($servername, $username, $password, $dbname, $port);
        } catch (\mysqli_sql_exception $e) {
            die("<h2>Database Connection Failed</h2>
                 <p>Could not connect to the database.</p>
                 <p><strong>Error:</strong> " . $e->getMessage() . "</p>");
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
