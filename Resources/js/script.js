'use strict';

window.onload = function() {
    const tableContainer = document.querySelector('.page__request-table-container');
    
    const priceTypeSelect = document.querySelector('.form__price-type');
    let priceType = priceTypeSelect.value;
    priceTypeSelect.addEventListener('change', (e) => {
      priceType = e.target.value;
    });
    
    const minPriceInput = document.querySelector('.form__min-price');
    let minPrice = minPriceInput.value;
    minPriceInput.addEventListener('change', (e) => {
      minPrice = e.target.value;
    });
    
    const maxPriceInput = document.querySelector('.form__max-price');
    let maxPrice = maxPriceInput.value;
    maxPriceInput.addEventListener('change', (e) => {
      maxPrice = e.target.value;
    });
    
    const limitTypeSelect = document.querySelector('.form__limit-type');
    let limitType = limitTypeSelect.value;
    limitTypeSelect.addEventListener('change', (e) => {
      limitType = e.target.value;
    });
    
    const amountInput = document.querySelector('.form__amount');
    let amount = amountInput.value;
    amountInput.addEventListener('change', (e) => {
      amount = e.target.value;
    });
    
    const createRequestURL = () => {
        return `getRequestData.php?minPrice=${minPrice}&amount=${amount}&maxPrice=${maxPrice}&limitType=${limitType}&priceType=${priceType}`;
    }
    
    const getResult = (method, url) => {
        return new Promise((resolve, reject) => {
            const xhr = new XMLHttpRequest();
            xhr.open(method, url, true);
            xhr.onload = () => {
                if (xhr.readyState==4 && xhr.status==200) {
                    resolve(xhr.response ? JSON.parse(xhr.response) : null);
                } else {
                    reject(xhr.response);
                }
            };
            xhr.onerror = () => {
                reject(xhr.response);
            }

            xhr.send();
        })
    };
    
    const createTable = (response) => {
        tableContainer.innerHTML = '';
        if(response && response.length>0) {
            
            let table = document.createElement('table');
            table.setAttribute('cellspacing', '2');
            table.setAttribute('border', '1');
            table.setAttribute('cellpadding', '5');
            table.setAttribute('border-collapse', 'collapse');
            let fragment = new DocumentFragment();
            const createTD = (tr, value, isHeader) => {
                let td;
                if(isHeader) {
                    td = document.createElement('th');
                } else {
                    td = document.createElement('td');
                }
                td.append(value);
                tr.append(td);
            }
            
            let tr = document.createElement('tr');
            const itemRow = ['Наименование товара', 'Стоимость, руб', 'Стоимость опт, руб', 'Наличие на складе 1, шт', 'Наличие на складе 2, шт', 'Страна производства' ];
            itemRow.forEach(item => createTD(tr, item, true))
            fragment.append(tr);
            response.forEach((item) => {
                let tr = document.createElement('tr');
                const { productName, price, priceWholesale, amountStock1, amountStock2, countryFrom } = item;
                
                for(let itemEl in item) {
                    createTD(tr, item[itemEl]);
                }
                fragment.append(tr);
            });
            table.append(fragment);
            tableContainer.append(table);
        } else {
            tableContainer.innerHTML = '<p>Данных по Вашему запросу не обнаружено. Попробуйте изменить условия фильтров</p>'
        }
    };
    
    let error, err;
    
    getResult('get', createRequestURL())
        .then(response => {
            response ? createTable(response) : console.log('данных нет');
        }) 
        .catch(err = console.log(error));

    const submitInput = document.querySelector('.form__submit');
    submitInput.addEventListener('click', (e) => {
        e.preventDefault();
        getResult('get', createRequestURL())
            .then(response => {
                response ? createTable(response) : console.log('данных нет');
            }) 
            .catch(err = console.log(error));
    });
    
};