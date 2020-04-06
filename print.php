<?php include 'app/config.php'; ?>
<html>
<head>
<meta charset="utf-8">
<title>Вывод списка посетителей, прошедших сегодня</title>
<link rel="stylesheet" type="text/css" href="css/print.css">
</head>
<body>
<br>
	<h2>Сотрудники ООО "ЛУБД" находящиеся на предприятии в данный момент</h2>
	<p>Всего - <?php countVisitorsToday ($link, $date); ?> человек</p>
	<button onclick="print()">Печать</button>
	<button style="background: rgb(20,255,20);" onClick='location.href="http://isinfo.h910230154.nichost.ru/"'>НА ГЛАВНУЮ </button>
	<div class="table">
	<table>
	<tr>
		<td style="width:60px">Время входа</td>
		<td style="width:60px">Время выхода</td>
		<td style="width:300px">ФИО</td>
		<td style="width:60px">Номер</td>
		<td>Дата входа</td>
	</tr>
	<?php
	showListTodayVisitors($link, $date);
	?>
		</table>
		</div>
</body>
</html>

<?php
function showListTodayVisitors ($link, $date) {
	global $dateNoFormat;
	global $dateNoFormatYest;
	$query = "SELECT * FROM Registrator WHERE Timeout = 0 AND Timein_noform BETWEEN '$dateNoFormatYest' AND '$dateNoFormat'";
	mysqli_set_charset($link, "utf8");
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
			
	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
			$result = '';
				foreach ($data as $elem) {
				$result .= '<tr>';
				$result .= '<td>' . $elem['Timein'] . '</td><td>' . $elem['Timeout'] .'</td><td>'. $elem['FIO'] .'</td><td>'. $elem['id_card'] . '</td><td>'. $elem['Date'] . '</td>';
				$result .= '<tr>'; 
			}
			print_r ($result);
	}

function countVisitorsToday ($link, $date) {
	global $dateNoFormat;
	global $dateNoFormatYest;
	$query = "SELECT id_card FROM Registrator WHERE Timeout = 0 AND Timein_noform BETWEEN '$dateNoFormatYest' AND '$dateNoFormat'";
	mysqli_set_charset($link, "utf8");
	$result = $link->query($query);
	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
	$id_card = 'id_card';
	$result = count ($data);
	echo ($result);
	}
?>