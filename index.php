<?php
    include 'conexion.php';
    $pdo = new conexion();
    
    if($_SERVER['REQUEST_METHOD']=='GET'){
        if (isset($_GET['n_credito'])){
            $sql = $pdo->prepare("select* from creditos WHERE n_credito=:n_credito");
            $sql->bindValue(':n_credito', $_GET['n_credito']);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            echo "Mostrar credito";
            echo json_encode($sql->fetchAll());
            exit;  

        }else { 

        $sql = $pdo->prepare("select* from creditos");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        echo "Mostrar todos los creditos";
        echo json_encode($sql->fetchAll());
        exit;
        }
    }

    //Crear creditos
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if (isset($_POST['cedula'])){
            $sql = "INSERT INTO creditos (cedula,nombre,valor) VALUES (:cedula,:nombre,:valor)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':cedula',$_POST['cedula']);
            $stmt->bindValue(':nombre',$_POST['nombre']);
            $stmt->bindValue(':valor',$_POST['valor']);
            $stmt-> execute();
            $idPost= $pdo->lastInsertId();
            if($idPost){
                //header("HTTP/1.1 200 ok datos");
                echo json_encode($idPost);
                exit;  
            }
        }
    }

    //Actualizar creditos
    if($_SERVER['REQUEST_METHOD']=='PUT'){
        if (isset($_GET['cedula'])){
            $sql = "UPDATE creditos SET cedula=:cedula,nombre=:nombre,valor=:valor WHERE n_credito=:n_credito" ;   
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':cedula',$_GET['cedula']);
            $stmt->bindValue(':nombre',$_GET['nombre']);
            $stmt->bindValue(':valor',$_GET['valor']);
            $stmt->bindValue(':n_credito',$_GET['n_credito']);
            $stmt-> execute(); 
            echo "Credito actualizado";
            exit;
        }
    }

    //Crear aprobaciones
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if (isset($_POST['n_credito'])){
            $sql = "INSERT INTO aprobaciones (n_credito) VALUES (:n_credito)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':n_credito',$_POST['n_credito']);
            $stmt-> execute();
            $idPost= $pdo->lastInsertId();
            if($idPost){
                //header("HTTP/1.1 200 ok datos");
                echo "Aprobación creada";
                echo json_encode($idPost);
                exit;  
            }
        }
    }

    //Actualizar estado aprobaciones y creditos
    if($_SERVER['REQUEST_METHOD']=='PUT'){
        if (isset($_GET['estado'])){
            $sql = "UPDATE aprobaciones INNER JOIN creditos ON creditos.n_credito = aprobaciones.n_credito
                    SET aprobaciones.estado_aprobacion=:estado, creditos.estado=:estado WHERE aprobaciones.n_credito=:n_credito";   
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':n_credito',$_GET['n_credito']);
            $stmt->bindValue(':estado',$_GET['estado']);
            $stmt-> execute();
            echo "Aprobacion actualizada en credito";
            if ($_GET['estado'] == '3'){
                $sql = "SELECT valor FROM creditos WHERE n_credito=:n_credito";   
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':n_credito',$_GET['n_credito']);
                $stmt-> execute();
                $valor = $stmt->fetchAll();
                $valor = floatval($valor[0]['valor']);

                $sql = "UPDATE creditos SET saldo=:valor WHERE n_credito=:n_credito";   
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':n_credito',$_GET['n_credito']);
                $stmt->bindValue(':valor',$valor);
                $stmt-> execute();
                echo "\n Saldo añadido en credito autorizado";
            }
            header("HTTP/1.1 200 ok datos listos");
            exit;
        }
    }
    
    //Actualizar valor saldo creditos
    //Prueba git
    if($_SERVER['REQUEST_METHOD']=='PUT'){
        if (isset($_GET['saldo'])){
            $sql = "SELECT saldo FROM creditos WHERE n_credito=:n_credito";   
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':n_credito',$_GET['n_credito']);
            $stmt-> execute();
            $saldoIni = $stmt->fetchAll();
            $saldoIni = floatval($saldoIni[0]['saldo']);

            if ($saldoIni <= 0){
                echo "Saldo en 0";
            }
            else{
            $saldoRes = floatval($_GET['saldo']);
            $saldo = $saldoIni - $saldoRes;

            $sql = "UPDATE creditos SET saldo=:saldo WHERE n_credito=:n_credito";   
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':n_credito',$_GET['n_credito']);
            $stmt->bindValue(':saldo',$saldo);
            $stmt-> execute(); 
            echo "Credito actualizado, nuevo saldo: ".$saldo;
            }
            exit;
        }
    }
            



?>