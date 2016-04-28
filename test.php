<?php

$secret = md5('antichat'); // Неизвестная часть

if(isset($_GET['test'])) // Получаем тестовую сигнатуру
{
	echo md5($secret . ':user');
 	exit;
}

if(isset($_GET['admin'])) // Получаем админскую сигнатуру для проверки
{
	echo md5($secret . ':admin');
	exit;
}

$signature = md5($secret .':'. $_GET['type']); // Формат сигнатуры "secret:тип юзера"

if($signature == $_GET['sig']) 
{
	$data = explode(':', $_GET['type']); // Убираем : из параметра type
 	if(end($data) == 'admin') 
 	{
  		echo 'You are admin!'; // Если type = admin, а сигнатура для этого пользователя верна - выводим
 	} 
 	else 
 	{
  		echo 'You are user'; // Если type = user, а сигнатура для этого пользователя верна - выводим
 	}
} 
else 
{
	echo 'Wrong signature'; // Если сигнатура невалидна, выводим сообщение о невалидности
}

?>
