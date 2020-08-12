<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRUD - Listar Pessoas</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/crud/public/style.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>
  <body>

  <div class="container">
    <h1>Listagem de Pessoas</h1>

    <a href="<?php echo $baseurl; ?>/add" type="button" class="btn btn-primary">Adicionar</a>

    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Telefone</th>
          <th scope="col">Celular</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>

      <?php foreach($lista as $item) { ?>
        <tr>
          <th scope="row"><?php echo $item['id_pessoa_pes']; ?></th>
          <td><?php echo $item['st_nome_pes']; ?></td>
          <td><?php echo $item['st_telefone_pes']; ?></td>
          <td><?php echo $item['st_celular_pes']; ?></td>
          <td>
            <a href="<?php echo $baseurl; ?>/edit/<?php echo $item['id_pessoa_pes']; ?>" type="button" class="btn btn-warning">Editar</a>
          </td>
        </tr>
      <?php } ?>

      </tbody>
    </table>

    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <?php if($pagina > 1){ ?>
          <li class="page-item"><a class="page-link" href="/crud/public?pagina=<?php echo $pagina-1 ?>">Previous</a></li>
        <?php } ?>
        <li class="page-item"><a class="page-link" href="/crud/public?pagina=<?php echo $pagina+1 ?>">Next</a></li>
      </ul>
    </nav>
  </div>
    
  </body>
</html>