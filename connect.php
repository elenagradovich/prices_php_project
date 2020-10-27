<?php
    // Подключение к MySQL
    function connect () {
        $servername = "localhost"; // локалхост
        $username = "root"; // имя пользователя
        $password = "mysqlpwd"; // пароль если существует
        $conn = mysqli_connect($servername, $username, $password);
        // Проверка соединения
        if (!$conn) {
           die("Ошибка подключения: " . mysqli_connect_error());
        }
        return $conn;
    }
    
    // Закрыть подключение
    function closeConnection ($conn) {
        if($conn) mysqli_close($conn);
    }
?>

