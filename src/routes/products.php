<?php

use Slim\Http\Request;
use Slim\Http\Response;

// GET Todos los productos
$app->get('/products', function (Request $request, Response $response) {
    try {
        $db = new db();
        $db = $db->connectionDB();

        $sql = 'SELECT * FROM product ORDER BY id ASC;';
        $result = $db->query($sql);

        if ($result->rowCount() > 0) {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            return $response->withJson([
                'status' => 'success',
                'code' => 200,
                'data' => $data,
            ]);
        } else {
            return $response->withJson([
                'status' => 'error',
                'code' => 404,
                'message' => 'No existen productos registrados.',
            ]);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e . getMessage() . '}';
    }
});

// GET Recuperar producto por ID
$app->get('/products/{id}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');

    try {
        $db = new db();
        $db = $db->connectionDB();

        $sql = 'SELECT * FROM product WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        if ($result->rowCount() > 0) {
            $data = $result->fetchAll(PDO::FETCH_OBJ);
            return $response->withJson([
                'status' => 'success',
                'code' => 200,
                'data' => $data,
            ]);
        } else {
            return $response->withJson([
                'status' => 'error',
                'code' => 404,
                'message' => 'El producto no existe.',
            ]);
        }
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e . getMessage() . '}';
    }
});

// POST Crear un nuevo producto
$app->post('/products', function (Request $request, Response $response, array $args) {
    $_input = $request->getParsedBody();

    if (
        !empty($_input['name']) &&
        !empty($_input['brand']) &&
        !empty($_input['price']) &&
        !empty($_input['stock'])
    ) {

        try {
            $db = new db();
            $db = $db->connectionDB();

            $sql = 'INSERT INTO product (
                    name,
                    brand,
                    price,
                    stock
                ) VALUES (
                    :name,
                    :brand,
                    :price,
                    :stock
                )';
            $result = $db->prepare($sql);

            $result->bindParam(':name', $_input['name'], PDO::PARAM_STR, 255);
            $result->bindParam(':brand', $_input['brand'], PDO::PARAM_STR, 255);
            $result->bindParam(':price', $_input['price'], PDO::PARAM_STR, 255);
            $result->bindParam(':stock', $_input['stock'], PDO::PARAM_INT);

            $result->execute();
            $_input['id'] = $db->lastInsertId();

            if ($result->rowCount() > 0) {
                return $response->withJson([
                    'status' => 'success',
                    'code' => 200,
                    'data' => [$_input],
                ]);
            } else {
                return $response->withJson([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Producto no creado.',
                ]);
            }
        } catch (PDOException $e) {
            echo '{"error" : {"text":' . $e . getMessage() . '}';
        }
    } else {
        return $response->withJson([
            'status' => 'error',
            'code' => 404,
            'message' => 'Producto no creado, verifique los datos ingresados.',
        ]);
    }
});

// PUT Modificar producto
$app->put('/products/{id}', function (Request $request, Response $response, array $args) {
    $_input = $request->getParsedBody();
    $_input['id'] = $request->getAttribute('id');

    if (
        !empty($_input['name']) &&
        !empty($_input['brand']) &&
        !empty($_input['price']) &&
        !empty($_input['stock'])
    ) {

        try {
            $db = new db();
            $db = $db->connectionDB();

            $sql = 'UPDATE product SET
                        name = :name,
                        brand = :brand,
                        price = :price,
                        stock = :stock
                        WHERE id = :id';
            $result = $db->prepare($sql);

            $result->bindParam(':name', $_input['name'], PDO::PARAM_STR, 255);
            $result->bindParam(':brand', $_input['brand'], PDO::PARAM_STR, 255);
            $result->bindParam(':price', $_input['price'], PDO::PARAM_STR, 255);
            $result->bindParam(':stock', $_input['stock'], PDO::PARAM_INT);
            $result->bindParam(':id', $_input['id'], PDO::PARAM_INT);

            $result->execute();

            if ($result->rowCount() > 0) {
                return $response->withJson([
                    'status' => 'success',
                    'code' => 200,
                    'data' => [$_input],
                ]);
            } else {
                return $response->withJson([
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'Producto no actualizado.',
                ]);
            }
        } catch (PDOException $e) {
            echo '{"error" : {"text":' . $e . getMessage() . '}';
        }
    } else {
        return $response->withJson([
            'status' => 'error',
            'code' => 404,
            'message' => 'Producto no actualizado, verifique los datos ingresados.',
        ]);
    }
});

// DELETE Modificar producto
$app->delete('/products/{id}', function (Request $request, Response $response, array $args) {
    $id = $request->getAttribute('id');

    try {
        $db = new db();
        $db = $db->connectionDB();

        $sql = 'DELETE FROM product WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $query = $result->rowCount();

        return $response->withStatus($query > 0 ? 200 : 404)
            ->withJson([
                'status' => $query > 0 ? 'success' : 'error',
                'code' => $query > 0 ? 200 : 404,
                'message' => $query > 0
                ? 'Producto eliminado correctamente.'
                : 'Producto no eliminado.',
            ]);
    } catch (PDOException $e) {
        echo '{"error" : {"text":' . $e . getMessage() . '}';
    }
});
