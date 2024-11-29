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
    <link rel="stylesheet" href="car_details.css"> 
</head>
<body>
    <div class="car-details">
        <img src="/CarShowroom/<?php echo $car['image']; ?>" alt="Car Image">
        <h2><?php echo $car['brand'] . " " . $car['model']; ?></h2>
        <p><strong>Об'єм двигуна:</strong> <?php echo $car['engine_volume']; ?> L</p>
        <p><strong>Тип палива:</strong> <?php echo $car['fuel_type']; ?></p>
        <p><strong>Тип транспорту:</strong> <?php echo $car['type_of_transport']; ?></p>
        <p><strong>Тип кузова:</strong> <?php echo $car['body_type']; ?></p>
        <p><strong>Рік випуску:</strong> <?php echo $car['year_of_release']; ?></p>
        <p><strong>Ціна:</strong> <span id="price"><?php echo $car['price']; ?></span> USD</p>
        
        <!-- (пример динамической функции) -->
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
    </script>
</body>
</html>

