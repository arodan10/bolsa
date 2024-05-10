<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Diagrama de Proceso de Fabricación</title>
<style>
  body {
    font-family: Arial, sans-serif;
  }
  .flow-container {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  .event, .task, .gateway, .subprocess {
    border: solid 2px #000;
    padding: 20px;
    margin: 10px;
    text-align: center;
    border-radius: 10px;
  }
  .event {
    background-color: #FFD700; /* Gold */
    border-radius: 50%;
    width: 180px;
  }
  .task {
    background-color: #9fdf9f; /* Light green */
    width: 200px;
  }
  .gateway {
    background-color: #f2f2f2; /* Light grey */
    width: 180px;
    border-radius: 50px;
  }
  .subprocess {
    background-color: #ADD8E6; /* Light blue */
    width: 250px;
  }
  .arrow {
    margin: 10px;
    text-align: center;
    font-size: 24px;
  }
  .horizontal-split {
    display: flex;
    justify-content: center;
  }
  .horizontal-arrow {
    padding: 0 20px;
    align-self: center;
  }
  h2 {
    text-align: center;
    color: #333;
  }
  .details {
    margin-top: 40px;
    border-top: 2px dashed #666;
    padding-top: 20px;
  }
</style>
</head>
<body>
<div class="flow-container">
  <div class="event">Inicio: Recibir OP</div>
  <div class="arrow">↓</div>
  <div class="task">Registrar OP</div>
  <div class="arrow">↓</div>
  <div class="subprocess">Evaluar Lugar de Fabricación</div>
  <div class="arrow">↓</div>
  <div class="gateway">¿Fabricación propia?</div>
  <div class="horizontal-split">
    <div class="flow-container">
      <div class="horizontal-arrow">→ Sí</div>
      <div class="task">Ejecutar fabricación de OP</div>
    </div>
    <div class="flow-container">
      <div class="horizontal-arrow">→ No</div>
      <div class="task">Negociar con proveedor</div>
      <div class="arrow">↓</div>
      <div class="task">Gestionar tercerización de fabricación</div>
    </div>
  </div>
  <div class="arrow">↓</div>
  <div class="task">Recibir productos en APT</div>
  <div class="arrow">↓</div>
  <div class="subprocess">Asignar Unidad de Transporte</div>
  <div class="arrow">↓</div>
  <div class="task">Despachar producto</div>
  <div class="arrow">↓</div>
  <div class="event">Fin</div>
</div>

<div class="details">
  <h2>Detalles del Subproceso: Evaluar Lugar de Fabricación</h2>
  <div class="flow-container">
    <div class="task">Evaluar disponibilidad de máquinas</div>
    <div class="arrow">↓</div>
    <div class="task">Evaluar disponibilidad de obreros</div>
    <div class="arrow">↓</div>
    <div class="gateway">¿Hay capacidad para fabricar?</div>
    <div class="horizontal-split">
      <div class="flow-container">
        <div class="horizontal-arrow">→ Sí</div>
        <div class="task">Continuar a Fabricación propia</div>
      </div>
      <div class="flow-container">
        <div class="horizontal-arrow">→ No</div>
        <div class="task">Continuar a Fabricación tercerizada</div>
      </div>
    </div>
  </div>
</div>

<div class="details">
  <h2>Detalles del Subproceso: Asignar Unidad de Transporte</h2>
  <div class="flow-container">
    <div class="task">Asignar Vehículo</div>
    <div class="arrow">↓</div>
    <div class="task">Notificar al conductor</div>
    <div class="arrow">↓</div>
    <div class="task">Preparar vehículo</div>
    <div class="arrow">↓</div>
    <div class="task">Registro de vehículo</div>
    <div class="arrow">↓</div>
    <div class="gateway">¿Cliente fuera de Lima?</div>
    <div class="flow-container">
      <div class="horizontal-arrow">→ Sí</div>
      <div class="task">Tercerizar transporte</div>
    </div>
  </div>
</div>

</body>
</html>
