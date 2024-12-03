<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = ""; // Пока оставляю пустым
$dbname = "cars_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем ID машины из URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $carId = (int)$_GET['id'];
    
    // SQL-запрос для получения данных о машине
    $sql = "SELECT * FROM cars WHERE id = $carId";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Получение данных
        $car = $result->fetch_assoc();
    } else {
        echo "<h3>Машина с таким ID не найдена</h3>";
        exit();
    }
} else {
    echo "<h3>ID машины не указан</h3>";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Детали машины</title>
    <link rel="stylesheet" href="../css-stylee/car_page.css"> 
</head>
<body>
    <div>
		<header class="headerBox">
			
			<span class="logo"><a href="../index.html">Наше-Авторія</a></span>
			
			<nav>
				<ul >
					<li><a href="#">КОНТАКТИ</a></li>
					<li><a href="#">ПРО НАС</a></li>
					<li><a href="#">ПРОПОЗИЦІЇ</a></li>
				</ul>
			</nav>

			<a href="../personal_office.html" class="newAccount"><img src="../img/account.svg"></a>
		</header>
	</div>

	<div class="car-inspection">
		<div class="img-slaiders">
            <img src="/CarShowroom/<?php echo $car['image']; ?>" alt="Car Image">
		</div>
		<div class="car-information">
			<form action="../payment.html">
				<ul>
					<li id="brand-name"><?php echo $car['brand'] . " " . $car['model']; ?></li>
					<li>Колір: Сірий Металік</li>
					<li>Обʼєм двигуна: <?php echo $car['engine_volume']; ?> л</li>
					<li>Тип палива: <?php echo $car['fuel_type']; ?></li>
					<li>Вид кузову: <?php echo $car['body_type']; ?></li>
					<li id="price"><?php echo $car['price']; ?> USD</li>
					<li id="button-reserve"><button>Забронювати</button></li>
				</ul>
			</form>
		</div>
	</div>


	<div class="middle">
		<form action="../payment.html">
				
			<div class="first-block">
				
				<h1>Додаткові послуги</h1>

				<div class="additional-services">
					<ul>
						<li class="first-li">
							<ul class="nested-list">
								<li>Підігрів сидінь</li>
								<li class="right-block">150 000,00грн <input type="checkbox" name="heated-seats"></li>
							</ul>
						</li>
						<li class="first-li">
							<ul class="nested-list">
								<li>Матеріал салону кожа</li>
								<li class="right-block">200 000,00грн <input type="checkbox" name="interior-material"></li>
							</ul>
						</li>
						<li class="first-li" id="block-interior-material">
							<label>
								<input type="radio" name="radio-interior-material">
								<img src="../img/material1.svg">
							</label>
							<label>
								<input type="radio" name="radio-interior-material">
								<img src="../img/material2.svg">
							</label>
							<label>
								<input type="radio" name="radio-interior-material">
								<img src="../img/material3.svg">
							</label>
							<label>
								<input type="radio" name="radio-interior-material">
								<img src="../img/material4.svg">
							</label>
						</li>
						<li class="first-li">
							<ul class="nested-list">
								<li>Інший колір авто</li>
								<li class="right-block">90 000,00грн <input type="checkbox" name="color-car"></li>
							</ul>
						</li>
						<li class="first-li">
							<ul class="nested-list" id="colorblock">
								<li>
									<input type="radio" name="radio-color" id="color1">
									<input type="radio" name="radio-color" id="color2">
									<input type="radio" name="radio-color" id="color3">
									<input type="radio" name="radio-color" id="color4">
									<input type="radio" name="radio-color" id="color5">
									<input type="radio" name="radio-color" id="color6">
									<input type="radio" name="radio-color" id="color7">
									<input type="radio" name="radio-color" id="color8">
									<input type="radio" name="radio-color" id="color9">
									<input type="radio" name="radio-color" id="color10">
								</li>
							</ul>
						</li>
						<li class="first-li">
							<ul class="nested-list">
								<li>Два види палива</li>
								<li class="right-block">180 000,00грн <input type="checkbox" name="type-of-fuel"></li>
							</ul>
						</li>
						<li class="first-li">
							<ul class="nested-list">
								<li class="block-radio-fuel">
									<div>
										<label for="radio-fuel">Бензин</label>
										<input type="radio" name="radio-fuel">
									</div>
									<div>
										<label for="radio-fuel">Газ</label>
										<input type="radio" name="radio-fuel">
									</div>
									<div>
										<label for="radio-fuel">Електро</label>
										<input type="radio" name="radio-fuel">
									</div>
								</li>
							</ul>
						</li>
						<li class="first-li">
							<ul class="nested-list">
								<li>Коробка передач: Автомат</li>
								<li class="right-block">100 000,00грн <input type="checkbox" name="gear-box"></li>
							</ul>
						</li>
						<li class="first-li">
							<ul class="nested-list">
								<li>Привод: Задній</li>
								<li class="right-block">70 000,00грн <input type="checkbox" name="drive"></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>

			<div class="brief-information">
				<div class="second-block">
					<ul>
						<li id="brand-name"><?php echo $car['brand'] . " " . $car['model']; ?></li>
						<li id="unikum"><img src="/CarShowroom/<?php echo $car['image']; ?>" alt="Car Image"></li>
						<li>Колір: Сірий Металік</li>
						<li>Обʼєм двигуна: <?php echo $car['engine_volume']; ?> л</li>
						<li>Тип палива: <?php echo $car['fuel_type']; ?></li>
						<li>Вид кузову: <?php echo $car['body_type']; ?></li>
						<li>Матеріал салону кожа, колір: беж</li>
						<li id="unikum">Два види палива: дизель, бензин</li>
					</ul>
				</div>
				<div class="end-block">
					<ul>
						<li>
							<ul class="price-block">
								<li>Сума без налогу (20%):</li>
								<li><?php echo $car['price']; ?> USD</li>
							</ul>
						</li>
						<li>
							<ul class="price-block">
								<li>Загальна сума:</li>
								<li>3 456 000,00 грн</li>
							</ul>
						</li>

						<li>
							<button>Оформити замовлення</button>
						</li>
					</ul>
				</div>
			</div>
		</form>
	</div>

	<div class="block-of-information">
		<div class="top-block">
			<div class="top-text-block">
				<h5>Телефон</h5>
				<h5 id="namber">+380 87 372 33 92</h5>
			</div>
			<div class="top-text-block">
				<h5>Електрона пошта</h5>
				<h5 id="email">kornevakristina16@gmail.com</h5>
			</div>
			<div class="top-text-block">
				<span>
					<img src="../img/instagram.svg">
					<img src="../img/facebook.svg">
					<img src="../img/telegram.svg">
				</span>
			</div>	
		</div>
		<div class="bottom-block">
			<div class="different">
				<h5>Моделі</h5>
				<p>Нові автомобілі</p>
				<p>Авто на складі</p>
			</div>
			<div class="different">
				<h5>Про компанію</h5>
				<p>Про нас</p>
				<p>Політика конфіденційності</p>
			</div>
			<div class="different">
				<h5>Послуги</h5>
				<p>Кредит</p>
				<p>Страхування</p>
				<p>Умови лізингу</p>
			</div>
			<div class="different">
				<h5>Сервіс</h5>
				<p>Малярно-кузовний відділ</p>
				<p>Сервісне обслуговування</p>
				<p>Запчастини</p>
				<p>Гарантія</p>
			</div>
		</div>
	</div>

<!--

    <div class="car-details">
        
        <h2></h2>
        <p><strong>Об'єм двигуна:</strong> </p>
        <p><strong>Тип палива:</strong> </p>
        <p><strong>Тип транспорту:</strong> <?php echo $car['type_of_transport']; ?></p>
        <p><strong>Тип кузова:</strong> </p>
        <p><strong>Рік випуску:</strong> <?php echo $car['year_of_release']; ?></p>
        <p><strong>Ціна:</strong> <span id="price"></span> USD</p>
        
        <div class="dynamic-price">
            <label for="discount">Скидка (%):</label>
            <input type="number" id="discount" placeholder="Введите скидку">
            <button onclick="calculatePrice()">Рассчитать цену</button>
            <p><strong>Итоговая цена:</strong> <span id="final-price"></span> USD</p>
        </div>
    </div>

    <script>
        // Скрипт для динамического расчёта цены со скидкой
        function calculatePrice() {
            const price = parseFloat(document.getElementById('price').innerText);
            const discount = parseFloat(document.getElementById('discount').value);
            if (!isNaN(discount) && discount >= 0 && discount <= 100) {
                const finalPrice = price - (price * (discount / 100));
                document.getElementById('final-price').innerText = finalPrice.toFixed(2);
            } else {
                alert("Введите корректное значение скидки (0-100%)");
            }
        }
    </script> -->
</body>
</html>

