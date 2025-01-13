<?php

namespace Alura\Mvc\Controller;

class ErrorController implements Controller
{
    public function processRequest(): void
    {
      http_response_code(404);
    }
}
