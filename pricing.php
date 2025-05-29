<d?php session_start(); ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codema - Pricing</title>
    <link rel="stylesheet" href="styles/homeStyles.css">
    <link rel="icon" type="image/png" href="media/favicon.png">

  </head>

  <body>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");
    ?>
    <main class="container" style="padding: 5rem 0;">
      <!-- Pricing Section -->
      <section id="pricing" class="pricing reveal">
        <h2 class="section-title">Flexible Pricing Plans</h2>
        <p style="text-align: center; max-width: 800px; margin: 0 auto 3rem;">
          We believe in making learning accessible for everyone. Choose the best plan that suits your needs. Whether
          you're just starting or you're aiming for a professional-level experience, we have something for you!
        </p>

        <div class="plans" id="plans">
          <!-- Free Plan -->
          <div class="plan">
            <h3>Free</h3>
            <p class="price">€0</p>
            <div class="data">
              <ul>
                <li>1 simultaneous course</li>
                <li>3 daily lives (recharge every 24 h)</li>
                <li>Community forum access</li>
                <li>Basic streak tracking</li>
                <li>Ad-supported experience</li>
              </ul>
              <a class="btn" href="#">Start Free</a>
            </div>

          </div>

          <!-- Plus Plan -->
          <div class="plan">
            <h3>Plus</h3>
            <p class="price">€9</p>
            <div class="data">
              <ul>
                <li>2 simultaneous courses</li>
                <li>4 daily lives (recharge every 24 h)</li>
                <li>All beginner & intermediate tracks</li>
                <li>Weekly progress reports</li>
                <li>No ads • Monthly webinars</li>
              </ul>
              <a class="btn" href="#">Upgrade to Plus</a>
            </div>
          </div>


          <!-- Pro Plan (recommended) -->
          <div class="plan recommended">
            <h3>Pro</h3>
            <p class="price">€19</p>
            <div class="data">
              <ul>
                <li>4 simultaneous courses</li>
                <li>4 daily lives (recharge every 6 h)</li>
                <li>All tracks & hands‑on projects</li>
                <li>AI code review & personalized study plan</li>
                <li>Priority email support</li>
              </ul>
              <a class="btn" href="#">Upgrade to Pro</a>
            </div>
          </div>

          <!-- Master Plan -->
          <div class="plan">
            <h3>Master</h3>
            <p class="price">€39</p>
            <div class="data">
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
        </div>

        <!-- <div class="plansPhone" id="plansPhone">
        <div class="plan">
          <h3>Free</h3>
          <p class="price">€0</p>
        </div>


        <div class="plan">
          <h3>Plus</h3>
          <p class="price">€9</p>
        </div>

        <div class="plan recommended">
          <h3>Pro</h3>
          <p class="price">€19</p>
        </div>

        <div class="plan">
          <h3>Master</h3>
          <p class="price">€39</p>
        </div>

      </div> -->

        <div class="planData" id="planData">
        </div>
      </section>

      <div class="pricing-info" style="text-align: center; margin-top: 4rem;">
        <h3>Compare Plans</h3>
        <p style="max-width: 900px; margin: 0 auto 3rem;">
          Not sure which plan is right for you? Here's a quick comparison to help you decide.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem;">
          <!-- Comparison Table -->
          <div class="pricing-comparison"
            style="background: var(--primary-color); padding: 2rem; border-radius: 1rem; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);">
            <h4 style="font-size: 1.3rem; margin-bottom: 1rem;">Features</h4>
            <ul style="list-style: none; padding-left: 0; margin-bottom: 2rem;">
              <li><strong>Free Plan:</strong> 1 course, 3 daily lives, ad-supported</li>
              <li><strong>Plus Plan:</strong> 2 courses, 4 daily lives, no ads</li>
              <li><strong>Pro Plan:</strong> 4 courses, AI reviews, priority support</li>
              <li><strong>Master Plan:</strong> Unlimited courses, career services, mentorship</li>
            </ul>
          </div>

          <div class="pricing-comparison"
            style="background: var(--secondary-color); padding: 2rem; border-radius: 1rem; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);">
            <h4 style="font-size: 1.3rem; margin-bottom: 1rem;">Student Discount</h4>
            <p>We offer a 15% discount for students on the Plus, Pro, and Master plans. Simply provide your student ID
              to
              claim this offer.</p>
          </div>
        </div>
      </div>

      <div class="cta" style="background: var(--accent-color); color: var(--text-color); padding: 4rem 2rem;">
        <h2>Ready to start your learning journey?</h2>
        <p>Choose your plan now and start learning programming at your own pace!</p>
        <a href="#pricing" class="btn">Get Started</a>
      </div>
    </main>
    <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
    ?>
  </body>

  <script src="scripts/pricing.js"></script>

  </html>