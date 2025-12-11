<?php 
include_once ("controllers/csosal.php"); // controlador de solsalida
?>

<div class="container-fluid mt-4">
    
    <!-- SECCIÓN: LISTADO DE SALIDAS -->
    <?php if (!$idsal): ?>
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="fa-solid fa-arrow-up-from-bracket text-primary"></i> Gestión de Salidas</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSalida">
            <i class="fa-solid fa-plus"></i> Nueva Salida
        </button>
    </div>

    <!-- Mensajes -->
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

    <!-- TABLA DE SALIDAS -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Tipo</th>
                            <th>Empresa</th>
                            <th>Usuario</th>
                            <th>Ubicación</th>
                            <th>Ref. Doc</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($dtAll && count($dtAll) > 0): ?>
                            <?php foreach ($dtAll as $s): ?>
                            <tr>
                                <td><?= $s['idsal'] ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($s['fecsal'])) ?></td>
                                <td><?= htmlspecialchars($s['tpsal']) ?></td>
                                <td><?= htmlspecialchars($s['nomemp'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($s['nomusu'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($s['nomubi'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($s['refdoc']) ?></td>
                                <td>
                                    <span class="badge bg-<?= $s['estsal'] == 'Pendiente' ? 'warning' : 'success' ?>">
                                        <?= $s['estsal'] ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="home.php?pg=<?= $pg; ?>&idsal=<?= $s['idsal']; ?>" 
                                        class="btn btn-sm btn-outline-primary me-2" title="Ver Detalles">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="javascript:void(0);"
                                       onclick="confirmarEliminacion('home.php?pg=<?= $pg; ?>&idsal=<?= $s['idsal']; ?>&ope=eLi')"
                                       class="btn btn-sm btn-outline-danger" title="Eliminar">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No hay salidas registradas</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php else: ?>
    
    <!-- SECCIÓN: DETALLE DE SALIDA -->
    <div class="mb-3">
        <a href="home.php?pg=<?= $pg ?>" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Volver al Listado
        </a>
    </div>

    <!-- ENCABEZADO CON BOTÓN FINALIZAR -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">
            <i class="fa-solid fa-file-invoice text-primary"></i> 
            Detalle de Salida #<?= $idsal ?>
        </h3>

        <form action="home.php?pg=<?= $pg ?>&idsal=<?= $idsal ?>" method="POST">
            <input type="hidden" name="ope" value="Fin">

            <?php if ($cab['estsal'] == 'Pendiente'): ?>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-save"></i> Finalizar Salida
                </button>
            <?php else: ?>
                <button type="button" class="btn btn-success" disabled>
                    <i class="fa-solid fa-check"></i> Salida Finalizada
                </button>
            <?php endif; ?>
        </form>
    </div>

    <!-- Mensajes -->
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

    <!-- INFORMACIÓN DE CABECERA -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Información General</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>Fecha:</strong><br>
                    <?= date('d/m/Y H:i', strtotime($cab['fecsal'])) ?>
                </div>
                <div class="col-md-3">
                    <strong>Tipo:</strong><br>
                    <?= htmlspecialchars($cab['tpsal']) ?>
                </div>
                <div class="col-md-3">
                    <strong>Empresa:</strong><br>
                    <?= htmlspecialchars($cab['nomemp'] ?? 'N/A') ?>
                </div>
                <div class="col-md-3">
                    <strong>Estado:</strong><br>
                    <span class="badge bg-<?= $cab['estsal'] == 'Pendiente' ? 'warning' : 'success' ?>">
                        <?= $cab['estsal'] ?>
                    </span>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <strong>Usuario:</strong><br>
                    <?= htmlspecialchars($cab['nomusu'] ?? 'N/A') ?>
                </div>
                <div class="col-md-3">
                    <strong>Ubicación:</strong><br>
                    <?= htmlspecialchars($cab['nomubi'] ?? 'N/A') ?>
                </div>
                <div class="col-md-6">
                    <strong>Ref. Documento:</strong><br>
                    <?= htmlspecialchars($cab['refdoc']) ?>
                </div>
            </div>
        </div>
    </div>

    <!-- AGREGAR PRODUCTOS -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fa-solid fa-plus-circle"></i> Agregar Producto</h5>
        </div>
        <div class="card-body">
            <form action="home.php?pg=<?= $pg ?>&idsal=<?= $idsal ?>" method="POST" id="formDetalle">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idsal" value="<?= $idsal ?>">
                <input type="hidden" name="idemp" value="<?= $cab['idemp'] ?>">
                
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Producto *</label>
                        <select name="idprod" id="idprod" class="form-select" required>
                            <option value="">Seleccione producto...</option>
                            <?php foreach ($productos as $p): ?>
                                <option value="<?= $p['idprod'] ?>">
                                    <?= htmlspecialchars($p['nomprod']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold">Cantidad *</label>
                        <input type="number" name="cantdet" id="cantdet" class="form-control" 
                               min="1" step="1" required onchange="calcularTotal()">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold">Valor Unit. *</label>
                        <input type="number" name="vundet" id="vundet" class="form-control" 
                               min="0" step="0.01" required onchange="calcularTotal()">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label fw-bold">Total</label>
                        <input type="text" id="total_preview" class="form-control" readonly>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fa-solid fa-plus"></i> Agregar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLA DE PRODUCTOS -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Productos en Salida</h5>
            <?php if (isset($detalles) && count($detalles) > 0): ?>
                <span class="badge bg-info"><?= count($detalles) ?> productos</span>
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
                                    <a href="home.php?pg=<?= $pg ?>&idsal=<?= $idsal ?>&delete=<?= $d['iddet'] ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('¿Está seguro de eliminar este producto?')">
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

    <?php endif; ?>
    
</div>

<!-- ============= MODAL NUEVA SALIDA ============= -->
<div class="modal fade" id="modalSalida" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="home.php?pg=<?= $pg; ?>" method="POST">
                <input type="hidden" name="ope" value="SaVe">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i> Nueva Salida
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Fecha *</label>
                            <input type="datetime-local" name="fecsal" class="form-control"
                                value="<?= date('Y-m-d\TH:i') ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tipo de Salida *</label>
                            <select name="tpsal" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <option value="Venta">Venta</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Consumo">Consumo Interno</option>
                                <option value="Ajuste">Ajuste</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Empresa *</label>
                            <select name="idemp" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <?php foreach ($emp as $e): ?>
                                    <option value="<?= $e['idemp'] ?>">
                                        <?= htmlspecialchars($e['nomemp']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Usuario *</label>
                            <select name="idusu" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <?php foreach ($usu as $u): ?>
                                    <option value="<?= $u['idusu'] ?>">
                                        <?= htmlspecialchars($u['nomusu']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Ubicación/Almacén *</label>
                            <select name="idubi" class="form-select" required>
                                <option value="">Seleccione...</</option>
                                <?php foreach ($ubi as $u): ?>
                                    <option value="<?= $u['idubi'] ?>">
                                        <?= htmlspecialchars($u['nomubi']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Referencia Documento *</label>
                            <input type="text" name="refdoc" class="form-control"
                                placeholder="Ej: FAC-001" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Crear Salida
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cantidadInput = document.getElementById('cantdet');
    const valorInput = document.getElementById('vundet');
    const totalPreview = document.getElementById('total_preview');
    
    function calcularTotal() {
        if (!cantidadInput || !valorInput || !totalPreview) return;
        
        const cantidad = parseFloat(cantidadInput.value) || 0;
        const valor = parseFloat(valorInput.value) || 0;
        const total = cantidad * valor;
        totalPreview.value = total.toFixed(2);
    }
    
    if (cantidadInput) cantidadInput.addEventListener('input', calcularTotal);
    if (valorInput) valorInput.addEventListener('input', calcularTotal);
    
    <?php if (isset($_SESSION['mensaje'])): ?>
        setTimeout(function() {
            const modal = bootstrap.Modal.getInstance(document.getElementById('modalSalida'));
            if (modal) modal.hide();
            
            setTimeout(function() {
                const formDetalle = document.getElementById('formDetalle');
                const urlParams = new URLSearchParams(window.location.search);
                const idsal = urlParams.get('idsal');
                
                if (formDetalle && idsal) {
                    window.location.href = 'home.php?pg=<?= $pg ?>&idsal=' + idsal;
                } else {
                    window.location.href = 'home.php?pg=<?= $pg ?>';
                }
            }, 1500);
        }, 2000);
    <?php endif; ?>
});

// Confirmación antes de eliminar
function confirmarEliminacion(url) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esto eliminará la salida permanentemente.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((res) => {
        if (res.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>
