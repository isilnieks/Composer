<?php
require_once 'vendor/autoload.php';

use App\Flower;
use App\Sellable;
use App\FlowerCollection;
use App\Suppliers\warehouseOne;
use App\Suppliers\warehouseTwo;
use Medoo\Medoo;


$flowers = new FlowerCollection();
$flowers->addFlowers($tulip = new Flower('Tulip', 10));
$flowers->addFlowers($rose = new Flower('Rose', 10));
$flowers->addFlowers($sunflower = new Flower('Sunflower', 10));

$tulip->setPrice(120);
$rose->setPrice(200);
$sunflower->setPrice(300);

$json = file_get_contents("storage/amazing-garden.json");
$jsonArray = json_decode($json, true);

$warehouseOne = new warehouseOne();
$warehouseOne->shipmentSize($jsonArray["name"], $jsonArray["amount"]);
//add delivery amount to main collection
foreach ($flowers->getFlowers() as $flower) {
    foreach ($warehouseOne->delivery()->getFlowers() as $delivery) {
        if ($flower->getName() == $delivery->getName()) {
            $flower->addAmount($delivery->getAmount());
        }
    }
}

$csv = file("storage/super-garden.csv");
$row = 1;
$csvArray = [];
if (($handle = fopen("storage/super-garden.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000 )) !== FALSE) {
        $num = count($data);
        $row++;
        for ($c = 0; $c < $num; $c++) {
            array_push($csvArray, $data[$c]);
        }
    }
    fclose($handle);
}

$warehouseTwo = new warehouseTwo();

$warehouseTwo->shipmentSize(new Flower($csvArray[0], $csvArray[1]));

foreach ($flowers->getFlowers() as $flower) {
    foreach ($warehouseTwo->delivery()->getFlowers() as $delivery) {
        if ($flower->getName() == $delivery->getName()) {
            $flower->addAmount($delivery->getAmount());
        }
    }
}

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'codelex',
    'server' => '127.0.0.1',
    'username' => 'root',
    'password' => 'root'
]);

$productsInfo = $database->select('products','*');

$sellable = new Sellable($productsInfo[0]["name"],$productsInfo[0]["amount"]);

foreach ($flowers->getFlowers() as $flower) {{
        if ($flower->getName() == $sellable->getName()) {
            $flower->addAmount($sellable->getAmount());
        }
    }
}



//$gender = readline('Enter your gender male/female: ');

$howManyTypes = 0;
foreach ($flowers->getFlowers() as $flower) {
    echo $howManyTypes . '. Flower: ' . $flower->getName() . ' | Price: ' . $flower->getPrice() . ' | Amount available: ' . $flower->getAmount() . '<br><br>';

    $howManyTypes++;
}



/*$howManyTypes -= 1;
$choice = readline("Choose your product: (0-$howManyTypes): ");
$amount = readline("How many would you like to buy: ");


$cost = $flowers->getFlowers()[$choice]->getPrice();

$flowers->getFlowers()[$choice]->removeAmount($amount);

if($gender == 'female'){
    $discount = ($cost * $amount) - (($cost * $amount) * 0.8);
    echo 'You have to pay: ' . (($cost * $amount) * 0.8) . ' coins.' . 'Discount: ' . $discount . PHP_EOL;
}else{
    echo 'You have to pay: ' . ($cost * $amount) . ' coins' . PHP_EOL;
}}*/