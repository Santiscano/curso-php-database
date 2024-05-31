<?php

namespace App\Controllers;

use Database\PDO\Connection;

class WithdrawalController
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
  public function store()
  {
    $connection = Connection::getInstance()->getConnection();
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
