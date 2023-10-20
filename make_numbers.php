<?php
// Create an array to store the random numbers
$numbers = array();

// Generate 300 random total prices, with price betwen 1 and 100 and quantity between 1 and 10
for ($i = 0; $i < 300; $i++) {
    $price = mt_rand(1, 200);
    $quantity = mt_rand(1, 20);
    $numbers[] = $price * $quantity;
}

// Convert the array into a string, with each number on a new line
$numbersString = implode("\n", $numbers);

// Write the string to a text file
file_put_contents('random_numbers.txt', $numbersString);
?>