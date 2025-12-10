<?php 
<<<<<<< Updated upstream
require_once __DIR__ . '/../controllers/csosal.php'; 
?>

<div class="conte">
    <h2><i class="fa-solid fa-arrow-up-from-bracket"></i> Detalle de Salida</h2>
    
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?= $_SESSION['tipo_mensaje'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['mensaje'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php 
        unset($_SESSION['mensaje']);
        unset($_SESSION['tipo_mensaje']);
        ?>
    <?php endif; ?>

    <!-- Formulario -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Agregar Producto a Salida</h5>
=======
require_once 'controllers/csosal.php'; 
?>

<div class="container mt-4">
    <h2 class="mb-4">📋 Registro de Salida de Inventario</h2>

    <!-- ===================== CABECERA ===================== -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            Información General de la Salida
>>>>>>> Stashed changes
        </div>

        <div class="card-body">
<<<<<<< Updated upstream
            <form action="dashboard.php?pg=2070&idsol=<?= htmlspecialchars($idsol) ?>" method="POST" id="formDetalle">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idsol" value="<?= htmlspecialchars($idsol) ?>">
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="idprod" class="form-label">Producto <span class="text-danger">*</span></label>
                        <select name="idprod" id="idprod" class="form-control" required onchange="mostrarStock()">
                            <option value="">Seleccione un producto...</option>
                            <?php 
                            if (isset($productos) && is_array($productos) && !empty($productos)) {
                                foreach ($productos as $p):
                            ?>
                                    <option value="<?= htmlspecialchars($p['idprod']) ?>" 
                                            data-stock="<?= isset($p['stock']) ? $p['stock'] : 0 ?>"
                                            data-precio="<?= isset($p['precio']) ? $p['precio'] : 0 ?>">
                                        <?= htmlspecialchars($p['nomprod']) ?>
                                        <?php if (isset($p['stock'])): ?>
                                            (Stock: <?= $p['stock'] ?>)
                                        <?php endif; ?>
                                    </option>
                            <?php 
                                endforeach;
                            } else {
                                echo '<option disabled>No hay productos disponibles</option>';
                            }
                            ?>
                        </select>
                        <div id="stock-info" class="form-text"></div>
                    </div>
                    
                    <div class="col-md-2">
                        <label for="cantdet" class="form-label">Cantidad <span class="text-danger">*</span></label>
                        <input type="number" name="cantdet" id="cantdet" class="form-control" min="1" step="1" required>
                        <div class="form-text" id="stock-warning" style="color: red; display: none;">
                            Cantidad mayor al stock disponible
=======
            <form action="home.php?pg=2001" method="POST" id="formCabeceraSalida">
                <input type="hidden" name="ope" value="SaVe">
                <input type="hidden" name="idsal" value="<?= $cab['idsal'] ?? '' ?>">

                <div class="row">
                    <div class="col-md-6">

                        <!-- TIPO DE SALIDA -->
                        <div class="form-group mb-3">
                            <label class="form-label">Tipo de Salida *</label>
                            <select class="form-control" name="tipsal" required>
                                <option value="">Seleccione...</option>
                                <option value="Venta" 
                                    <?= (isset($cab) && $cab['tipsal']=='Venta')?'selected':'' ?>>
                                    Venta
                                </option>
                                <option value="Transferencia"
                                    <?= (isset($cab) && $cab['tipsal']=='Transferencia')?'selected':'' ?>>
                                    Transferencia
                                </option>
                                <option value="Consumo"
                                    <?= (isset($cab) && $cab['tipsal']=='Consumo')?'selected':'' ?>>
                                    Consumo Interno
                                </option>
                                <option value="Ajuste"
                                    <?= (isset($cab) && $cab['tipsal']=='Ajuste')?'selected':'' ?>>
                                    Ajuste por Pérdida
                                </option>
                            </select>
                        </div>

                        <!-- REFERENCIA -->
                        <div class="form-group mb-3">
                            <label class="form-label">Referencia</label>
                            <input type="text" class="form-control" 
                                   name="refdoc"
                                   value="<?= htmlspecialchars($cab['refdoc'] ?? '') ?>">
>>>>>>> Stashed changes
                        </div>

                    </div>
<<<<<<< Updated upstream
                    
                    <div class="col-md-3">
                        <label for="vundet" class="form-label">Valor Unitario <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="vundet" id="vundet" class="form-control" min="0" step="0.01" required>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <label for="total_preview" class="form-label">Total</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="text" id="total_preview" class="form-control" readonly>
=======

                    <div class="col-md-6">

                        <!-- CLIENTE / DESTINO -->
                        <div class="form-group mb-3">
                            <label class="form-label">Cliente / Destino</label>
                            <input type="text" class="form-control"
                                   name="clides"
                                   value="<?= htmlspecialchars($cab['clides'] ?? '') ?>">
                        </div>

                        <!-- ALMACÉN ORIGEN -->
                        <div class="form-group mb-3">
                            <label class="form-label">Almacén Origen *</label>
                            <select class="form-control" name="idalma" required>
                                <option value="">Seleccione...</option>

                                <?php foreach ($almacenes as $a): ?>
                                    <option value="<?= $a['idalma'] ?>"
                                        <?= (isset($cab) && $cab['idalma']==$a['idalma'])?'selected':'' ?>>
                                        <?= htmlspecialchars($a['nomalma']) ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
>>>>>>> Stashed changes
                        </div>

                    </div>
<<<<<<< Updated upstream
                </div>
                
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-warning" id="btnGuardar">
                            <i class="fa-solid fa-save"></i> Guardar Salida
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fa-solid fa-eraser"></i> Limpiar
=======
                </div>

                <!-- OBSERVACIONES -->
                <div class="form-group mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea class="form-control" name="obs" rows="2"><?= htmlspecialchars($cab['obs'] ?? '') ?></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar Cabecera y Añadir Productos
                </button>

                <span class="badge bg-info ms-3">
                    Estado: <?= htmlspecialchars($cab['estado'] ?? 'Creada') ?>
                </span>

            </form>
        </div>
    </div>

    <!-- ===================== DETALLES ===================== -->
    <div class="card shadow-sm mb-4" 
         id="cardDetalles"
         style="<?= isset($cab['idsal']) ? '' : 'opacity:0.6;pointer-events:none;' ?>">

        <div class="card-header bg-secondary text-white">
            Productos a Despachar (Líneas de Detalle)
        </div>

        <div class="card-body">

            <!-- FORM AGREGAR LINEA -->
            <form action="home.php?pg=2001" method="POST" id="formAgregarLinea" class="mb-4 border p-3 rounded">
                <input type="hidden" name="ope" value="SaVeDet">
                <input type="hidden" name="idsal" value="<?= $cab['idsal'] ?? '' ?>">

                <h5>Añadir Producto</h5>

                <div class="row g-3">

                    <!-- BUSCAR PRODUCTO -->
                    <div class="col-md-5">
                        <label class="form-label">Producto (SKU/Nombre)</label>
                        <input type="text" class="form-control" 
                               name="nomprod" placeholder="Busque producto">
                        <small class="text-muted">Stock: <span id="stockDisp">-</span></small>
                    </div>

                    <!-- CANTIDAD -->
                    <div class="col-md-3">
                        <label class="form-label">Cantidad</label>
                        <input type="number" class="form-control"
                               name="cant" min="1" required>
                    </div>

                    <!-- BOTÓN -->
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-plus-circle"></i> Agregar
>>>>>>> Stashed changes
                        </button>
                    </div>

                </div>
            </form>
<<<<<<< Updated upstream
=======

            <!-- TABLA DETALLE -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Lote</th>
                            <th>Vence</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if ($det && count($det)>0): ?>
                            <?php foreach ($det as $d): ?>
                            <tr>
                                <td><?= htmlspecialchars($d['nomprod']) ?></td>
                                <td><?= number_format($d['cant'], 2) ?></td>
                                <td><?= htmlspecialchars($d['codlot']) ?></td>
                                <td><?= date('d/m/Y', strtotime($d['fecven'])) ?></td>

                                <td>
                                    <a href="home.php?pg=2001&ope=eLiDet&iddet=<?= $d['iddet'] ?>&idsal=<?= $cab['idsal'] ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('¿Eliminar línea?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No hay productos agregados.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>

        </div>

        <div class="card-footer text-end">

            <a href="home.php?pg=2001&ope=CaAn&idsal=<?= $cab['idsal'] ?? 0 ?>"
               class="btn btn-lg btn-danger me-2">
                Cancelar Salida
            </a>

            <a href="home.php?pg=2001&ope=FiNa&idsal=<?= $cab['idsal'] ?? 0 ?>"
               class="btn btn-lg btn-success">
                <i class="fas fa-check-circle"></i> Confirmar y Generar Movimiento
            </a>

>>>>>>> Stashed changes
        </div>

    </div>

<<<<<<< Updated upstream
    <hr>

    <!-- Lista de detalles -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Productos en Salida</h5>
            <?php if (isset($detalles) && count($detalles) > 0): ?>
                <span class="badge bg-warning"><?= count($detalles) ?> productos</span>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <?php if (isset($detalles) && is_array($detalles) && count($detalles) > 0): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-end">Valor Unitario</th>
                                <th class="text-end">Total</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $gran_total = 0;
                            foreach ($detalles as $d): 
                                $gran_total += $d['totdet'];
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($d['nomprod']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($d['cantdet']) ?></td>
                                <td class="text-end">$<?= number_format($d['vundet'], 2, ',', '.') ?></td>
                                <td class="text-end">$<?= number_format($d['totdet'], 2, ',', '.') ?></td>
                                <td class="text-center">
                                    <a href="dashboard.php?pg=2070&idsol=<?= $idsol ?>&delete=<?= $d['iddet'] ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('¿Está seguro de eliminar este registro?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-secondary">
                            <tr>
                                <th colspan="3" class="text-end">TOTAL GENERAL:</th>
                                <th class="text-end">$<?= number_format($gran_total, 2, ',', '.') ?></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-4">
                    <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No hay productos registrados en esta salida</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cantidadInput = document.getElementById('cantdet');
    const valorInput = document.getElementById('vundet');
    const totalPreview = document.getElementById('total_preview');
    const productoSelect = document.getElementById('idprod');
    const stockInfo = document.getElementById('stock-info');
    const stockWarning = document.getElementById('stock-warning');
    const btnGuardar = document.getElementById('btnGuardar');
    
    function calcularTotal() {
        const cantidad = parseFloat(cantidadInput.value) || 0;
        const valor = parseFloat(valorInput.value) || 0;
        const total = cantidad * valor;
        totalPreview.value = total.toFixed(2);
    }
    
    function mostrarStock() {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        if (selectedOption && selectedOption.dataset.stock !== undefined) {
            const stock = parseInt(selectedOption.dataset.stock);
            const precio = parseFloat(selectedOption.dataset.precio);
            
            stockInfo.textContent = `Stock disponible: ${stock} unidades`;
            stockInfo.style.color = stock > 0 ? 'green' : 'red';
            
            // Prellenar precio si está disponible
            if (precio > 0 && !valorInput.value) {
                valorInput.value = precio.toFixed(2);
                calcularTotal();
            }
            
            // Validar cantidad vs stock
            validarStock();
        } else {
            stockInfo.textContent = '';
        }
    }
    
    function validarStock() {
        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        if (selectedOption && selectedOption.dataset.stock !== undefined) {
            const stock = parseInt(selectedOption.dataset.stock);
            const cantidad = parseInt(cantidadInput.value) || 0;
            
            if (cantidad > stock) {
                stockWarning.style.display = 'block';
                btnGuardar.disabled = true;
            } else {
                stockWarning.style.display = 'none';
                btnGuardar.disabled = false;
            }
        }
    }
    
    cantidadInput.addEventListener('input', function() {
        calcularTotal();
        validarStock();
    });
    
    valorInput.addEventListener('input', calcularTotal);
    productoSelect.addEventListener('change', mostrarStock);
    
    // Limpiar el preview al resetear
    document.getElementById('formDetalle').addEventListener('reset', function() {
        totalPreview.value = '';
        stockInfo.textContent = '';
        stockWarning.style.display = 'none';
        btnGuardar.disabled = false;
    });
    
    // Hacer la función global para que funcione desde el HTML
    window.mostrarStock = mostrarStock;
});
</script>
=======
</div>
>>>>>>> Stashed changes
