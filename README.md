# PawConnect

Webanwendung, die Tierliebhaber und Tierheime verbindet (Adoption und Ehrenamt).
Team: Anna Loser, Johannes Guirguis – Web Technologies, FH Technikum Wien.

Technik: HTML, CSS mit Bootstrap 5, PHP. Die Datenbank (MariaDB) wird nach dem Video Milestone angebunden.

## Einrichten

1. Projektordner in `htdocs` von XAMPP bzw. MAMP legen.
2. Fotos der Tiere in den Ordner `img/` legen: `bruno.jpg`, `mila.jpg`, `rocky.jpg`, `luna.jpg`, `hoppel.jpg`.
3. Im Browser `http://localhost/PawConnect/` öffnen (bei MAMP mit Port, z. B. `localhost:8888`).

## Testkonten

| Rolle    | E-Mail                  | Passwort     |
|----------|-------------------------|--------------|
| Admin    | admin@pawconnect.at     | Admin123!    |
| Tierheim | sonnenhof@pawconnect.at | Tierheim123! |
| Nutzer   | mia@pawconnect.at       | User1234!    |

## Stand Video Milestone (ca. 40 %)

Alle Daten stehen vorerst als Arrays in `includes/daten.php`.

| User Story | Dateien |
|---|---|
| Tierprofile ansehen | `tiere.php`, `tier.php` |
| Benutzerkonto erstellen | `registrierung.php` |
| Tierheim-Konto anlegen | `registrierung.php` (Checkbox) |
| Anmelden und abmelden | `login.php`, `logout.php`, `includes/header.php` |
| Tierfoto hochladen | `tier_anlegen.php` |

Noch offen: Datenbank, Tierprofile bearbeiten/löschen, Anfragen senden und verwalten,
Profilseite, Passwort vergessen, Admin Panel.
