<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require_once("vendor/autoload.php");
 
 

$app =new \Slim\App(['settings' => [
         
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'db' => [
            /*'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'slime',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',*/

            // Eloquent configuration
            'driver' => 'pgsql',
            'host' => '41.93.38.76',
            'port' => '5432',
            'database' => 'costech_rmp_db',
            'username' => 'postgres',
            'password' => 'laamu',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
    
        ]
    ]]);

   $container=$app->getContainer();
  
   
    
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    $container['db']=function ($container) use ($capsule){
        return $capsule;
    };

 

    $container['Home']=function($container){
        return new \App\Controllers\Home($container);
    };

     
    $app->get("/display","Home:getFunder");
     
     
    $app->run();
?>