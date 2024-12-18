<!DOCTYPE html>
<html>
<head>
<title>Гостевая книга(lab_№9)</title>
<link rel="stylesheet" href="style.css">
<style>
    body{
        background-color:bisque;
    }
</style>
<meta charset="utf-8">
</head>
<nav>
	<ul>
		<li><a href="index.php">На главную</a></li>
	</ul>
</nav>
<body>
<?php
// Подключение к базе данных
$servername = "hostname";
$username = "username";
$password = "passwd";
$dbname = "name";

$items_per_page = 25;
$page = isset($_GET['page']) ? $_GET['page'] : 1; //Номер страницы из запроса
$offset = ($page - 1) * $items_per_page;

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Порядок сортировки таблицы
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'date';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'DESC';

// Получение сообщений SQL-запросом
$sql = "SELECT user, email, text, date FROM `messages` ORDER BY $sort_by $sort_order LIMIT $offset, $items_per_page";
$result = $conn->query($sql);

$a = $conn->query("SELECT COUNT(*) as count FROM `messages`");
$b = $a->fetch_assoc();
$count = intdiv($b["count"] , $items_per_page) + 1;
$total_pages = $count; // Количество страниц

// Вывод данных в виде таблицы
if ($result->num_rows > 0) {
    echo "<table><tr>
    <th>UserName
    <a href = http://my_websyte/guests.php?sort_by=username&sort_order=ASC>↑</a>
    <a href = http://my_websyte/guests.php?sort_by=username&sort_order=DESC>↓</a>
    </th> 
    <th>Email
    <a href = http://my_websyte/guests.php?sort_by=email&sort_order=ASC>↑</a>
    <a href = http://my_websyte/guests.php?sort_by=email&sort_order=DESC>↓</a>
    </th>
    <th>Text
    <a href = http://my_websyte/guests.php?sort_by=text&sort_order=ASC>↑</a>
    <a href = http://my_websyte/guests.php?sort_by=text&sort_order=DESC>↓</a>
    </th>
    <th>Date
    <a href = http://my_websyte/guests.php?sort_by=date&sort_order=ASC>↑</a>
    <a href = http://my_websyte/guests.php?sort_by=date&sort_order=DESC>↓</a>
    </th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["user"] . "</td><td>" . $row["email"] . "</td><td>" . $row["text"] . "</td><td>" . $row["date"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
//Вывод ссылок на страницы
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href = http://my_websyte/guests.php?sort_by=$sort_by&sort_order=$sort_order&page=$i>$i</a> ";
}
$conn->close();
?>
</form>
</body>
</html>