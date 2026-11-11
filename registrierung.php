<?php
session_start();
require_once("includes/daten.php");

$username = "";
$email = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Eingaben auslesen
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $passwordInput = $_POST["password"] ?? "";
    $passwordRepeat = $_POST["password_repeat"] ?? "";

    // Eingaben prüfen
    if ($username === "") {
        $errors[] = "Bitte gib einen Namen ein.";
    }

    if ($email === "") {
        $errors[] = "Bitte gib eine E-Mail-Adresse ein.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Die E-Mail-Adresse ist ungültig.";
    } elseif (isset($users[$email])) {
        $errors[] = "Mit dieser E-Mail-Adresse gibt es bereits ein Konto.";
    }

    if ($passwordInput === "") {
        $errors[] = "Bitte gib ein Passwort ein.";
    } elseif ($passwordInput !== $passwordRepeat) {
        $errors[] = "Die Passwörter stimmen nicht überein.";
    }

    if (empty($errors)) {
        // Checkbox "Wir betreiben ein Tierheim"
        if (isset($_POST["is_shelter"])) {
            $newRole = "tierheim";
        } else {
            $newRole = "user";
        }

        // Später: Konto mit password_hash() in der Datenbank speichern.
        // Bis dahin wird der neue Nutzer direkt angemeldet.
        $_SESSION["email"] = $email;
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $newRole;

        header("Location: index.php?registered=1");
        exit();
    }
}

$pageTitle = "Registrieren";
include("includes/header.php");
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h3 mb-4">Konto erstellen</h1>

                <?php
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>";
                }
                ?>

                <form method="post" action="registrierung.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Name *</label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="<?php echo htmlspecialchars($username); ?>" required>
                        <div class="form-text">Bei Tierheimen: Name des Tierheims</div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail-Adresse *</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Passwort * (mind. 8 Zeichen)</label>
                        <input type="password" class="form-control" id="password" name="password" minlength="8" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_repeat" class="form-label">Passwort wiederholen *</label>
                        <input type="password" class="form-control" id="password_repeat" name="password_repeat" required>
                    </div>

                    <div class="form-check mb-4">
                        <input type="checkbox" class="form-check-input" id="is_shelter" name="is_shelter">
                        <label for="is_shelter" class="form-check-label">Wir betreiben ein Tierheim</label>
                    </div>

                    <button type="submit" class="btn btn-paw w-100">Registrieren</button>
                </form>

                <p class="mt-3 mb-0 text-center">
                    Schon ein Konto? <a href="login.php">Hier anmelden</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
