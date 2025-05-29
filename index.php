<?php
session_start();
if (isset($_SESSION['is_superuser'])) {
session_destroy();
session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Codema – Learn to code daily with interactive challenges, gamified streaks and a supportive community.">
  <title>Codema – Learn to Code Daily</title>
  <link rel="icon" type="image/png" href="media/favicon.png">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/homeStyles.css">
</head>

<body>
  <!-- Header -->

    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");
    ?>
  <!-- Hero -->
  <section class="hero reveal">
    <div class="hero-copy">
      <h1>Master coding in bite-sized lessons.</h1>
      <p>Interactive challenges, real-time feedback and gamified streaks that turn learning into a daily habit.</p>
      <a class="btn" href="#pricing">Start Free Today</a>
      <a class="btn-outline" href="#">Book a Demo</a>
    </div>
    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/24ed9392232693.5e45b4885aef5.jpg"
      alt="Technology picture">
  </section>
  <main class="container">

  <!-- Features -->
  <section id="features" class="features reveal">
    <div class="feature-card">
      <h3>Interactive challenges</h3>
      <p>Code directly in your browser whether in ur computer or your phone and see results instantly.</p>
    </div>
    <div class="feature-card">
      <h3>Daily streaks & XP</h3>
      <p>Earn XP, unlock badges and keep your motivation high trying to pass other users.</p>
    </div>
    <div class="feature-card">
      <h3>Personalized paths</h3>
      <p>Courses adapt to your pace and goals, no need to rush while learning.</p>
    </div>
    <div class="feature-card">
      <h3>Community support</h3>
      <p>Ask questions and collaborate worldwide just a few clicks away.</p>
    </div>
  </section>
  <!-- Logos -->
  <section class="logos reveal">
    <div class="section-title">In colaboration with</div>
    <div class="logo-wrap">
      <img src="https://digitechfp.com/wp-content/uploads/2024/09/HZN-03-SIN-CAJA-CIAN-RGB@2x.png" alt="Digitech">
    </div>
  </section>
  <!-- Tracks -->
  <section id="tracks" class="tracks reveal">
    <h2 class="section-title">Choose your learning track</h2>
    <p style="text-align: center;">Choose what do you wanna learn, there are no obstacles in your way</p>
    <div class="tracks-grid">
      <div class="track"><img
          src="https://kinsta.com/es/wp-content/uploads/sites/8/2021/12/front-end-developer.png" alt="Web dev">
        <div class="track-content">
          <h4>Front-end developer</h4>
          <p>HTML, CSS, JS, React & more.</p>
        </div>
      </div>
      <div class="track"><img
          src="https://kinsta.com/es/wp-content/uploads/sites/8/2021/12/back-end-developer.png"
          alt="Back-end dev">
        <div class="track-content">
          <h4>Back-end developer</h4>
          <p>Python, PHP, SQL & more.</p>
        </div>
      </div>
      <div class="track"><img
          src="https://kinsta.com/es/wp-content/uploads/sites/8/2021/12/what-is-a-full-stack-developer.png"
          alt="Full-stack dev">
        <div class="track-content">
          <h4>Full-stack developer</h4>
          <p>Front-end y back-end: HTML, CSS, JS, Python, SQL, React & más.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Curriculum -->
  <section class="curriculum reveal">
    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
      alt="Curriculum preview">
    <div style="display:grid; gap: 1rem; justify-items: start ;width:100%;" id="curriculum-content">
      <h3>Get ready for todays programming</h3>
      <ul>
        <li>200+ different exercises</li>
        <li>See instant results of your code</li>
        <li>Mini-quizzes</li>
        <li>Daily challenges</li>
        <li>AI chatbot integrated</li>
      </ul><a class="btn" href="#pricing">See Pricing</a>
    </div>
  </section>
  <!-- Testimonials -->
  <section class="testimonials reveal">
    <h2>Success stories</h2>
    <div class="testimonial-wrap">
      <div class="testimonial"><img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah">
        <p>“I landed my first developer job in 6 months!”</p>
        <h4>Sarah • Front‑End Dev</h4>
      </div>
      <div class="testimonial"><img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos">
        <p>“My 120‑day streak skyrocketed my skills.”</p>
        <h4>Carlos • Data Analyst</h4>
      </div>
      <div class="testimonial"><img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Ava">
        <p>“Best learning experience ever.”</p>
        <h4>Ava • CS Student</h4>
      </div>
    </div>
  </section>
  <!-- Pricing -->
  <section id="pricing" class="pricing reveal">
    <h2 class="section-title">Flexible pricing</h2>
    <div class="plans">
    <!-- Free Plan -->
    <div class="plan">
      <h3>Free</h3>
      <p class="price">€0</p>
      <ul>
        <li>1 simultaneous course</li>
        <li>3 daily lives (recharge every 24 h)</li>
        <li>Community forum access</li>
        <li>Basic streak tracking</li>
        <li>Ad‑supported experience</li>
      </ul>
      <a class="btn" href="#">Start Free</a>
    </div>

    <!-- Plus Plan -->
    <div class="plan">
      <h3>Plus</h3>
      <p class="price">€9</p>
      <ul>
        <li>2 simultaneous courses</li>
        <li>4 daily lives (recharge every 24 h)</li>
        <li>All beginner & intermediate tracks</li>
        <li>Weekly progress reports</li>
        <li>No ads • Monthly webinars</li>
      </ul>
      <a class="btn" href="#">Upgrade to Plus</a>
    </div>

    <!-- Pro Plan (recommended) -->
    <div class="plan recommended">
      <h3>Pro</h3>
      <p class="price">€19</p>
      <ul>
        <li>4 simultaneous courses</li>
        <li>4 daily lives (recharge every 6 h)</li>
        <li>All tracks & hands‑on projects</li>
        <li>AI code review & personalized study plan</li>
        <li>Priority email support</li>
      </ul>
      <a class="btn" href="#">Upgrade to Pro</a>
    </div>

    <!-- Master Plan -->
    <div class="plan">
      <h3>Master</h3>
      <p class="price">€39</p>
      <ul>
        <li>Unlimited courses</li>
        <li>5 lives (recharge every 2 h)</li>
        <li>1‑on‑1 mentorship (monthly)</li>
        <li>Career services & interview prep</li>
        <li>Exclusive masterclasses & certificate</li>
      </ul>
      <a class="btn" href="#">Become Master</a>
    </div>
  </div>
  </section>
  <!-- CTA -->
  <section class="cta reveal">
    <h2>Ready to start coding your future?</h2><a class="btn" href="#pricing">Create Your Free Account</a>
  </section>
</main>
  <!-- Newsletter -->
  <section id="newsletter" class="newsletter reveal">
    <h2>Get tips & free mini‑lessons</h2>
    <form><input type="email" placeholder="you@example.com" required><button class="btn">Subscribe</button></form>
    <p>No spam. Unsubscribe anytime.</p>
  </section>
  <!-- FAQ -->
  <section id="faq" class="faq reveal">
    <h2 class="section-title">Frequently Asked Questions</h2>
    <div class="faq-item">
      <h4>Do I need prior experience?</h4>
      <p>No—beginner‑friendly tracks guide you step‑by‑step.</p>
    </div>
    <div class="faq-item">
      <h4>Can I cancel anytime?</h4>
      <p>Yes. Downgrade or cancel in one click.</p>
    </div>
    <div class="faq-item">
      <h4>Student discount?</h4>
      <p>Verify a student email for 35% off.</p>
    </div>
    <div class="faq-item">
      <h4>Payment methods?</h4>
      <p>Visa, MasterCard, AmEx, PayPal, SEPA.</p>
    </div>
  </section>
  <!-- Footer -->
      <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
    ?>
  <!-- Scroll to top -->
  <button class="scroll-top" aria-label="scroll back to top">▲</button>
  <script src="scripts/script.js"></script>
</body>

</html>