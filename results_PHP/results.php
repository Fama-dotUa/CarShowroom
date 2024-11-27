<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Результаты поиска</title>
    <link rel="stylesheet" type="text/css" href="../css-stylee/filters-stylee.css"> <!-- Путь к CSS -->
</head>
	<body>
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

		echo "<h2>Результати пошуку</h2>";
		if ($result->num_rows > 0) {
			echo "<div class='car-list'>";
			while ($row = $result->fetch_assoc()) {
				echo "<div class='car-item'>";
				echo "<img src='/CarShowroom-main/" . $row["image"] . "' alt='Car Image' />";
				
				
				echo "<p><strong>Марка:</strong> " . $row["brand"] . "</p>";
				echo "<p><strong>Модель:</strong> " . $row["model"] . "</p>";
				echo "<p><strong>Об'єм двигуна:</strong> " . $row["engine_volume"] . " L</p>";
				echo "<p><strong>Тип палива:</strong> " . $row["fuel_type"] . "</p>";
				echo "<p><strong>Тип кузова:</strong> " . $row["body_type"] . "</p>";
				echo "<p><strong>Тип транспорту:</strong> " . $row["type_of_transport"] . "</p>";
				echo "<p><strong>Тип приводу:</strong> " . $row["drive_type"] . "</p>";
				echo "<p><strong>Коробка передач:</strong> " . $row["gear_box"] . "</p>";
				echo "<p><strong>Рік випуску:</strong> " . $row["year_of_release"] . "</p>";
				echo "<p><strong>Ціна:</strong> $" . $row["price"] . "</p>";
				echo "</div>";
			}
			echo "</div>";
		} else {
			echo "<p>Машини не знайдені за заданими критеріями</p>";
		}

		$conn->close();
		?>
	</body>
</html>