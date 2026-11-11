<?php
session_start();
require_once("includes/daten.php");

// ID aus der URL lesen, z. B. tier.php?id=3
$id = intval($_GET["id"] ?? 0);

$pageTitle = "Tierprofil";
include("includes/header.php");
?>

<a href="tiere.php" class="d-inline-block mb-3">Zurück zur Übersicht</a>

<?php if (!isset($animals[$id])) { ?>
    <div class="alert alert-warning">Dieses Tier wurde nicht gefunden.</div>
<?php } else {
    $animal = $animals[$id];
?>
    <div class="row g-4">
        <div class="col-md-6">
            <img src="<?php echo $animal["image"]; ?>" class="img-fluid rounded shadow-sm" alt="Foto von <?php echo $animal["name"]; ?>">
        </div>

        <div class="col-md-6">
            <h1><?php echo $animal["name"]; ?></h1>

            <table class="table">
                <tr>
                    <th>Tierart</th>
                    <td><?php echo $animal["species"]; ?></td>
                </tr>
                <tr>
                    <th>Rasse</th>
                    <td><?php echo $animal["breed"]; ?></td>
                </tr>
                <tr>
                    <th>Alter</th>
                    <td><?php echo $animal["age"]; ?> Jahre</td>
                </tr>
                <tr>
                    <th>Tierheim</th>
                    <td><?php echo $animal["shelter"]; ?></td>
                </tr>
            </table>

            <p>
                <?php
                if ($animal["adoption"]) {
                    echo "<span class='badge text-bg-success'>Zur Adoption</span> ";
                }
                if ($animal["volunteering"]) {
                    echo "<span class='badge text-bg-info'>Für Ehrenamt</span>";
                }
                ?>
            </p>

            <h2 class="h5">Beschreibung</h2>
            <p><?php echo $animal["description"]; ?></p>
        </div>
    </div>
<?php } ?>

<?php include("includes/footer.php"); ?>
