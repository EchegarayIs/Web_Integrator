<?php
require_once "Conexion.php";

class MDocentes{

    public function verificar($noEmpleado, $contrasenia) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM docentes WHERE no_empleado = :noEmpleado AND contrasenia = :contrasenia");
            $stmt->bindParam(':noEmpleado', $noEmpleado);
            $stmt->bindParam(':contrasenia', $contrasenia);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function buscar($docente){
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT * FROM docentes WHERE nombre LIKE :docente OR app LIKE :docente OR apm LIKE :docente 
                                        OR no_empleado LIKE :docente OR correo LIKE :docente OR especialidad LIKE :docente 
                                        OR grado_estudio LIKE :docente OR curp LIKE :docente OR rfc LIKE :docente OR nss LIKE :docente 
                                        OR telefono LIKE :docente OR activo LIKE :docente OR cedula LIKE :docente");
            $searchTerm = '%' . $docente . '%';
            $stmt->bindParam(':docente', $searchTerm);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function registrar($nombre, $app, $apm, $contrasenia, $estado, $noEmpleado, $fechaNac, $cedula, $especialidad, $gradoEstudio, $correo = '', $curp = '', $rfc = '', $nss = '', $telefono = '') {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("INSERT INTO docentes (nombre, app, apm, correo, contrasenia, activo, no_empleado, fecha_nac, cedula, curp, rfc, nss, telefono, especialidad, grado_estudio) 
            VALUES (:nombre, :app, :apm, :correo, :contrasenia, :estado, :noEmpleado, :fechaNac, :cedula, :curp, :rfc, :nss, :telefono, :especialidad, :gradoEstudio)");

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':app', $app);
            $stmt->bindParam(':apm', $apm);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':contrasenia', $contrasenia);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':noEmpleado', $noEmpleado);
            $stmt->bindParam(':fechaNac', $fechaNac);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':curp', $curp);
            $stmt->bindParam(':rfc', $rfc);
            $stmt->bindParam(':nss', $nss);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':especialidad', $especialidad);
            $stmt->bindParam(':gradoEstudio', $gradoEstudio);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }   
    
    public function obtenerDocentePorId($idDocente){
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                SELECT * 
                FROM docentes
                WHERE id_docente = :idDocente
            ");
<<<<<<< HEAD
            $stmt->bindParam(':idDocente', $idDocente);
=======
            $stmt->bindParam(':idDocente', $idDocente);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function actualizarPassword($idDocente, $nuevaPassword){
        $cnx = new Conexion();
        try{
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                UPDATE docentes
                SET contrasenia = :password
                WHERE id_docente = :idDocente
            ");
            $stmt->bindParam(':password', $nuevaPassword);
            $stmt->bindParam(':idDocente', $idDocente);
            return $stmt->execute();
        }catch(PDOException $e){
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        }finally{
            $cnx->cerrarConexion();
        }
    }
    
    public function obtenerGruposDocente($idDocente){
    $cnx = new Conexion();
        try{
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                SELECT 
                    dg.id_docente_grupo,
                    g.id_grupo,
                    g.nombre_grupo,
                    m.nombre_materia
                FROM docente_grupo dg
                INNER JOIN grupos g 
                    ON dg.id_grupo = g.id_grupo
                INNER JOIN materias m
                    ON g.id_materia = m.id_materia
                WHERE dg.id_docente = :idDocente
            ");

            $stmt->bindParam(':idDocente', $idDocente);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            throw new Exception("Error en el sistema: " . $e->getMessage());
        }finally{
            $cnx->cerrarConexion();
        }
    }
    
    public function obtenerAlumnosGrupo($idGrupo){
        $cnx = new Conexion();

        try{

            $conexion = $cnx->conectar();

            $stmt = $conexion->prepare("
                SELECT 
                    a.id_alumno,
                    a.nombre,
                    a.app,
                    a.apm
                FROM alumno_grupo ag
                INNER JOIN alumnos a
                    ON ag.id_alumno = a.id_alumno
                WHERE ag.id_grupo = :idGrupo
                ORDER BY a.app ASC
            ");

            $stmt->bindParam(':idGrupo', $idGrupo);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }catch(PDOException $e){

            throw new Exception("Error en el sistema: " . $e->getMessage());

        }finally{

            $cnx->cerrarConexion();
        }
    }

    public function obtenerAlumnoGrupo($idAlumno, $idGrupo){

        $cnx = new Conexion();

        try{

            $conexion = $cnx->conectar();

            $stmt = $conexion->prepare("
                SELECT id_alumno_grupo
                FROM alumno_grupo
                WHERE id_alumno = :idAlumno
                AND id_grupo = :idGrupo
            ");

            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->bindParam(':idGrupo', $idGrupo);

>>>>>>> 2168162cbb749a51f62ca038dcc58b76f650e736
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
<<<<<<< HEAD
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function actualizarPassword($idDocente, $nuevaPassword){
        $cnx = new Conexion();
        try{
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                UPDATE docentes
                SET contrasenia = :password
                WHERE id_docente = :idDocente
            ");
            $stmt->bindParam(':password', $nuevaPassword);
            $stmt->bindParam(':idDocente', $idDocente);
            return $stmt->execute();
        }catch(PDOException $e){
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        }finally{
            $cnx->cerrarConexion();
        }
    }
    
    public function obtenerGruposDocente($idDocente){
    $cnx = new Conexion();
        try{
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                SELECT 
                    dg.id_docente_grupo,
                    g.id_grupo,
                    g.nombre_grupo,
                    m.nombre_materia
                FROM docente_grupo dg
                INNER JOIN grupos g 
                    ON dg.id_grupo = g.id_grupo
                INNER JOIN materias m
                    ON g.id_materia = m.id_materia
                WHERE dg.id_docente = :idDocente
            ");

            $stmt->bindParam(':idDocente', $idDocente);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            throw new Exception("Error en el sistema: " . $e->getMessage());
        }finally{
=======

        }catch(PDOException $e){

            throw new Exception('Error en el sistema: ' . $e->getMessage());

        }finally{

            $cnx->cerrarConexion();
        }
    }
    
    public function obtenerDocenteGrupo($idDocente, $idGrupo){

        $cnx = new Conexion();

        try{

            $conexion = $cnx->conectar();

            $stmt = $conexion->prepare("
                SELECT id_docente_grupo
                FROM docente_grupo
                WHERE id_docente = :idDocente
                AND id_grupo = :idGrupo
            ");

            $stmt->bindParam(':idDocente', $idDocente);
            $stmt->bindParam(':idGrupo', $idGrupo);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        }catch(PDOException $e){

            throw new Exception('Error en el sistema: ' . $e->getMessage());

        }finally{

            $cnx->cerrarConexion();
        }
    }

    public function guardarAsistencia($fecha, $hora, $estado, $idAlumnoGrupo, $idDocenteGrupo){

        $cnx = new Conexion();

        try{

            $conexion = $cnx->conectar();

            $stmt = $conexion->prepare("
                INSERT INTO asistencias(
                    fecha,
                    estado,
                    hora_registro,
                    id_alumno_grupo,
                    id_docente_grupo
                )
                VALUES(
                    :fecha,
                    :estado,
                    :hora,
                    :idAlumnoGrupo,
                    :idDocenteGrupo
                )
            ");

            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':hora', $hora);
            $stmt->bindParam(':idAlumnoGrupo', $idAlumnoGrupo);
            $stmt->bindParam(':idDocenteGrupo', $idDocenteGrupo);

            return $stmt->execute();

        }catch(PDOException $e){

            throw new Exception('Error en el sistema: ' . $e->getMessage());

        }finally{

>>>>>>> 2168162cbb749a51f62ca038dcc58b76f650e736
            $cnx->cerrarConexion();
        }
    }

    public function consultar() {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT id_docente, no_empleado, nombre, app, apm, correo, especialidad, activo FROM docentes ORDER BY id_docente ASC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function editar($idDocente, $nombre, $app, $apm, $contrasenia, $activo, $noEmpleado, $fechaNac, $cedula, $curp, $rfc, $nss, $telefono, $especialidad, $gradoEstudio) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("UPDATE docentes SET nombre = :nombre, app = :app, apm = :apm, contrasenia = :contrasenia, activo = :activo,
                                        no_empleado = :noEmpleado, fecha_nac = :fechaNac, cedula = :cedula, curp = :curp, rfc = :rfc, nss = :nss, telefono = :telefono,
                                        especialidad = :especialidad, grado_estudio = :gradoEstudio WHERE id_docente = :idDocente");

            $stmt->bindParam(':idDocente', $idDocente);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':app', $app);
            $stmt->bindParam(':apm', $apm);
            $stmt->bindParam(':contrasenia', $contrasenia);
            $stmt->bindParam(':activo', $activo);
            $stmt->bindParam(':noEmpleado', $noEmpleado);
            $stmt->bindParam(':fechaNac', $fechaNac);
            $stmt->bindParam(':cedula', $cedula);
            $stmt->bindParam(':curp', $curp);
            $stmt->bindParam(':rfc', $rfc);
            $stmt->bindParam(':nss', $nss);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':especialidad', $especialidad);
            $stmt->bindParam(':gradoEstudio', $gradoEstudio);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function eliminar($idDocente) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("DELETE FROM docentes WHERE id_docente = :idDocente");
            $stmt->bindParam(':idDocente', $idDocente);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }
}