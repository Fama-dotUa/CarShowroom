<?php
// данные из GET-запроса
$totalPrice = isset($_GET['total_price']) ? (float)$_GET['total_price'] : 0;
$taxFreePrice = isset($_GET['tax_free_price']) ? (float)$_GET['tax_free_price'] : 0;

// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = ""; // Пока оставляю пустым
$dbname = "cars_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаю ID машины из URL
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
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css-stylee/payment.css">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link href="https://db.onlinewebfonts.com/c/bc28028bf5fff883c167bfe77545594d?family=Bitstream+Iowan+Old+Style" rel="stylesheet">
	<title>Оплата</title>
</head>
<body>
	<div>
		<header class="headerBox">
			<span class="logo"><a href="index.html">Наше-Авторія</a></span>
			<nav>
				<ul >
					<li><a href="#">КОНТАКТИ</a></li>
					<li><a href="#">ПРО НАС</a></li>
					<li><a href="#">ПРОПОЗИЦІЇ</a></li>
				</ul>
			</nav>
			<a href="personal_office.html" class="newAccount"><img src="img/account.svg"></a>
		</header>
	</div>

	<div class="wrapeer">
		<div class="main-block">
			<div class="left-block">
				<form action="">
					<h1>Оплата</h1>
					<div class="personal-info">
						
					</div>

					<h2>Метод оплати</h2>

					<div class="third-block">
						<div class="payment-method"><label for="payment-method"><input type="checkbox"> Платіжна картка</label></div>
						<div class="card">
							
						</div>
						<div class="payment-method"><label for="payment-method"><input type="checkbox"> PayPal</label></div>
					</div>

					<button>Сплатити</button>
				</form>
			</div>
	
			<div class="right-block">
				<div class="second-block">
					<ul>
						<li id="brand-name"><?php echo $car['brand'] . " " . $car['model']; ?></li>
						<li id="unikum"><img src="/CarShowroom/<?php echo $car['image']; ?>" alt="Car Image"></li>
						<li>Колір: <?php echo $car['color']; ?></li>
						<li>Обʼєм двигуна: <?php echo $car['engine_volume']; ?> л</li>
						<li>Тип палива: <?php echo $car['fuel_type']; ?></li>
						<li>Вид кузову: <?php echo $car['body_type']; ?></li>
						<li>Ціна: <?php echo number_format($car['price'], 2, ',', ' ') . " USD"; ?></li>
					</ul>
				</div>
				<div class="end-block">
					<ul>
						<li>
							<ul class="price-block">
								<li>Сума без налогу (20%):</li>
								<li><?php echo number_format($taxFreePrice, 2, ',', ' ') . " грн"; ?></li>
							</ul>
						</li>
						<li>
							<ul class="price-block">
								<li>Загальна сума:</li>
								<li><?php echo number_format($totalPrice, 2, ',', ' ') . " грн"; ?></li>
							</ul>
						</li>
						<li>
							<ul class="price-block">
								<li>Сума авансу (5%):</li>
								<li><?php echo number_format($totalPrice * 0.05, 2, ',', ' ') . " грн"; ?></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
