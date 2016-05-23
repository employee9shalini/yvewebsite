<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payments using Stripe</title>
</head>
<body>
<h1>Buy Session Credits</h1>
<p>Price: 20.00$</p>


<form action="charge.php" method="POST">

    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"  data-key="pk_test_Fmt7z87bYThhesW1WuWMgFT8"
    data-image="http://yve.ibuildmart.in/images/logo.png"
    data-name="yve.ibuildmart.com"
    data-description="Buy Credits ($20.00)"
    data-amount="2000">
    </script>

    </form>

    </body>
    </html>