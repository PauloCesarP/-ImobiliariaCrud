<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="owidth=device-width, initial-scale=1.0" />
    <title>CRUD - Adicionar Contrato</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/crud/public/style.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>
  <body>

  <div class="container">
    <h1>Adicionar Contrato</h1>

    <form class="needs-validation" novalidate method="POST">

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="endereco">ID do Imóvel</label>
          <input type="text" class="form-control" id="endereco" value="" name="ID_IMOVEL_IMO" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="numero">Tipo de Contrato</label>
          <input type="text" class="form-control" id="numero" value="" name="ID_TIPO_CON" required>
        </div>
      </div>

      <button class="btn btn-primary" type="submit">Adicionar</button>
    </form>

    <!-- <?php print_r($dados); ?> -->
    
  </div>
    
  </body>
</html>