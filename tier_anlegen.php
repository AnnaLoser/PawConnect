<?php
session_start();

// Nur angemeldete Tierheime dürfen Tiere anlegen
if (!isset($_SESSION["email"])) {
    header("Location: login.php?required=1");
    exit();
}
if ($_SESSION["role"] !== "tierheim") {
    header("Location: index.php");
    exit();
}

$speciesList = ["Hund", "Katze", "Kaninchen", "Sonstiges"];
$acceptedtype = ["jpg", "jpeg", "png", "webp"];

$name = "";
$species = "";
$breed = "";
$age = "";
$description = "";
$errors = [];
$target_file = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Eingaben auslesen
    $name = trim($_POST["name"] ?? "");
    $species = $_POST["species"] ?? "";
    $breed = trim($_POST["breed"] ?? "");
    $age = trim($_POST["age"] ?? "");
    $description = trim($_POST["description"] ?? "");

    // Eingaben prüfen
    if ($name === "") {
        $errors[] = "Bitte gib einen Namen ein.";
    }
    if (!in_array($species, $speciesList)) {
        $errors[] = "Bitte wähle eine Tierart aus.";
    }
    if ($breed === "") {
        $errors[] = "Bitte gib eine Rasse ein.";
    }
    if ($age === "" || intval($age) < 0) {
        $errors[] = "Bitte gib ein gültiges Alter ein.";
    }
    if ($description === "") {
        $errors[] = "Bitte gib eine Beschreibung ein.";
    }
    if (!isset($_POST["for_adoption"]) && !isset($_POST["for_volunteering"])) {
        $errors[] = "Bitte wähle Adoption und/oder Ehrenamt aus.";
    }

    // Foto prüfen
    if (empty($_FILES["picture"]["name"])) {
        $errors[] = "Bitte lade ein Foto hoch.";
    } else {
        $uploadExt = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));

        if (!in_array($uploadExt, $acceptedtype)) {
            $errors[] = "Nur Bilder im Format JPG, PNG oder WebP sind erlaubt.";
        }
        if ($_FILES["picture"]["size"] > 5000000) {
            $errors[] = "Das Foto darf höchstens 5 MB groß sein.";
        }
    }

    // Wenn alles passt: Foto im Ordner uploads speichern
    if (empty($errors)) {
        // Timestamp im Dateinamen, damit keine Datei überschrieben wird
        $date = new DateTime();
        $timestamp = $date->getTimestamp();
        $target_dir = "uploads/";
        $target_file = $target_dir . "tier_" . $timestamp . "." . $uploadExt;

        if (!move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            $errors[] = "Beim Hochladen des Fotos ist ein Fehler aufgetreten.";
            $target_file = "";
        }
        // Später: Tier zusätzlich in der Datenbank speichern
    }
}

$pageTitle = "Neues Tier anlegen";
include("includes/header.php");
?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <a href="dashboard.php" class="d-inline-block mb-3">Zurück zum Dashboard</a>

        <?php if ($target_file !== "") { ?>
            <!-- Erfolgreich hochgeladen: Vorschau des neuen Tierprofils -->
            <div class="alert alert-success">Das Foto wurde hochgeladen.</div>

            <div class="card shadow-sm mb-4">
                <img src="<?php echo $target_file; ?>" class="card-img-top animal-img object-fit-cover" alt="Foto von <?php echo htmlspecialchars($name); ?>">
                <div class="card-body">
                    <h2 class="h5"><?php echo htmlspecialchars($name); ?></h2>
                    <p class="card-text">
                        <?php echo htmlspecialchars($species); ?>, <?php echo htmlspecialchars($breed); ?>, <?php echo intval($age); ?> Jahre
                    </p>
                    <p class="card-text"><?php echo htmlspecialchars($description); ?></p>
                </div>
            </div>

            <a href="tier_anlegen.php" class="btn btn-paw">Weiteres Tier anlegen</a>
        <?php } else { ?>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h3 mb-4">Neues Tier anlegen</h1>

                <?php
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>";
                }
                ?>

                <form method="post" action="tier_anlegen.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="name" name="name"
                               value="<?php echo htmlspecialchars($name); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="species" class="form-label">Tierart *</label>
                        <select class="form-select" id="species" name="species" required>
                            <option value="">Bitte wählen</option>
                            <option value="Hund">Hund</option>
                            <option value="Katze">Katze</option>
                            <option value="Kaninchen">Kaninchen</option>
                            <option value="Sonstiges">Sonstiges</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="breed" class="form-label">Rasse *</label>
                        <input type="text" class="form-control" id="breed" name="breed"
                               value="<?php echo htmlspecialchars($breed); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Alter in Jahren *</label>
                        <input type="number" class="form-control" id="age" name="age" min="0"
                               value="<?php echo htmlspecialchars($age); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Beschreibung *</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($description); ?></textarea>
                    </div>

                    <p class="mb-1">Verfügbar für *</p>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="for_adoption" name="for_adoption">
                        <label for="for_adoption" class="form-check-label">Adoption</label>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="for_volunteering" name="for_volunteering">
                        <label for="for_volunteering" class="form-check-label">Ehrenamt (z. B. Spazierengehen, Spielen)</label>
                    </div>

                    <div class="mb-4">
                        <label for="picture" class="form-label">Foto * (JPG, PNG oder WebP, max. 5 MB)</label>
                        <input type="file" class="form-control" id="picture" name="picture"
                               accept="image/jpeg, image/png, image/webp" required>
                    </div>

                    <button type="submit" class="btn btn-paw w-100">Tier speichern</button>
                </form>
            </div>
        </div>

        <?php } ?>
    </div>
</div>

<?php include("includes/footer.php"); ?>
