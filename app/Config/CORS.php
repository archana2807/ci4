
<?php
// app/Config/CORS.php

namespace Config;

class CORS
{
    public function handle()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        // Allow credentials (if needed) - set to true if your API supports credentials
        // header('Access-Control-Allow-Credentials: true');

        // Handle preflight requests
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Allow-Headers: Content-Type, Authorization');
            exit(0); // Preflight requests don't need to go through the entire application
        }
    }
}
?>