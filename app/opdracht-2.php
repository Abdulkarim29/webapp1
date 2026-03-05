<?php

// STAP 1: Maak hier een array met je hobby's
// Bijvoorbeeld: ["Gamen", "Voetbal", "Programmeren"]
$mijnHobbies= ["Voetballen","Gamen","Gymmen","Eten"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mijn Hobby's</title>
</head>
<body>

<h2>Hobby's</h2>

<ul>
    <!-- STAP 2: Toon hier je hobby's met een loop en HTML -->
    <?php
    foreach ($mijnHobbies as $hobbies ) {
        echo "<div>" .$hobbies .  "</div>";
    }
    ?>
</ul>

</body>
</html>