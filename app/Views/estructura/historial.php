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
        <h2>Historial</h2>
        <form name="form" action="<?php echo base_url(); ?>/historial/filtrarFechas" method="post">
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

            <div class="col-md-12">
                <a href="<?php echo base_url(); ?>/historial/bar_chart" class="btn btn-warning"><i class="fa fa-chart-simple"></i> Graficar</a>
            </div>
        </div>
<br>
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
                </tr>
            </thead>
            <tbody>
                <?php if (gettype($list_record) == 'string') {
                    $orderenes = json_decode($list_record);
                    if ($orderenes->response) { ?>
                        <?php foreach ($orderenes->response as $key => $value) { ?>
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
                                    <?php echo $value->last_update; ?>
                                </td>
                            </tr>
                        <?php }
                    }
                } else {
                    $orderenes = $list_record;
                    foreach ($orderenes as $key => $value) : ?>
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
                                <?php echo $value->last_update; ?>
                            </td>
                        </tr>
                <?php endforeach;
                } ?>
            </tbody>
        </table>
    </div>
</body>

</html>