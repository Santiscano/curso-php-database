<?php

namespace App\Controllers;

use Database\MySQLi\Connection;

class IncomesController
{

  /**
   * Muestra una lista de los recursos.
   */
  public function index()
  {
    echo 'IncomesController index';
  }

  /**
   * Muestra un recurso específico.
   */
  public function show()
  {
    echo 'IncomesController show';
  }

  /**
   * Muestra el formulario para crear un nuevo recurso.
   */
  public function create()
  {
    echo 'IncomesController create';
  }

  /**
   * Almacena un recurso recién creado en el almacenamiento.
   */
  public function store($data)
  {
    $connection = Connection::getInstance()->get_database_instance();

    // $connection->query("INSERT INTO incomes (payment_method, type, date, amount, description) 
    //   VALUES (
    //     {$data['payment_method']}, 
    //     {$data['type']}, 
    //     '{$data['date']}', 
    //     {$data['amount']}, 
    //     '{$data['description']}'
    //   )");

    // stmt = statement
    $stmt = $connection->prepare("INSERT INTO incomes 
    (payment_method, type, date, amount, description) 
      VALUES 
    (?,?,?,?,?);
    ");

    // i = integer, s = string, d = double, b = blob
    $stmt->bind_param("iisds", $data['payment_method'], $data['type'], $data['date'], $data['amount'], $data['description']);
    $stmt->execute();

    echo "Se han insertado {$stmt->affected_rows} registros";
  }

  /**
   * Muestra el formulario para editar un recurso específico.
   */
  public function edit()
  {
    echo 'IncomesController edit';
  }

  /**
   * Actualiza un recurso específico.
   */
  public function update()
  {
    echo 'IncomesController update';
  }

  /**
   * Elimina un recurso específico.
   */
  public function destroy()
  {
    echo 'IncomesController destroy';
  }
}
