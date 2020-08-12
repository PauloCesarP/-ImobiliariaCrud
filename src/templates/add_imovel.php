<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>CRUD - Adicionar Imóvel</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="/crud/public/style.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </head>
  <body>

  <div class="container">
    <h1>Adicionar Imóvel</h1>

    <form class="needs-validation" novalidate method="POST">

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="tipo_imovel">Tipo de Imóvel</label>
          <select class="custom-select" id="tipo_imovel" name="ST_TIPO_IMO" required>
            <option selected disabled value="">Choose...</option>
            <option value="1">Casa</option>
            <option value="2">Casa em Condimínio</option>
            <option value="3">Casa comercial</option>
            <option value="4">Apartamento</option>
            <option value="5">Cobertura</option>
            <option value="6">Flat</option>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label for="cep">CEP</label>
          <input type="text" class="form-control" id="cep" value="" name="ST_CEP_IMO" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="endereco">Endereço</label>
          <input type="text" class="form-control" id="endereco" value="" name="ST_ENDERECO_IMO" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="numero">Numero</label>
          <input type="text" class="form-control" id="numero" value="" name="ST_NUMERO_IMO" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="complemento">Complemento</label>
          <input type="text" class="form-control" id="complemento" value="" name="ST_COMPLEMENTO_IMO" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="bairoo">Bairro</label>
          <input type="text" class="form-control" id="bairoo" value="" name="ST_BAIRRO_IMO" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="cidade">Cidade</label>
          <input type="text" class="form-control" id="cidade" value="" name="ST_CIDADE_IMO" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="estado">Estado</label>
          <input type="text" class="form-control" id="estado" value="" name="ST_ESTADO_IMO" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-6 mb-3">
          <label for="id_dono">ID do dono do imóvel</label>
          <input type="text" class="form-control" id="id_dono" value="<?php echo $id; ?>" name="ID_PESSOA_PES" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="valor_alugel">Valor do Aluguel</label>
          <input type="text" class="form-control" id="valor_alugel" value="" name="VL_ALUGUEL_IMO" required>
        </div>
      </div>

      <div class="form-row">
        <div class="col-md-4 mb-2">
          <label for="id_dono">Valor de venda</label>
          <input type="text" class="form-control" id="id_dono" value="" name="VL_VENDA_IMO" required>
        </div>
        <div class="col-md-4 mb-2">
          <label for="valor_alugel">Taxa de administração mensal (%)</label>
          <input type="text" class="form-control" id="valor_alugel" value="" name="TX_ADM_IMO" required>
        </div>
        <div class="col-md-4 mb-2">
          <label for="taxa_adm_fixa">Taxa de administração fixa ?</label>
          <select class="custom-select" id="taxa_adm_fixa" name="FL_TXADMVALORFIXO_IMO" required>
            <option selected disabled value="">Choose...</option>
            <option value="0">Não</option>
            <option value="1">SIM</option>
          </select>
        </div>
      </div>

      <button class="btn btn-primary" type="submit">Adicionar</button>
    </form>

    <!-- <?php print_r($dados); ?> -->
    
  </div>
    
  </body>
</html>