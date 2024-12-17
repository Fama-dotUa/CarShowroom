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
				<ul>
					<li id="brand-name"><?php echo $car['brand'] . " " . $car['model']; ?></li>
					<li>Колір: Сірий Металік</li>
					<li>Обʼєм двигуна: <?php echo $car['engine_volume']; ?> л</li>
					<li>Тип палива: <?php echo $car['fuel_type']; ?></li>
					<li>Вид кузову: <?php echo $car['body_type']; ?></li>
					<li id="price"><?php echo $car['price']; ?> USD</li>
				</ul>
		</div>
	</div>


	<div class="middle">
		<form action="payment.php" method="GET">
				
			<div class="first-block" >
				
				<h1>Додаткові послуги</h1>

				<div class="additional-services">
					<ul>
						<li class="first-li">
							<ul class="nested-list">
								<li>Підігрів сидінь</li>
								<li class="right-block">150 000,00грн
									<input type="checkbox" name="heated-seats" data-price="150000">
								</li>
							</ul>
						</li>
						<li class="first-li">
							<ul class="nested-list">
								<li>Матеріал салону кожа</li>
								<li class="right-block">200 000,00грн
									<input type="checkbox" name="interior-material" data-price="200000">
								</li>
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
								<li class="right-block">90 000,00грн
									<input type="checkbox" name="color-car" data-price="90000">
								</li>
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
								<li class="right-block">180 000,00грн
									<input type="checkbox" name="type-of-fuel" data-price="180000">
								</li>
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
								<li class="right-block">100 000,00грн
									<input type="checkbox" name="gear-box" data-price="100000">
								</li>
							</ul>
						</li>
						<li class="first-li">
							<ul class="nested-list">
								<li>Привод: Задній</li>
								<li class="right-block">70 000,00грн
									<input type="checkbox" name="drive" data-price="70000">
								</li>
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
						<li>Колір: <?php echo $car['color']; ?></li>
						<li>Обʼєм двигуна: <?php echo $car['engine_volume']; ?> л</li>
						<li>Тип палива: <?php echo $car['fuel_type']; ?></li>
						<li>Вид кузову: <?php echo $car['body_type']; ?></li>
						<li>Конфигурація авто: <?php echo $car['configuration']; ?></li>
						<li id="unikum">Вид палива: дизель, бензин</li>
					</ul>
				</div>
				
				<?php
				// Конвертация из долларов в гривны
				$usdToUahRate = 40; // Курс доллара
				$priceInUah = $car['price'] * $usdToUahRate;
				$priceWithoutTaxInUah = $priceInUah / 1.2;
				?>
				
				<div class="end-block">
					<ul>
						<li>
							<ul class="price-block">
								
								<li>Сума без налогу (20%):</li>
								<li><!--id="tax-free-price"-->
									<?php
										echo number_format($priceInUah, 0, '', ' ') . " грн";
									?>
								</li>
							</ul>
						</li>
						<li>
							<ul class="price-block">
								<li>Загальна сума:</li>
								<li ><!--id="total-price"-->
									<?php
										echo number_format($priceWithoutTaxInUah, 0, '', ' ') . " грн";
									?>
								</li>
							</ul>
						</li>

						<li>
							<input type="hidden" name="total_price" id="total-price-hidden" value="<?php echo $priceWithoutTaxInUah; ?>">
							<input type="hidden" name="tax_free_price" id="tax-free-price-hidden" value="<?php echo $priceInUah; ?>">
							<input type="hidden" name="id" value="<?php echo $car['id']; ?>">
							<li> <button type="submit">Оформити замовлення</button></li>
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

	
	<script>
        document.addEventListener("DOMContentLoaded", function () {
		const totalPriceElement = document.getElementById("total-price");
		const taxFreePriceElement = document.getElementById("tax-free-price");
		const totalHiddenInput = document.getElementById("total-price-hidden");
		const taxFreeHiddenInput = document.getElementById("tax-free-price-hidden");
		const optionInputs = document.querySelectorAll('input[type="checkbox"], input[type="radio"]');

		// начальная цена из PHP (цена машины)
		const basePrice = <?php echo $priceInUah; ?>;

		function updateTotalPrice() {
			let totalPrice = basePrice; // Начинаем с базовой цены

			optionInputs.forEach(input => {
				if (input.checked) {
					totalPrice += parseInt(input.dataset.price || "0", 10);
				}
			});

			// Обновляю отображение итоговой суммы (включая налог)
			totalPriceElement.textContent = totalPrice.toLocaleString("uk-UA") + " грн";

			// Рассчитываю цену без налога (20%)
			const taxFreePrice = totalPrice / 1.2;
			taxFreePriceElement.textContent = taxFreePrice.toLocaleString("uk-UA", { minimumFractionDigits: 2 }) + " грн";
			
			totalHiddenInput.value = totalPrice.toFixed(2);
			taxFreeHiddenInput.value = taxFreePrice.toFixed(2);
		}

		// Добавляю обработчик событий для изменения цены
		optionInputs.forEach(input => {
			input.addEventListener("change", updateTotalPrice);
		});

		updateTotalPrice(); // Обновляю цену при загрузке страницы
		});

    </script>
	
</body>
</html>

