<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">

  <title>Orden de Compra Nº <?= h(str_pad($orden->id,4,'0',STR_PAD_LEFT)) ?></title>
  
  <style>
    @font-face {
    font-family: 'Montserrat';
    src: url('../font/Montserrat-Regular.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    }

    @font-face {
      font-family: 'Montserrat';
      src: url('../font/Montserrat-Regular.ttf') format('truetype');
      font-weight: bold;
      font-style: normal;
    }

    body {
      font-family: 'Montserrat', sans-serif;
      font-size: 11px;
    }

    .header h1 {
      margin: 0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 10px;
    }

    th, td {
      border: 1px solid #666;
      padding: 5px;
    }

    th {
      background: #eee;
    }

    .right {
      text-align: right;
    }

    h1 {
      font-size: 20px;
      font-weight: bold;
    }

    .bold {
      font-weight: bold;
    }

    .recuadro-principal {
      border: 1px solid #191919;
      border-radius: 8px;
      padding: 5px;
    }

    .header-table {
      width: 100%;
      border: 0;
    }

    .logo {
      border: none;
      width: 150px;
      vertical-align: middle;
    }

    .titulo {
      border: none;
      text-align: center;
      vertical-align: middle;
      font-weight: bold;
      font-size: 30px;
    }

    .datos-oc {
      border: none;
      text-align: right;
      vertical-align: middle;
      white-space: nowrap;
      font-size: 15px;
    }

    .empresa-info {
      margin-bottom: 15px;
      font-size: 11px;
      line-height: 1.4;
    }

    /* Estilos generales de tabla */
    table.detalles, table.resumen {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 15px;
      font-size: 11px;
    }

    /* header de la tabla */
    table.detalles thead th,
    table.resumen thead th {
      background: #025736;
      color: #fff;
      padding: 8px;
      border: none;
      text-align: center;
    }


    /* Filas alternas */
    table.detalles tbody tr:nth-child(odd),
    table.resumen tbody tr:nth-child(odd) {
      background: #f2f2f2;
    }

    /* Celdas */
    table.detalles td,
    table.resumen td {
      padding: 6px 8px;
      border-bottom: 1px solid #ddd;
    }

    /* Última fila de  sin borde bottom */
    table.resumen {
      font-weight: bold;
    }

    /* Alinear columnas numéricas */
    .text-right {
      text-align: right;
    }

    .observaciones {
      border: 1px solid #999;
      padding: 10px;
      margin-top: 30px;
      font-size: 11px;
      min-height: 80px;
      page-break-inside: avoid;
    }


    /* estilo para cuando la orden de compra sea ANULADA */
    .watermark {
      position: fixed;
      top: 40%;
      left: 20%;
      width: 60%;
      text-align: center;
      font-size: 128px;
      color: rgba(255,0,0,0.3);
      transform: rotate(-45deg);
      z-index: 99;
    }
  </style>
  
</head>

<body>

  <!-- Acá es donde verifico si la orden de compra es ANULADA, si es asi, aplico el estilo con marca de agua. -->
  <?php if ($orden->estado === 'Anulada'): ?>
    <div class="watermark">ANULADA</div>
  <?php endif; ?>


  <div class="recuadro-principal">

      <?php
        // tuve muchisimos problemas para poder insertar la img del logo, por ende, esta fue la unica solucion que encontré en un foro.
        // tengo que usar base64 porque domPDF no puede leer los archivos.
        $logoPath = WWW_ROOT . 'img' . DS . 'Logo - AdecoAGRO - Dashboard.png';
        $logoData = base64_encode(file_get_contents($logoPath));
        $logoMime = mime_content_type($logoPath);
      ?>
    <table class="header-table">
      <tr>
        <!-- Logo (Izquierda) -->
        <td class="logo">
          <img src="data:<?= $logoMime ?>;base64,<?= $logoData ?>" alt="Logo" style="width: 100%;">
        </td>
        
        <!-- Título (en el medio) -->
        <td class="titulo">
          <div>Orden de Compra</div>
        </td>
        
        <!-- Datos (Derecha) -->
        <td class="datos-oc">
          Orden de Compra Nº: <strong><?= h(str_pad($orden->id, 4, '0', STR_PAD_LEFT)) ?></strong><br>
          Fecha de Emisión: <strong><?= h($orden->fecha_emision->format('d/m/Y')) ?></strong><br>
          Fecha de Vencimiento: <strong><?= h($orden->fecha_vencimiento ? $orden->fecha_vencimiento->format('d/m/Y') : '-') ?></strong>
        </td>
      </tr>
    </table>

    
  
    <!-- Datos AdecoAGRO -->
    <div class="empresa-info">
      <table>
        <tr>
          <th>Razón Social:</th>
            <td colspan="2">ADECO AGROPECUARIA S.A</td>
          <th>CUIT:</th>
            <td colspan="2">30-61870567-2</td>
        </tr>
        <tr>
          <th>Condición IVA:</th>
            <td>Responsable Inscripto</td>
          <th>Dirección:</th>
            <td>Molino Mercedes Adeco, Mercedes, Corrientes</td>
          <th>Código Postal:</th>
            <td>3470</td>
        </tr>
      </table>
    </div>

    <!-- Datos Proveedor -->
    <table>
      <tr>
        <th colspan="2">Proveedor</th>
        <td colspan="5"><?= h($orden->proveedore->razon_social) ?></td>
        <th>CUIT</th>
        <td colspan="2"><?= h($orden->proveedore->cuit) ?></td>
      </tr>
      <tr>
        <th colspan="2">Dirección</th>
        <td colspan="8">
          <?= h($orden->proveedore->direccion) ?>,
          <?= h($orden->proveedore->localidad) ?> - <?= h($orden->proveedore->provincia->nombre) ?>
        </td>
      </tr>
      <tr>
        <th colspan="2">Forma de Pago</th>
        <td colspan="3"><?= h($orden->forma_pago) ?></td>
        <th colspan="2">Forma de Envío</th>
        <td colspan="3"><?= h($orden->forma_envio) ?></td>
      </tr>
    </table>


    <!-- Datos OC - Detalles -->
    <table class="detalles">
      <thead>
        <tr>
          <th style="width:5%;">Item</th>
          <th style="width:40%;">Descripción</th>
          <th style="width:10%;">Cantidad</th>
          <th style="width:15%;">Precio<br>Unitario</th>
          <th style="width:10%;">Bonificación %</th>
          <th style="width:10%;">Subtotal S/IVA</th>
          <th style="width:10%;">Subtotal C/IVA</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($orden->orden_detalles as $i => $det): ?>
        <tr>
          <td><?= $i+1 ?></td>
          <td><?= h($det->descripcion_producto) ?></td>
          <td class="text-right"><?= $this->Number->format($det->cantidad) ?></td>
          <td class="text-right"><?= h($orden->tipo_moneda->simbolo) . ' ' . $this->Number->format($det->precio_unitario) ?></td>
          <td class="text-right"><?= $this->Number->format($det->bonificacion) ?>%</td>
          <td class="text-right"><?= h($orden->tipo_moneda->simbolo) . ' ' . $this->Number->format($det->subtotal_sin_iva) ?></td>
          <td class="text-right"><?= h($orden->tipo_moneda->simbolo) . ' ' . $this->Number->format($det->subtotal_con_iva) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Resumen de Totales -->
    <table class="resumen">
      <thead>
        <tr>
          <th>Concepto</th>
          <th class="text-right">Importe</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Importe Neto Gravado</td>
          <td class="text-right">
            <?= h($orden->tipo_moneda->simbolo) . ' ' . $this->Number->format($netoGravado) ?>
          </td>
        </tr>
        <tr>
          <td>IVA Total</td>
          <td class="text-right">
            <?= h($orden->tipo_moneda->simbolo) . ' ' . $this->Number->format($ivaTotal) ?>
          </td>
        </tr>
        <tr>
          <td>Total Orden de Compra</td>
          <td class="text-right">
            <?= h($orden->tipo_moneda->simbolo) . ' ' . $this->Number->format($orden->total_orden_compra) ?>
          </td>
        </tr>
      </tbody>
    </table>


    <!-- Observaciones -->
    <?php if (!empty($orden->observaciones)): ?>
      <div class="observaciones">
        <h4>Observaciones:</h4>
        <p><?= nl2br(h($orden->observaciones)) ?></p>
      </div>
    <?php endif; ?>

  </div>
</body>
</html>
