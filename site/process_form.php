<?php
session_start();
if($_POST['kapcha'] != $_SESSION['rand_code']) echo "Капча введена неверно";
else{
$redirect = "./ok.php"; // адрес страницы, на которую нужно перейти при успешной отправке сообщения

// Подключение к базе данных
$servername = "hostname";
$username = "username";
$password = "passwd";
$dbname = "name";
/* $servername: Для OpenServer используется localhost.
$username: По умолчанию в OpenServer это root.
$password: Оставьте пустым (в OpenServer пароль по умолчанию отсутствует).
$dbname: Название вашей базы данных (например, guestbook).
*/
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Обработка данных из формы
$userName = mysqli_real_escape_string($conn, $_POST['userName']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$homepage = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['homepage']));
$captchaCode = mysqli_real_escape_string($conn, $_POST['kapcha']);
$text =  htmlspecialchars(mysqli_real_escape_string($conn, $_POST['message']));
$ipAddress = $_SERVER['REMOTE_ADDR'];
$browserInfo = $_SERVER['HTTP_USER_AGENT'];
$date = date("Y-m-d H:i:s"); 

// SQL запрос для добавления записи в базу данных
$sql = "INSERT INTO `messages` (user, email, homepage, captcha, text, ip, browser, date)
        VALUES ('$userName', '$email', '$homepage', '$captchaCode', '$text', '$ipAddress', '$browserInfo','$date')";

if ($conn->query($sql) === TRUE) {
    header('Location: '.$redirect);
} else {
	header('Location: ' . "./error.php");
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
?>