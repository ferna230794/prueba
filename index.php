<?php 	
    // Llamada a DbOperation
    require_once 'DbOperation.php';

    // Array de Respuesta
    $response = array();

    if(isset($_GET['op'])){

        switch($_GET['op'])
        {

            case 'mostrar_todo':
                $db = new DbOperation();
                $Datos = $db->show_Data_All();

                $x = array(
                    "TURISTAS_DB" =>$Datos
                );

                $cadena = json_encode($x,JSON_PRETTY_PRINT);
                header("Content-Type: application/json; charset=UTF-8");
                echo ($cadena);
            break;

            case 'mostrar_nombres':
                $db = new DbOperation();
                $Datos = $db->show_Data_Nombres();

                $x = array(
                    "TURISTAS" =>$Datos
                );

                $cadena = json_encode($x,JSON_PRETTY_PRINT);
                header("Content-Type: application/json; charset=UTF-8");
                echo ($cadena);

            break;

             // Llamada GET PARA INSERTAR
             case 'insertar':
                $db = new DbOperation();

                if(isset($_GET['nombres']) && isset($_GET['apellidos']) && isset($_GET['dni']) && isset($_GET['pasaporte']) && isset($_GET['edad']) && isset($_GET['ocupacion']) && isset($_GET['e_mail']) && isset($_GET['altura']) && isset($_GET['peso']))
                {                   
                    if($db->insert_Data($_GET['nombres'] , $_GET['apellidos'] , $_GET['dni'], $_GET['pasaporte'] , $_GET['edad'] , $_GET['ocupacion'] , $_GET['e_mail'] , $_GET['altura'] , $_GET['peso']))
                    {
                        $response['Mensaje :'] = "Datos Ingresados Correctamente.";

                    }else{
                        $response['Mensaje :'] = "No se ingresaron Datos.";
                    }
                
                }else{
                    $response['Mensaje :'] = "No existen Datos para registrar.";
                }
                echo json_encode($response);

            break;

             // Llamada GET PARA ELIMINAR
             case 'eliminar':
                $db = new DbOperation();

                if(isset($_GET['id']))
                {                   
                    if($db->del_Data($_GET['id']))
                    {
                        $response['Mensaje :'] = "Datos Eliminados Correctamente.";

                    }else{
                        $response['Mensaje :'] = "No se puede eliminar los Datos.";
                    }
                
                }else{
                    $response['Mensaje :'] = "No existen Datos para eliminar.";
                }
                echo json_encode($response);

            break;

            
             // Llamada GET PARA ACTUALIZAR
             case 'actualizar':
                $db = new DbOperation();

                if(isset($_GET['nombres']) && isset($_GET['apellidos']) && isset($_GET['dni']) && isset($_GET['pasaporte']) && isset($_GET['edad']) && isset($_GET['ocupacion']) && isset($_GET['e_mail']) && isset($_GET['altura']) && isset($_GET['peso']) && isset($_GET['id']))
                {                   
                    if($db->update_Data($_GET['nombres'] , $_GET['apellidos'] , $_GET['dni'], $_GET['pasaporte'] , $_GET['edad'] , $_GET['ocupacion'] , $_GET['e_mail'] , $_GET['altura'] , $_GET['peso'], $_GET['id']))
                    {
                        $response['Mensaje :'] = "Datos Actualizados Correctamente.";

                    }else{
                        $response['Mensaje :'] = "No sepueden actualizar los  Datos.";
                    }
                
                }else{
                    $response['Mensaje :'] = "No existen Datos para actualizar.";
                }
                echo json_encode($response);

            break;
            default;
                $response['Mensaje :'] = "No existe seleccion VALIDA de LF.";
                echo json_encode($response);
            break;
           
        }// SWITCH

    }else{
        $response['Mensaje :'] = "requerimiento Invalido.";
        echo json_encode($response);
    }//if OP



?>