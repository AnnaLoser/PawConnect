<?php
// Testdaten für PawConnect
// Solange es noch keine Datenbank gibt, stehen alle Daten hier in Arrays.
// Später werden diese Daten aus der Datenbank geladen.

// Nutzer: die E-Mail-Adresse ist der Schlüssel
// Die Passwörter sind mit password_hash() gespeichert (Klartext siehe README.md)
$users = [
    "admin@pawconnect.at" => [
        "username" => "Admin",
        "password" => '$2y$10$PZ1tr3gTQHQnaeWYxI1F8uzuVPB92JdBtEvzigTl1hPCBlqgT/FrS',
        "role" => "admin"
    ],
    "sonnenhof@pawconnect.at" => [
        "username" => "Tierheim Sonnenhof",
        "password" => '$2y$10$b9Bsw1V.eFm.uoQ8sdqdK.9dMuKgsHTk16LxBVC2zqf5gmqInbLde',
        "role" => "tierheim"
    ],
    "mia@pawconnect.at" => [
        "username" => "Mia",
        "password" => '$2y$10$8I5a.OznTvvbVvHd1SJu/e5heF/O7epkErmGHMMxLqlhD4xcpA5A6',
        "role" => "user"
    ]
];

// Tiere: die Zahl ist die ID des Tieres (z. B. tier.php?id=1)
$animals = [
    1 => [
        "name" => "Bruno",
        "species" => "Hund",
        "breed" => "Labrador-Mix",
        "age" => 4,
        "description" => "Bruno ist verschmust, versteht sich gut mit anderen Hunden und liebt lange Spaziergänge im Wald.",
        "image" => "img/bruno.jpg",
        "shelter" => "Tierheim Sonnenhof",
        "adoption" => true,
        "volunteering" => true
    ],
    2 => [
        "name" => "Mila",
        "species" => "Katze",
        "breed" => "Europäisch Kurzhaar",
        "age" => 2,
        "description" => "Mila braucht ein paar Tage, bis sie Vertrauen fasst. Danach ist sie sehr anhänglich.",
        "image" => "img/mila.jpg",
        "shelter" => "Tierheim Sonnenhof",
        "adoption" => true,
        "volunteering" => false
    ],
    3 => [
        "name" => "Rocky",
        "species" => "Hund",
        "breed" => "Schäferhund",
        "age" => 7,
        "description" => "Rocky ist ruhig und gelassen. Er freut sich über jeden, der mit ihm spazieren geht.",
        "image" => "img/rocky.jpg",
        "shelter" => "Tierheim Sonnenhof",
        "adoption" => false,
        "volunteering" => true
    ],
    4 => [
        "name" => "Luna",
        "species" => "Katze",
        "breed" => "Maine Coon",
        "age" => 5,
        "description" => "Luna ist neugierig und verspielt. Sie sucht ein Zuhause mit viel Platz zum Klettern.",
        "image" => "img/luna.jpg",
        "shelter" => "Tierheim Pfotenhilfe",
        "adoption" => true,
        "volunteering" => true
    ],
    5 => [
        "name" => "Hoppel",
        "species" => "Kaninchen",
        "breed" => "Zwergkaninchen",
        "age" => 2,
        "description" => "Hoppel ist noch jung und sehr aktiv. Er möchte am liebsten mit einem Partner zusammen vermittelt werden.",
        "image" => "img/hoppel.jpg",
        "shelter" => "Tierheim Pfotenhilfe",
        "adoption" => true,
        "volunteering" => false
    ]
];
?>
