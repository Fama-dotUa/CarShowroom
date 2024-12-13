<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты поиска</title>
    <link rel="stylesheet" type="text/css" href="../css-stylee/car_selection.css"> <!-- Путь к CSS -->
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

	<div class="search-block">
		<div class="block-of-options">
		<?php
		// Подключение к базе данных
		$servername = "localhost";
		$username = "root";
		$password = ""; // Пока оставляю пустым
		$dbname = "cars_db"; // Название базы данных

		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Начальное построение SQL-запроса
		$sql = "SELECT * FROM cars WHERE 1=1";
		
		// Проверка фильтра "Марка"
		if (isset($_GET['brand']) && !empty($_GET['brand'])) {
			$brands = $_GET['brand'];
			$brandConditions = array_map(function($brand) use ($conn) {
				return "'" . $conn->real_escape_string($brand) . "'";
			}, $brands);
			$sql .= " AND brand IN (" . implode(",", $brandConditions) . ")";
		}
		
		// Проверка фильтра "Об'єм двигуна"
		if (isset($_GET['engine_volume']) && !empty($_GET['engine_volume'])) {
			$engines = $_GET['engine_volume'];
			$engineConditions = array_map(function($engine) use ($conn) {
				return "'" . $conn->real_escape_string($engine) . "'";
			}, $engines);
			$sql .= " AND engine_volume IN (" . implode(",", $engineConditions) . ")";
		}
		
		// Проверка фильтра "Вид палива"
		if (isset($_GET['fuel_type']) && !empty($_GET['fuel_type'])) {
			$fuels = $_GET['fuel_type'];
			$fuelConditions = array_map(function($fuel) use ($conn) {
				return "'" . $conn->real_escape_string($fuel) . "'";
			}, $fuels);
			$sql .= " AND fuel_type IN (" . implode(",", $fuelConditions) . ")";
		}

		// Проверка фильтра типа транспорта
		if (isset($_GET['Type-of-Transport']) && !empty($_GET['Type-of-Transport'])) {
			$types = $_GET['Type-of-Transport'];
			$typeConditions = array_map(function($type) use ($conn) {
				return "'" . $conn->real_escape_string($type) . "'";
			}, $types);
			$sql .= " AND type_of_transport IN (" . implode(",", $typeConditions) . ")";
		}
		 
		// Проверка фильтра "Вид кузова"
		if (isset($_GET['body_type']) && !empty($_GET['body_type'])) {
			$bodies = $_GET['body_type'];
			$bodyConditions = array_map(function($body) use ($conn) {
				return "'" . $conn->real_escape_string($body) . "'";
			}, $bodies);
			$sql .= " AND body_type IN (" . implode(",", $bodyConditions) . ")";
		}

		// Проверка фильтра типа привода
		if (isset($_GET['Drive-type']) && !empty($_GET['Drive-type'])) {
			$drives = $_GET['Drive-type'];
			$driveConditions = array_map(function($drive) use ($conn) {
				return "'" . $conn->real_escape_string($drive) . "'";
			}, $drives);
			$sql .= " AND drive_type IN (" . implode(",", $driveConditions) . ")";
		}

		// Проверка фильтра коробки передач
		if (isset($_GET['Gear-box']) && !empty($_GET['Gear-box'])) {
			$gearBoxes = $_GET['Gear-box'];
			$gearBoxConditions = array_map(function($box) use ($conn) {
				return "'" . $conn->real_escape_string($box) . "'";
			}, $gearBoxes);
			$sql .= " AND gear_box IN (" . implode(",", $gearBoxConditions) . ")";
		}

		if (isset($_GET['year_from']) && $_GET['year_from'] != '') {
			$yearFrom = (int)$_GET['year_from'];
			$sql .= " AND year_of_release >= $yearFrom";
		}

		if (isset($_GET['year_to']) && $_GET['year_to'] != '') {
			$yearTo = (int)$_GET['year_to'];
			$sql .= " AND year_of_release <= $yearTo";
		}

		// Выполнение запроса и вывод результатов
		//echo $sql; // Отладка: вывод сформированного SQL-запроса
		$result = $conn->query($sql);
		
		// Для отладки
		//echo "<pre>";
		//print_r($_GET); // Выводит все данные, отправленные через GET
		//echo "</pre>";
		//die(); // Остановить выполнение, чтобы увидеть данные

		
		if ($result->num_rows > 0) {
			echo "<h2>Результати пошуку</h2>";
			echo "<div class='car-list'>";
			while ($row = $result->fetch_assoc()) {
				echo "<div class='car-item'>";
				echo "<a href='car_details.php?id=" . $row["id"] . "'>"; // Ссылка на car_details.php с передачей ID

				echo "<img src='/CarShowroom/" . $row["image"] . "' alt='Car Image' />";
				
				
				echo "<h3>" . $row["brand"]. " ". $row["model"]. "</h3>";
				echo "<p><strong>Об'єм двигуна:</strong> " . $row["engine_volume"] . " L</p>";
				echo "<p><strong>Тип палива:</strong> " . $row["fuel_type"] . "</p>";
				echo "<p><strong>Тип транспорту:</strong> " . $row["type_of_transport"] . "</p>";
				echo "<p><strong>Рік випуску:</strong> " . $row["year_of_release"] . "</p>";
				echo "<p><strong>Ціна:</strong> $" . $row["price"] . "</p>";
				echo "</a>"; // Закрываю ссылку
				echo "</div>";
			}
			echo "</div>";
		} else {
			echo "<h3 id='error'>Машини не знайдені за заданими критеріями</h3>";
		}

		$conn->close();
		?>
		</div>
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
	</body>
</html>