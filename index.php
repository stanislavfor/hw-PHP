<?php

/** Первый пример
$db = new PDO('mysql:host=localhost;dbname=filmoteka', 'root', '');
$sql = "SELECT * FROM films";
$result = $db->query($sql);
echo "<h>Вывод записей из результатов по одной: </h2>";
echo "<br><br>";

while( $film = $result->fetch(PDO::FETCH_ASSOC) ) {
		//print_r($film);
		echo "Название фильма: " . $film['title'] . "<br>";
		echo "Жанр фильма: " . $film['genre'] . "<br>";
		echo "Год выпуска фильма: " . $film['year'] . "<br>";
		echo "<br><br>";
}
//print_r( $result->fetch(PDO::FETCH_ASSOC));
**/

/** Второй пример
$db = new PDO('mysql:host=localhost;dbname=filmoteka', 'root', '');
echo "<hr/>";
$sql = "SELECT * FROM films";
$result = $db->query($sql);
$films = $result->fetchAll(PDO::FETCH_ASSOC);
//print_r($result->fetchAll(PDO::FETCH_ASSOC));

echo "<h2>Выборка все записей в массив и вывод на экран: </h2>";
foreach ($films as $film) {
	echo "Название фильма: " . $film['title'] . "<br>";
		echo "Жанр фильма: " . $film['genre'] . "<br>";
		echo "Год выпуска фильма: " . $film['year'] . "<br>";
		echo "<br><br>";
}
**/

/** Третий пример
$db = new PDO('mysql:host=localhost;dbname=filmoteka', 'root', '');
echo "<hr/>";
$sql = "SELECT * FROM films";
$result = $db->query($sql);

$result->bindColumn('id', $id);
$result->bindColumn('title', $title);
$result->bindColumn('genre', $genre);
$result->bindColumn('year', $year);

echo "<h2>Выборка все записей с привязкой данных к переменным: </h2>";
while ( $result->fetch(PDO::FETCH_ASSOC)) {
	echo "ID: {$id} <br>";
	echo "Название фильма: {$title} <br>";
	echo "Жанр фильма: {$genre} <br>";
	echo "Год выпуска фильма: {$year} <br>";
 	echo "<br><br>";
 } 
 **/

/** Четвертый пример

//1. Выборка без защиты от SQL иньекций
$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');

$username = 'Joker';
$password = '555';
$sql = "SELECT * FROM users WHERE name = '{$username}' AND password = '{$password}' LIMIT 1";
$result = $db->query($sql);
echo "<h2>Выборка без защиты от SQL иньекций: </h2>";
//print_r( $result->fetch(PDO::FETCH_ASSOC) );

if ( $result->rowCount() == 1 ) {
	$user = $result->fetch(PDO::FETCH_ASSOC);
	echo "Имя пользователя: {$user['name']} <br>";
	echo "Email пользователя: {$user['email']} <br>";
	echo "Пароль пользователя: {$user['password']} <br>";
}
**/


/** Пятый пример
//2. Выборка с защитой от SQL иньекций - В РУЧНОМ режиме

$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');

$username = 'Joker';
$password = '555';

$username = $db->quote( $username );
$username = strtr($username, array('_' => '\_', '%' => '\%') );
$password = $db->quote( $password );
$password = strtr($password, array('_' => '\_', '%' => '\%') );
$sql = "SELECT * FROM users WHERE name = '{$username}' AND password = '{$password}' LIMIT 1";
$result = $db->query($sql);
echo "<h2>Выборка без защиты от SQL иньекций: </h2>";

if ( $result->rowCount() == 1 ) {
	$user = $result->fetch(PDO::FETCH_ASSOC);
	echo "Имя пользователя: {$user['name']} <br>";
	echo "Email пользователя: {$user['email']} <br>";
	echo "Пароль пользователя: {$user['password']} <br>";
}
**/


/** Шестой пример
//3. Выборка с защитой от SQL иньекций - В АВТОМАТИЧЕСКОМ режиме
$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
$sql = "SELECT * FROM users WHERE name = :username AND password = :password LIMIT 1";
$stmt = $db->prepare($sql);
$username = 'Joker';
$password = '555';

$stmt->bindValue(':username', $username);
$stmt->bindValue(':password', $password);
$stmt->execute();
//Метод для нескольких данных
//$stmt->execute(array(':username' => $username, ':password' => $password));
$stmt->bindColumn('name', $name);
$stmt->bindColumn('email', $email);
echo "<h2>Выборка записи с автоматической защиты от SQL иньекций: </h2>";
$stmt->fetch();
echo "Имя пользователя: {$name} <br>";
echo "Email пользователя: {$email} <br>";
**/


/** Седьмой пример
//4. Выборка с защитой от SQL иньекций - В АВТОМАТИЧЕСКОМ режиме - ТОЛЬКО ДРУГОЙ ФОРМАТ ЗАПРОСА

$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
$sql = "SELECT * FROM users WHERE name = ? AND password = ? LIMIT 1";
$stmt = $db->prepare($sql);
$username = 'Joker';
$password = '555';

$username = htmlentities($username);
$password = htmlentities($password);

$stmt->bindValue(1, $username);
$stmt->bindValue(2, $password);
$stmt->execute();
//Метод для нескольких данных
//$stmt->execute(array($username, $password));
$stmt->bindColumn('name', $name);
$stmt->bindColumn('email', $email);

echo "<h2>Выборка записи с автоматической защиты от SQL иньекций: </h2>";
$stmt->fetch();
echo "Имя пользователя: {$name} <br>";
echo "Email пользователя: {$email} <br>";
**/


/** Восьмой пример
// Добавление записей в базу данных

$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
$sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
$stmt = $db->prepare($sql);

$username = "Flash";
$useremail = "Flash@gmail.com";

$stmt->bindValue(':name', $username );
$stmt->bindValue(':email', $useremail );
$stmt->execute();
//Метод для нескольких данных
//$stmt->execute(array(':username' => $username, ':password' => $password));
echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";
echo "<p>ID вставленной записи: " . $db->lastInsertId() . "</p>";
**/

/**
// Дополнительный пример добавления записи
$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
$sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
$stmt = $db->prepare($sql);

$username = "Shrek";
$useremail = "Shrek@gmail.com";

$stmt->bindValue(':name', $username );
$stmt->bindValue(':email', $useremail );
$stmt->execute();
//Метод для нескольких данных
//$stmt->execute(array(':username' => $username, ':password' => $password));
echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";
echo "<p>ID вставленной записи: " . $db->lastInsertId() . "</p>";
**/


/** Девятый пример
//Обновление записей базы данных

$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
$sql = "UPDATE users SET name = :name WHERE id = :id";
$stmt = $db->prepare($sql);
$username = "New Flash";
$id = '8';
$stmt->bindValue(':name', $username );
$stmt->bindValue(':id', $id );
$stmt->execute();
echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";
**/


/** Десятый пример
// Удаление записи из базы данных

$db = new PDO('mysql:host=localhost;dbname=mini-site', 'root', '');
$sql = "DELETE FROM users WHERE name = :name";
$stmt = $db->prepare($sql);
$username = "Flash";
$stmt->bindValue(':name', $username );
$stmt->execute();
echo "<p>Было затронуто строк: " . $stmt->rowCount() . "</p>";
**/

?>