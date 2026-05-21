<?php

return [

    /*
    |----------------------------------------------------------------------
    | Rutas con CORS Habilitado
    |----------------------------------------------------------------------
    | Define las rutas a las que se aplicarán las reglas CORS.
    | 'api/*' es lo mínimo para APIs, y 'sanctum/csrf-cookie' es necesario si
    | usas Sanctum para autenticación.
    */
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    /*
    |----------------------------------------------------------------------
    | Métodos HTTP Permitidos
    |----------------------------------------------------------------------
    | '*' permite todos los métodos (GET, POST, PUT, DELETE, etc.).
    | Puedes cambiarlo a un array como ['GET', 'POST'] si quieres ser más restrictivo.
    */
    'allowed_methods' => ['*'],

    /*
    |----------------------------------------------------------------------
    | Orígenes (Dominios) Permitidos
    |----------------------------------------------------------------------
    | Aquí es donde pones la URL de tu frontend.
    | Es importante que sea la URL *exacta* con https:// y sin barra al final.
    */
    'allowed_origins' => [
        'https://panel.grupoeuroandino.com',
        'http://localhost:5173'
        // <-- TU DOMINIO PRINCIPAL
        // Si lo pruebas desde localhost durante el desarrollo, añádelo también:
        // 'http://localhost:3000',
    ],

    /*
    |----------------------------------------------------------------------
    | Patrones de Orígenes Permitidos (Avanzado)
    |----------------------------------------------------------------------
    | Útil si necesitas permitir dinámicamente subdominios como
    | cliente1.tudominio.com sin listarlos todos.
    */
    'allowed_origins_patterns' => [],

    /*
    |----------------------------------------------------------------------
    | Cabeceras de Solicitud Permitidas
    |----------------------------------------------------------------------
    | '*' permite todas las cabeceras comunes. Es la opción recomendada para
    | la mayoría de los casos.
    */
    'allowed_headers' => ['*'],

    /*
    |----------------------------------------------------------------------
    | Cabeceras Expuestas al Navegador
    |----------------------------------------------------------------------
    | Útil si tu frontend necesita leer cabeceras personalizadas como
    | 'X-Total-Count'. Déjalo vacío si no es tu caso.
    */
    'exposed_headers' => [],

    /*
    |----------------------------------------------------------------------
    | Duración del Cache para Preflight (segundos)
    |----------------------------------------------------------------------
    | Un valor de 0 desactiva el cache. 3600 (1 hora) o 86400 (1 día)
    | son buenos para producción y reducen peticiones OPTIONS.
    */
    'max_age' => 3600,

    /*
    |----------------------------------------------------------------------
    | Soporte para Credenciales (Cookies / Tokens)
    |----------------------------------------------------------------------
    | Ponlo en 'true' si tu frontend necesita enviar cookies de sesión
    | (ej. con Laravel Sanctum) o el header 'Authorization'.
    | ¡ATENCIÓN! Si lo pones en 'true', NO puedes usar '*' en 'allowed_origins'.
    */
    'supports_credentials' => false, // Cámbialo a 'true' si usas sesiones o tokens

];