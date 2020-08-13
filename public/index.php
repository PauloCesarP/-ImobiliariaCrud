<?php
require '../src/autoload.php';
require '../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
$baseurl = '/crud/public';
$access_token = 'a09f3cde-4060-3740-8b3a-5498b1d3fb88';
$app_token = 'f9ad4d06-2373-3621-b8c3-e1fed4efea7e';


$container = $app->getContainer();
$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('../src/templates');
};
$container['baseurl'] = $baseurl;

$app->get('/', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'home.php', [
        'baseurl' => $this->baseurl
    ]);
});

$app->get('/pessoas', function (Request $request, Response $response, array $args) {
    if(isset($_GET["pagina"]) && !empty($_GET["pagina"])){
        $pagina = htmlspecialchars($_GET["pagina"]);
    } else {
        $pagina = 1;
    }
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "http://apps.superlogica.net/imobiliaria/api/proprietarios?pagina=".$pagina,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => array(
        "access_token: ".$access_token,
        "app_token: ".$app_token,
        "content-type: application/json"
    ),
    ));

    $res = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        print_r($err);
        exit;
    } else {
        $data = json_decode($res, true);
        $data = $data['data'];

        return $this->view->render($response, 'listar_pessoas.php', [
            'lista' => $data,
            'pagina' => $pagina,
            'baseurl' => $this->baseurl
        ]);
    }
});

$app->get('/pessoas/edit/{id}', function (Request $request, Response $response, array $args) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $json = array(
        'id' => $id
    );

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "http://apps.superlogica.net/imobiliaria/api/proprietarios",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => json_encode($json),
    CURLOPT_HTTPHEADER => array(
        "access_token: ".$access_token,
        "app_token: ".$app_token,
        "content-type: application/json"
    ),
    ));

    $res = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        print_r($err);
        exit;
    } else {
        $data = json_decode($res, true);
        $data = $data['data'];

        if(count($data) === 0){
            echo 'ID inválido';
            exit;
        }

        return $this->view->render($response, 'update_pessoa.php', [
            'dados' => $data,
            'baseurl' => $this->baseurl
        ]);
    }
});

$app->post('/pessoas/edit/{id}', function (Request $request, Response $response, array $args) use ($app) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');

    $json = array(
        'ID_PESSOA_PES' => $id,
        'ST_NOME_PES' => $_POST['st_nome_pes']
    );

    $json = array_merge($json, $_POST);

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "http://apps.superlogica.net/imobiliaria/api/proprietarios",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "PUT",
    CURLOPT_POSTFIELDS => json_encode($json),
    CURLOPT_HTTPHEADER => array(
        "access_token: ".$access_token,
        "app_token: ".$app_token,
        "content-type: application/json"
    ),
    ));

    $res = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        print_r($err);
        exit;
    } else {
        // return $response->withRedirect('/crud/public/edit/'.$id);
        return $response->withRedirect($this->baseurl.'/pessoas');
    }
});

$app->get('/pessoas/add', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'add_pessoa.php', []);
});

$app->post('/pessoas/add', function (Request $request, Response $response, array $args) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "http://apps.superlogica.net/imobiliaria/api/proprietarios",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($_POST),
    CURLOPT_HTTPHEADER => array(
        "access_token: ".$access_token,
        "app_token: ".$app_token,
        "content-type: application/json"
    ),
    ));

    $res = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        print_r($err);
        exit;
    } else {
        $decoded = json_decode($res);
        $message =  $decoded->msg;
        $idPessoa = $decoded->data[0]->data->id_pessoa_pes;

        return $this->view->render($response, 'pessoa_add_success.php', [
            'baseurl' => $this->baseurl,
            'id_pessoa' => $idPessoa,
            'message' => $message
        ]);
    }
});

$app->get('/imoveis', function (Request $request, Response $response, array $args) {
    if(isset($_GET["pagina"]) && !empty($_GET["pagina"])){
        $pagina = htmlspecialchars($_GET["pagina"]);
    } else {
        $pagina = 1;
    }
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "http://apps.superlogica.net/imobiliaria/api/imoveis?pagina=".$pagina,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => array(
        "access_token: ".$access_token,
        "app_token: ".$app_token,
        "content-type: application/json"
    ),
    ));

    $res = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        print_r($err);
        exit;
    } else {
        $data = json_decode($res, true);
        $data = $data['data'];

        return $this->view->render($response, 'listar_imoveis.php', [
            'lista' => $data,
            'pagina' => $pagina,
            'baseurl' => $this->baseurl
        ]);
    }
});

$app->get('/imoveis/add/{id}', function (Request $request, Response $response, array $args) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');
    
    return $this->view->render($response, 'add_imovel.php', [
        'baseurl' => $this->baseurl,
        'id' => $id
    ]);
});

$app->post('/imoveis/add/{id}', function (Request $request, Response $response, array $args) {
    $json = $_POST;

    $proprietario['ID_PESSOA_PES'] = intval($_POST['ID_PESSOA_PES']);
    $proprietario['FL_PROPRIETARIO_PRB'] = 1;
    $proprietario['NM_FRACAO_PRB'] = "100.00";

    $json['PROPRIETARIOS_BENEFICIARIOS'] = array(
        $proprietario
    );

    // print_r(json_encode($json));
    // exit;
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "http://apps.superlogica.net/imobiliaria/api/imoveis",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($json),
    CURLOPT_HTTPHEADER => array(
        "access_token: ".$access_token,
        "app_token: ".$app_token,
        "content-type: application/json"
    ),
    ));

    $res = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        print_r($err);
        exit;
    } else {
        $decoded = json_decode($res);
        $message =  $decoded->msg;
        $idImovel = $decoded->data[0]->data->id_imovel_imo;

        return $this->view->render($response, 'imovel_add_success.php', [
            'baseurl' => $this->baseurl,
            'id_imovel' => $idImovel,
            'message' => $message
        ]);
    }
});

$app->get('/imovel/{id}', function (Request $request, Response $response, array $args) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');
    
    return $this->view->render($response, 'add_imovel.php', [
        'baseurl' => $this->baseurl,
        'id' => $id
    ]);
});

$app->get('/contratos', function (Request $request, Response $response, array $args) {
    if(isset($_GET["pagina"]) && !empty($_GET["pagina"])){
        $pagina = htmlspecialchars($_GET["pagina"]);
    } else {
        $pagina = 1;
    }
    
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "http://apps.superlogica.net/imobiliaria/api/contratos?pagina=".$pagina,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_POSTFIELDS => "",
    CURLOPT_HTTPHEADER => array(
        "access_token: ".$access_token,
        "app_token: ".$app_token,
        "content-type: application/json"
    ),
    ));

    $res = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        print_r($err);
        exit;
    } else {
        $data = json_decode($res, true);
        $data = $data['data'];

        return $this->view->render($response, 'listar_contratos.php', [
            'lista' => $data,
            'pagina' => $pagina,
            'baseurl' => $this->baseurl
        ]);
    }
});

$app->get('/contratos/add', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'add_contrato.php', []);
});

$app->run();