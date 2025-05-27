<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Codema – Learn to code daily with interactive challenges, gamified streaks and a supportive community.">
  <title>Codema – Learn to Code Daily</title>
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
    <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=900&q=80"
      alt="Woman coding on laptop">
  </section>
  <!-- Logos -->
  <section class="logos reveal">
    <div class="section-title">Trusted by learners at</div>
    <div class="logo-wrap">
      <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" alt="Microsoft">
      <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/Google_Logo.svg" alt="Google">
      <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" alt="Amazon">
      <img src="https://upload.wikimedia.org/wikipedia/commons/1/17/IBM_logo_in.jpg" alt="IBM">
      <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Logo_Tesla.svg" alt="Tesla">
    </div>
  </section>
  <!-- Features -->
  <section id="features" class="features reveal">
    <div class="feature-card">
      <h3>Interactive challenges</h3>
      <p>Code directly in your browser and see results instantly.</p>
    </div>
    <div class="feature-card">
      <h3>Daily streaks & XP</h3>
      <p>Earn XP, unlock badges and keep your motivation high.</p>
    </div>
    <div class="feature-card">
      <h3>Personalized paths</h3>
      <p>Courses adapt to your pace and goals.</p>
    </div>
    <div class="feature-card">
      <h3>Community support</h3>
      <p>Ask questions and collaborate worldwide.</p>
    </div>
  </section>
  <!-- Tracks -->
  <section id="tracks" class="tracks reveal">
    <h2 class="section-title">Choose your learning track</h2>
    <div class="tracks-grid">
      <div class="track"><img
          src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=900&q=80" alt="Web dev">
        <div class="track-content">
          <h4>Full-Stack Web Dev</h4>
          <p>HTML, CSS, JS, React, Node & more.</p>
        </div>
      </div>
      <div class="track"><img
          src="https://images.unsplash.com/photo-1581091012184-5cbf53d899d0?auto=format&fit=crop&w=900&q=80"
          alt="Data Science">
        <div class="track-content">
          <h4>Data Science</h4>
          <p>Python, Pandas, SQL & ML.</p>
        </div>
      </div>
      <div class="track"><img
          src="https://images.unsplash.com/photo-1557432401-b646b5af6c6c?auto=format&fit=crop&w=900&q=80"
          alt="Mobile Apps">
        <div class="track-content">
          <h4>Mobile Apps</h4>
          <p>Flutter & React Native.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Curriculum -->
  <section class="curriculum reveal">
    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=900&q=80"
      alt="Curriculum preview">
    <div>
      <h3>Dive into a career-ready curriculum</h3>
      <ul>
        <li>200+ bite-sized lessons</li>
        <li>Hands-on projects</li>
        <li>Mini-quizzes</li>
        <li>Weekly webinars</li>
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