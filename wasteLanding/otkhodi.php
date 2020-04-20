
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include '../app/config.php';
mysqli_set_charset($link, "utf8");
$type = $_GET['page'];
$query = "SELECT name, fkko, src1 FROM Otkhodi WHERE name = '$type'";
            $result = mysqli_query($link, $query) or die(mysqli_error($link));
			
	for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);
			$result = '';
				foreach ($data as $elem) {
				$result .= '<tr>';
				$result .= '<td>' . $elem['name'] . '</td><td>' . $elem['fkko'] .'</td><td>'. $elem['src1'];
				$result .= '<tr>'; 
			}
			print_r ($result);
?>

</body>
</html>