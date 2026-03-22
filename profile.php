<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'includes/header.php';


            
	require_login($logged_in);                              // Redirect user if not logged in
	$username = $_SESSION['username'];                      // Retrieve the username from the session data
    $custID   = $_SESSION['custID'];                        // Retrieve the custID from the session data



    /* Create a function that retrieves ALL order information for the logged-in user 

              Your function should:
                1. Query the appropriate tables to retrieve:
                    - order information
                    - toy name
                    - toy image
                    Make sure to sort the results in descending order (most recent first)
                2. Execute the SQL query using the pdo() helper function and fetch the results
                3. Return orders for the logged-in user only
	*/
    function get_orders_by_user($pdo, $custID) {
        // Query to retrieve order information, toy name, and toy image for the logged-in user
        $sql = "SELECT *
                FROM orders o
                JOIN toy t ON o.toyID = t.toyID
                WHERE o.custID = :custID
                ORDER BY o.date_ordered DESC";

        // Execute query and fetch results
        $stmt = pdo($pdo, $sql, ['custID' => $custID]);
        return $stmt->fetchAll();
    }



    /* Call function to retrieve orders for the logged-in user */
    $orders = get_orders_by_user($pdo, $custID);

	
?>

<main class="container profile-page">

    <h1>Welcome, <?= htmlspecialchars($username) ?>!</h1>

    <!-- Check if no orders were returned from the database -->
    <?php if (!$orders) : ?>
        <div class="no-orders">
            <p>You have no orders yet.</p>
        </div>

    <!-- Otherwise (order data was returned) -->
    <?php else : ?>
        <div class="orders-container">

            <!-- Loop through each order returned from the database -->
            <?php foreach ($orders as $order) : ?>

                <div class="order-card">

                    <!-- Display the toy image and update the alt text to the toy name -->
                    <img src="<?= $order['img_src'] ?>" alt="<?= $order['name'] ?>">

                    <div class="order-info">

                        <!--  Display the order number -->
                        <p><strong>Order Number:</strong> <?= $order['orderID'] ?></p>

                        <!--  Display the toy name -->
                        <p><strong>Toy:</strong> <?= $order['name'] ?></p>

                        <!--  Display the order quantity -->
                        <p><strong>Quantity:</strong> <?= $order['quantity'] ?></p>

                        <!--  Display the date ordered -->
                        <p><strong>Date Ordered:</strong> <?= $order['date_ordered'] ?></p>

                        <!--  Display the delivery address -->
                        <p><strong>Delivery Address:</strong> <?= $order['deliv_addr'] ?></p>

                        <!--  Display the delivery date
                                    Hint: If the delivery date is NULL, use the null-coalescing operator to display a placeholder message like "Pending"
                         -->
                        <p><strong>Delivery Date:</strong> <?= $order['date_deliv'] ?? 'Pending' ?></p>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</main>

<?php include 'includes/footer.php'; ?>