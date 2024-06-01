<?php

namespace App\Controllers;

use Database\PDO\Connection;

class WithdrawalController
{

  private $connection;

  public function __construct()
  {
    $this->connection = Connection::getInstance()->getConnection();
  }

  /**
   * Muestra una lista de los recursos.
   */
  public function index()
  {
    $stmt = $this->connection->prepare("SELECT * FROM withdrawals");
    $stmt->execute();

    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    foreach ($result as $result)
      echo "Gaste: $" . $result['amount'] . " en " . $result['description'] . "<br>";
  }

  /**
   * Muestra un recurso específico.
   */
  public function show($id)
  {
    $stmt = $this->connection->prepare("SELECT * FROM withdrawals WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

    echo "Gaste: $" . $result['amount'] . " en " . $result['description'] . "<br>";
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
    // stmt = statement
    $stmt = $this->connection->prepare("INSERT INTO withdrawals (payment_method, type, date, amount, description) 
      VALUES (:payment_method, :type, :date, :amount, :description)
    ");

    $stmt->bindParam(':payment_method', $data['payment_method']);
    $stmt->bindParam(':type', $data['type']);
    $stmt->bindParam(':date', $data['date']);
    $stmt->bindParam(':amount', $data['amount']);
    $stmt->bindParam(':description', $data['description']);

    $stmt->execute();

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
  public function update($data, $id)
  {
    $stmt = $this->connection->prepare("UPDATE withdrawals SET 
      payment_method = :payment_method, 
      type = :type, 
      date = :date, 
      amount = :amount, 
      description = :description
    WHERE id = :id");

    $stmt->bindValue(':payment_method', $data['payment_method']);
    $stmt->bindValue(':type', $data['type']);
    $stmt->bindValue(':date', $data['date']);
    $stmt->bindValue(':amount', $data['amount']);
    $stmt->bindValue(':description', $data['description']);
    $stmt->bindValue(':id', $id);

    $stmt->execute();
  }

  /**
   * Elimina un recurso específico.
   */
  public function destroy($id)
  {
    $delete = $this->connection->prepare("DELETE FROM withdrawals WHERE id = :id");
    $delete->bindParam(':id', $id);
    $delete->execute();

    echo "Se han eliminado {$delete->rowCount()} registros";
  }
}
