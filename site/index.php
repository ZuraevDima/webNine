<!DOCTYPE html>
<html>
<head>
<title>Гостевая книга</title>
<link rel="stylesheet" href="styles1.css">
<meta charset="utf-8">
</head>
<body>
<nav>
	<ul>
		<li><a href='C:\Users\Admin\Desktop\newweb\js9\index.php'>Задания</a></li>
		<li><a href='guests.php'>Посмотреть сообщения</a></li>
	</ul>
</nav>
<form action="process_form.php" method="post">
	<label>Your name (Dima)</label><br>
    <input type="text" name="userName" pattern="[A-Za-z0-9]{3,50}" required><br>
	<label>Email (example@mail.com)</label><br>
    <input type="email" name="email" required><br>
	<label>Homepage (https://example.com)</label><br>
    <input type="url" name="homepage"><br>
	<label>CAPTCHA</label><br>
	<img src = "captcha.php"><br>
	<input type = "text" name = "kapcha"  pattern="[A-Za-z0-9]{5}" required><br><br>
	<label>Your message</label><br>
    <br><textarea name="message" rows="4" cols="50" required></textarea><br>
    <input type="submit" value="Submit">
</form>
</body>
</html>