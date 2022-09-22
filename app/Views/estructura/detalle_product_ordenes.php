<?php
echo view('estructura/header');

$orderenes = json_decode($detail);
// var_dump($orderenes->response);
// print_r($orderenes->response->products);
if ($orderenes->response) {

    $street_name = $orderenes->response->address;
    $zip_code = $orderenes->response->zip_code;
    $address = $orderenes->response->address;
    $phone = $orderenes->response->phone;
    $state = $orderenes->response->state;
    $city = $orderenes->response->city;
} else {
    $street_name = "";
    $zip_code = "";
    $address = "";
    $phone = "";
    $state = "";
    $city = "";
}
?>
<style>
    .alinearBoton {
        margin-top: 13%;
    }

    .alinearInput {
        margin-top: 8%;
    }
</style>
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
    <h2>Detalle orden</h2>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <?php
                echo form_label('Nombre de calle', 'street_name');
                echo form_input(array('name' => 'street_name', 'id' => 'street_name', 'placeholder' => 'Nombre de calle', 'class' => 'form-control', 'value' => $street_name, 'disabled' => true));
                echo "<br>"; ?>
            </div>
            <div class="col-md-4">
                <?php
                echo form_label('CP', 'zip_code');
                echo form_input(array('name' => 'zip_code', 'id' => 'zip_code', 'placeholder' => 'CP', 'class' => 'form-control', 'value' => $zip_code, 'disabled' => true));
                echo "<br>"; ?>
            </div>
            <div class="col-md-4">
                <?php
                echo form_label('Colonia', 'address');
                echo form_input(array('name' => 'address', 'id' => 'address', 'placeholder' => 'Colonia', 'class' => 'form-control', 'value' => $address, 'disabled' => true));
                echo "<br>"; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php
                echo form_label('Teléfono', 'phone');
                echo form_input(array('name' => 'phone', 'id' => 'phone', 'placeholder' => 'Teléfono', 'class' => 'form-control', 'value' => $phone, 'disabled' => true));
                echo "<br>"; ?>
            </div>
            <div class="col-md-4">
                <?php
                echo form_label('Estado', 'state');
                echo form_input(array('name' => 'state', 'id' => 'state', 'placeholder' => 'Estado', 'class' => 'form-control', 'value' => $state, 'disabled' => true));
                echo "<br>"; ?>
            </div>
            <div class="col-md-4">
                <?php
                echo form_label('Ciudad', 'city');
                echo form_input(array('name' => 'city', 'id' => 'city', 'placeholder' => 'Ciudad', 'class' => 'form-control', 'value' => $city, 'disabled' => true));
                echo "<br>"; ?>
            </div>
        </div>
        <br>
        <div>
            <h6>Productos</h6>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    if ($orderenes->response->products) : ?>
                        <?php foreach ($orderenes->response->products as $key => $value) : ?>
                            <tr>
                            <td>
                                <?php echo $value->title; ?>
                            </td>
                                <td>
                                    <?php echo $value->qty; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>