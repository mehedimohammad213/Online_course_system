<?php
session_start();
include("../config/db.php");

if ($_SESSION['role'] != 'instructor') {
    header("Location: ../auth/login.php");
}

$course_id = $_GET['id'];
?>

<h2>Upload Course Material</h2>

<form method="post" enctype="multipart/form-data">
    Title: <br>
    <input type="text" name="title"><br><br>

    File: <br>
    <input type="file" name="file"><br><br>

    <input type="submit" name="upload" value="Upload">
</form>

<?php
if (isset($_POST['upload'])) {
    $title = $_POST['title'];
    $file_name = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];

    move_uploaded_file($tmp, "../uploads/".$file_name);

    mysqli_query($conn, "INSERT INTO materials (course_id, title, file_path)
                         VALUES ($course_id, '$title', '$file_name')");

    echo "Material Uploaded";
}
?>
