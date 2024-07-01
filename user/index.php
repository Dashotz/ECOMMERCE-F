<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0" charset="utf-8">
    <title>Shop.co</title>
    <link rel="stylesheet" href="design.css">    
    <link rel="stylesheet" href="css/nav1.css">    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/249726be58.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <section class="header">
      <?php include("inc/nav.php"); ?>
      <?php include("inc/nav1.php"); ?>
    </section>

    <h1 style="text-align: center;">New Arrivals!</h1>

    <section class="slideshow-container">
      <?php include("inc/slideshow.php"); ?>
    </section>
    
    <section class="services">
      <h1>Categories</h1>
      <div class="row">
        <a href="productpage.php?category=Dry Food" class="services-col">
          <img src="img/category1.jpg" alt="">
          <h1>Dry Food</h1>
        </a>
        <a href="productpage.php?category=Wet Food" class="services-col">
          <img src="img/category2.jpg" alt="">
          <h1>Wet Food</h1>
        </a>
        <a href="productpage.php?category=Treats" class="services-col">
          <img src="img/category3.jpg" alt="">
          <h1>Treats</h1>
        </a>
        <a href="productpage.php?category=Medicine" class="services-col">
          <img src="img/category4.jpg" alt="">
          <h1>Medicine</h1>
        </a>
      </div>
    </section>

    <section class="about-us">
      <div class="row">
        <div class="about-col">
          <h1>EARTHBATH <br> Oatmeal & Aloe Shampoo - Vanilla & Almond</h1>
          <p>
            Purified water, colloidal oatmeal, renewable plant-derived & coconut-based cleansers, organic aloe vera, vitamins A, B, D, & E, panthenol, botanical fragrances of vanilla & almond, preservative.
            <br><br>• Promote healing, and re-moisturize sensitive, dry skin.
            <br><br>• Soap free and pH-balanced.
            <br><br>• Safe for all animals over 6 weeks.
          </p>
        </div>
        <div class="about-col">
          <img src="img/featured.jpg" alt="">
        </div>
      </div>
    </section>

    <section class="services">
      <h1>Featured Products!</h1>
      <div class="row">
        <a href="productview.php" class="services-col">
          <img src="img/product1.jpg" alt="">
          <h3>Puppy Dry Dog Food</h3>
          <span class="star-rating">⭐⭐⭐⭐⭐</span>
          <h3>₱ 290.00</h3>
        </a>
        <a href="productview.php" class="services-col">
          <img src="img/product2.jpg" alt="">
          <h3>3m Retractable Dog Leash</h3>
          <span class="star-rating">⭐⭐⭐⭐</span>
          <h3>₱ 150.00</h3>
        </a>
        <a href="productview.php" class="services-col">
          <img src="img/product3.jpg" alt="">
          <h3>Bowl Fun Feeder</h3>
          <span class="star-rating">⭐⭐⭐</span>
          <h3>₱ 125.00</h3>
        </a>
        <a href="productview.php" class="services-col">
          <img src="img/product4.jpg" alt="">
          <h3>Dog Treats</h3>
          <span class="star-rating">⭐⭐⭐⭐⭐</span>
          <h3>₱ 350.00</h3>
        </a>
      </div>
    </section>

    <section class="cta1">
      <h1>Formulated to support <br> your senior dog!</h1>
      <a href="productview.php" class="hero-btn1">Buy Now!</a>
    </section>

    <section class="review">
      <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
      <div class="elfsight-app-3464a615-98c1-4e2f-9ccd-f9bd95b5bd4b" data-elfsight-app-lazy></div>
    </section>

    <section class="cta">
      <h1>Stay up to date about <br> our latest offers!</h1>
      <a href="contact.php" class="hero-btn">Contact Us!</a>
    </section>

    <?php include("footer.php"); ?>
  </body>
</html>
