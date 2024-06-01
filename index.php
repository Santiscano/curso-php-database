<?php

use App\Controllers\IncomesController;
use App\Controllers\WithdrawalController;
use App\Enums\IncomeTypeEnum;
use App\Enums\PaymentMethodEnum;
use App\Enums\WithdrawalTypeEnum;

require("vendor/autoload.php");

$incomes_controller = new IncomesController();
$incomes_controller->store([
  "payment_method" => PaymentMethodEnum::BankAccount->value,
  "type" => IncomeTypeEnum::Salary->value,
  "date" => date("Y-m-d H:i:s"),
  "amount" => 1000,
  "description" => "Salary payment"
]);


$withdrawals_controller = new WithdrawalController();
// *esta forma  haria que tenga que extraer cada valor en el bind_param
$withdrawals_controller->store([
  "payment_method" => PaymentMethodEnum::CreditCard->value,
  "type" => WithdrawalTypeEnum::Purchase->value,
  "date" => date("Y-m-d H:i:s"),
  "amount" => 100,
  "description" => "Purchase of a new laptop"
]);

// la opcion 2 es aqui poner los : en las keys 
// $withdrawals_controller->store([
//   ":payment_method" => PaymentMethodEnum::CreditCard->value,
//   ":type" => WithdrawalTypeEnum::Purchase->value,
//   ":date" => date("Y-m-d H:i:s"),
//   ":amount" => 100,
//   ":description" => "Purchase of a new laptop"
// ]);

$withdrawals_controller->index();
