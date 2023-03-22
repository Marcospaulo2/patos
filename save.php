<?php
    session_start();

    $username = '';
    $password = '';

    $conn = new PDO('mysql:host=vps.usina.tech;dbname=evenyx_gparadise', $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if((isset($_POST['name']) && $_POST['name'] != "" ) && (isset($_POST['email'])  && $_POST['email'] != "")){


        try {

            $sql = "INSERT INTO users (name, email, instagram,phone) VALUES (?,?,?,?)";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$_POST['name'], $_POST['email'], $_POST['insta'],$_POST['phone']]);
            
            $_SESSION["success"] = "Informações cadastradas com sucesso, em breve você receberar nossas novidades!!!";
            header("Location: index.php");
       } catch (PDOException $e) {
           $_SESSION["error"] = $e->getMessage();
           header("Location: index.php");
       }
        

    }else{
        if(!isset($_POST['email']) || $_POST['email'] == ""){
            $_SESSION["email"] = "informe o seu email";
        }

        if(!isset($_POST['name']) || $_POST['name'] == ""){
            $_SESSION["name"] = "informe o seu nome";
        }
        header("Location: index.php");
    }