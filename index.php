<?php

/** Первый пример

$person1_name = 'Peter';
$person1_speciality = 'Programmer';
$person1_age = 25;

function person1_hello($name, $spec, $age){
	echo "Hello! My name is $name. I am $spec and $age years old. ";
}
person1_hello($person1_name, $person1_speciality, $person1_age);
echo "<br><br>";

$person2_name = 'Jane';
$person2_speciality = 'Web-designer';
$person2_age = 23;

function person2_hello($name, $speciality, $age){
	echo "Hello! My name is $name. I am $spec and $age years old. ";
}
person1_hello($person2_name, $person2_speciality, $person2_age);
echo "<br><br>";
 **/

/** Второй пример

class Person {
	public $name = "John Doe ";
	public $speciality = "some spec ";
	public $age = "-";	
}

$person1 = new Person;
echo $person1->name;
echo $person1->speciality;
echo $person1->age;
echo "<br><br>";
 **/

/** Третий пример

class Person {
	public $name;
	public $speciality;
	public $age;	
}

$person1 = new Person;
$person1->name = 'Peter ';
$person1->speciality = 'Programmer ';
$person1->age = 25;

echo $person1->name = 'Peter ';
echo $person1->speciality = 'Programmer ';
echo $person1->age = 25;
 **/

/** Четвертый пример

class Person {
	public $name;
	public $speciality;
	public $age;

	public function greeting(){
		echo "Hello! My name is " . $this->name . ". I am " . $this->speciality . " and " . $this->age . " years old. ";
		//echo $this->name;
		//echo $this->speciality;
		//echo $this->age;
	}
}

$person1 = new Person;
$person1->name = 'Peter ';
$person1->speciality = 'Programmer ';
$person1->age = 25;

//$person1->greeting($person1->name, $person1->speciality, $person1->age);
$person1->greeting();
 **/

/** Пятый пример
 **/

class Person{
	public $name;
	public $speciality;
	public $age;
	public function __construct($name, $speciality, $age){
		$this->name = $name;
		$this->speciality = $speciality;
		$this->age = $age;
	}

	public function greeting(){
		echo "Hello! My name is " . $this->name . ". I am " . $this->speciality . " and " . $this->age . " years old. ";		
	}
}

$person1 = new Person('Peter ', 'Programmer ', 25);
$person1->greeting();
echo "<br><br>";
$person2 = new Person('Jane ', 'Web-designer ', 23);
$person2->greeting();

//$person2 = new Person;
//$person3 = new Person;
//$person1->name = 'Peter ';
//$person1->speciality = 'Programmer ';
//$person1->age = 25;







?> 