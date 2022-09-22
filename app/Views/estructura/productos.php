<?= $cabecera ?>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand">Tienda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php

                                                use PHPUnit\Util\Type;

                                                echo base_url(); ?>/home">Inicio <span class="sr-only"></span></a>
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
        <h2>Productos</h2>
        <form name="form" action="<?php echo base_url(); ?>/productos/filtrarFechas" method="post">
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio venta</th>
                    <th scope="col">Descuento</th>
                    <th scope="col">Precio</th>
                    <!-- <th scope="col">Estatus</th> -->
                    <th scope="col">Fecha</th>
                    <!-- <th scope="col">Fecha actualización</th> -->
                </tr>
            </thead>
            <tbody>
                <?php if (gettype($productos) == 'string') {
                    $produc = json_decode($productos);
                    if ($produc->response) { ?>
                        <?php foreach ($produc->response as $key => $value) : ?>
                            <tr>
                                <td>
                                    <?php echo $value->id; ?>
                                </td>
                                <td>
                                    <?php echo $value->category; ?>
                                </td>
                                <td>
                                    <?php echo $value->title; ?>
                                </td>
                                <td>
                                    <?php echo $value->short_description; ?>
                                </td>
                                <td>
                                    <?php echo $value->sale_count; ?>
                                </td>
                                <td>
                                    <?php echo $value->discount; ?>
                                </td>
                                <td>
                                    <?php echo $value->price; ?>
                                </td>
                                <!-- <td>
                                    <?php echo $value->create_date; ?>
                                </td> -->
                                <td>
                                    <?php echo $value->last_update; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php }
                } else {
                    $produc = $productos;
                    if ($produc) { ?>
                        <?php foreach ($produc as $key => $value) : ?>
                            <tr>
                                <td>
                                    <?php echo $value->id; ?>
                                </td>
                                <td>
                                    <?php echo $value->category; ?>
                                </td>
                                <td>
                                    <?php echo $value->title; ?>
                                </td>
                                <td>
                                    <?php echo $value->short_description; ?>
                                </td>
                                <td>
                                    <?php echo $value->sale_count; ?>
                                </td>
                                <td>
                                    <?php echo $value->discount; ?>
                                </td>
                                <td>
                                    <?php echo $value->price; ?>
                                </td>
                                <td>
                                    <?php echo $value->last_update; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                <?php }
                };
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>