<?php
session_start();

// Nur angemeldete Tierheime dürfen diese Seite sehen
if (!isset($_SESSION["email"])) {
    header("Location: login.php?required=1");
    exit();
}
if ($_SESSION["role"] !== "tierheim") {
    header("Location: index.php");
    exit();
}

require_once("includes/daten.php");

$pageTitle = "Tierheim-Dashboard";
include("includes/header.php");
?>

<h1 class="mb-3">Tierheim-Dashboard</h1>
<a href="tier_anlegen.php" class="btn btn-paw mb-4">Neues Tier anlegen</a>

<h2 class="h4 mb-3">Meine Tiere</h2>

<table class="table bg-white">
    <tr>
        <th>Foto</th>
        <th>Name</th>
        <th>Tierart</th>
        <th>Alter</th>
    </tr>
    <?php
    $count = 0;
    foreach ($animals as $id => $animal) {
        // Nur die Tiere des angemeldeten Tierheims anzeigen
        if ($animal["shelter"] === $_SESSION["username"]) {
            $count++;
            echo "<tr>";
            echo "<td><img src='" . $animal["image"] . "' alt='Foto' width='60'></td>";
            echo "<td><a href='tier.php?id=" . $id . "'>" . $animal["name"] . "</a></td>";
            echo "<td>" . $animal["species"] . "</td>";
            echo "<td>" . $animal["age"] . " Jahre</td>";
            echo "</tr>";
        }
    }
    ?>
</table>

<?php
if ($count === 0) {
    echo "<div class='alert alert-info'>Du hast noch keine Tiere angelegt.</div>";
}

include("includes/footer.php");
?>
