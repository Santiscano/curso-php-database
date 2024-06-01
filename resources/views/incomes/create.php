<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agrega un nuevo ingreso</title>
</head>
<body>
  
    <h1>Agrega un nuevo ingreso</h1>

    <form action="/incomes" method="post">

      <label for="payment_method">Metodo de pago</label>
      <select name="payment_method" id="payment_method">
        <option value="1" selected>Cuenta bancaria</option>
        <option value="2">Tarjeta de credito</option>
      </select>
      
      <label for="type">Tipo de ingreso</label>
      <select name="type" id="type">
        <option value="1" selected>Pago de nòmina</option>
        <option value="2">Reembolso</option>
      </select>

      <label for="amount">Monto</label>
      <input type="text" name="amount" id="amount">
      
      <label for="description">Descripción</label>
      <input type="text" name="description" id="description">

      <input type="hidden" name="method" value="post">

      <button type="submit">Guardar</button>

    </form>
</body>
</html>
