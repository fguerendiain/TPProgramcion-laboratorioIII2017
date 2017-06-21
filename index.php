<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once './vendor/autoload.php';
    require_once './resources/PlaceResource.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);

    //CONFIGURACION DE CORS PARA LA API
    $app->add(function($request, $response, $next){
        $response = $next($request, $response);
        return $response
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type. Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Content-Type','application/json; charset=utf-8');
    });

    $app->group('/place', function () {
        $this->get('',           \PlaceResource::class . ':find');
        $this->post('',          \PlaceResource::class . ':create');
        $this->get('/{id}',      \PlaceResource::class . ':get');
        $this->put('/{id}',      \PlaceResource::class . ':update');
        $this->delete('/{id}',   \PlaceResource::class . ':delete');
    });

    $app->group('/vehicle', function(){
        $this->get('',           \VehicleResource::class . ':find');
        $this->get('/{id}',      \VehicleResource::class . ':get');
    });

    $app->group('/parking', function(){
        $this->get('',           \PlaceResource::class . ':find');
        $this->post('',          \PlaceResource::class . ':create');
        $this->get('/{id}',      \PlaceResource::class . ':get');
        $this->put('/{id}',      \PlaceResource::class . ':update');
    });

    $app->group('/user', function(){
        $this->get('/{id}',      \UserResource::class . ':get');
        $this->get('',           \UserResource::class . ':find');
        $this->put('/{id}',      \UserResource::class . ':update');
        $this->delete('/{id}',   \UserResource::class . ':delete');
    });

    $app->group('/session', function(){
        $this->post('',          \SessionResource::class . ':create');
    });

    /*->add(Midelware)*/

    $app->run();
?>