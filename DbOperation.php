<?php

    class DbOperation{

        private $con;

        function __construct(){
            require_once dirname(__FILE__).'/DbConnect.php';
            $db = new DbConnect();
            $this->con = $db->connect();
        }// fun Construct

        // PRUEBA DE CONEXION Y LISTADO
        public function show_Data_All(){
            // Consulta con la BD
            $stmt = $this->con->prepare("SELECT `id`,`nombres`,`apellidos`,`dni`,`pasaporte`,`edad`,`ocupacion`,`e_mail`,`altura`,`peso` FROM `TURISTAS` WHERE `id` >0");
            $stmt->execute();
            $stmt->bind_result($id,$nombres,$apellidos,$dni,$pasaporte,$edad,$ocupacion,$e_mail,$altura,$peso);
            
            $TURISTAS_JS = array();

            while($stmt->fetch()){
                $temp = array();

                $temp["id"]=utf8_encode($id);
                $temp["nombres"]=utf8_encode($nombres);
                $temp["apellidos"]=utf8_encode($apellidos);
                $temp["dni"]=utf8_encode($dni);
                $temp["pasaporte"]=utf8_encode($pasaporte);
                $temp["edad"]=utf8_encode($edad);
                $temp["ocupacion"]=utf8_encode($ocupacion);
                $temp["e_mail"]=utf8_encode($e_mail);
                $temp["altura"]=utf8_encode($altura);
                $temp["peso"]=utf8_encode($peso);

                array_push($TURISTAS_JS,$temp);
                /*
                "nombre_persona"=>"Rodmy"
                "nombre_persona"=>"Carlos"......
                */
            }// While Personas

            return $TURISTAS_JS;
        }// fun ShowData

        // PRUEBA DE CONEXION Y LISTADO
        public function show_Data_Nombres(){
            // Consulta con la BD
            $stmt = $this->con->prepare("SELECT `nombres` FROM `TURISTAS` WHERE `id` >0");
            $stmt->execute();
            $stmt->bind_result($nombres);
            
            $TURISTAS_JS = array();

            while($stmt->fetch()){
                $temp = array();

                $temp["nombres"]=utf8_encode($nombres);

                array_push($TURISTAS_JS,$temp);
                /*
                "nombre_persona"=>"Rodmy"
                "nombre_persona"=>"Carlos"......
                */
            }// While Personas

            return $TURISTAS_JS;
        }// fun ShowData
        
        // CREAR MEDIANTE GET- JSON
        public function insert_Data($nombres,$apellidos,$dni,$pasaporte,$edad,$ocupacion,$e_mail,$altura,$peso){
            // Consulta con la BD
            $stmt = $this->con->prepare("INSERT INTO `TURISTAS` (`nombres`,`apellidos`,`dni`,`pasaporte`,`edad`,`ocupacion`,`e_mail`,`altura`,`peso`) values (?,?,?,?,?,?,?,?,?)");
            /*
                i => entero
                d => double
                s => string
                b => blob / paquete
            */
            $stmt->bind_param("ssssissdd",$nombres,$apellidos,$dni,$pasaporte,$edad,$ocupacion,$e_mail,$altura,$peso);

            if($stmt->execute()){
                return true;
            }else{
                return false;
            }// if Execute

        }// funcion insert_Data

        // ELIMINAR MEDIANTE GET- JSON
        public function del_Data($id){

                // Consulta con la BD
                $stmt = $this->con->prepare("DELETE FROM `TURISTAS` WHERE `id`= ?");
                /*
                    i => entero
                    d => double
                    s => string
                    b => blob / paquete
                */
                $stmt->bind_param("i", $id);
    
                if($stmt->execute()){
                    return true;
                }else{
                    return false;
                }// if Execute
    
        }//funcion del_Data

        // ACTUALIZAR MEDIANTE GET- JSON
        public function update_Data($nombres,$apellidos,$dni,$pasaporte,$edad,$ocupacion,$e_mail,$altura,$peso, $id){
        // Consulta con la BD
        $stmt = $this->con->prepare("UPDATE `TURISTAS` SET `nombres`= ?,  `apellidos`= ?,  `dni`= ?, `pasaporte`= ?,  `edad`= ?,  `ocupacion`= ?, `e_mail`= ?,  `altura`= ?,  `peso`= ? WHERE `id`= ?");
        /*
            i => entero
            d => double
            s => string
            b => blob / paquete
        */
        $stmt->bind_param("ssssissddi", $nombres,$apellidos,$dni,$pasaporte,$edad,$ocupacion,$e_mail,$altura,$peso, $id);

        if($stmt->execute()){
        return true;
        }else{
        return false;
        }// if Execute

        }//

    }// Class DbOperacion

?>