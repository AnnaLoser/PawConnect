<?php
session_start();

// Session beenden, damit der Nutzer abgemeldet ist
session_destroy();

header("Location: login.php?logout=1");
exit();
?>
