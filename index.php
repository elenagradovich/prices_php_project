<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Prices</title>
    </head>
    <body>
        <h1>Парсинг XLS файла.</h1>
        <?php
            require 'connect.php';
            require 'createDB.php';
            require 'createTable.php';
            require 'renderTable.php';
            
            $conn = connect();
            if($conn){
                global $conn;
                createDB($conn);
                createTable($conn);
                renderTable($conn);
                closeConnection($conn);
            }
        ?>
    </body>
</html>
