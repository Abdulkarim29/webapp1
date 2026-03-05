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
<?php

echo "<div>{$studenten[0]['naam']}</div>
      <div>{$studenten[2]['naam']}</div>
      <div>{$studenten[4]['naam']}</div>";
?>
<!-- Toon de eerste, derde en vijfde student uit de lijst -->


</body>
</html>