<?php
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    
    require_once './vendor/autoload.php';
    require_once './resources/PlaceResource.php';
    require_once './resources/VehicleResource.php';
    require_once './resources/ParkingResource.php';
    require_once './resources/UserResource.php';
    require_once './resources/SessionResource.php';
    require_once './resources/ReportResource.php';
    require_once './midelware/RequestValidator.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);

    //CONFIGURACION DE CORS HEADERS PARA LA API
    $app->add(function($request, $response, $next){
        $response = $next($request, $response);
        return $response
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type. Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS')
                ->withHeader('Content-Type','application/json; charset=utf-8');
    });

    $app->group('/place', function () {
        $this->get('',                     \PlaceResource::class . ':find'); //?includeinactive=false (Traer Todas las cocheras incluyendo inactivas)
        $this->post('',                    \PlaceResource::class . ':create')
                ->add(\RequestValidator::class . ':ValidateUserPermissions')
                ->add(\RequestValidator::class . ':PlaceRequestValues');
        $this->get('/{id}',                \PlaceResource::class . ':get');
        $this->put('/{id}',                \PlaceResource::class . ':update')
                ->add(\RequestValidator::class . ':ValidateUserPermissions')
                ->add(\RequestValidator::class . ':PlaceRequestValues');
        $this->delete('/{id}',             \PlaceResource::class . ':delete')
                ->add(\RequestValidator::class . ':ValidateUserPermissions');
    })
    ->add(\RequestValidator::class . ':SessionTokenRequestValue');


    $app->group('/vehicle', function(){
        $this->get('',                      \VehicleResource::class . ':find');
        $this->get('/{id}',                 \VehicleResource::class . ':get');
    })
    ->add(\RequestValidator::class . ':SessionTokenRequestValue');


    $app->group('/parking', function(){
        $this->get('',                      \ParkingResource::class . ':find');
        $this->post('',                     \ParkingResource::class . ':create')
                ->add(\RequestValidator::class . ':ParkingRequestValues');
        $this->get('/{id}',                 \ParkingResource::class . ':get');
        $this->put('/{id}',                 \ParkingResource::class . ':update') //?changedata=true (Editar Vehiculo y Cochera)
                ->add(\RequestValidator::class . ':ParkingRequestValues'); 
    })
    ->add(\RequestValidator::class . ':SessionTokenRequestValue');


    $app->group('/user', function(){
        $this->get('/{id}',                 \UserResource::class . ':get');
        $this->get('',                      \UserResource::class . ':find'); //?includeinactive=false (Traer Todos los usuarios incluyendo inactivos)
        $this->put('/{id}',                 \UserResource::class . ':update')
                ->add(\RequestValidator::class . ':ValidateUserPermissions')
                ->add(\RequestValidator::class . ':SessionUserRequestValues');
        $this->delete('/{id}',              \UserResource::class . ':delete')
                ->add(\RequestValidator::class . ':ValidateUserPermissions');
        $this->post('',                     \UserResource::class . ':create')
                ->add(\RequestValidator::class . ':ValidateUserPermissions')
                ->add(\RequestValidator::class . ':SessionUserRequestValues');
    })
    ->add(\RequestValidator::class . ':SessionTokenRequestValue');


    $app->group('/session', function(){
        $this->post('',                    \SessionResource::class . ':create')
                ->add(\RequestValidator::class . ':SessionUserRequestValues');
    });

    $app->group('/report', function(){
        $this->get('/userlogin/{id}',       \ReportResource::class . ':reportUserLogin'); //días y horarios que se logearon
        $this->get('/useroperations/{id}',  \ReportResource::class . ':reportUserOperations'); //Cantidad de operaciones por cada uno
        $this->get('/placeuse',             \ReportResource::class . ':reportPlaceUse'); //La más y menos y las que nunca se utilizaron
        $this->get('/parked',               \ReportResource::class . ':reportParked'); //vehiculos en playa
    })
    ->add(\RequestValidator::class . ':SessionTokenRequestValue')
    ->add(\RequestValidator::class . ':ValidateUserPermissions');


    $app->run();
?>