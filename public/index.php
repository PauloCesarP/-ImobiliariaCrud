<?php
require '../src/autoload.php';
require '../vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;
$baseurl = '/crud/public';

$container = $app->getContainer();
$container['view'] = function ($container) {
    return new \Slim\Views\PhpRenderer('../src/templates');
};
$container['baseurl'] = $baseurl;

$app->get('/', function (Request $request, Response $response, array $args) {
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
        "access_token: a09f3cde-4060-3740-8b3a-5498b1d3fb88",
        "app_token: f9ad4d06-2373-3621-b8c3-e1fed4efea7e",
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

$app->get('/edit/{id}', function (Request $request, Response $response, array $args) {
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
        "access_token: a09f3cde-4060-3740-8b3a-5498b1d3fb88",
        "app_token: f9ad4d06-2373-3621-b8c3-e1fed4efea7e",
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

$app->post('/edit/{id}', function (Request $request, Response $response, array $args) use ($app) {
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
        "access_token: a09f3cde-4060-3740-8b3a-5498b1d3fb88",
        "app_token: f9ad4d06-2373-3621-b8c3-e1fed4efea7e",
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
        return $response->withRedirect($this->baseurl);
    }
});

$app->get('/add', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, 'add_pessoa.php', []);
});

$app->post('/add', function (Request $request, Response $response, array $args) {
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
        "access_token: a09f3cde-4060-3740-8b3a-5498b1d3fb88",
        "app_token: f9ad4d06-2373-3621-b8c3-e1fed4efea7e",
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
        return $response->withRedirect($this->baseurl);
    }
});

$app->get('/add/imovel/{id}', function (Request $request, Response $response, array $args) {
    $route = $request->getAttribute('route');
    $id = $route->getArgument('id');
    
    return $this->view->render($response, 'add_imovel.php', [
        'baseurl' => $this->baseurl,
        'id' => $id
    ]);
});

$app->post('/add/imovel/{id}', function (Request $request, Response $response, array $args) {
    $json = $_POST;

    $json['PROPRIETARIOS_BENEFICIARIOS'] = array(
        array(
            'ID_PESSOA_PES' => $_POST['ID_PESSOA_PES'],
            'FL_PROPRIETARIO_PRB' => 1,
            'NM_FRACAO_PRB' => "100.00"
        )
    );

    // print_r($json['PROPRIETARIOS_BENEFICIARIOS'][0]);
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
    CURLOPT_POSTFIELDS => json_encode($_POST),
    CURLOPT_HTTPHEADER => array(
        "access_token: a09f3cde-4060-3740-8b3a-5498b1d3fb88",
        "app_token: f9ad4d06-2373-3621-b8c3-e1fed4efea7e",
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
        print_r($res);
        exit;
        return $response->withRedirect($baseurl);
    }
});

$app->run();

// $math = new Matematica\Basica();

// echo $math->somar(10, 11);