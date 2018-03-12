<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Search</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
    html,
    body {
    height: 100%;
    }

    body {
    display: -ms-flexbox;
    display: -webkit-box;
    display: flex;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
    margin: 10px;
    }
    .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    }
    .form-signin .checkbox {
    font-weight: 400;
    }
    .form-signin .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
    }
    .form-signin .form-control:focus {
    z-index: 2;
    }
    .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    }
    </style>
  </head>

  <body >

    <form>
      <div class="form-row" style="margin-bottom: 15px;">
        <div class="col-12" style="margin-bottom: 10px;">
          <button class="btn btn-sm btn-danger " style="float: right;">Cerrar sesión</button>
        </div>
        <div class="col-12">
          <h4 class="">Bienvenido, <label id="usuario"></label></h4>
        </div>
      </div>
      <div class="form-row" style="margin-bottom: 35px;">
        <div class="col-8">
          <input type="text" class="form-control" placeholder="Código" id="code">
        </div>
        <div class="col-4">
          <button id="buscar" class="btn btn-md btn-primary btn-block">Buscar</button>
        </div>
      </div>
        <fieldset disabled>
          <div class="form-group">
            <label for="status">Estado</label>
            <input type="text" id="status" class="form-control" placeholder="">
          </div>
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" class="form-control" placeholder="">
          </div>
          <div class="form-group">
            <label for="trade_name">Nombre Comercial</label>
            <input type="text" id="trade_name" class="form-control" placeholder="">
          </div>
          <div class="form-group">
            <label for="business_name">Razon Social</label>
            <input type="text" id="business_name" class="form-control" placeholder="">
          </div>
          <div class="form-group">
            <label for="address">Dirección</label>
            <input type="text" id="address" class="form-control" placeholder="">
          </div>
          <div class="form-group">
            <label for="nit">NIT</label>
            <input type="text" id="nit" class="form-control" placeholder="">
          </div>
          <div class="form-group">
            <label for="phone">Teléfono</label>
            <input type="text" id="phone" class="form-control" placeholder="">
          </div>

        </fieldset>
    </form>
  
  <script>
  jQuery('#usuario').text(localStorage.nombre);
  jQuery('#buscar').on('click', function(e){
    e.preventDefault();
    // window.location.href = 'search';

    jQuery.ajax({
        url: 'api/customer/search',
        data: { code: jQuery('#code').val() },
        type: 'GET',
        success: function(data) {
            if(data.result){
              jQuery('#name').val(data.records.name);
              jQuery('#trade_name').val(data.records.trade_name);
              jQuery('#business_name').val(data.records.business_name);
              jQuery('#address').val(data.records.address);
              jQuery('#nit').val(data.records.nit);
              jQuery('#phone').val(data.records.phone);
              jQuery('#status').val(data.records.status);
            }
            else {
                alert(data.message);
            }
        },
        error: function(data) {

        }
    });
})
  </script>
  </body>
</html>