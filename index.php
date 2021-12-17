<!-- index.php содержит верстку а также скрипты сайта -->

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Каталог</title>
</head>
<body>
<section class="catalog">
  <div class="catalog__container">
  </div>
  <div class="catalog__buttons">
<!--  Кнопка "Еще" отвечает за добавление 25-ти новых товаров на страницу  -->
    <button onclick="getMoreProducts()">Еще</button>
<!--  Кнопка "Меньше" отвечает за то чтобы убрать 25 товаров со страницы (в случае если их больше 25-ти) -->
    <button onclick="showLessProducts()">Меньше</button>
  </div>
</section>
</body>
</html>

<script>
// функция getProducts() получает данные (товары) с базы, а потом инициализирует их рендер
    function getProducts() {
        fetch(`db.php?page=${page}`)
            .then(data => data.json())
            .then(data => renderProducts(data))
    }
/*
  функция getMoreProducts() производит проверку того, не загрузили ли мы еще
  все товары из базы данных. В случае если мы уже загрузили все товары -
  переменная page прекратит инкрементироваться, а страница, при нажатии на кнопу,
  не изменится
*/
    function getMoreProducts() {
        fetch(`db.php`)
            .then(data => data.json())
            .then(data => data[0].count)
            .then(numberOfProducts => numberOfProducts/25)
            .then(numberOfPages => {
                if (page < numberOfPages) {
                    page++
                    getProducts()
                } else if (page === numberOfPages) {
                    getProducts()
                }
            })
    }
// функция showLessProducts() убирает 25 товаров со страницы
    function showLessProducts() {
        page <= 1 ? page = 1 : page--
        getProducts()
    }
// функция renderProducts() отвечает за вставку карточек товаров в ДОМ
    function renderProducts(products) {
        document.querySelector('.catalog__container').innerHTML = ''
        let template = ``
        products.forEach(product => {
            template += `<div class="catalog__product-card">
                            <p>ID товара: ${product.id}</p>
                            <p>Название товара: ${product.name}</p>
                            <p>Цена товара: ${product.price}</p>
                         </div>`
        })
        document.querySelector('.catalog__container').insertAdjacentHTML('afterbegin', template)
    }
// Далее производится небольшая инициализация для начальной страницы
    let page = 1
    getProducts()
</script>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  .catalog {
    background-color: darkgray;
    padding: 25px 0;
  }

  .catalog__container {
    max-width: 1000px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
  }

  .catalog__product-card {
    border: 1px solid black;
    color: white;
    padding: 25px;
    margin: 5px;
    width: 30%;
  }

  .catalog__buttons {
    display: flex;
    justify-content: center;
  }

  .catalog__buttons button {
    padding: 10px;
    cursor: pointer;
  }
</style>
