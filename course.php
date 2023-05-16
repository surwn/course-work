<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "course";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if (isset($_POST['message'])) {
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
        
        if (isset($_GET['hashtag'])) {
            $hashtag = $_GET['hashtag'];
            $sql = "SELECT * FROM SMS WHERE message LIKE '%#$hashtag%'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<p>" . $row["info"] . "</p>";
                }
            } else {
                echo "Нет сообщений с таким хэштегом.";
            }
        }
    }
?>