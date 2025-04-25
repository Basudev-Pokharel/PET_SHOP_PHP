<?php

//Universal Class to be extended
abstract class Pet
{
    public $name;
    public $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
    abstract public function action();
}
//Class for DOG is here
class Dog extends Pet
{
    public function action()
    {
        return "$this->name. Dog Barks";
    }
}
class Cat extends Pet
{
    public function action()
    {
        return "$this->name. Cat Meow";
    }
}
class Bird extends Pet
{
    public function action()
    {
        return "$this->name. Bird Chi Chi";
    }
}
session_start();

if (isset($_POST['submit'])) {
    $type = $_POST['type'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    if (!isset($_SESSION['pets']) || !is_array($_SESSION['pets'])) {
        $_SESSION['pets'] = [];
    }
    switch ($type) {
        case 'Dog':
            $pet = new Dog($name, $age);
            break;
        case 'Cat':
            $pet = new Cat($name, $age);
            break;
        case 'Bird':
            $pet = new Bird($name, $age);
            break;
    }
    array_push($_SESSION['pets'], $pet);
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet-Shop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="box">
        <form method="POST">
            <fieldset>
                <legend>Pet Information</legend>
                <select name="type" id="">
                    <option value="Cat">Cat</option>
                    <option value="Dog">Dog</option>
                    <option value="Bird">Bird</option>
                </select>
                <input type="text" name="name" placeholder="Enter Pet Name">
                <input type="text" name="age" placeholder="Enter Pet Age">
                <input type="submit" name="submit" value="Submit" id="submit">
            </fieldset>
        </form>
        <h2>Pets List</h2>
        <table>
            <tr>
                <th>Animal</th>
                <th>Name</th>
                <th>Age</th>
                <th>Action</th>
            </tr>

            <?php
            if (isset($_SESSION['pets'])) {
                for ($a = 0; $a < count($_SESSION['pets']); $a++) {


            ?>
                    <tr>
                        <td><?php $className = get_class($_SESSION['pets'][$a]);
                            echo $className; ?></td>
                        <td><?= $_SESSION['pets'][$a]->age ?></td>
                        <td><?= $_SESSION['pets'][$a]->name ?></td>
                        <td><?= $_SESSION['pets'][$a]->action() ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "No animal added till yet.";
            }
            ?>
        </table>
    </div>
</body>

</html>