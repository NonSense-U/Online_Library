<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::get('/test', function(){
    throw new AuthorizationException();
});