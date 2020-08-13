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
    <h1>Alterar Pessoa ID: <?php echo $dados[0]['id_pessoa_pes']; ?></h1>

    <form class="needs-validation" novalidate method="POST">

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="nome">Nome</label>
          <input type="text" class="form-control" id="nome" value="<?php echo $dados[0]['st_nome_pes']; ?>" name="ST_NOME_PES" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="nome_fantasia">Nome Fantasia</label>
          <input type="text" class="form-control" id="nome_fantasia" value="<?php echo $dados[0]['st_fantasia_pes']; ?>" name="ST_FANTASIA_PES" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="telefone">Telefone</label>
          <input type="text" class="form-control" id="telefone" value="<?php echo $dados[0]['st_telefone_pes']; ?>" name="ST_TELEFONE_PES" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="celular">Celular</label>
          <input type="text" class="form-control" id="celular" value="<?php echo $dados[0]['st_celular_pes']; ?>" name="ST_CELULAR_PES" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="cnpj_cpf">CNPJ CPF</label>
          <input type="text" class="form-control" id="cnpj_cpf" value="<?php echo $dados[0]['st_cnpj_pes']; ?>" name="ST_CNPJ_PES" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="rg">RG</label>
          <input type="text" class="form-control" id="rg" value="<?php echo $dados[0]['st_rg_pes']; ?>" name="ST_RG_PES" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="orgao">Orgão Emissor</label>
          <input type="text" class="form-control" id="orgao" value="<?php echo $dados[0]['st_orgao_pes']; ?>" name="ST_ORGAO_PES" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="sexo">Sexo</label>
          <select class="custom-select" id="st_sexo_pes" name="ST_SEXO_PES" required>
            <!-- <option selected disabled value="">Choose...</option> -->
            <option value="2" <?php echo  $dados[0]['st_sexo_pes'] === '2' ? 'selected' : ''; ?>>Feminino</option>
            <option value="1" <?php echo  $dados[0]['st_sexo_pes'] === '1' ? 'selected' : ''; ?>>Masculino</option>
          </select>
        </div>
      </div>

      <button class="btn btn-primary" type="submit">Alterar</button>
      <a href="<?php echo $baseurl;?>/imoveis/add/<?php echo $dados[0]['id_pessoa_pes'];?>" class="btn btn-primary" type="submit">Adicionar Imóvel</a>
    </form>

    <!-- <?php print_r($dados); ?> -->
    
  </div>
    
  </body>
</html>