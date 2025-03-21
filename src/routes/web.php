<?php

use App\Services\AnalyzeApplicationService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('analyze', function () {
    $userData = 'IT Engineer graduated from the National University of Trujillo. My passion for software development led me to work on desktop applications in Java, Android mobile applications, and eventually specialize in web development with PHP, where I have been working for over 7 years. I have learned various technologies and tools for database analysis and design, programming with frontend and backend frameworks, testing, and deploying web applications. My goal is to continue learning, challenging myself, and giving my best in every project I am involved in, contributing to achieving the goals of the team I work with.';
    $positionData = 'Estamos en busca de un Tech Lead (PHP - Vue.js) que pueda liderar el desarrollo y optimización de nuestras aplicaciones web con una arquitectura basada en Microservicios. Serás responsable de definir la arquitectura, garantizar buenas prácticas de desarrollo y colaborar con equipos multidisciplinarios para ofrecer soluciones escalables y eficientes.';
    $analyzeService = new AnalyzeApplicationService;
    $response = $analyzeService->analyze($userData, $positionData);
    dd($response);
});
