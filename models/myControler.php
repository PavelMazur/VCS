<?php
include "./controlers/UserControler.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['save'])) {
        session_start();
        $err = 0;

        /* --------------------------------------------------
	                     name validation 
        ----------------------------------------------------- */
        if (empty($_POST['name'])) {
            $_SESSION['errName'][] = "You didn't enter the name<br>";
            $err++;
        }

        $existingPlantName = User::ifExistsPlantName($_POST['name']);
        if ($existingPlantName != null) {
            $_SESSION['errName'][] = "The " . strtoupper($_POST['name']) . " plant already exists in the database<br>";
            $err++;
        }

        if (!preg_match("/^[a-zA-Z Ą ą Č č Ę ę Ė ė Į į Š š Ų ų Ū ū Ž ž]*$/", $_POST['name'])) {
            $_SESSION['errName'][] = "Your name should be just letters<br>";
            $err++;
        }

        if (strlen($_POST['name']) < 3 && strlen($_POST['name']) != 0) {
            $_SESSION['errName'][] = strtoupper($_POST['name']) . ' name is too short';
            $err++;
        } 
        
        else if (strlen($_POST['name']) > 15) {
            $_SESSION['errName'][] = strtoupper($_POST['name']) . ' name is too long';
            $err++;
        }

        /* --------------------------------------------------
	                     surname validation 
        ----------------------------------------------------- */
        if (empty($_POST['surname'])) {
            $_SESSION['errSurname'][] = "You didn't enter the surname<br>";
            $err++;
        }

        $existingPlantSurname = User::ifExistsPlantSurname($_POST['surname']);
        if ($existingPlantSurname != null) {
            $_SESSION['errSurname'][] = "The " . strtoupper($_POST['surname']) . " plant already exists in the database<br>";
            $err++;
        }

        if (!preg_match("/^[a-zA-Z]*$/", $_POST['surname'])) {
            $_SESSION['errSurname'][] = "Your lot_name should be just letters";
            $err++;
        }

        if (strlen($_POST['surname']) < 3 && strlen($_POST['surname']) != 0) {
            $_SESSION['errSurname'][] = strtoupper($_POST['surname']) . ' lotName is too short';
            $err++;
        } 

        else if (strlen($_POST['surname']) > 15) {
            $_SESSION['errSurname'][] = strtoupper($_POST['surname']) . ' lotName is too long';
            $err++;
        }

        /* --------------------------------------------------
	                     button validation 
        ----------------------------------------------------- */
        if (!isset($_POST['bool'])) {
            $_SESSION['errButton'][] = "No class selected.";
            $err++;
        }

        /* --------------------------------------------------
	                     age validation 
        ----------------------------------------------------- */
        if (empty($_POST['age'])) {
            $_SESSION['errAge'][] = "You didn't enter the age<br>";
            $err++;
        } 

        else if (!preg_match("/^(\d+(?:[\,{2, }\.{2, }]\d{1,})?)$/", $_POST['age']) && ($_POST['age'][0] != 0 && $_POST['age'][0] != ',' && $_POST['age'][0] != '.')) {
            $_SESSION['errAge'][] = "You can't put 2 (dots/commas) in a row or in age<br>";
            $err++;
        }

        if (!preg_match("/^[0-9 . ,]*$/", $_POST['age'])) {
            $_SESSION['errAge'][] = "Your age should be just numbers<br>";
            $err++;
        }
        
        if ($_POST['age'][0] == 0) {
            $_SESSION['errAge'][] = "You can't put first 'ZERO<br>";
            $err++;
        }
        
        if ($_POST['age'][0] == ',') {
            $_SESSION['errAge'][] = "You can't put first COMMA<br>";
            $err++;
        }
       
        if ($_POST['age'][0] == '.') {
            $_SESSION['errAge'][] = "You can't put first DOT<br>";
            $err++;
        }
        
        if ($_POST['age'][strlen($_POST['age']) - 1] == ',') {
            $_SESSION['errAge'][] = "You can't put last COMMA<br>";
            $err++;
        }

        if ($_POST['age'][strlen($_POST['age']) - 1] == '.') {
            $_SESSION['errAge'][] = "You can't put last DOT<br>";
            $err++;
        }

        if (strlen($_POST['age']) > 15) {
            $_SESSION['errAge'][] = strtoupper($_POST['age']) . ' age length is too long';
            $err++;
        } 

        /* --------------------------------------------------
	                     height validation 
        ----------------------------------------------------- */
        if (empty($_POST['height'])) {
            $_SESSION['errHeight'][] = "You didn't enter the height<br>";
            $err++;
        }

        else if (!preg_match("/^(\d+(?:[\,{2, }\.{2, }]\d{1,})?)$/", $_POST['height']) && ($_POST['height'][0] != 0 && $_POST['height'][0] != ',' && $_POST['height'][0] != '.')) {
            $_SESSION['errHeight'][] = "You can't put 2 (dots/commas) in a row or in age<br>";
            $err++;
        }

        if (!preg_match("/^[0-9 . ,]*$/", $_POST['height'])) {
            $_SESSION['errHeight'][] = "Your age should be just numbers<br>";
            $err++;
        }

        if ($_POST['height'][0] == 0) {
            $_SESSION['errHeight'][] = "You can't put first 'ZERO";
            $err++;
        }
    
        if ($_POST['height'][0] == ',') {
            $_SESSION['errHeight'][] = "You can't put first COMMA";
            $err++;
        }

        if ($_POST['height'][strlen($_POST['height']) - 1] == ',') {
            $_SESSION['errHeight'][] = "You can't put last COMMA";
            $err++;
        }

        if ($_POST['height'][0] == '.') {
            $_SESSION['errHeight'][] = "You can't put first DOT ";
            $err++;
        }

        if ($_POST['height'][strlen($_POST['height']) - 1] == '.') {
            $_SESSION['errHeight'][] = "You can't put last DOT";
            $err++;
        }

        if (strlen($_POST['height']) > 15) {
            $_SESSION['errHeight'][] = strtoupper($_POST['height']) . ' height length is too long';
            $err++;
        } 
    
        /* --------------------------------------------------
	                     function tail 
        ----------------------------------------------------- */

    if ($err == 0) {
        UserControler::store();
    }

    header("Location:" . $_SERVER['REQUEST_URI']);
    die;
    }

    if (isset($_POST['edit'])) {
        $user = UserControler::show();
    }

    if (isset($_POST['update'])) {
        UserControler::update();
        header("Location:" . $_SERVER['REQUEST_URI']);
    }

    if (isset($_POST['destroy'])) {
        UserControler::destroy();
        header("Location:" . $_SERVER['REQUEST_URI']);
    }
}

$users = UserControler::index();
