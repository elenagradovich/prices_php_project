<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Prices</title>
    </head>
    <body>
        <h1>Работа с Ajax запросами на PHP</h1>
        <a href='index.php'>Парсинг XLS файла =></a>
        <section>
            <form method='get' action=''>
                <p>Показать товары, у которых</p>
                <select class='form__price-type' name='priceType'>
                    <option value='wholesalePrice'>Оптовая цена</option>
                    <option value='retailPrice'>Розничная цена</option>
                </select>
                <span>от</span>
                <input class='form__min-price' type='number' name='minPrice' value='1000'>
                <span>до</span>
                <input class='form__max-price' type='number' name='maxPrice' value='3000'>
                <span>рублей и на складе</span>
                <select class='form__limit-type' name='limitType'>
                    <option value='limitMore'>Более</option>
                    <option value='limitLess'>Менее</option>
                </select>
                <input class='form__amount' type='number' name='amount' value='20'>
                <span>штук.</span>
                <input class='form__submit' type='submit' value='Показать товары'>
            </form>
        </section>
        <div class='page__request-table-container'>
        </div>
        <script src="Resources/js/script.js"></script>
    </body>
</html>
