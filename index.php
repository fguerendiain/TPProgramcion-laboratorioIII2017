<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once './vendor/autoload.php';
    require_once './resources/PlaceResource.php';
    require_once './resources/VehicleResource.php';
    require_once './resources/UserResource.php';
    require_once './resources/SessionResource.php';
    require_once './resources/ParkingResource.php';

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

    $app->group('/place', function () { //ok
        $this->get('',           \PlaceResource::class . ':find'); //?includeinactive=false (Traer Todas las cocheras incluyendo inactivas)
        $this->post('',          \PlaceResource::class . ':create');
        $this->get('/{id}',      \PlaceResource::class . ':get');
        $this->put('/{id}',      \PlaceResource::class . ':update');
        $this->delete('/{id}',   \PlaceResource::class . ':delete');
    })/*->add(Midelware)*/;

    $app->group('/vehicle', function(){ //ok
        $this->get('',           \VehicleResource::class . ':find');
        $this->get('/{id}',      \VehicleResource::class . ':get');
    })/*->add(Midelware)*/;

    $app->group('/parking', function(){
        $this->get('',           \ParkingResource::class . ':find');
        $this->post('',          \ParkingResource::class . ':create');
        $this->get('/{id}',      \ParkingResource::class . ':get');
        $this->put('/{id}',      \ParkingResource::class . ':update'); //?changedata=true (Editar Vehiculo y Cochera)
    })/*->add(Midelware)*/;

    $app->group('/user', function(){ //ok
        $this->get('/{id}',      \UserResource::class . ':get');
        $this->get('',           \UserResource::class . ':find'); //?includeinactive=false (Traer Todos los usuarios incluyendo inactivos)
        $this->put('/{id}',      \UserResource::class . ':update');
        $this->delete('/{id}',   \UserResource::class . ':delete');
        $this->post('',          \UserResource::class . ':create');
    })/*->add(Midelware)*/;

    $app->group('/session', function(){ //ok
        $this->post('',          \SessionResource::class . ':create');
    })/*->add(Midelware)*/;

    $app->run();
?>