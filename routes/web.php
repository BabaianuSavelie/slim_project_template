<?php

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app->get("/",[\App\Http\Controllers\HomeController::class,'index'])->setName('index');
$app->get("/persons/{name}",[\App\Http\Controllers\HomeController::class,'details']);

$app->get('/create',[\App\Http\Controllers\HomeController::class,'create']);
$app->post('/create',[\App\Http\Controllers\HomeController::class,'store']);