<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="media/favicon.png">
    <title>Codema - About Us</title>
     <link rel="stylesheet" href="styles/homeStyles.css">

</head>
<body>
       <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");
    ?>
  <!-- Introduction -->
  <section class="hero">
    <div class="hero-copy">
      <h1>About Us</h1>
      <p>
        Codema is a project created by two developers with the mission of making programming education more accessible, practical, and fun for everyone. We believe knowledge should be shared — that’s why we’ve built this free and interactive platform.
      </p>
    </div>
    <img src="https://images.unsplash.com/photo-1637073849667-91120a924221?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Development team">
  </section>
    <main class="container">

  <!-- Mission and Vision -->
  <section class="features">
    <div class="feature-card">
      <h3>Our Mission</h3>
      <p>
        To democratize access to tech education by offering hands-on exercises, clear explanations, and an environment where learning becomes an enjoyable experience.
      </p>
    </div>
    <div class="feature-card">
      <h3>Our Vision</h3>
      <p>
        To become a leading global platform for self-taught programmers, offering high-quality resources and a strong, supportive community.
      </p>
    </div>
  </section>



  <!-- Our Technology -->
  <section class="curriculum">
    <div>
      <h3>What Is Codema Built With?</h3>
      <ul>
        <li>Frontend: HTML, CSS, Vanilla JavaScript</li>
        <li>Backend: PHP + MySQL</li>
        <li>Modern and responsive design with pure CSS</li>
        <li>Original content based on years of experience</li>
        <li>Lightweight architecture for top performance</li>
      </ul>
    </div>
    <img src="https://images.unsplash.com/photo-1669023414162-8b0573b9c6b2?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Technology used">
  </section>

  <!-- Core Values -->
  <section class="features">
    <div class="feature-card">
      <h3>Practicality</h3>
      <p>Hands-on, progressive exercises that help you improve real skills.</p>
    </div>
    <div class="feature-card">
      <h3>Transparency</h3>
      <p>We care about honesty. No tricks, no forced upsells — everything is open and clear.</p>
    </div>
    <div class="feature-card">
      <h3>Passion for Teaching</h3>
      <p>We don’t just write code — we teach how and why it works.</p>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="cta">
    <h2>Ready to start learning to code with us?</h2>
    <a href="/register.html" class="btn">Start for Free</a>
  </section>
</main>


   <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
    ?>
</body>
</html>