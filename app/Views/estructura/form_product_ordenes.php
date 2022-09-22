<?php
echo view('estructura/header')
?>

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
    <h2>Nueva orden</h2>
    <!-- <?php
            echo form_open('/ordenes/guarda');
            ?> -->
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <?php
                echo form_label('Nombre de calle', 'street_name');
                echo form_input(array('name' => 'street_name','id' => 'street_name', 'placeholder' => 'Nombre de calle', 'class' => 'form-control'));
                echo "<br>"; ?>
            </div>
            <div class="col-md-4">
                <?php
                echo form_label('CP', 'zip_code');
                echo form_input(array('name' => 'zip_code','id' => 'zip_code', 'placeholder' => 'CP', 'class' => 'form-control'));
                echo "<br>"; ?>
            </div>
            <div class="col-md-4">
                <?php
                echo form_label('Colonia', 'address');
                echo form_input(array('name' => 'address','id' => 'address', 'placeholder' => 'Colonia', 'class' => 'form-control'));
                echo "<br>"; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php
                echo form_label('Teléfono', 'phone');
                echo form_input(array('name' => 'phone','id' => 'phone', 'placeholder' => 'Teléfono', 'class' => 'form-control'));
                echo "<br>"; ?>
            </div>
            <div class="col-md-4">
                <?php
                echo form_label('Estado', 'state');
                echo form_input(array('name' => 'state','id' => 'state', 'placeholder' => 'Estado', 'class' => 'form-control'));
                echo "<br>"; ?>
            </div>
            <div class="col-md-4">
                <?php
                echo form_label('Ciudad', 'city');
                echo form_input(array('name' => 'city','id' => 'city', 'placeholder' => 'Ciudad', 'class' => 'form-control'));
                echo "<br>"; ?>
            </div>
        </div>
        <h6>Añadir productos</h6>
        <div class="row">
            <div class="col-md-7">
                <label for="slc_productos">Productos</label>
                <select class="form-control" id="slc_productos">
                    <option>Seleccione un producto</option>
                    <?php $produc = json_decode($productos);
                    if ($produc->response) : ?>
                        <?php foreach ($produc->response as $key => $value) : ?>
                            <option value="<?php echo $value->id; ?>">
                                <?php echo $value->title; ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control alinearInput" name="txt_cantidad" id="txt_cantidad">
            </div>
            <div class="col-md-2">
                <button onclick="btn_anadir_pro()" class="btn btn-info alinearBoton">Añadir</button>
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
                <tbody name="productos" id="tb_productos">

                </tbody>
            </table>
        </div>
        <!-- <?php echo form_submit('guarda', 'Guardar', 'class="btn btn-primary"');
                ?> -->
        <button onclick="btn_guardar()" class="btn btn-primary">Guardar</button>
    </div>
    <?php
    // echo form_close(); 
    ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>

<script>
    var array = []

    function btn_anadir_pro() {
        var str = ''
        var idproducto = $('#slc_productos').val()
        var cantidad = $('#txt_cantidad').val()
        var producto = $('select[id="slc_productos"] option:selected').text();
        var datos = {
            product_id: idproducto,
            producto: producto,
            qty: cantidad
        }
        array.push(datos)
        for (let i = 0; i < array.length; i++) {
            const element = array[i];
            str += '<tr>' +
                '<td>' + element.producto + '</td>' +
                '<td>' + element.qty + '</td>' +
                '</tr>';
        }
        $('#tb_productos').html(str)
    }

    function btn_guardar() {
        var data = {
            'street_name': $('#street_name').val(),
            'zip_code': $('#zip_code').val(),
            'address': $('#address').val(),
            'phone': $('#phone').val(),
            'state': $('#state').val(),
            'city': $('#city').val(),
            'product_list':array
        }
        console.log(data);
        $.ajax({
            url: "<?php echo base_url("/ordenes/guarda"); ?>",
            type: 'POST',
            data: data,
            success: function() {
                window.location.href="<?php echo base_url(); ?>/ordenes";
            }
        });
    }
</script>