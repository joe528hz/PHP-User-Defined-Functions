<?php
    declare(strict_types = 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <?php 
    // Without Parameters
    function sayHello(){
        echo "Hello World" . "<br>";
    }
    sayHello(); 

    // With Parameters
    function sayHelloName($name){
        echo "Hi my name is " . $name ."!" . "<br>";
    }
    sayHelloName("joel");

    // Returns value
    function valueReturn(){
        return "Hello World" . "<br>";
    }
    $test =  valueReturn();
    echo $test;

    // Default parameters
    function defaultParameters($name = "makoy"){
        return "Hello there " . $name ."<br>";
    }
    $test2 = defaultParameters();
    echo $test2;

    // Parameters Type Declaration (nake sure to declare strict_types at the top)
    function typeDeclaration(string $name){
        return "Hello there " .$name."<br>";
    }
    $test3 = typeDeclaration("mike");
    echo $test3;

    // Using global variable in functions
    $sampleGlobal = 4;
    function calculator(int $num1, int $num2){
        global $sampleGlobal;
        $result = $num1 + $num2 + $sampleGlobal;
        return $result;
    }
    $test4 = calculator(1,2);
    echo $test4;
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <input type="number" name="num01">
        <select name="operator" id="">
            <option value="add">+</option>
            <option value="minus">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="number" name="num02">
        <button>calculate</button>
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // grab inputs
            $num1 = filter_input(INPUT_POST, 'num01', FILTER_SANITIZE_NUMBER_FLOAT);
            $num2 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
            $operator = htmlspecialchars($_POST["operator"]);

            $errors = false;
            // Error Handlers
            if(empty($num1) || empty($num2) || empty($operator)){
                echo "<p>Fill all fields.</p>";
                $errors = true;
            }

            if(!is_numeric($num1) || !is_numeric($num2)){
                echo "<p>Only numbers.</p>";
                $errors = true;
            }

            // calculate if no errors
            function add($num1, $num2){
                return $num1 + $num2;
            }
            function minus($num1, $num2){
                return $num1 - $num2;
            }
            function multiply($num1, $num2){
                return $num1 * $num2;
            }
            function divide($num1, $num2){
                return $num1 / $num2;
            }

            if(!$errors){
                $value = 0;
                switch($operator){
                    case "add":
                        $value = add($num1, $num2);
                        break;
                    case "minus":
                        $value = minus($num1, $num2);
                        break;
                    case "multiply":
                        $value = multiply($num1, $num2);
                        break;
                    case "divide":
                        $value = divide($num1, $num2);
                        break;
                    default:
                    echo "<p>Somtething went wrong!</p>";
                }
                echo "<p>Result is " .$value. " </p>";
            }
        }
    
    ?>

</body>
</html>