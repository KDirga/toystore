<?php

    include 'includes/header.php';



    // Retrieve the value of the 'toynum' parameter from the URL query string
	//          Example URL: .../toy.php?toynum=0001
	$toy_id = $_GET['toynum'];



    // Function that retrieves ALL toy and manufacturer information 
    function getToyInfo(PDO $pdo, string $toy_id) {
        // Query to retrieve information
        $sql = "SELECT * 
        FROM toy
        JOIN manuf
                ON toy.manID = manuf.manID 
        WHERE toy.toyID = :toy_id";

        // Execute the query and return the result
        $toy_info = pdo($pdo, $sql, ['toy_id' => $toy_id])->fetch();
        return $toy_info;
    }

    // Call function to retrieve toy information
    $toy_info = getToyInfo($pdo, $toy_id);

?>

<section class="toy-details-page container">
    <div class="toy-details-container">
        <div class="toy-image">

            <!-- TO-DO: Display the toy image and update the alt text to the toy name -->
            <img src="<?= $toy_info['img_src'] ?>" alt="<?= $toy_info['name'] ?>">

        </div>

        <div class="toy-details">

            <!-- Display the toy name -->
            <h1><?= $toy_info['name'] ?></h1>

            <h3>Toy Information</h3>

            <!-- Display the toy description -->
            <p><strong>Description:</strong> <?= $toy_info['description'] ?></p>

            <!-- Display the toy price -->
            <p><strong>Price:</strong> $ <?= $toy_info['price'] ?></p>

            <!-- Display the toy age range -->
            <p><strong>Age Range:</strong> <?= $toy_info['age_range'] ?></p>

            <!-- Display stock of toy -->
            <p><strong>Number In Stock:</strong> <?= $toy_info['in_stock'] ?></p>

            <br />

            <h3>Manufacturer Information</h3>

            <!-- Display the manufacturer name -->
            <p><strong>Name:</strong> <?= $toy_info['name'] ?> </p>

            <!-- Display the manufacturer address -->
            <p><strong>Address:</strong> <?= $toy_info['street'] ?>, <?= $toy_info['city'] ?>, <?= $toy_info['state'] ?> <?= $toy_info['zip'] ?></p>

            <!-- Display the manufacturer phone -->
            <p><strong>Phone:</strong> <?= $toy_info['phone'] ?></p>

            <!-- Display the manufacturer contact -->
            <p><strong>Contact:</strong> <?= $toy_info['contact'] ?></p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>