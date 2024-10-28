<h1>Aufgabe GET & POST</h1>
<form action="index.php?var1=hahaha" method="post">
    <input type="text" name="vorname" id="vorname">
    <input type="text" name="nachname" id="nachname">
    <input type="submit" value="submit">
</form>
<?php
$post = $_POST;
$get = $_GET;
    echo '<pre>';
    print_r($post);
    print_r($get);
    echo '</pre>';
?>

<br>
<br>
<br>
<br>
<br>
<h1>Aufgabe 1</h1>
<?php
    for ($i = 0; $i < 256; $i++) {
        echo chr($i);
        echo '<br>';
    }
?>
<h1>Aufgabe 2</h1>
<?php
    for ($i = 0; $i < 101; $i++) {
        if ($i %2) {
            echo $i;
            echo '<br>';
        }
    }
?>
<h1>Aufgabe 3</h1>
<?php
    for ($i = 0; $i < 1001; $i++) {
        $checker = true;
        for ($a = 2; $a < $i; $a++){
            if ($i%$a == 0) {
                $checker = false;
            }
        }
        if ($checker) {
            echo $i;
            echo '<br>';
        }
    }
?>