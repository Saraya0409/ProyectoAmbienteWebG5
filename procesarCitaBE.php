<?php
include('DB.php');
$data = $_POST;
switch ($data['action']) {
    case 'add':
        if ($data["nombre"] ?? ''  != '') {
           
            $query = "INSERT INTO `citas` (`cedula`,`nombre`, `telefono`, `email`, `fechaCita`, `horaCita`, `doctor`) VALUES ('" . $data['cedula'] . "', '" . $data['nombre'] . "', '" . $data['telefono'] . "','" . $data['email'] . "','" . $data['fechaCita'] . "','" . $data['horaCita'] . "','" . $data['doctor'] . "')";
            try {
                if ($conn->query($query) ==  TRUE) {
                    echo json_encode(["status" => "00", "message" => "Se agrego correctamente la cita"]);
                } else {
                    echo json_encode(["status" => "99", "message" => "Error al guardar la cita"]);
                }
            } catch (Exception $e) {
                echo json_encode(["status" => "99", "message" => "Error al guardar la cita"]);
            }
        }

        break;
        case 'getAll':
            $sql = "SELECT * FROM citas";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                $citas = [];
                while ($cita = $result->fetch_assoc()) {
                    $doctorId = $cita["doctor"];
                    $sql = "SELECT doctornombre FROM farmacia.doctor where iddoctor=$doctorId";
                    $result_doctor = $conn->query($sql);
                    if ($result_doctor->num_rows > 0) {                     
                        $doctor = $result_doctor->fetch_assoc();
                        $doctorNombre = $doctor["doctornombre"];
                    } else {
                        $doctorNombre = "Desconocido"; 
                    }
                    $citas[] = [
                        "idcitas" => $cita["idcitas"],
                        "cedula" => $cita["cedula"],
                        "nombre" => $cita["nombre"],
                        "telefono" => $cita["telefono"],
                        "email" => $cita["email"],
                        "fechaCita" => $cita["fechaCita"],
                        "horaCita" => $cita["horaCita"],
                        "doctor" => $doctorNombre                   
                    ];
                    

                }
                echo json_encode(["status" => "00", "citas" => $citas]);
            } else {
                echo json_encode(["status" => "99", "citas" => []]);
            }
            break;
            case 'getByCedula':
                $cedula = $_POST['cedula'] ?? '';
                if (empty($cedula)) {
                    echo json_encode(["status" => "99", "message" => "La cédula es requerida"]);
                    exit;
                }
                $sql = "SELECT * FROM citas WHERE cedula = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $cedula);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows > 0) {
                    $citas = [];
                    while ($cita = $result->fetch_assoc()) {
                        $doctorId = $cita["doctor"];
                        $sql = "SELECT doctornombre FROM farmacia.doctor where iddoctor=$doctorId";
                        $result_doctor = $conn->query($sql);
                        if ($result_doctor->num_rows > 0) {                     
                            $doctor = $result_doctor->fetch_assoc();
                            $doctorNombre = $doctor["doctornombre"];
                        } else {
                            $doctorNombre = "Desconocido"; 
                        }
                        $citas[] = [      
                            "idcitas" => $cita["idcitas"],                      
                            "cedula" => $cita["cedula"],
                            "nombre" => $cita["nombre"],
                            "telefono" => $cita["telefono"],
                            "email" => $cita["email"],
                            "fechaCita" => $cita["fechaCita"],
                            "horaCita" => $cita["horaCita"],
                            "doctor" => $doctorNombre                
                        ];
                        
    
                    }
                    echo json_encode(["status" => "00", "citas" => $citas]);
                } else {
                    echo json_encode(["status" => "99", "citas" => ["ssss"]]);
                }
                break;

                case 'delete':
                    $id = $data["id"];
                    $query = "DELETE FROM citas where idcitas = '$id'";
                    try {
                        if ($conn->query($query) ==  TRUE) {
                            echo json_encode(["status" => "00", "message" => "Se Borro exitosamente la cita"]);
                        } else {
                            echo json_encode(["status" => "99", "message" => "Error al borrar la cita"]);
                        }
                    } catch (Exception $e) {
                        echo json_encode(["status" => "99", "message" => "Error al borrar la cita"]);
                    }
                    break;

                    case 'update':
                        $id = $data["id"];
                        $name = $data["name"];
                        $query = "update citas set name = '$name' where id = '$id'";
                        try {
                            if ($conn->query($query) ==  TRUE) {
                                echo json_encode(["status" => "00", "message" => "Se actualizo exitosamente al profesor", "name" => $name]);
                            } else {
                                echo json_encode(["status" => "99", "message" => "Error al actualizar al profesor"]);
                            }
                        } catch (Exception $e) {
                            echo json_encode(["status" => "99", "message" => "Error al actualizar al profesor"]);
                        }
                        break;

}


