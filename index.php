<?php  
	session_start();
	require "server/connection.php";
	require "check.php";


	//подключение bootstrap ->
	echo "<!-- Latest compiled and minified CSS -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>

	<!-- Optional theme -->
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'>";

	echo '<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
	</script>';

	echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    ';
include 'template/header.tpl';
    //выборка информации из БД

    	//выборка пользователей

	$sql_users = mysqli_query($link, "SELECT * FROM users");
	$result_users = mysqli_num_rows($sql_users);

		//выборка IMEI
	$sql_imei = mysqli_query($link, "SELECT * FROM phones");
	$result_phones = mysqli_num_rows($sql_imei);
	
		//выборка краденных/ворованных
	$sql_bad = mysqli_query($link, "SELECT * FROM phones WHERE state = true");
	$result_bad = mysqli_num_rows($sql_bad);
 	

	

	echo "<br><br>";



	//запросы с форм

	if (isset($_POST['addinfo'])) {
		require 'template/addinfo.tpl';
		exit;
	}

	if (isset($_POST['addlost'])) {
		require 'template/addlost.tpl';
		exit;
	}


	

	//обработчик проверки IMEI
	if (isset($_POST['check'])) {

		$imei = $_POST['imei'];

		$sql_imeicheck = mysqli_query($link, "SELECT * FROM phones WHERE imei = '$imei'");
		$result_infocheck = mysqli_fetch_array($sql_imeicheck);
		
		
		if (!empty($result_infocheck['imei'])) {
			require 'template/info.tpl';
			exit;
		}

		$noneimei = ('Данных по IMEI - <span style="color: red;"> ' . $_POST['imei'] . '</span> не обнаружено.');

	}

		//подключение шаблона ->

	
	include 'template/body.tpl';


?>