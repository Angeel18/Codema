<header class="reveal">
  <a href="/" class="logo">Codema</a>

    <button class="hamburger" id="hamburger">
      <span class="hamburger-box"></span>
      <span class="hamburger-box"></span>
      <span class="hamburger-box"></span>
    </button>

  <nav class="nav-container">
    <ul class="nav-list">
      <?php if (isset($_SESSION['id_user'])): ?>
        <li><a href="/exercises/selectorView">Exercises</a></li>
        <li><a href="/courses">Courses</a></li>

        <li><a href="/progress">My progress</a></li>
        <li><a href="/monthlyRanking">Monthly Ranking</a></li>
        <li><a href="/pruebaDailyConAPI/cargarEx.php">Daily Challenge</a></li>
        <li>
          <a href="/logout" title="Logout">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
              class="bi bi-box-arrow-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd"
                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
              <path fill-rule="evenodd"
                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
            </svg>
          </a>
        </li>
      <?php else: ?>
        <li><a href="#tracks">Tracks</a></li>
        <li><a href="pricing">Pricing</a></li>
        <li><a href="#newsletter">Newsletter</a></li>
        <li><a href="aboutUs">About Us</a></li>
        <li><a href="contact">Contact</a></li>
        <li>
          <a href="/login" title="Login">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill"
              viewBox="0 0 16 16">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
            </svg>
          </a>
        </li>
      <?php endif; ?>

    </ul>
  </nav>
</header>

<script defer>
  const reveals = document.querySelectorAll('.reveal');
  const io = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('active');
        io.unobserve(e.target);
      }
    });
  }, { threshold: .15 });
  reveals.forEach(el => io.observe(el));

  const hamburger = document.querySelector('.hamburger');
  
  hamburger.addEventListener('click', function() {
      hamburger.classList.toggle('active');
      document.querySelector('.nav-list').classList.toggle('active');

  });


</script>

