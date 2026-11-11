<?php
session_start();
require_once("includes/daten.php");

$email = "";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $passwordInput = $_POST["password"] ?? "";

    if ($email === "" || $passwordInput === "") {
        $errors[] = "Bitte E-Mail-Adresse und Passwort eingeben.";
    }

    if (empty($errors)) {
        // Gibt es einen Nutzer mit dieser E-Mail-Adresse und stimmt das Passwort?
        if (isset($users[$email]) && password_verify($passwordInput, $users[$email]["password"])) {
            // Daten in der Session speichern
            $_SESSION["email"] = $email;
            $_SESSION["username"] = $users[$email]["username"];
            $_SESSION["role"] = $users[$email]["role"];

            header("Location: index.php");
            exit();
        } else {
            $errors[] = "E-Mail-Adresse oder Passwort ist falsch.";
        }
    }
}

$pageTitle = "Anmelden";
include("includes/header.php");
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h1 class="h3 mb-4">Anmelden</h1>

                <?php
                if (isset($_GET["logout"])) {
                    echo "<div class='alert alert-success'>Du wurdest erfolgreich abgemeldet.</div>";
                }

                if (isset($_GET["required"])) {
                    echo "<div class='alert alert-warning'>Bitte melde dich an, um diese Seite zu sehen.</div>";
                }

                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>";
                }
                ?>

                <form method="post" action="login.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail-Adresse</label>
                        <input type="email" class="form-control" id="email" name="email"
                               value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Passwort</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-paw w-100">Anmelden</button>
                </form>

                <p class="mt-3 mb-0 text-center">
                    Noch kein Konto? <a href="registrierung.php">Jetzt registrieren</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
