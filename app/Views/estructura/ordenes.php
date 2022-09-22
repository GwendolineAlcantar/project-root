<?php
echo view('estructura/header')
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo base_url(); ?>/home">Tienda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo base_url(); ?>/home">Inicio <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>/productos">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>/ordenes">Ordenes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url(); ?>/historial">Historial</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>Ordenes</h2>
        <form name="form" action="<?php echo base_url(); ?>/ordenes/filtrarFechas" method="post">
            <div class="row">
                <div class="col-md-5">
                    <p>Fecha inicio: <input type="date" class="form-control" id="inicio" name="inicio">
                </div>
                <!-- <div class="col-md-5">
                    Fecha final: <input class="form-control" type="date" id="final" name="final"></p>
                </div> -->
                <div class="col-md-2 alinearBotonBus">
                    <?php echo form_submit('filtrarFechas', 'Buscar', 'class="btn btn-primary"');
                    ?>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-6">
                <a href="<?php echo base_url(); ?>/ordenes/formulario" class="btn btn-success" role="button"><i class="fa fa-user-plus"></i> Nuevo</a>
            </div>
            <div class="col-md-6">
                    <a href="<?php echo base_url(); ?>/ordenes/bar_chart" class="btn btn-warning" ><i class="fa fa-chart-simple"></i> Graficar</a>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">CP</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Total</th>
                    <th scope="col">Fecha</th>
                    <!-- <th scope="col">Fecha actualización</th> -->
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (gettype($orders) == 'string') {
                    $ordenes = json_decode($orders);
                    if ($ordenes->response) { ?>
                        <?php foreach ($ordenes->response as $key => $value) { ?>
                            <tr>
                                <td>
                                    <?php echo $value->id; ?>
                                </td>
                                <td>
                                    <?php echo $value->user_id; ?>
                                </td>
                                <td>
                                    <?php echo $value->phone; ?>
                                </td>
                                <td>
                                    <?php echo $value->address; ?>
                                </td>
                                <td>
                                    <?php echo $value->city; ?>
                                </td>
                                <td>
                                    <?php echo $value->state; ?>
                                </td>
                                <td>
                                    <?php echo $value->zip_code; ?>
                                </td>
                                <td>
                                    <?php echo $value->subtotal; ?>
                                </td>
                                <td>
                                    <?php echo $value->total; ?>
                                </td>
                                <!-- <td>
                                    <?php echo $value->create_date; ?>
                                </td> -->
                                <td>
                                    <?php echo $value->last_update; ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url(); ?>/ordenes/detalle?order_id=<?php echo $value->id; ?>" class="btn btn-info" role="button"><i class='fas fa-eye'></i></a>
                                </td>
                            </tr>
                        <?php }
                    }
                } else {
                    $ordenes = $orders;
                    foreach ($ordenes as $key => $value) : ?>
                        <tr>
                            <td>
                                <?php echo $value->id; ?>
                            </td>
                            <td>
                                <?php echo $value->user_id; ?>
                            </td>
                            <td>
                                <?php echo $value->phone; ?>
                            </td>
                            <td>
                                <?php echo $value->address; ?>
                            </td>
                            <td>
                                <?php echo $value->city; ?>
                            </td>
                            <td>
                                <?php echo $value->state; ?>
                            </td>
                            <td>
                                <?php echo $value->zip_code; ?>
                            </td>
                            <td>
                                <?php echo $value->subtotal; ?>
                            </td>
                            <td>
                                <?php echo $value->total; ?>
                            </td>
                            <td>
                                <?php echo $value->create_date; ?>
                            </td>
                            <td>
                                <?php echo $value->last_update; ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url(); ?>/ordenes/detalle?order_id=<?php echo $value->id; ?>" class="btn btn-info" role="button"><i class='fas fa-eye'></i></a>
                            </td>
                        </tr>
                <?php endforeach;
                } ?>

            </tbody>
        </table>
    </div>
</body>

</html>