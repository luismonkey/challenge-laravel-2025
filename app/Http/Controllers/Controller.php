<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\ApiResponse;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Mi API - Documentación",
 *      description="Documentación de la API de mi proyecto",
 *      @OA\Contact(
 *          email="soporte@midominio.com"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Servidor principal"
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ApiResponse;

}
