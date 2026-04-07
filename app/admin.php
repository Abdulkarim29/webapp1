<?php
session_start();

$connection = new PDO('mysql:host=mysql_db;dbname=Ijssalon;charset=utf8mb4', 'root', 'rootpassword');
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$fout = '';
$melding = '';

$kleuren = [
        'kt-roze'   => 'Roze',
        'kt-geel'   => 'Geel',
        'kt-groen'  => 'Groen',
        'kt-oranje' => 'Oranje',
        'kt-bruin'  => 'Bruin',
        'kt-creme'  => 'Crème',
        'kt-blauw'  => 'Blauw',
        'kt-paars'  => 'Paars',
];

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

if (isset($_POST['inloggen'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'admin') {
        $_SESSION['ingelogd'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $fout = 'Deze inloggegevens kloppen niet.';
    }
}

if (isset($_SESSION['ingelogd']) && isset($_POST['titel'])) {
    $titel = trim($_POST['titel'] ?? '');
    $omschrijving = trim($_POST['omschrijving'] ?? '');
    $prijs = $_POST['prijs'] ?? '';
    $flavor = $_POST['flavor'] ?? 'kt-roze';

    if ($titel !== '' && $omschrijving !== '' && $prijs !== '') {
        $sql = $connection->prepare("
            INSERT INTO menukaart (titel, omschrijving, prijs, flavor)
            VALUES (:titel, :omschrijving, :prijs, :flavor)
        ");

        $sql->execute([
                ':titel' => $titel,
                ':omschrijving' => $omschrijving,
                ':prijs' => $prijs,
                ':flavor' => $flavor
        ]);

        $melding = 'Gerecht toegevoegd.';
    }
}

if (isset($_SESSION['ingelogd']) && isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $sql = $connection->prepare("DELETE FROM menukaart WHERE id = :id");
    $sql->execute([
            ':id' => $id
    ]);

    header('Location: admin.php');
    exit;
}

$sql = $connection->prepare("SELECT * FROM menukaart ORDER BY id DESC");
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);

function getKleurData($flavor) {
    $bgColor = '#f7c5cf';
    $scoopMain = '#e07090';
    $scoopLight = '#f4a0b5';

    if ($flavor === 'kt-geel') {
        $bgColor = '#f5f0b0';
        $scoopMain = '#e8c030';
        $scoopLight = '#f7e060';
    } elseif ($flavor === 'kt-groen') {
        $bgColor = '#c8e6c0';
        $scoopMain = '#50b860';
        $scoopLight = '#80d890';
    } elseif ($flavor === 'kt-oranje') {
        $bgColor = '#f9d4a8';
        $scoopMain = '#e88030';
        $scoopLight = '#f8b060';
    } elseif ($flavor === 'kt-bruin') {
        $bgColor = '#dfc8bc';
        $scoopMain = '#5c2e0a';
        $scoopLight = '#8b4513';
    } elseif ($flavor === 'kt-creme') {
        $bgColor = '#f0ead6';
        $scoopMain = '#ddd0a0';
        $scoopLight = '#f5f0d0';
    } elseif ($flavor === 'kt-blauw') {
        $bgColor = '#cfe0f6';
        $scoopMain = '#3070c0';
        $scoopLight = '#60a8e8';
    } elseif ($flavor === 'kt-paars') {
        $bgColor = '#e2d2f4';
        $scoopMain = '#8050b8';
        $scoopLight = '#b080e0';
    }

    return [
            'bgColor' => $bgColor,
            'scoopMain' => $scoopMain,
            'scoopLight' => $scoopLight
    ];
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - De Zoete Hoorn</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="nav-inner">
        <span class="logo">🍦 Admin - De Zoete Hoorn</span>
        <ul>
            <li><a href="index.php">Website</a></li>
            <?php if (isset($_SESSION['ingelogd'])): ?>
                <li><a href="admin.php?logout=1" class="nav-admin">Uitloggen</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<section class="admin-sectie">
    <div class="admin-inner">

        <?php if (!isset($_SESSION['ingelogd'])): ?>

            <h2>Admin login</h2>
            <p class="sub">Log in om gerechten te beheren.</p>

            <form method="post" class="admin-form">
                <label>Gebruikersnaam
                    <input type="text" name="username" required>
                </label>

                <label>Wachtwoord
                    <input type="password" name="password" required>
                </label>

                <button type="submit" name="inloggen" class="btn">Inloggen</button>

                <?php if ($fout !== ''): ?>
                    <p class="fout-melding"><?php echo htmlspecialchars($fout); ?></p>
                <?php endif; ?>
            </form>

        <?php else: ?>

            <h2>Nieuw gerecht toevoegen</h2>
            <p class="sub">Vul hieronder een nieuw gerecht in.</p>

            <?php if ($melding !== ''): ?>
                <p class="succes-melding"><?php echo htmlspecialchars($melding); ?></p>
            <?php endif; ?>

            <form method="post" class="admin-form">
                <label>Titel
                    <input type="text" name="titel" required>
                </label>

                <label>Omschrijving
                    <textarea name="omschrijving" rows="4" required></textarea>
                </label>

                <label>Prijs
                    <input type="number" step="0.01" min="0" name="prijs" required>
                </label>

                <label>Kleur
                    <select name="flavor" required>
                        <?php foreach ($kleuren as $waarde => $label): ?>
                            <option value="<?php echo htmlspecialchars($waarde); ?>">
                                <?php echo htmlspecialchars($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <button type="submit" class="btn">Gerecht toevoegen</button>
            </form>

            <div class="admin-overzicht">
                <div class="menu-grid">
                    <?php foreach ($result as $menuitem): ?>
                        <?php
                        $flavor = $menuitem['flavor'] ?? 'kt-roze';
                        $kleurData = getKleurData($flavor);
                        ?>

                        <article class="kaart">
                            <div class="kaart-top" style="background: <?php echo $kleurData['bgColor']; ?>;">
                                <svg viewBox="0 0 90 130" width="78" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <defs>
                                        <radialGradient id="admin-grad-<?php echo (int)$menuitem['id']; ?>" cx="35%" cy="35%">
                                            <stop offset="0%" stop-color="<?php echo $kleurData['scoopLight']; ?>" />
                                            <stop offset="100%" stop-color="<?php echo $kleurData['scoopMain']; ?>" />
                                        </radialGradient>
                                    </defs>

                                    <circle cx="45" cy="34" r="24" fill="url(#admin-grad-<?php echo (int)$menuitem['id']; ?>)"/>
                                    <polygon points="45,52 22,112 68,112" fill="#d89a6f"/>

                                    <line x1="31" y1="72" x2="59" y2="72" stroke="rgba(140,90,50,.35)" stroke-width="1.2"/>
                                    <line x1="28" y1="84" x2="62" y2="84" stroke="rgba(140,90,50,.35)" stroke-width="1.2"/>
                                    <line x1="25" y1="96" x2="65" y2="96" stroke="rgba(140,90,50,.35)" stroke-width="1.2"/>
                                </svg>
                            </div>

                            <div class="kaart-body">
                                <h3><?php echo htmlspecialchars($menuitem['titel']); ?></h3>
                                <p><?php echo htmlspecialchars($menuitem['omschrijving']); ?></p>
                                <span class="prijs">€ <?php echo number_format((float)$menuitem['prijs'], 2, ',', '.'); ?></span>

                                <div class="admin-knoppen">
                                    <a class="btn btn-klein" href="aanpassen.php?id=<?php echo (int)$menuitem['id']; ?>">Aanpassen</a>
                                    <a class="btn btn-klein btn-rood" href="admin.php?delete=<?php echo (int)$menuitem['id']; ?>" onclick="return confirm('Weet je het zeker?')">Verwijderen</a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php endif; ?>

    </div>
</section>

</body>
</html>