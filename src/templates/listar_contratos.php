<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRUD - Listar Contratos</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/crud/public/style.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="<?php echo $baseurl; ?>">Crud</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $baseurl; ?>/pessoas">Pessoas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $baseurl; ?>/imoveis">Imóveis</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo $baseurl; ?>/contratos">Contratos <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <h1>Listagem de Contratos</h1>

    <div class="btn_container_add">
      <a href="<?php echo $baseurl; ?>/contratos/add" type="button" class="btn btn-primary">Adicionar</a>
    </div>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Imóvel</th>
          <th scope="col">Inquilinos</th>
          <th scope="col">Proprietarios</th>
          <th scope="col">Valor Aluguel</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>

      <!-- <?php print_r($lista[0]); ?> -->

      <?php foreach($lista as $item) { ?>
        <tr>
          <th scope="row"><?php echo $item['id_contrato_con']; ?></th>
          <td>
            <a href="<?php echo $baseurl; ?>/imovel/edit/<?php echo $item['id_imovel_imo']; ?>" type="button" class="btn btn-primary">Ver dados no imóvel</a>
          </td>
          <td>
            <?php foreach($item['inquilinos'] as $itemInquilino) { ?>
              <a href="<?php echo $baseurl; ?>/locatarios/edit/<?php echo $itemInquilino['id_pessoa_pes']; ?>" type="button" class="btn btn-primary"><?php echo $itemInquilino['st_nomeinquilino']; ?></a>
            <?php } ?>
          </td>
          <td>
            <?php foreach($item['proprietarios_beneficiarios'] as $itemProp) { ?>
              <a href="<?php echo $baseurl; ?>/pessoas/edit/<?php echo $itemProp['id_pessoa_pes']; ?>" type="button" class="btn btn-primary"><?php echo $itemProp['st_nome_pes']; ?></a>
            <?php } ?>
          </td>
          <td><?php echo $item['vl_aluguel_con']; ?></td>
          <td>
            <!-- <a href="<?php echo $baseurl; ?>/contrato/edit/<?php echo $item['id_contrato_con']; ?>" type="button" class="btn btn-warning">Editar</a> -->
          </td>
        </tr>
      <?php } ?>

      </tbody>
    </table>

    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <?php if($pagina > 1){ ?>
          <li class="page-item"><a class="page-link" href="<?php echo $baseurl; ?>/contratos?pagina=<?php echo $pagina-1 ?>">Previous</a></li>
        <?php } ?>
        <li class="page-item"><a class="page-link" href="<?php echo $baseurl; ?>/contratos?pagina=<?php echo $pagina+1 ?>">Next</a></li>
      </ul>
    </nav>
  </div>
    
  </body>
</html>