<?php
session_start();

$pageTitle = "Startseite";
include("includes/header.php");

if (isset($_GET["registered"])) {
    echo "<div class='alert alert-success'>Dein Konto wurde erstellt und du bist jetzt angemeldet.</div>";
}
?>

<section class="hero text-center mb-5">
    <h1 class="display-5 fw-bold">Willkommen bei PawConnect</h1>
    <p class="lead mb-4">
        PawConnect verbindet Tierliebhaber mit Tierheimen.
        Finde ein neues Familienmitglied oder verbringe ehrenamtlich Zeit mit Tieren.
    </p>
    <a href="tiere.php" class="btn btn-paw btn-lg">Tiere ansehen</a>
</section>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h2 class="h4">Adoption</h2>
                <p class="card-text">
                    Schau dir die Profile der Tiere an, erfahre mehr über Alter, Rasse und Charakter
                    und finde ein Tier, das zu dir passt.
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h2 class="h4">Ehrenamt</h2>
                <p class="card-text">
                    Du kannst kein eigenes Tier halten? Dann geh mit Hunden spazieren
                    oder spiel mit Katzen und unterstütze so ein Tierheim.
                </p>
            </div>
        </div>
    </div>
</div>

<?php if (!isset($_SESSION["email"])) { ?>
    <div class="text-center mt-5">
        <p>Du betreibst ein Tierheim oder möchtest mitmachen?</p>
        <a href="registrierung.php" class="btn btn-outline-secondary">Jetzt registrieren</a>
    </div>
<?php } ?>

<?php include("includes/footer.php"); ?>
