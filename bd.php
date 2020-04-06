<?php
include 'app/config.php';

if ($id_card = $_POST['id_card']) { 
    idCardCheck();
    } elseif ($id_card = $_POST['id_card_write']) 
    {getInPlant();
    } elseif ($id_card = $_POST['id_card_write_exit']) 
    {getOutPlant();
    }

function checkingOfBase (){
    global $link;
    global $id_card;
    global $time;
    global $date;
    global $dateNoFormat;
    $query = "SELECT max(id) FROM Registrator WHERE id_card = '$id_card' and date = '$date'";
    $sql = mysqli_query($link, $query) or die(mysqli_error($link));
    $result = mysqli_fetch_row($sql);
    $res = reset($result);

    $query2 = "SELECT timeout FROM Registrator WHERE id = '$res'";
    $sql2 = mysqli_query($link, $query2) or die(mysqli_error($link));
    $result2 = mysqli_fetch_row($sql2);
    $res2 = reset($result2);
    if ($res2 == ""){
            echo json_encode("Вы зашли на завод, но еще не выходили");
        } else {
            $query = "SELECT last_name, first_name, sur_name FROM Employees WHERE id_card = '$id_card'";
            $sql = mysqli_query($link, $query) or die(mysqli_error($link));
            $result = mysqli_fetch_assoc($sql);
            $stringRes = implode(' ',$result);
            $queryWrite = "INSERT INTO Registrator (id_card, FIO, Date, Timein, Timein_noform) VALUES ('$id_card', '$stringRes', '$date', '$time', '$dateNoFormat')";
            mysqli_query($link, $queryWrite);
            echo json_encode($stringRes . ", вы зашли на завод в " . $time . ", дата " . $date . ", запись сделана успешно!");
        }

    

    } 

function idCardCheck(){
    global $link;
    global $id_card;
    mysqli_set_charset($link, "utf8");
    $query = "SELECT * FROM Employees WHERE id_card = '$id_card'";
    $sql = mysqli_query($link, $query) or die(mysqli_error($link));
    $result = mysqli_fetch_assoc($sql);
    echo json_encode($result);	
    } 

function getInPlant(){
    global $link;
    mysqli_set_charset($link, "utf8");
    global $id_card;
    global $time;
    global $date;
    global $dateNoFormat;
    $query_check = "SELECT * FROM Registrator WHERE id_card = '$id_card' AND Date = '$date'";
    $sql_check = mysqli_query($link, $query_check) or die(mysqli_error($link));
    $result_check = mysqli_fetch_row($sql_check);
    if (is_null($result_check)){
        $query = "SELECT last_name, first_name, sur_name FROM Employees WHERE id_card = '$id_card'";
        $sql = mysqli_query($link, $query) or die(mysqli_error($link));
        $result = mysqli_fetch_assoc($sql);
        $stringRes = implode(' ',$result);
        $queryWrite = "INSERT INTO Registrator (id_card, FIO, Date, Timein, Timein_noform) VALUES ('$id_card', '$stringRes', '$date', '$time', '$dateNoFormat')";
        mysqli_query($link, $queryWrite);
        echo json_encode($stringRes . ", вы зашли на завод в " . $time . ", дата " . $date . ", запись сделана успешно!");
        } else {
            checkingOfBase();       
        }
    } 

function getOutPlant(){
    global $link;
    mysqli_set_charset($link, "utf8");
    global $id_card;
    global $time;
    global $date;
    global $dateNoFormat;
    global $dateNoFormatYest;
    $query = "SELECT max(id) FROM Registrator WHERE id_card = '$id_card' AND Timein_noform BETWEEN '$dateNoFormatYest' AND '$dateNoFormat'";
    $sql = mysqli_query($link, $query) or die(mysqli_error($link));
    $result = mysqli_fetch_row($sql);
    $res = reset($result);
    if (is_null($res)){
        echo json_encode("Вы не проходили на предприятие");
    } else { 
        $queryWrite = "UPDATE Registrator SET Timeout = ('$time') WHERE id_card = '$id_card' AND id = '$res' AND Timein_noform BETWEEN '$dateNoFormatYest' AND '$dateNoFormat'";
        mysqli_query($link, $queryWrite) or die(mysqli_error($link));
        echo json_encode("Вы покинули предприятие в " . $time);
        }
    }


?>
