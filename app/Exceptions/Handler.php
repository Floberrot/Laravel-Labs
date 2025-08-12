<?php

namespace App\Exceptions;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Throwable;

class Handler implements ExceptionHandler
{

    public function report(Throwable $e)
    {
        // TODO: Implement report() method.
    }

    public function shouldReport(Throwable $e)
    {
        // TODO: Implement shouldReport() method.
    }

    public function render($request, Throwable $e)
    {
        // Exemple : Si la requête attend une réponse JSON
        if ($request->expectsJson()) {
            // Si l'exception est de type ValidationException (erreur de validation)
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                // Retourne une réponse JSON avec le code 422 pour une erreur de validation
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $e->errors(),  // Récupère les erreurs de validation
                ], 422); // 422 : Unprocessable Entity
            }
        }

        // Autres types d'exception peuvent être traités ici si nécessaire

        // Si l'exception n'est pas capturée par un cas spécifique, appelle la méthode parent.
        return parent::render($request, $e);
    }

    public function renderForConsole($output, Throwable $e)
    {
        // TODO: Implement renderForConsole() method.
    }
}
