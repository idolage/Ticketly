<?php
require_once 'includes/dbh.inc.php'; 
require_once 'includes/header.inc.php';
?>

<link rel="stylesheet" href="css/style.css">

<div class="card">
    <div class="card-header bg-primary text-light">
        <h6><strong>Pay Portal</strong></h6>
    </div>
<br>
    <div class="card-body my-auto mx-auto shadow-lg p-3">
        <h2 class="my-4  text-center"><img src="..\Admin\AdminLogin\images\img-01.png" alt="IMG"></h2>
        <form action="includes/charge.inc.php" method="post" id="payment-form" >
            <div class="form-row">
            <input type="text" name="name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="<?php echo $_SESSION['userName']?>" disabled translate="no">
            <input type="text" name="amount" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="LKR <?php echo $_SESSION['price']?>.00" disabled>
            <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="<?php echo $_SESSION['userEmail']?>" disabled translate="no">
                <div id="card-element" class="form-control">
                <!-- a Stripe Element will be inserted here. -->
                </div>
                <!-- Used to display form errors -->
                <div id="card-errors" role="alert"></div>
            </div>
            <button>Submit Payment</button>
        </form>
    </div>
    <br>
    <br>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script src="./js/charge.js"></script>

<?php
require_once 'includes/footer.inc.php';
?>