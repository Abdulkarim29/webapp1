<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mijn resultaat</title>
</head>
<body>

<h2>Temperatuur</h2>

<?php
// Maak een variabele voor de temperatuur
$temperatuur = 14
;

// Als de temperatuur hoger is dan 25:
// Toon: "Het is warm."
if ($temperatuur > 25){
    echo "<div> het is warm </div>";
}  elseif ($temperatuur > 15) {
    echo "<div> het is lekker weer buiten </div>";
}
else
    echo "<div> het is koud buiten </div>"
//
// Anders:
// Toon: "Het is koud."

?>
</body>
</html>