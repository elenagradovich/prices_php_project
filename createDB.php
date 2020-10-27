<?php
    function createDB($conn) {
        // Созданние базы данных
        $sql = "CREATE DATABASE IF NOT EXISTS Prices;";
        if (!mysqli_query($conn, $sql)) {
            echo "Ошибка создания базы данных: " . mysqli_error($conn);
        }
    }
?>

