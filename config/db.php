<?php
$servername = "127.0.0.1";
$username = "course_user";
$password = "course_pass";
$dbname = "online_course_db";
$port = 3306;

// Enable error reporting for debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = mysqli_connect($servername, $username, $password, $dbname, $port);
} catch (mysqli_sql_exception $e) {
    die("<h2>Database Connection Failed</h2>
         <p>Could not connect to the database. Please check your configuration in <code>config/db.php</code>.</p>
         <p><strong>Error:</strong> " . $e->getMessage() . "</p>
         <hr>
         <p>If you have not set up the database yet, please:</p>
         <ol>
            <li>Open <code>config/db.php</code> and set the correct <code>\$username</code> and <code>\$password</code> for your MySQL server.</li>
            <li>Run <code>php setup_database.php</code> in the terminal.</li>
         </ol>");
}
?>
