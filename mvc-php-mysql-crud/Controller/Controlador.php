<?php
    require_once("../Modell/conexion.php");
    header('Content-Type: application/json');
    
    $body = json_decode(file_get_contents("php://input"), true);

    class Categoria extends Conectar{
        public function get_categoria(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM task";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_categoria($title,$description){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO task(title,description) VALUES (?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $title);
            $sql->bindValue(2, $description);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }


    }

    /* APIS */
    $categoria = new Categoria();

    switch($_GET["op"]){

        case "get_list":
            $datos=$categoria->get_categoria();
            echo json_encode($datos);
        break;

        case "insert_list":
            $datos=$categoria->insert_categoria($body["title"],$body["description"]);
            echo json_encode("Insert Correcto");
        break;

    }
?>