<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException; // <-- 1. Importe a classe

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        // --- 2. ADICIONE ESTE BLOCO DENTRO DA FUNÇÃO register() ---

        $this->renderable(function (AuthenticationException $e, $request) {
            // Verifica se a requisição espera JSON (é uma API)
            if ($request->expectsJson()) {

                // Se o token não foi enviado (header 'Authorization' está vazio)
                if (!$request->bearerToken()) {
                    // Retorno 422 (Token não informado)
                    return response()->json(['message' => 'Treinador, faltou informar seu token'], 422);
                } else {
                    // Se o token foi enviado, mas é inválido
                    // Retorno 401 (Token inválido)
                    return response()->json(['message' => 'Treinador, este token não é mais válido'], 401);
                }
            }
        });

        // -------------------------------------------------------------
    }

    // --- 3. REMOVA A FUNÇÃO "render()" SE VOCÊ A ADICIONOU ANTES ---
    // (Não deve existir uma public function render(...) aqui)
}
