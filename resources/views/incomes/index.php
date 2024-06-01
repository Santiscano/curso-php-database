<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="/css/index.css">
  <title>Lista de ingresos</title>
</head>
<body>
  
    <h1>Lista de ingresos</h1>

    <main>
      <table>
        <thead>
          <tr>
            <th>Metodo de pago</th>
            <th>Tipo de ingreso</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Descripción</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($results as $result): ?>
            <tr>
              <td><?= $result["payment_method"] ?></td>
              <td><?= $result["type"] ?></td>
              <td><?= $result["date"] ?></td>
              <td><?= $result["amount"] ?></td>
              <td><?= $result["description"] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </main>

    <a class="button-link" href="/incomes/create">Agregar un nuevo ingreso</a>
</body>
</html>
