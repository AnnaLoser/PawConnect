<?php
session_start();
require_once("includes/daten.php");

$pageTitle = "Tiere";
include("includes/header.php");
?>

<h1 class="mb-4">Unsere Tiere</h1>

<div class="row g-4">
    <?php foreach ($animals as $id => $animal) { ?>
        <div class="col-sm-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <img src="<?php echo $animal["image"]; ?>" class="card-img-top animal-img object-fit-cover" alt="Foto von <?php echo $animal["name"]; ?>">
                <div class="card-body">
                    <h2 class="h5 card-title"><?php echo $animal["name"]; ?></h2>
                    <p class="card-text">
                        <?php echo $animal["species"]; ?>, <?php echo $animal["breed"]; ?>, <?php echo $animal["age"]; ?> Jahre
                    </p>
                    <a href="tier.php?id=<?php echo $id; ?>" class="btn btn-paw">Profil ansehen</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php include("includes/footer.php"); ?>
