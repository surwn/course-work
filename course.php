<?php
    $servername = "localhost";
    $username = "root";
    $password = "1111";
    $dbname = "course";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if (isset($_POST['massage'])) {
        $message = $_POST['message'];
        $info = $message;
        $massageWithoutLinks = strip_tags($message);
        preg_match('/#"(\w+)/', $massageWithoutLinks, $matches);
        $key = $matches[1];
        $text = preg_replace('/#"(\w+)/','', $massageWithoutLinks);
        $sql = "INSERT INTO SMS VALUES ('$key', '$text')";
        if ($conn->query($sql) === TRUE) {
            echo "Сообщение сохраненно.";
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    }
?>