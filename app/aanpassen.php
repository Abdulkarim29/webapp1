<?php
session_start();

if (!isset($_SESSION['ingelogd'])) {
    header('Location: admin.php');
    exit;
}

$connection = new PDO('mysql:host=mysql_db;dbname=Ijssalon;charset=utf8mb4', 'root', 'rootpassword');
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit;
}

$id = (int) $_GET['id'];

$kleuren = [
        'kt-roze'   => '🌸 Roze',
        'kt-geel'   => '🌟 Geel',
        'kt-groen'  => '🍃 Groen',
        'kt-oranje' => '🍊 Oranje',
        'kt-bruin'  => '🍫 Bruin',
        'kt-creme'  => '🍦 Crème',
        'kt-blauw'  => '🫐 Blauw',
        'kt-paars'  => '🍇 Paars',
];

if (isset($_POST['titel'])) {
    $sql = $connection->prepare("
        UPDATE menukaart 
        SET titel = :titel, omschrijving = :omschrijving, prijs = :prijs, flavor = :flavor 
        WHERE id = :id
    ");

    $sql->execute([
            ':titel' => trim($_POST['titel']),
            ':omschrijving' => trim($_POST['omschrijving']),
            ':prijs' => $_POST['prijs'],
            ':flavor' => $_POST['flavor'],
            ':id' => $id,
    ]);

    header('Location: admin.php');
    exit;
}

$sql = $connection->prepare("SELECT * FROM menukaart WHERE id = :id");
$sql->execute([':id' => $id]);
$data = $sql->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IJsje aanpassen – De Zoete Hoorn</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="nav-inner">
        <span class="logo">🔧 Admin – De Zoete Hoorn</span>
        <ul>
            <li><a href="admin.php">← Terug naar admin</a></li>
        </ul>
    </div>
</nav>

<section class="admin-sectie">
    <div class="admin-inner">
        <h2>IJsje aanpassen</h2>
        <p class="sub">Pas de gegevens aan en sla op.</p>

        <form method="post" class="admin-form">
            <label>Naam
                <input type="text" name="titel" value="<?php echo htmlspecialchars($data['titel']); ?>" required>
            </label>

            <label>Omschrijving
                <textarea name="omschrijving" rows="4" required><?php echo htmlspecialchars($data['omschrijving']); ?></textarea>
            </label>

            <label>Prijs
                <input type="number" step="0.01" min="0" name="prijs" value="<?php echo htmlspecialchars($data['prijs']); ?>" required>
            </label>

            <label>Kleur van de kaart
                <select name="flavor" required>
                    <?php foreach ($kleuren as $val => $label): ?>
                        <option value="<?php echo htmlspecialchars($val); ?>" <?php echo ($data['flavor'] === $val) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($label); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <div class="admin-knoppen">
                <button type="submit" class="btn">💾 Opslaan</button>
                <a href="admin.php" class="btn btn-secundair">Annuleren</a>
            </div>
        </form>
    </div>
</section>

<footer>
    <p>🍦 <strong>De Zoete Hoorn</strong> · Admin paneel</p>
</footer>

</body>
</html>