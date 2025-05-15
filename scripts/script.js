    // // Current year
    // document.getElementById('year').textContent = new Date().getFullYear();

    // // Reveal on scroll
    // const reveals = document.querySelectorAll('.reveal');
    // const io = new IntersectionObserver(entries => {
    //   entries.forEach(e => {
    //     if (e.isIntersecting) {
    //       e.target.classList.add('active');
    //       io.unobserve(e.target);
    //     }
    //   });
    // }, { threshold: .15 });
    // reveals.forEach(el => io.observe(el));

    // FAQ toggle
    document.querySelectorAll('.faq-item h4').forEach(h => {
      h.addEventListener('click', () => h.parentElement.classList.toggle('open'));
    });

    // Scroll-top button
    const topBtn = document.querySelector('.scroll-top');
    window.addEventListener('scroll', () => {
      topBtn.classList.toggle('show', window.scrollY > 600);
    });
    topBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));