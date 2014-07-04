<?php
try {
	// Соединение с базой, кодировка UTF-8, персистентное соединение отключено из-за проблем хостинга
	// Часовой пояс +2 +1 час летнего времени
	
	$db = new PDO('mysql:host=mysql6.000webhost.com;dbname=a7587012_feedbck', 'a7587012_feedbck', 'Q1w2e3m', array(
		PDO::ATTR_PERSISTENT => false,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8; SET time_zone = '+3:00';"
	));
} catch (PDOException $e) {
    echo "Ошибка подключения к базе: " . $e->getMessage() . "\n";
    exit;
}
?>