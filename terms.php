<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="media/favicon.png">

    <title>Codema - Service Agreement</title>
  <link rel="stylesheet" href="styles/homeStyles.css">

    <style>
        :root {
            --primary-color: #292653;
            --secondary-color: #709ad0;
            --background-color: #222842;
            --header-footer-bg: #191f3b;
            --text-color: #ffffff;
            --accent-color: #6812b8;
            --success-color: #6f7eff;
        }

        /* Base styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', 'Segoe UI', 'Inter', sans-serif;
            background: var(--background-color);
            color: var(--text-color);
            line-height: 1.7;
        }

        .container {
            width: min(90%, 1200px);
            margin-inline: auto;
            padding: 2rem 0;
        }

        h1, h2, h3, h4 {
            color: var(--secondary-color);
            margin-bottom: 1rem;
        }

        h1 {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
        }

        h1::after {
            content: '';
            display: block;
            width: 100px;
            height: 4px;
            background: var(--accent-color);
            margin: 1rem auto;
            border-radius: 2px;
        }

        h2 {
            font-size: 1.8rem;
            margin-top: 2.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid rgba(112, 154, 208, 0.2);
        }

        p {
            margin-bottom: 1.2rem;
        }

        a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: opacity 0.2s;
        }

        a:hover {
            opacity: 0.8;
        }

        ul {
            margin-left: 1.5rem;
            margin-bottom: 1.5rem;
        }

        li {
            margin-bottom: 0.5rem;
            position: relative;
        }

        section {
            margin-bottom: 3rem;
            background: rgba(41, 38, 83, 0.3);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s;
        }

        section:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.2);
        }

        strong {
            color: var(--secondary-color);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
            
            section {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "/header.php");
  ?>

  <main class="container">
    <h1>Service Agreement</h1>

    <section>
      <h2>1. OBJECT</h2>
      <p>
        This agreement establishes the terms under which Codema provides access to its educational platform for learning programming languages, including interactive features, daily exercises, and gamification systems.
      </p>
    </section>

    <section>
      <h2>2. SCOPE OF SERVICE</h2>
      <p><strong>Basic Features:</strong></p>
      <ul>
        <li>Access to programming exercises in languages such as Java, JavaScript, Python, HTML, CSS, and PHP.</li>
        <li>Progress tracking and ranking system.</li>
        <li>Daily challenges and statistics monitoring.</li>
      </ul>
      <p><strong>Premium Plans:</strong></p>
      <ul>
        <li>Advanced content, mentoring, and priority support (depending on the subscribed plan).</li>
      </ul>
      <p><strong>Technical Support:</strong></p>
      <ul>
        <li>Email assistance at <a href="mailto:codemacademy74@gmail.com">codemacademy74@gmail.com</a> for technical issues.</li>
      </ul>
    </section>

    <section>
      <h2>3. PROVIDER OBLIGATIONS</h2>
      <p><strong>Availability:</strong></p>
      <ul>
        <li>Guarantee 95% monthly uptime, excluding scheduled maintenance (with 24-hour advance notice).</li>
      </ul>
      <p><strong>Security:</strong></p>
      <ul>
        <li>Data protection compliant with LOPD and GDPR regulations.</li>
        <li>Use of HTTPS, weekly backups, and DDoS protection (Cloudflare).</li>
      </ul>
      <p><strong>Updates:</strong></p>
      <ul>
        <li>Periodic implementation of improvements and bug fixes.</li>
      </ul>
    </section>

    <section>
      <h2>4. USER OBLIGATIONS</h2>
      <p><strong>Registration:</strong></p>
      <ul>
        <li>Provide truthful information and keep access credentials secure.</li>
      </ul>
      <p><strong>Proper Use:</strong></p>
      <ul>
        <li>Unauthorized system access, spam, or illegal activities are prohibited.</li>
      </ul>
      <p><strong>Payments (premium plans):</strong></p>
      <ul>
        <li>Pay subscription fees according to published rates (Free, Plus, Pro, Master).</li>
      </ul>
    </section>

    <section>
      <h2>5. PRIVACY POLICY</h2>
      <p>
        Personal data will be handled according to our Privacy Policy.
      </p>
      <p>
        Users can exercise their ARCO rights (Access, Rectification, Cancellation, Opposition) by sending a request to the Provider's email.
      </p>
    </section>

    <section>
      <h2>6. INTELLECTUAL PROPERTY</h2>
      <p>
        The design, platform structure, gamification system, and all proprietary Codema elements are protected by intellectual property rights and belong to Codema or its licensors.
      </p>
      <p>
        Exercises and educational content available on the platform may include third-party material shared under open licenses or authorized use. Codema does not claim exclusive ownership of such exercises and always respects the usage conditions established by the original authors.
      </p>
      <p>
        Unauthorized reproduction, distribution, or commercialization of platform content is prohibited unless expressly permitted by third-party licenses.
      </p>
    </section>

    <section>
      <h2>7. LIMITATION OF LIABILITY</h2>
      <ul>
        <li>Codema does not guarantee specific learning outcomes.</li>
        <li>Not responsible for indirect damages resulting from platform use.</li>
      </ul>
    </section>

    <section>
      <h2>8. DURATION AND TERMINATION</h2>
      <ul>
        <li>Free plans: No commitment required.</li>
        <li>Paid plans: Automatic monthly/annual renewal. Users may cancel via their control panel.</li>
        <li>Codema reserves the right to suspend accounts for terms violations.</li>
      </ul>
    </section>

    <section>
      <h2>9. INCIDENTS AND SUPPORT</h2>
      <p><strong>Reporting protocol:</strong></p>
      <ul>
        <li>Send incidents to <a href="mailto:codemacademy74@gmail.com">codemacademy74@gmail.com</a> with:</li>
        <ul>
          <li>Detailed description</li>
          <li>Steps to reproduce the error</li>
          <li>Screenshots (optional)</li>
        </ul>
        <li>Classification and response within 72 hours maximum</li>
      </ul>
    </section>

    <section>
      <h2>10. ACCEPTANCE OF TERMS</h2>
      <p>
        Registering on the platform implies full acceptance of this agreement.
      </p>
    </section>

    <p style="text-align: center; margin-top: 3rem; opacity: 0.8;">Codema</p>
  </main>

  <?php
  require_once($_SERVER['DOCUMENT_ROOT'] . "/footer.html");
  ?>

</body>
</html>