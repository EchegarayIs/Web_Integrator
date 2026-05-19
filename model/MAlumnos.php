<?php
require_once "Conexion.php";

class MAlumnos{

    public function verificar($matricula, $contrasenia) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
            
            SELECT 
                a.id_alumno,
                a.nombre,
                a.app,
                a.apm,
                a.contrasenia,
                a.activo,
                a.fecha_registro,
                a.fecha_nac,
                a.matricula,
                a.curp,
                a.rfc,
                a.nss,
                a.correo,
                a.telefono,
                a.semestre,
                c.nombre AS carrera
            FROM alumnos a
            INNER JOIN carreras c 
                ON a.id_carrera = c.id_carrera
            WHERE a.matricula = :matricula 
            AND a.contrasenia = :contrasenia;

            
            ");
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':contrasenia', $contrasenia);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function registrar($nombre, $app, $apm, $contrasenia, $estado, $matricula, $fechaNac, $semestre, $idCarrera) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("INSERT INTO alumnos (nombre, app, apm, contrasenia, activo, fecha_nac, matricula, semestre, id_carrera) 
            VALUES (:nombre, :app, :apm, :contrasenia, :estado, :fechaNac, :matricula, :semestre, :idCarrera)");

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':app', $app);
            $stmt->bindParam(':apm', $apm);
            $stmt->bindParam(':contrasenia', $contrasenia);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':fechaNac', $fechaNac);
            $stmt->bindParam(':semestre', $semestre);
            $stmt->bindParam(':idCarrera', $idCarrera);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function resumenGeneral($idAlumno){
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("

            SELECT 
                COUNT(DISTINCT ag.id_grupo) AS numero_grupos,
                SUM(CASE WHEN asi.estado = 1 THEN 1 ELSE 0 END) AS numero_asistencias,
                SUM(CASE WHEN asi.estado = 0 THEN 1 ELSE 0 END) AS numero_faltas,
                COUNT(DISTINCT j.id_justificante) AS numero_justificantes
            FROM alumnos a
            INNER JOIN carreras c 
                ON a.id_carrera = c.id_carrera
            INNER JOIN alumno_grupo ag 
                ON a.id_alumno = ag.id_alumno
            LEFT JOIN asistencias asi 
                ON ag.id_alumno_grupo = asi.id_alumno_grupo
            LEFT JOIN justificantes j
                ON a.id_alumno = j.id_alumno
            WHERE a.id_alumno = :idAlumno
            GROUP BY a.id_alumno, a.nombre, a.app, a.apm, a.matricula, c.nombre;

            ");
            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function actividadReciente($idAlumno) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                SELECT 
                'ASISTENCIA' AS tipo_registro,
                asi.fecha AS fecha_evento,
                asi.estado AS estado,
                asi.hora_registro AS hora_evento,
                NULL AS motivo,
                NULL AS comentarios
                FROM alumnos a
                INNER JOIN carreras c 
                    ON a.id_carrera = c.id_carrera
                INNER JOIN alumno_grupo ag 
                    ON a.id_alumno = ag.id_alumno
                INNER JOIN asistencias asi 
                    ON ag.id_alumno_grupo = asi.id_alumno_grupo
                WHERE a.id_alumno = :idAlumno

                UNION ALL

                SELECT 
                    'JUSTIFICANTE' AS tipo_registro,
                    j.fecha_solicitud AS fecha_evento,
                    j.estado AS estado,
                    j.fecha_resolucion AS hora_evento,
                    j.motivo AS motivo,
                    j.comentarios AS comentarios
                FROM alumnos a
                INNER JOIN carreras c 
                    ON a.id_carrera = c.id_carrera
                INNER JOIN justificantes j 
                    ON a.id_alumno = j.id_alumno
                WHERE a.id_alumno = :idAlumno

                ORDER BY fecha_evento DESC;
            ");
            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function actualizarPerfil($idAlumno, $correo, $telefono, $contrasenia) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            
            if (!empty($contrasenia)) {
                $stmt = $conexion->prepare("
            
                    UPDATE alumnos
                    SET correo = :correo,
                        telefono = :telefono,
                        contrasenia = :contrasenia
                    WHERE id_alumno = :idAlumno;"
                );
                $stmt->bindParam(':idAlumno', $idAlumno);
                $stmt->bindParam(':correo', $correo);
                $stmt->bindParam(':telefono', $telefono);
                $stmt->bindParam(':contrasenia', $contrasenia);
            } else {
                $stmt = $conexion->prepare("
                    UPDATE alumnos SET 
                    correo = :correo, 
                    telefono = :telefono 
                    WHERE id_alumno = :idAlumno"
                );
                $stmt->bindParam(':idAlumno', $idAlumno);
                $stmt->bindParam(':correo', $correo);
                $stmt->bindParam(':telefono', $telefono);
            }
            
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function generalAsistencias($idAlumno) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                SELECT 
                    g.id_grupo,
                    g.nombre_grupo,
                    ce.nombre AS nombre_ciclo,
                    COUNT(DISTINCT asi.id_asistencia) AS numero_clases,
                    SUM(CASE WHEN asi.estado = 1 THEN 1 ELSE 0 END) AS numero_asistencias,
                    SUM(CASE WHEN asi.estado = 2 THEN 1 ELSE 0 END) AS numero_retardos,
                    SUM(CASE WHEN asi.estado = 0 THEN 1 ELSE 0 END) AS numero_faltas,
                    d.nombre AS nombre_docente,
                    d.app AS apellido_paterno_docente,
                    d.apm AS apellido_materno_docente
                FROM alumnos a
                INNER JOIN alumno_grupo ag 
                    ON a.id_alumno = ag.id_alumno
                INNER JOIN grupos g 
                    ON ag.id_grupo = g.id_grupo
                INNER JOIN ciclos_escolares ce
                    ON g.id_ciclo = ce.id_ciclo
                INNER JOIN asistencias asi 
                    ON ag.id_alumno_grupo = asi.id_alumno_grupo
                INNER JOIN docente_grupo dg 
                    ON g.id_grupo = dg.id_grupo
                INNER JOIN docentes d 
                    ON dg.id_docente = d.id_docente
                WHERE a.id_alumno = :idAlumno
                GROUP BY g.id_grupo, g.nombre_grupo, ce.nombre, d.nombre, d.app, d.apm;


            ");
            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function obtenerAsistencias($idAlumno, $idGrupo) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                SELECT 
                    g.id_grupo,
                    g.nombre_grupo,
                    ce.nombre AS nombre_ciclo,
                    asi.fecha,
                    asi.estado,
                    d.nombre AS nombre_docente,
                    d.app AS apellido_paterno_docente,
                    d.apm AS apellido_materno_docente
                FROM alumnos a
                INNER JOIN alumno_grupo ag 
                    ON a.id_alumno = ag.id_alumno
                INNER JOIN grupos g 
                    ON ag.id_grupo = g.id_grupo
                INNER JOIN ciclos_escolares ce 
                    ON g.id_ciclo = ce.id_ciclo
                INNER JOIN asistencias asi 
                    ON ag.id_alumno_grupo = asi.id_alumno_grupo
                INNER JOIN docente_grupo dg 
                    ON g.id_grupo = dg.id_grupo
                INNER JOIN docentes d 
                    ON dg.id_docente = d.id_docente
                WHERE a.id_alumno = :idAlumno and g.id_grupo = :idGrupo
                ORDER BY asi.fecha DESC;
            ");
            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->bindParam(':idGrupo', $idGrupo);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }


    public function obtenerJustificantes($idAlumno) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                SELECT 
                    j.id_justificante,
                    j.fecha_solicitud,
                    j.fecha_inicio,
                    j.fecha_fin,
                    j.motivo,
                    j.tipo,
                    j.estado,
                    j.comentarios,
                    j.fecha_resolucion,
                    a.nombre AS nombre_alumno,
                    a.app AS apellido_paterno,
                    a.apm AS apellido_materno,
                    d.nombre AS nombre_docente,
                    d.app AS apellido_paterno_docente,
                    d.apm AS apellido_materno_docente,
                    ce.nombre AS nombre_ciclo
                FROM justificantes j
                INNER JOIN alumnos a 
                    ON j.id_alumno = a.id_alumno
                INNER JOIN docentes d 
                    ON j.id_docente = d.id_docente
                INNER JOIN ciclos_escolares ce 
                    ON j.id_ciclo = ce.id_ciclo
                WHERE j.id_alumno = :idAlumno
                ORDER BY j.fecha_solicitud DESC;
            ");
            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function listarDocentes() {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("SELECT id_docente, nombre, app, apm FROM docentes WHERE activo = 1");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function tramitarJustificante($idAlumno, $idDocente, $fechaInicio, $fechaFin, $idCiclo, $motivo, $tipo, $estado, $comentarios) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                INSERT INTO justificantes (
                    fecha_solicitud,
                    fecha_inicio,
                    fecha_fin,
                    motivo,
                    tipo,
                    estado,
                    comentarios,
                    fecha_resolucion,
                    id_alumno,
                    id_docente,
                    id_ciclo
                ) VALUES (
                    CURRENT_TIMESTAMP,        
                    :fechaInicio,             
                    :fechaFin,            
                    :motivo,                   
                    :tipo,                      
                    :estado,                    
                    :comentarios,               
                    NULL,                       
                    :idAlumno,                     
                    :idDocente,                         
                    :idCiclo                          
                );
                ;
            ");
            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->bindParam(':idDocente', $idDocente);
            $stmt->bindParam(':fechaInicio', $fechaInicio);
            $stmt->bindParam(':fechaFin', $fechaFin);
            $stmt->bindParam(':idCiclo', $idCiclo);
            $stmt->bindParam(':motivo', $motivo);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':comentarios', $comentarios);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function obtenerGruposInscritos($idAlumno) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                SELECT 
                    g.id_grupo,
                    g.nombre_grupo,
                    g.semestre,
                    g.turno,
                    ce.nombre AS nombre_ciclo,
                    m.nombre_materia,
                    ag.fecha_inscripcion
                FROM alumno_grupo ag
                INNER JOIN grupos g 
                    ON ag.id_grupo = g.id_grupo
                INNER JOIN ciclos_escolares ce 
                    ON g.id_ciclo = ce.id_ciclo
                INNER JOIN materias m 
                    ON g.id_materia = m.id_materia
                WHERE ag.id_alumno = :idAlumno
                ORDER BY g.semestre, g.nombre_grupo;

            ");
            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function inscribirGrupo($idAlumno, $idGrupo) {
        $cnx = new Conexion();

        $fechaActual = date('Y-m-d');

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                INSERT INTO alumno_grupo (id_alumno, id_grupo, fecha_inscripcion)
                VALUES (:idAlumno, :idGrupo, :fechaActual);

                
            ");
            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->bindParam(':idGrupo', $idGrupo);
            $stmt->bindParam(':fechaActual', $fechaActual);
            return $stmt->execute();
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function obtenerGruposDisponibles($idAlumno) {
        $cnx = new Conexion();

        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                SELECT 
                    g.id_grupo,
                    g.nombre_grupo,
                    g.semestre,
                    g.turno,
                    ce.nombre AS nombre_ciclo,
                    m.nombre_materia
                FROM grupos g
                INNER JOIN ciclos_escolares ce 
                    ON g.id_ciclo = ce.id_ciclo
                INNER JOIN materias m 
                    ON g.id_materia = m.id_materia
                WHERE g.id_grupo NOT IN (
                    SELECT ag.id_grupo
                    FROM alumno_grupo ag
                    WHERE ag.id_alumno = :idAlumno
                )
                ORDER BY g.semestre, g.nombre_grupo;


            ");
            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());

        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function obtenerReporteAsistencia($idAlumno) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                SELECT 
                    asi.fecha,
                    asi.estado, -- 1: Asistencia, 0: Falta, 2: Retardo
                    m.nombre_materia,
                    g.nombre_grupo,
                    ce.nombre AS nombre_ciclo
                FROM asistencias asi
                INNER JOIN alumno_grupo ag 
                    ON asi.id_alumno_grupo = ag.id_alumno_grupo
                INNER JOIN grupos g 
                    ON ag.id_grupo = g.id_grupo
                INNER JOIN materias m 
                    ON g.id_materia = m.id_materia
                INNER JOIN ciclos_escolares ce 
                    ON g.id_ciclo = ce.id_ciclo
                INNER JOIN docente_grupo dg 
                    ON g.id_grupo = dg.id_grupo
                INNER JOIN docentes d 
                    ON dg.id_docente = d.id_docente
                WHERE ag.id_alumno = :idAlumno
                ORDER BY asi.fecha DESC;
            ");
            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    public function obtenerReporteJustificante($idAlumno) {
        $cnx = new Conexion();
        try {
            $conexion = $cnx->conectar();
            $stmt = $conexion->prepare("
                SELECT 
                    j.id_justificante,
                    j.fecha_solicitud,
                    j.fecha_inicio,
                    j.fecha_fin,
                    j.motivo,
                    CASE j.tipo 
                        WHEN 0 THEN 'Permiso'
                        WHEN 1 THEN 'Incapacidad'
                        WHEN 2 THEN 'Otro'
                    END AS tipo_justificante,
                    CASE j.estado 
                        WHEN 0 THEN 'Rechazado'
                        WHEN 1 THEN 'Aprobado'
                        WHEN 2 THEN 'Pendiente'
                    END AS estado_justificante,
                    j.comentarios,
                    j.fecha_resolucion,
                    a.nombre AS nombre_alumno,
                    a.app AS apellido_paterno_alumno,
                    a.apm AS apellido_materno_alumno,
                    d.nombre AS nombre_docente,
                    d.app AS apellido_paterno_docente,
                    d.apm AS apellido_materno_docente,
                    ce.nombre AS nombre_ciclo
                FROM justificantes j
                INNER JOIN alumnos a 
                    ON j.id_alumno = a.id_alumno
                INNER JOIN docentes d 
                    ON j.id_docente = d.id_docente
                INNER JOIN ciclos_escolares ce 
                    ON j.id_ciclo = ce.id_ciclo
                WHERE j.id_alumno = :idAlumno
                ORDER BY j.fecha_solicitud DESC;
            ");
            $stmt->bindParam(':idAlumno', $idAlumno);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception('Error en el sistema: ' . $e->getMessage());
        } finally {
            $cnx->cerrarConexion();
        }
    }

    
}

?>