<?php

namespace App\Http\Controllers;

use App\Models\Person;
use DI\Container;
use Slim\Routing\RouteContext;
use Slim\Views\PhpRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Throwable;

class HomeController
{
    protected PhpRenderer $view;

    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
    }

    /**
     * @throws Throwable
     */
    public function index(Request $request, Response $response)
    {
        $models = Person::all();
        return $this->view->render($response, 'index.php',['name'=>'John Doe','models'=>$models]);
    }

    /**
     * @throws Throwable
     */
    public function details(Request $request, Response $response, $name){
        return $this->view->render($response,'details.php',['name'=>$name]);
    }

    public function create(Request $request, Response $response){
        return $this->view->render($response,'create.php');
    }
    public function store(Request $request, Response $response){
        $data = $request->getParsedBody();
        $model = new Person($data);
        $model->save();

        $router = RouteContext::fromRequest($request)->getRouteParser();
        $indexUrl = $router->urlFor('index');

        return $response
            ->withHeader('Location',$indexUrl)
            ->withStatus(302);
    }
}
