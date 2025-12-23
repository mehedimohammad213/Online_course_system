<?php
include("db.php");
if ($conn) {
    echo "Database Connected Successfully\n";
    echo "Server: " . mysqli_get_server_info($conn) . "\n";
    echo "Database: online_course_db\n";

    // Check if tables exist
    $result = mysqli_query($conn, "SHOW TABLES");
    if ($result) {
        $tables = mysqli_num_rows($result);
        echo "Tables found: $tables\n";
    }
} else {
    echo "Database connection failed: " . mysqli_connect_error() . "\n";
}
?>
