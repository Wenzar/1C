<!DOCTYPE HTML>
<html>
<head>
<title>Таблица</title>
<style type="text/css">
   	TABLE 							  /* Создание рамок для таблицы */
   	{
   		width: 600px; 				/* Ширина таблицы */
   		border-collapse: collapse; /* Убираем двойные линии между ячейками */
  	}
  	TD, TH 
   	{
    	padding: 3px; 			  /* Поля вокруг содержимого таблицы */
   		border: 1px solid black; /* Параметры рамки */
   	}
</style>
</head>
<body>
<table> 	<!-- Заголовки для таблицы -->
   	<tr>
    	<th>Фамилия</th>
    	<th>Имя</th>
    	<th>Год рождения</th>
    	<th>Дата регистрации компании</th>
    	<th>ОПФ (ООО/ИП)</th>
    	<th>Наименование компании</th> 
    </tr>
<?php
include "database.php"; 									  /* Подключаем фаил, который устанавливает соединение с БД */
$_table_ = mysqli_query($connection, "SELECT * FROM `pNc`"); /* Выполняем запрос к нужной таблице */
foreach ($_table_ as $s) 									/* Заполнем таблицу при помощи цикла */
	{
	echo'<tr>
	     <td>' . $s['surname'] . '</td>
	     <td>' . $s['name'] . '</td>
	     <td>' . $s['year_of_birth'] . '</td>
	     <td>' . $s['gosreg_date'] . '</td>
	     <td>' . $s['opf'] . '</td>
	     <td>' . $s['title'] . '</td>
	     </tr>';
	}
?>
</table>
<fieldset>
	<form method="post" action="myphp.php" id="nubexForm">			<!-- Поля для поиска по имени\фамилии -->
		<label for="name">Имя для поиска:</label><br/>
		<input type="text" name="name" size="30"><br/>
		<label for="surname">Фамилия для поиска:</label><br/>
		<input type="text" name="surname" size="30"><br/>
		<input id="submit" type="submit" value="Найти и вывести"><br/>
		<select name="opf" size="3" multiple form="nubexForm">		<!-- Метод select для ОПФ(Проблема: вывод только одного человека) -->
			<option>ИП</option>
			<option>OOO</option>
		</select><br/>
		<input type="submit" value="Отправить" />
	</form>
</fieldset>

<?php
require 'database.php'; 		  /* Устанавливаем соединение с БД */
$name = trim($_REQUEST['name']); /* Получаем данные из формы и обрабатываем */
$surname = trim($_REQUEST['surname']);
// $year_of_birth = trim($_REQUEST['year_of_birth']);
// $gosreg_date = trim($_REQUEST['gosreg_date']);
$opf = trim($_REQUEST['opf']);
// $title = trim($_REQUEST['title']);
 
$sql_select = mysqli_query($connection, "SELECT * FROM pNc WHERE surname='$surname' OR name='$name' OR opf = '$opf' "); /* Исполняет запрос к БД на вывод нужного типа информации */
$row = mysqli_fetch_array($sql_select ); /* Обрабатывает запрос, возвращая  массив */

do 									   /* Выводим всю информацию, которая соответствует запросу */
{
	printf("<p>Человек: " 
		. $row['name'] . " " . $row['surname'] . " " 
		. $row['year_of_birth'] . " " . $row['gosreg_date'] . " " 
		. $row['opf'] . " " . $row['title'] . "</p>");
}
while($row = mysqli_fetch_array($sql_select));
?>

</body>
</html>


