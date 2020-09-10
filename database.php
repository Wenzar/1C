<?php
$connection = mysqli_connect('127.0.0.1','root','','MyTest'); /* Подключение к БД */

if ( $connection == false ) 								/* Вывод ошибки если подключение не произошло */
{
	echo 'Не удалось подключится к базе данных!<br>';
	echo mysqli_connect_error();
	exit();
}
?>
