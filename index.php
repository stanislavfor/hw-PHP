<?php

require "db.php";

/** Пример первый
// Создание новых записей.

$course = R::dispense('courses');
$course->title = "Курс по React";

$course->tuts = 10;
$course->homeworks = 8;
$course->level = "Для студентов школы";
$course->price = 100;
R::store($course);
**/


/** Пример второй
// Получение данных, вывод записей из базы данных.

$courses = R::find('courses');
//print_r( $courses );
foreach ($courses as $course) {
	//print_r( $course );
	echo "ID: " . $course->id . "<br>";
	echo "Название: " . $course->title . "<br>";
	echo "Кол-во уроков: " . $course->tuts . "<br>";
	echo "Уровень: " . $course->level . "<br>";
	echo "<hr>";
}
**/


/** Пример третий
// Обновление записей в базе данных.

$course = R::load('courses', 3);
//print_r($course);
	/*echo "ID: " . $course->id . "<br>";
	echo "Название: " . $course->title . "<br>";
	echo "Кол-во уроков: " . $course->tuts . "<br>";
	echo "Уровень: " . $course->level . "<br>";
	echo "Цена: " . $course->price . "<br>";
	echo "<hr>";*/
/**
$course->title = "Курс по верстке 2 - ступень 1-я";
$course->tuts = 14;
$course->homeworks = 5;
$course->price = 80;
$course->students = 26;
R::store($course);
**/

/*$course = R::load('courses', 2);
R::trash($course);*/



?>