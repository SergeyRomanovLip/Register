<?php

$host = 'localhost';
$user = 'h910230154_rso';
$password = 'Pwos9028';
$database = 'h910230154_isinfo';
$link = mysqli_connect($host, $user, $password, $database); 

if ($id_card = $_POST['id_card']) {

$query = "SELECT * FROM Employees WHERE id_card = '$id_card'";
mysqli_set_charset($link, "utf8");
$sql = mysqli_query($link, $query) or die(mysqli_error($link));
	$result = mysqli_fetch_assoc($sql);
	echo json_encode($result);	
} 

if ($id_card = $_POST['id_card_write']) {
	
$query = "SELECT last_name, first_name, sur_name FROM Employees WHERE id_card = '$id_card'";
mysqli_set_charset($link, "utf8");
$sql = mysqli_query($link, $query) or die(mysqli_error($link));
$result = mysqli_fetch_assoc($sql);
$stringRes = implode(' ',$result);
	
$time = date('H:i');
$date = date('d.m.y');
$queryWrite = "INSERT INTO Registrator (id_card, FIO, Date, Timein) VALUES ('$id_card', '$stringRes', '$date', '$time')";
	if (mysqli_query($link, $queryWrite)) {
    echo json_encode($stringRes . ", вы зашли на завод в " . $time . ", дата " . $date . ", запись сделана успешно!");
} else {
    echo json_encode("Error: " . $queryWrite . "<br>" . mysqli_error($link));
		
}
} 

if ($id_card = $_POST['id_card_write_exit']) {

$date = date('d.m.y');
$time = date('H:i');
$query = "SELECT max(id) FROM Registrator WHERE id_card = '$id_card' AND Date = '$date'";
mysqli_set_charset($link, "utf8");
$sql = mysqli_query($link, $query) or die(mysqli_error($link));
$result = mysqli_fetch_assoc($sql);
$stringRes = implode('',$result);	
$queryWrite = "UPDATE Registrator SET Timeout = ('$time') WHERE id_card = '$id_card' AND Date = '$date' AND id = '$stringRes'";	
	if (mysqli_query($link, $queryWrite)) {
    echo json_encode("Вы успешно покинули предприятие в " . $time . ", дата " . $date . ", запись сделана успешно!");
} else {
    echo json_encode("Error: " . $queryWrite . "<br>" . mysqli_error($link));
		
}	

}


//if ($id_card = $_POST['id_card_write_exit']) {
//mysqli_set_charset($link, "utf8");
//$date = date('d.m.y');
//$time = date('H:i');
//$query = "SELECT max(id) FROM Registrator WHERE id_card = '$id_card' AND Date = '$date'";
//$sql_exit = mysqli_query($link, $query);
//$result = mysqli_fetch_assoc($sql_exit);
//$stringRes = implode('',$result);
//	
//if ($stringRes !== ""){
//$queryWrite = "UPDATE Registrator SET Timeout = ('$time') WHERE id_card = '$id_card' AND Date = '$date' AND id = '$stringRes'";
//echo json_encode($stringRes);
////echo json_encode("Вы успешно покинули предприятие в " . $time . ", дата " . $date . ", запись сделана успешно!");	
//} else {
//echo json_encode("ВЫ НЕ ПРОХОДИЛИ НА ЗАВОД");
//}}
	
?>
