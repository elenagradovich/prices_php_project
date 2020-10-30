<?php
    // Подключение к MySQL
    global $conn;
    
    function connect () {
        global $conn;
        $servername = "localhost"; // локалхост
        $username = "root"; // имя пользователя
        $password = "mysqlpwd"; // пароль если существует
        $conn = mysqli_connect($servername, $username, $password);
        // Проверка соединения
        if (!$conn) {
           die("Ошибка подключения: " . mysqli_connect_error());
        }
    }
    
    
    // Закрыть подключение
    function closeConnection () {
        global $conn;
        if($conn) mysqli_close($conn);
    }
?>

