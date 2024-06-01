<?php

namespace App\Controllers;

use Database\MySQLi\Connection;
use Database\PDO\Connection as PDOConnection;


class WaysToConnection
{
  public function querySQLi($data)
  {
    $connection = Connection::getInstance()->get_database_instance();

    $connection->query(
      "INSERT INTO incomes (payment_method, type, date, amount, description) 
        VALUES (
          {$data['payment_method']}, 
          {$data['type']}, 
          '{$data['date']}', 
          {$data['amount']}, 
          '{$data['description']}'
        )"
    );

    echo "Se insertaron {$connection->affected_rows} registros";
  }

  public function querySqliBindParam($data)
  {
    $connection = Connection::getInstance()->get_database_instance();

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

  public function queryPdo($data)
  {
    $connection = PDOConnection::getInstance()->getConnection();

    $affected_rows = $connection->exec("INSERT INTO withdrawals (payment_method, type, date, amount, description) 
      VALUES (
        {$data['payment_method']}, 
        {$data['type']}, 
        '{$data['date']}', 
        {$data['amount']}, 
        '{$data['description']}'
      )");

    echo "Se insertaron {$affected_rows} registros";
  }

  public function queryPdoPrepare($data)
  {
    $connection = PDOConnection::getInstance()->getConnection();

    // stmt = statement
    $stmt = $connection->prepare(
      "INSERT INTO withdrawals (payment_method, type, date, amount, description) 
        VALUES (:payment_method, :type, :date, :amount, :description);"
    );

    // $stmt->execute([
    //   ':payment_method' => $data['payment_method'],
    //   ':type' => $data['type'],
    //   ':date' => $data['date'],
    //   ':amount' => $data['amount'],
    //   ':description' => $data['description']
    // ]);

    // si en la ejecucion entrego las llaves con los : podria hacer
    $stmt->execute($data);

    echo "Se han insertado {$stmt->rowCount()} registros";
  }

  public function queryPdoBindParam($data)
  {
    $connection = PDOConnection::getInstance()->getConnection();

    $stmt = $connection->prepare(
      "INSERT INTO withdrawals (payment_method, type, date, amount, description) 
        VALUES (:payment_method, :type, :date, :amount, :description);"
    );

    $stmt->bindParam(':payment_method', $data['payment_method']);
    $stmt->bindParam(':type', $data['type']);
    $stmt->bindParam(':date', $data['date']);
    $stmt->bindParam(':amount', $data['amount']);
    $stmt->bindParam(':description', $data['description']);

    // el unico problema con esto seria la posibilidad del cambio de valor por referencia
    $data["description"] = "Nuevo valor modificado antes del execute()";

    $stmt->execute();

    echo "Se han insertado {$stmt->rowCount()} registros";
  }

  public function queryPdoBindValue($data)
  {
    $connection = PDOConnection::getInstance()->getConnection();

    $stmt = $connection->prepare(
      "INSERT INTO withdrawals (payment_method, type, date, amount, description) 
        VALUES (:payment_method, :type, :date, :amount, :description);"
    );

    $stmt->bindValue(':payment_method', $data['payment_method']);
    $stmt->bindValue(':type', $data['type']);
    $stmt->bindValue(':date', $data['date']);
    $stmt->bindValue(':amount', $data['amount']);
    $stmt->bindValue(':description', $data['description']);

    // con esta ya no se puede modificar el valor de la variable

    $stmt->execute();

    echo "Se han insertado {$stmt->rowCount()} registros";
  }
}
