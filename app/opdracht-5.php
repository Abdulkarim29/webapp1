<?php

// Studentenlijst
$studenten = [
        ["naam" => "Emma", "leeftijd" => 17],
        ["naam" => "Liam", "leeftijd" => 19],
        ["naam" => "Noah", "leeftijd" => 16],
        ["naam" => "Karim", "leeftijd" => 21],
        ["naam" => "Lucas", "leeftijd" => 18]
];

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Studentenlijst</title>
</head>
<body>

<h1>Studentenlijst</h1>

<!-- HIER MOET JOUW CODE KOMEN -->
<!-- Toon alle studenten. Studenten die minderjarig zijn markeer je rood. -->
<!-- Studenten die volwassen zijn, markeer je groen -->
<?php
foreach ($studenten as $s) {
    $kleur = ($s["leeftijd"] < 18) ? "red" : "green";
    echo "<div style='color:$kleur'>{$s['naam']} ({$s['leeftijd']})</div>";
}
?>

</body>
</html>