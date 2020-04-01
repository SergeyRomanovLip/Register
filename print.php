<?php ?>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<link rel="stylesheet" type="text/css" href="css/print.css">
<body>
	<button onclick="print()">Печать</button>
	<table>
	<?php
	$host = 'localhost';
$user = 'h910230154_rso';
$password = 'Pwos9028';
$database = 'h910230154_isinfo';
$link = mysqli_connect($host, $user, $password, $database);
$date = date('d.m.y');
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
	
	?>
		</table>
</body>
</html>