<?php 
  // 1. Retrieve form data
  $nameInput = isset($_POST['nameInput']) ? $_POST['nameInput'] : "";
  $membership = isset($_POST['membership']) ? $_POST['membership'] : "";
  $yoga = isset($_POST['yoga']) ? $_POST['yoga'] : "";
  $karate = isset($_POST['karate']) ? $_POST['karate'] : "";
  $personalTrainer = isset($_POST['personalTrainer']) ? $_POST['personalTrainer'] : "";
  $membershipDuration = isset($_POST['membershipDuration']) ? (int) $_POST['membershipDuration'] : 0;

  // 2. Define Constants for membership
  define('ADULT', 40);
  define('CHILD', 20);
  define('STUDENT', 25);
  define('SENIOR', 30);

  // 3. Define Constants for options
  define('YOGA', 10);
  define('KARATE', 30);
  define('PTRAINER', 50);

  // 4. Basic Calculation
  switch($membership) {
    case 'adult':
      $monthlyFee = ADULT;
      break;
    case 'child':
      $monthlyFee = CHILD;
      break;
    case 'student':
      $monthlyFee = STUDENT;
      break;
    case 'senior':
      $monthlyFee = SENIOR;
      break;
    default: 
      $monthlyFee = 0;  
  }

  if($yoga) $monthlyFee += YOGA;
  if($karate) $monthlyFee += KARATE;
  if($personalTrainer) $monthlyFee += PTRAINER;

  $total = $membershipDuration * $monthlyFee;

  // Format currency
  function FormatCurrency($amount) {
    return '$' . number_format($amount, 2);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Summary - Membership Fee Calculator</title>
  <link rel="stylesheet" href="css/process-order.css">
</head>
<body>
  <?php 
    if($membershipDuration < 1 || $membershipDuration > 24) {
      echo '<script>alert("Membership duration must be between 1 and 24 months"); window.history.back();</script>';
      exit;
    }   
  ?>
  <div class="container">
    <p>Customer Name: <strong><?= htmlspecialchars($nameInput) ?></strong></p>
      <p>Membership: <strong><?= ucfirst(htmlspecialchars($membership)) ?></strong></p>

      <p>Optional Membership</p>
      <ul>
        <?php if($yoga): ?>
          <li>Yoga ($10.00 / Month)</li>
        <?php endif; ?>

        <?php if($karate): ?>
          <li>Karate ($30.00 / Month)</li>
        <?php endif; ?>

        <?php if($personalTrainer): ?>
          <li>Personal Trainer ($50.00 / Month)</li>
        <?php endif; ?>
        
        <?php if(!$yoga && !$karate && !$personalTrainer): ?>
          <li>None</li>
        <?php endif; ?> 

      </ul>

    <p>MONTHLY FEE: <?= FormatCurrency($monthlyFee) ?></p>
    <p>TOTAL: <?= FormatCurrency($total) ?></p>
  </div> 
</body>
</html>