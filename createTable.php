<?php
    function createTable () {
        global $conn;
        
        $sql = "USE Prices";
        if (!mysqli_query($conn, $sql)) {
            echo "Ошибка БД не выбрана: " . mysqli_error($conn);
        };

        $sql = "DROP TABLE IF EXISTS PriceList;";
        if (!mysqli_query($conn, $sql)) {
            echo "Ошибка удаления БД: " . mysqli_error($conn);
        };


        $sql = "CREATE TABLE PriceList(
    ORDER_NUMBER INT,
    PRODUCT_NAME VARCHAR(250),
    PRICE DECIMAL(13, 2),
    PRICE_WHOLESALE DECIMAL(13, 2),
    AMOUNT_STOCK1 INT,
    AMOUNT_STOCK2 INT,
    COUNTRY_FROM VARCHAR(30),
    PRIMARY KEY (ORDER_NUMBER));";

        if (!mysqli_query($conn, $sql)) {
            echo "Ошибка создания таблицы: " . mysqli_error($conn);
        };
    }
?>  


