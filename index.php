<?php 

	include 'includes/header.php';



    /*
	 * Retrieve toy information from the database based on the toy ID.
	 * 
	 * @param PDO $pdo       An instance of the PDO class. (PDO = connection between database and PHP)
	 * @param string $id     The ID of the toy to retrieve.
	 * @return array|null    An associative array containing the toy information, or null if no toy is found.
	 */
	function get_all_toys(PDO $pdo) {
		                                                    // SQL query to retrieve toy information based on the toy ID
		$sql = "SELECT * 
			FROM toy";
		                                                    // It's a parameterized query that helps prevent SQL injection attacks and ensures safer interaction with the database

		                                                    // Execute the SQL query using the pdo function and fetch the result
		$toys = pdo($pdo, $sql)->fetchAll();				// Associative array where 'id' is the key and $id is the value. Used to bind the value of $id to the placeholder :id in SQL query.

		return $toys;                                       // Return the toy information (associative array)
	}

	$toys = get_all_toys($pdo);                          // Retrieve info about all toys from the database using provided PDO connection
?>


<section class="toy-catalog">


    <!-- TOY CARD START -->
    <div class="toy-catalog">
		
		<!-- Loop through each toy and display its information -->
  	    <?php foreach ($toys as $toy) : ?>

		<!-- Create a card for each toy -->
        <div class="toy-card">

			<!-- Toy link and image -->
            <a href="toy.php?toynum=<?= $toy['toyID'] ?>">
                <img src="<?= $toy['img_src'] ?>" alt="<?= $toy['name'] ?>">
            </a>

			<!-- Toy name and price -->
            <h2><?= $toy['name'] ?></h2>
            <p>$<?= $toy['price'] ?></p>

        </div>
    <?php endforeach; ?>
    <!-- TOY CARD END -->

	
</section>

<?php include 'includes/footer.php'; ?>
