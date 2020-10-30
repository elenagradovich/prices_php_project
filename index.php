<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Prices</title>
    </head>
    <body>
        <h1>Парсинг XLS файла</h1>
        <a href='ajax_query_page.php'>Работа с Ajax запросами на PHP => </a>
        <?php
            require 'connect.php';
            require 'createDB.php';
            require 'createTable.php';
            require 'renderTable.php';
            
            connect();
            createDB();
            createTable();
            renderTable();
            closeConnection();
        ?>
    </body>
</html>
