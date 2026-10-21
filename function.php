<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $num1 = (int) $_POST["num1"];
    $num2 = (int) $_POST["num2"];
    echo calculate($num1, $num2);
    
}

function calculate(float $num1, float $num2){

        switch(($_POST['op'])){
        case 'sum':
            return (int) $sum = $num1 + $num2;
        case 'difference':
            return (int) $dfference = $num1 - $num2;   
        case 'product':
            return (int) $product = $num1 * $num2;   
        case 'quotient':
            return(int) $quotient = $num1 / $num2;   
    }
}
    /*
    {
    $num1 = (int) $_POST["num1"];
    $num2 = (int) $_POST["num2"];
    
    switch(($_POST['op'])){
        case 'sum':
            echo (int) $sum = $num1 + $num2;
            break;
        case 'difference':
            echo (int) $dfference = $num1 - $num2;   
            break;
        case 'product':
            echo (int) $product = $num1 * $num2;   
            break;
        case 'quotient':
        echo (int) $quotient = $num1 / $num2;   
            break;
    }

}*/






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
    <input type="text" name ="num1">
    <br><br>
    <input type="text" name ="num2">
    <br><br>
    <select name="op" id="">    
            <option value="sum">Add</option>
            <option value="difference">Subtract</option>
            <option value="product">Multiply</option>
            <option value="quotient">Divide</option>
        </select>
        <button type="submit">Calculate></button>
    </form>

</body>
</html>