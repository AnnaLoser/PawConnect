<?php
// Wird am Anfang jeder Seite eingebunden.
// Vorher muss auf der Seite session_start() aufgerufen und $pageTitle gesetzt werden.

$loggedIn = isset($_SESSION["email"]);
$role = $_SESSION["role"] ?? "";
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?> – PawConnect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-paw">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">PawConnect</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Menü öffnen">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Startseite</a></li>
                <li class="nav-item"><a class="nav-link" href="tiere.php">Tiere</a></li>
                <?php if ($role === "tierheim") { ?>
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Tierheim-Dashboard</a></li>
                <?php } ?>
            </ul>

            <ul class="navbar-nav">
                <?php if ($loggedIn) { ?>
                    <li class="nav-item">
                        <span class="navbar-text me-3">
                            Hallo, <?php echo htmlspecialchars($_SESSION["username"]); ?>
                            <span class="badge bg-light text-dark"><?php echo htmlspecialchars($role); ?></span>
                        </span>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Abmelden</a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Anmelden</a></li>
                    <li class="nav-item"><a class="nav-link" href="registrierung.php">Registrieren</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
