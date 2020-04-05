<?php include 'app/config.php'; ?>
<html>
<head>
<meta charset="utf-8">
<title>Вывод списка посетителей, прошедших сегодня</title>
</head>
<link rel="stylesheet" type="text/css" href="css/print.css">
<body>
<br>
	<h2>Посетители, прошедшие <?php print_r(date('d.m.y')) ?></h2>
	<p>Всего - <?php countVisitorsToday ($link, $date); ?> человек</p>
	<button onclick="print()">Печать</button>
	<button style="background: rgb(20,255,20);" onClick='location.href="http://isinfo.h910230154.nichost.ru/"'>НА ГЛАВНУЮ </button>
	<table>
	<?php
	showListTodayVisitors($link, $date);
	?>
		</table>
</body>
</html>

<?php
function showListTodayVisitors ($link, $date) {
	$query = "SELECT * FROM Registrator WHERE date = '$date'";
	mysqli_set_charset($link, "utf8");
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
			
	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
			$result = '';
				foreach ($data as $elem) {
				$result .= '<tr>';
				$result .= '<td>' . $elem['Timein'] . '</td><td>' . $elem['Timeout'] .'</td><td>'. $elem['FIO'] .'</td><td>'. $elem['id_card'] . '</td>';
				$result .= '<tr>'; 
			}
			print_r ($result);
	}

function countVisitorsToday ($link, $date) {
	$query = "SELECT id_card FROM Registrator WHERE date = '$date'";
	mysqli_set_charset($link, "utf8");
	$result = $link->query($query);
	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
	$id_card = 'id_card';
	$result = count ($data);
	echo ($result);
	}
?>