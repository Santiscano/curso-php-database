<?php

namespace App\Controllers;

use Database\PDO\Connection;

class IncomesController
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
    $stmt = $this->connection->prepare("SELECT * FROM incomes");
    $stmt->execute();

    $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    require("../resources/views/incomes/index.php"); // esta ruta es relativa desde el archivo public/index.php



    // *con fetch haremos un hight para traer todos los registros
    // while ($row = $stmt->fetch(\PDO::FETCH_ASSOC))
    //   echo "Gaste: $" . $row['amount'] . " en " . $row['description'] . "<br>";

    // *usando bindColumn y con un ejemplo de fetch con FETCH_BOUND
    // $stmt->bindColumn('amount', $amount);
    // $stmt->bindColumn('description', $description);
    // while ($stmt->fetch(\PDO::FETCH_BOUND))
    //   echo "Gaste: $ $amount en $description <br>";
    
  }

  /**
   * Muestra un recurso específico.
   */
  public function show($id)
  {
    $stmt = $this->connection->prepare("SELECT * FROM incomes WHERE id = :id");
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
    require("../resources/views/incomes/create.php");
  }

  /**
   * Almacena un recurso recién creado en el almacenamiento. 
   */
  public function store($data)
  {

    // stmt = statement
    $stmt = $this->connection->prepare("INSERT INTO incomes 
    (payment_method, type, date, amount, description) 
      VALUES 
    (:payment_method, :type, :date, :amount, :description)
    ");

    // i = integer, s = string, d = double, b = blob
    $stmt->bindValue(":payment_method", $data['payment_method']);
    $stmt->bindValue(":type", $data['type']);
    $stmt->bindValue(":date", $data['date']);
    $stmt->bindValue(":amount", $data['amount']);
    $stmt->bindValue(":description", $data['description']);
    $stmt->execute();

    header("Location: /incomes"); // redirecciona a la lista de ingresos (index)
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
    $stmt = $this->connection->prepare("UPDATE incomes SET
      payment_method = :payment_method,
      type = :type,
      date = :date,
      amount = :amount,
      description = :description
      WHERE id = :id");

    $stmt->bindValue(":payment_method", $data['payment_method']);
    $stmt->bindValue(":type", $data['type']);
    $stmt->bindValue(":date", $data['date']);
    $stmt->bindValue(":amount", $data['amount']);
    $stmt->bindValue(":description", $data['description']);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    echo "Se han actualizado {$stmt->rowCount()} registros";
  }

  /**
   * Elimina un recurso específico.
   */
  public function destroy($id)
  {
    $this->connection->beginTransaction();
    $stmt = $this->connection->prepare("DELETE FROM incomes WHERE id = :id");
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    $sure = readline("¿Estás seguro de eliminar el registro? (s/n): ");

    if ($sure === 's') {
      $this->connection->commit(); // esto confirma la transaccion
      echo "Se ha eliminado el registro";
    } else {
      $this->connection->rollBack(); // esto revierte la transaccion
      echo "No se ha eliminado el registro";
    }
  }
}
