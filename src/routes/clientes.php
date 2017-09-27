<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;


//Obtener todos los clientes
$app->get('/api/clientes', function(Request $request, Response $response){
    $negClientes = new NegClientes();
    $clientes = $negClientes->GetAll();
    if(is_null($clientes))
        echo $clientes;
    else
        echo json_encode($clientes);
});

//Obtener un cliente por id
$app->get('/api/clientes/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $negClientes = new NegClientes();
    $cliente = $negClientes->GetById($id);
    if(is_null($cliente))
        echo $cliente;
    else
        echo json_encode($cliente);
});

//Agregar un cliente
$app->post('/api/clientes', function(Request $request, Response $response){
    $params = array();
    $params[0] = $request->getParam('nombre');
    $params[1] = $request->getParam('apellidos');

    $negClientes = new NegClientes();
    $respuesta = $negClientes->Add($params);
    if($respuesta==1)
        echo '{"notice": {"message": "Cliente registrado."} }';
    else
        echo '{"error": {"message": "Fallo al ingresar cliente."} }';
});

//Actualizar un cliente
$app->put('/api/clientes/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $params = array();
    $params[0] = $request->getParam('nombre');
    $params[1] = $request->getParam('apellidos');

    $negClientes = new NegClientes();
    $respuesta = $negClientes->Update($id, $params);
    if($respuesta==1)
        echo '{"notice": {"message": "Cliente actualizado."} }';
    else
        echo '{"error": {"message": "Fallo al actualizar cliente."} }';
});

//Eliminar un cliente
$app->delete('/api/clientes/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $negClientes = new NegClientes();
    $respuesta = $negClientes->Delete($id);
    if($respuesta==1)
        echo '{"notice": {"message": "Cliente eliminado."} }';
    else
        echo '{"error": {"message": "Fallo al eliminar cliente."} }';
});

