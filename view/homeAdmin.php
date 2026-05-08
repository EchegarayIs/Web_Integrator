<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="resources/homeAdmin.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php include 'menuLateralAdmin.php'; ?>
  <!-- Top bar -->
  

  <main class="container">
    <div class="grid">

      <!-- Main -->
      <section class="main">
        <!-- Profile summary -->
        <div class="card">
          <div class="profile">
            <div class="avatar" aria-label="Avatar">AP</div>

            <div class="profile-meta">
              <div>
                <h1 class="name">Ana Pérez</h1>
                <p class="role">Administradora · Perfil Activo</p>

                <div class="kv" role="group" aria-label="Datos generales">
                  <div class="item">
                    <div class="label">ID</div>
                    <div class="value">AP-1042</div>
                  </div>
                  <div class="item">
                    <div class="label">Últ. sync</div>
                    <div class="value">08:12</div>
                  </div>
                  <div class="item">
                    <div class="label">Departamento</div>
                    <div class="value">Operaciones</div>
                  </div>
                  <div class="item">
                    <div class="label">Nivel</div>
                    <div class="value">82</div>
                  </div>
                </div>
              </div>

              <div class="status-badge">
                <span class="dot" aria-hidden="true"></span>
                Activa
              </div>
            </div>
          </div>
        </div>

        <!-- KPIs -->
        <div class="card">
          <div class="section-title">
            <h2>Resumen general</h2>
            <span>KPIs del perfil</span>
          </div>

          <div class="kpis">
            <div class="kpi">
              <div class="top">
                <div class="label">Total de registros</div>
                <div class="trend">↑ +6%</div>
              </div>
              <div class="value">1,284</div>
              <div class="sub">vs. semana anterior</div>
            </div>

            <div class="kpi">
              <div class="top">
                <div class="label">Ingresos / saldo</div>
                <div class="trend">↑ +2.4%</div>
              </div>
              <div class="value">$12,450</div>
              <div class="sub">últimos 30 días</div>
            </div>

            <div class="kpi">
              <div class="top">
                <div class="label">Tasa de éxito</div>
                <div class="trend">↑ +1.1%</div>
              </div>
              <div class="value">93%</div>
              <div class="sub">operaciones completadas</div>
            </div>

            <div class="kpi">
              <div class="top">
                <div class="label">Pendientes</div>
                <div class="trend" style="color:#b45309;">↓ -3</div>
              </div>
              <div class="value">7</div>
              <div class="sub">para revisión</div>
            </div>
          </div>
        </div>

        <!-- Activity + Alerts -->
        <div class="two-col">
          <div class="card">
            <div class="section-title">
              <h2>Actividad reciente</h2>
              <span>últimos movimientos</span>
            </div>

            <div class="list">
              <div class="row-item">
                <div class="mini-icon">✓</div>
                <div>
                  <p class="title">Documento aprobado</p>
                  <p class="meta">08 mayo · 10:35</p>
                </div>
                <div class="tag ok">Completado</div>
              </div>

              <div class="row-item">
                <div class="mini-icon">⟲</div>
                <div>
                  <p class="title">Actualización de datos</p>
                  <p class="meta">07 mayo · 18:10</p>
                </div>
                <div class="tag ok">Actualizado</div>
              </div>

              <div class="row-item">
                <div class="mini-icon" style="color:var(--warning);">!</div>
                <div>
                  <p class="title">Validación pendiente</p>
                  <p class="meta">06 mayo · 09:02</p>
                </div>
                <div class="tag warn">Pendiente</div>
              </div>

              <div class="row-item">
                <div class="mini-icon" style="color:var(--danger);">×</div>
                <div>
                  <p class="title">Error en sincronización</p>
                  <p class="meta">05 mayo · 21:44</p>
                </div>
                <div class="tag err">Revisar</div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="section-title">
              <h2>Alertas</h2>
              <span>estado del perfil</span>
            </div>

            <div class="alerts">
              <div class="alert-card">
                <div class="alert-icon success">✓</div>
                <div>
                  <p class="alert-title">Perfil al día</p>
                  <p class="alert-desc">No hay inconsistencias detectadas en los últimos 7 días.</p>
                </div>
              </div>

              <div class="alert-card">
                <div class="alert-icon warning">!</div>
                <div>
                  <p class="alert-title">Documentación por vencer</p>
                  <p class="alert-desc">Faltan 12 días para renovar la verificación de identidad.</p>
                </div>
              </div>

              <div class="alert-card">
                <div class="alert-icon danger">×</div>
                <div>
                  <p class="alert-title">Pendiente crítico</p>
                  <p class="alert-desc">Hay 2 elementos que requieren confirmación manual.</p>
                </div>
              </div>
            </div>

            <div style="margin-top:12px; display:flex; justify-content:flex-end;">
              <button class="btn" type="button">Ver todas</button>
            </div>
          </div>
        </div>

        <!-- Details table + Actions -->
        <div class="two-col">
          <div class="card">
            <div class="section-title">
              <h2>Últimos elementos</h2>
              <span>detalle rápido</span>
            </div>

            <table class="mini-table" aria-label="Tabla de detalle rápido">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Estado</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Solicitud #A-221</td>
                  <td>08/05</td>
                  <td><span class="tag ok">Aprobado</span></td>
                </tr>
                <tr>
                  <td>Reporte de avance</td>
                  <td>07/05</td>
                  <td><span class="tag ok">OK</span></td>
                </tr>
                <tr>
                  <td>Actualización de datos</td>
                  <td>06/05</td>
                  <td><span class="tag warn">Revisión</span></td>
                </tr>
                <tr>
                  <td>Integración fallida</td>
                  <td>05/05</td>
                  <td><span class="tag err">Error</span></td>
                </tr>
                <tr>
                  <td>Documento adjunto</td>
                  <td>04/05</td>
                  <td><span class="tag ok">Completado</span></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="card">
            <div class="section-title">
              <h2>Acciones principales</h2>
              <span>atajos</span>
            </div>

            <div class="actions">
              <button class="btn primary" type="button" style="flex:1; min-width: 180px;">Actualizar perfil</button>
              <button class="btn" type="button" style="flex:1; min-width: 180px;">Ver historial</button>
              <button class="btn" type="button" style="flex:1; min-width: 180px;">Configurar notificaciones</button>
              <button class="btn" type="button" style="flex:1; min-width: 180px;">Crear nuevo registro</button>
            </div>

            <div style="margin-top:14px; color:var(--muted); font-weight:900; font-size:12px; line-height:1.4;">
              Sugerencia: conecta estos botones con tus rutas/funciones reales para cargar datos del perfil.
            </div>
          </div>
        </div>

      </section>
    </div>
  </main>
</body>
</html>