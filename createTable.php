<?php
    function createTable ($conn) {
        
        $sql = "USE Prices";
        mysqli_query($conn, $sql);

        $sql = "DROP TABLE IF EXISTS PriceList;";
        mysqli_query($conn, $sql);


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


