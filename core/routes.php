<?php

$routes = [

    //User controller
    'criar-usuario' => 'usercontroller@create_user_view',
    'listar-usuarios' => 'usercontroller@list_users_view',
    'informacoes-usuario' => 'usercontroller@show_user_view',
    'editar-usuario' => 'usercontroller@update_user_view',
    'editar-cor' => 'usercontroller@update_user_color_view',

    'update-user' => 'usercontroller@update_user',
    'delete-user' => 'usercontroller@delete_user',
    'update-user-color' => 'usercontroller@update_user_color',
    'create_user' => 'usercontroller@create_user',


];



$action = 'listar-usuarios';
$id = null; // Initialize ID as null

// Verifies if action exists on string query
if (isset($_GET['a'])) {
    // Split the query to extract action and ID if present
    $queryParts = explode('/', $_GET['a']);
    $actionPart = $queryParts[0]; // This is the action
    $idPart = isset($queryParts[1]) ? $queryParts[1] : null; // This is the ID if present

    // Verifies if action exists in routes
    if (array_key_exists($actionPart, $routes)) {
        $action = $actionPart;
        if (is_numeric($idPart)) {
            $id = (int) $idPart; // Convert ID to integer
        }
    } else {
        $action = 'listar-usuarios';
    }
}

$parts = explode('@', $routes[$action]);
$controller = 'core\\controllers\\' . ucfirst($parts[0]);
$method = $parts[1];


$ctr = new $controller();
if ($id !== null) {
    $ctr->$method($id); // Pass the ID to the method if it exists
} else {
    $ctr->$method(); // Call the method without ID if no ID is provided
}
