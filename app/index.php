<?php
$connection = new PDO('mysql:host=mysql_db;dbname=Ijssalon;charset=utf8mb4', 'root', 'rootpassword');
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$zoekterm = '';
if (isset($_GET['zoekknop'])) {
    $zoekterm = $_GET['zoekveld'];
    $sql = $connection->prepare("SELECT * FROM menukaart WHERE titel LIKE :filter OR omschrijving LIKE :filter");
    $sql->bindValue(':filter', '%' . $zoekterm . '%');
} else {
    $sql = $connection->prepare("SELECT * FROM menukaart");
}
$sql->execute();
$result = $sql->fetchAll();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>De Zoete Hoorn – IJssalon Nijmegen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="nav-inner">
        <span class="logo">🍦 De Zoete Hoorn</span>
        <ul>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#over">Over ons</a></li>
            <li><a href="#info">Info</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </div>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-tekst">
        <p class="hero-label">Vers · Ambachtelijk · Elke dag open</p>
        <h1>De Zoete Hoorn</h1>
        <p class="hero-sub">Het lekkerste ambachtelijke hoornijsje van Nijmegen — gemaakt met verse ingrediënten en een flinke dosis liefde. Voor groot en klein!</p>
        <a href="#menu" class="btn">Bekijk de menukaart</a>
    </div>
    <div class="hero-ijs" aria-hidden="true">
        <svg viewBox="0 0 200 340" xmlns="http://www.w3.org/2000/svg" width="240">
            <ellipse cx="100" cy="130" rx="62" ry="60" fill="#e8a0ab"/>
            <ellipse cx="70"  cy="115" rx="48" ry="46" fill="#d4839a"/>
            <ellipse cx="115" cy="100" rx="42" ry="40" fill="#f0bac3"/>
            <polygon points="60,175 140,175 100,320" fill="#d89a6f"/>
            <line x1="70"  y1="185" x2="100" y2="318" stroke="#b87a50" stroke-width="1.5"/>
            <line x1="88"  y1="178" x2="100" y2="318" stroke="#b87a50" stroke-width="1.2"/>
            <line x1="112" y1="178" x2="100" y2="318" stroke="#b87a50" stroke-width="1.2"/>
            <line x1="130" y1="185" x2="100" y2="318" stroke="#b87a50" stroke-width="1.5"/>
            <line x1="62"  y1="196" x2="138" y2="196" stroke="#b87a50" stroke-width="1"/>
            <line x1="67"  y1="214" x2="133" y2="214" stroke="#b87a50" stroke-width="1"/>
            <line x1="74"  y1="232" x2="126" y2="232" stroke="#b87a50" stroke-width="1"/>
            <line x1="82"  y1="250" x2="118" y2="250" stroke="#b87a50" stroke-width="1"/>
            <ellipse cx="115" cy="82" rx="22" ry="18" fill="white" opacity=".9"/>
            <circle  cx="115" cy="64" r="10" fill="#e63946"/>
            <line x1="115" y1="54" x2="120" y2="45" stroke="#2d6a4f" stroke-width="2.5" stroke-linecap="round"/>
        </svg>
    </div>
</section>

<!-- OVER ONS -->
<section class="over-ons" id="over">
    <div class="over-inner">
        <div class="over-tekst">
            <h2>Over ons</h2>

            <div class="over-icon-rij">
                <div class="over-icoon roze">🍓</div>
                <div class="over-icoon geel">🌻</div>
                <div class="over-icoon groen">🌿</div>
                <div class="over-icoon oranje">☀️</div>
            </div>

            <p>IJssalon De Zoete Hoorn ligt prachtig aan het Leuvensbroek in Nijmegen, midden in de natuur. Wij geloven dat een goed ijsje meer is dan alleen een traktatie — het is een moment van geluk.</p>
            <p>Onze ijsmeesters werken elke dag met verse, lokale ingrediënten. Geen kunstmatige kleurstoffen, geen goedkope vullers — gewoon eerlijk, lekker ijs. Of je nu kiest voor een klassieke stracciatella of onze seizoensspecial, je proeft het verschil.</p>
            <p>Wij zijn <strong>elke dag open van 11:00 tot 21:00</strong>, ook op feestdagen. Kom langs, ontspan aan het water en geniet van het beste hoornijsje van Nijmegen!</p>
        </div>
        <div class="over-feiten">
            <div class="feit">
                <span class="feit-getal">10+</span>
                <span>jaar open</span>
            </div>
            <div class="feit">
                <span class="feit-getal">20+</span>
                <span>smaken</span>
            </div>
            <div class="feit">
                <span class="feit-getal">100%</span>
                <span>vers dagelijks</span>
            </div>
            <div class="feit">
                <span class="feit-getal">365</span>
                <span>dagen per jaar</span>
            </div>
        </div>
    </div>
</section>

<!-- MENU -->
<section class="sectie" id="menu">
    <div class="sectie-kop">
        <h2>Onze Menukaart</h2>
        <p>Kies jouw favoriete hoornijsje — allemaal vers gemaakt</p>
    </div>

    <form method="get" class="zoek-form-menu">
        <input type="text" name="zoekveld" placeholder="🔍  Zoek een smaak of naam..." value="<?php echo htmlspecialchars($zoekterm); ?>">
        <button type="submit" name="zoekknop" class="btn">Zoeken</button>
    </form>

    <div class="menu-grid">
        <?php foreach ($result as $menuitem): ?>
            <article class="kaart">
                <div class="kaart-top <?php echo htmlspecialchars($menuitem['flavor'] ?? 'kt-creme'); ?>">
                    <div class="ice-icon">
                        <span class="scoop"></span>
                        <div class="cone-wrap">
                            <span class="cone-shape"></span>
                        </div>
                    </div>
                </div>
                <div class="kaart-body">
                    <span class="tag">IJs</span>
                    <h3><?php echo htmlspecialchars($menuitem['titel']); ?></h3>
                    <p><?php echo htmlspecialchars($menuitem['omschrijving']); ?></p>
                    <span class="prijs">€ <?php echo number_format((float)$menuitem['prijs'], 2, ',', '.'); ?> / bol</span>
                </div>
            </article>
        <?php endforeach; ?>
        <?php if (count($result) === 0): ?>
            <p class="geen-resultaat">😕 Geen ijsjes gevonden voor "<?php echo htmlspecialchars($zoekterm); ?>"</p>
        <?php endif; ?>
    </div>
</section>

<!-- INFO & CONTACT -->
<section class="sectie-alt" id="info">
    <div class="info-grid">
        <div class="info-blok">
            <h2>Bezoek ons</h2>
            <div class="uren-tabel">
                <div class="uren-rij">
                    <span>Maandag – Zondag</span>
                    <strong>11:00 – 21:00</strong>
                </div>
                <p class="uren-note">🎉 Elke dag open — ook op feestdagen!</p>
            </div>
            <div class="adres-blok">
                <p>📍 <strong>IJssalon De Zoete Hoorn</strong></p>
                <p>Leuvensbroek, Nijmegen</p>
                <p>📞 024 – 123 4567</p>
                <p>✉️ info@dezoetehoorn.nl</p>
            </div>
            <div class="kaart-wrap">
                <iframe title="Locatie Leuvensbroek Nijmegen"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2472.5!2d5.8494!3d51.8425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c70897a4f41f3b%3A0x400!2sLeuvensbroek%2C+Nijmegen!5e0!3m2!1snl!2snl!4v1711000000000"
                        allowfullscreen loading="lazy"></iframe>
            </div>
        </div>
        <div class="info-blok" id="contact">
            <h2>Stuur ons een bericht</h2>
            <p class="form-intro">Vragen, catering of een verjaardagsreservering? We horen graag van je!</p>
            <form class="form" method="post" action="#">
                <label>Naam<input type="text" name="naam" placeholder="Jouw naam" required></label>
                <label>E-mail<input type="email" name="email" placeholder="jouw@email.nl" required></label>
                <label>Bericht<textarea name="bericht" rows="5" placeholder="Schrijf hier je bericht…" required></textarea></label>
                <button type="submit" class="btn">Verstuur bericht ✉️</button>
            </form>
        </div>
    </div>
</section>

<footer>
    <p>🍦 <strong>De Zoete Hoorn</strong> · Leuvensbroek, Nijmegen · Open elke dag 11:00–21:00</p>
    <p class="footer-sub">Gemaakt met ❤️ en heel veel roomijs · © 2025 De Zoete Hoorn</p>
</footer>

</body>
</html>