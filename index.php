<?php
//ertertertertretrt6y56ww243tyhjuytjytjty
$min = 1;
$max = 8;
$text = ""; // Текст подсказки
$nameErr = ""; // Сообщение об ошибке

if (isset($_POST['Submit'])) { // Если нажата кнопка 'Submit'
    $count = $_POST['hidden'] + 1; // Увеличиваем счетчик на 1
    global $n;
    $n = $_POST['n'];
    if (empty($_POST["my_number"])) { // Если ничего не ввели
        $nameErr = "Число обязательно для ввода!";
    } else {
        $my_number = trim($_POST["my_number"]); //Удаляем лишние пробелы
        // проверка, содержатся ли только число
        if (!preg_match("/^[" . $min . "-" . $max . "]$/", $my_number)) {
            $nameErr = "Разрешается только число от $min до $max!";
        }
    }
    if ($nameErr === "") { // Если не было ошибки
        if ($my_number > $n)
            $text = "Слишком много!";
        elseif ($my_number < $n) {
            $text = "Слишком мало!";
        } else {
            $text = "Точно! Это $my_number! Угадано с $count попытки!<br/>";
        }
    }
} else {
    $n = rand($min, $max); //Задуманное число
    $count = 0; // Количество попыток
}

if (isset($_POST['Clear'])) { // Если нажата кнопка 'Clear'
    unset($_POST); // Удаление массива $_POST
    $count = 0;
    $text = "";
    $nameErr = "";
    header("Location:" . $_SERVER['PHP_SELF']); // Перечитываем ту же страницу
    exit; // Выход
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <p>Угадай число от <?= $min ?> до <?= $max ?> :</p>
        <?= $nameErr ?><br/>
        <form action="index.php" name="myform" method="POST">
            <input type="text" name="my_number" size="5">
            <input type="hidden" name="n"  value="<?= $n ?>">
            <input type="hidden" name="hidden"  value="<?= $count ?>">
            <input name="Submit" type="submit" value="Отправить">
            <input name="Clear" type="submit" value="Заново">
        </form>
        <br/>
        <?= $text ?> <br/>
        <svg height="210" width="500">
        <?php
        for ($i = 1; $i <= $count; $i++) {
            echo "<line x1=" . ($i * 20) . " y1='0' x2='" . ($i * 20) . "' y2='50' style='stroke:rgb(255,0,0);stroke-width:2'/>\n";
        }
        ?>
        </svg>
    </body>
</html>
