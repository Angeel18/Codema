<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codema - Contact </title>
     <link rel="stylesheet" href="styles/homeStyles.css">
     <script src="scripts/contact.js" defer></script>

</head>
<body>
    
   <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");
    ?>
    <main class="container" style="padding: 5rem 0;">
  <section class="contact">
    <h1 class="section-title">Contact Us</h1>
    <p style="text-align: center; max-width: 700px; margin: 0 auto 3rem;">
      We'd love to hear from you! Whether you have a question about our platform, need support, want to share feedback, or just want to say hello — feel free to reach out.
    </p>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 3rem;">
      
      <!-- Contact Form -->
      <form class="contact-form" style="background: var(--primary-color); padding: 2rem; border-radius: 1rem; box-shadow: 0 8px 24px rgba(0,0,0,0.25);">
        <div style="margin-bottom: 1.5rem;">
          <label for="name" style="display: block; margin-bottom: 0.5rem;">Your Name</label>
          <input type="text" id="name" name="name" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: none;">
        </div>
        
        <div style="margin-bottom: 1.5rem;">
          <label for="email" style="display: block; margin-bottom: 0.5rem;">Your Email</label>
          <input type="email" id="email" name="email" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: none;">
        </div>
        
        <div style="margin-bottom: 1.5rem;">
          <label for="message" style="display: block; margin-bottom: 0.5rem;">Message</label>
          <textarea id="message" name="message" rows="5" required style="width: 100%; padding: 0.75rem; border-radius: 0.5rem; border: none;"></textarea>
        </div>
        
        <button type="submit" class="btn">Send Message</button>
      </form>

      <!-- Contact Info -->
      <div style="padding: 1rem 0;">
        <h3 style="margin-bottom: 1rem;">Reach Us</h3>
        <p style="margin-bottom: 1rem;"><strong>Email:</strong> support@codema.fun</p>
        <p style="margin-bottom: 1rem;"><strong>Business Hours:</strong> Monday to Friday, 9:00 AM – 6:00 PM (CET)</p>
        <p style="margin-bottom: 1rem;"><strong>Social Media:</strong></p>
        <ul style="list-style: none; padding-left: 0;">
          <li><a href="https://twitter.com" target="_blank">🐦 Twitter</a></li>
          <li><a href="https://instagram.com" target="_blank">📷 Instagram</a></li>
          <li><a href="https://linkedin.com" target="_blank">💼 LinkedIn</a></li>
        </ul>
        <p style="margin-top: 2rem; font-style: italic; opacity: 0.8;">We typically respond within 24–48 hours.</p>
      </div>
    </div>
  </section>
</main>

   <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
    ?>
</body>
</html>