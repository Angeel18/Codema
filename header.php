<header class="reveal">
  <a href="/" class="logo">Codema</a>

    <button class="hamburger" id="hamburger">
      <span ></span>
      <span ></span>
      <span ></span>
    </button>

  <nav class="nav-container">
    <ul class="nav-list">
      <?php if (isset($_SESSION['id_user'])): ?>
        <li><a href="/exercises/selectorView">Exercises</a></li>
        <li><a href="/courses">Courses</a></li>

        <li><a href="/progress">My progress</a></li>
        <li><a href="/monthlyRanking">Monthly Ranking</a></li>
        <li><a href="/exercises/dailyChallenge">Daily Challenge</a></li>
        <li style="display: flex; align-items: center; gap: 10px;">
          <button class="review-btn" title="Leave a review" id="openReviewModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
          </button>
          <a href="/logout" title="Logout" style="display:flex">
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
        <li><a href="/#tracks">Tracks</a></li>
        <li><a href="/pricing">Pricing</a></li>
        <li><a href="/#newsletter">Newsletter</a></li>
        <li><a href="/aboutUs">About Us</a></li>
        <li><a href="/contact">Contact</a></li>
        <li>
          <a href="/login" title="Login" style="display:flex">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-fill"
              viewBox="0 0 16 16">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
            </svg>
          </a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>

  <!-- Modal de Reseña -->
  <div id="reviewModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Deja tu reseña</h2>
        <span class="close-modal">&times;</span>
      </div>
      <div class="modal-body">
        <div class="stars-container">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <svg class="star" data-value="<?= $i ?>" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>
          <?php endfor; ?>
          <input type="hidden" id="ratingValue" value="0">
        </div>
        <textarea id="reviewComment" placeholder="Escribe tu comentario aquí..." rows="4"></textarea>
        <button id="submitReview" class="submit-btn">Enviar</button>
      </div>
    </div>
  </div>
</header>
<?php $endpoint = $_SERVER['DOCUMENT_ROOT']."/actions/sendReview.php" ?>
<style>
  /* Estilos para el botón de reseña y el modal */
  .review-btn {
    background: none;
    border: none;
    cursor: pointer;
    padding: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: inherit;
  }

  .review-btn svg {
    transition: all 0.3s ease;
  }

  .review-btn:hover svg {
  color: var(--accent-color);
    transform: scale(1.1);
  }

  /* Estilos del modal */
  #reviewModal {
  display: none; /* keep controlled by JS */
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7); /* darker overlay */
}

/* Center the modal and match your dark header/footer palette */
.modal-content {
  background-color: var(--header-footer-bg);
  color: var(--text-color);
  margin: 10% auto;
  padding: 1.5rem;
  border-radius: 1rem;             /* use same border radius as in your theme */
  width: 90%;
  max-width: 460px;                /* slightly narrower than before */
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
  border: 1px solid var(--secondary-color);
}

/* Header row inside modal */
.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.25rem;
}

.modal-header h2 {
  margin: 0;
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--secondary-color);
}

.close-modal {
  font-size: 1.5rem;
  font-weight: bold;
  cursor: pointer;
  color: var(--secondary-color);
  transition: color 0.2s;
}

.close-modal:hover {
  color: var(--accent-color);
}

/* Body of modal: center stars + textarea + button */
.modal-body {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

/* Stars: use your accent color when active */
.stars-container {
  display: flex;
  justify-content: center;
  gap: 0.5rem;
}

.star {
  cursor: pointer;
  color: var(--secondary-color);
  transition: all 0.2s ease;
}

.star:hover,
.star.active {
  color: var(--accent-color);
  transform: scale(1.1);
}

/* Rating input is hidden, so no change needed */

/* Textarea: match background and text colors, softer border */
#reviewComment {
  width: 100%;
  background-color: var(--background-color);
  color: var(--text-color);
  border: 1px solid var(--secondary-color);
  border-radius: 0.5rem;
  padding: 0.75rem;
  resize: vertical;
  line-height: 1.5;
}

/* Submit button: reuse your .btn class rather than inline .submit-btn */
.submit-btn {
  /* If you already have a “.btn” class, you can combine both:
     <button class="btn submit-btn">Enviar</button> */
  background-color: var(--secondary-color);
  color: var(--primary-color);
  border: none;
  border-radius: 0.6rem;
  padding: 0.75rem 1.5rem;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: transform 0.2s, opacity 0.2s;
  align-self: center;
}

.submit-btn:hover {
  transform: translateY(-2px) scale(1.03);
  opacity: 0.92;
}

.submit-btn:disabled {
  background-color: #444; /* or use a grayed-out var(--secondary-color) */
  cursor: not-allowed;
}
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
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

    // Código para el modal de reseña
    const modal = document.getElementById('reviewModal');
    const openBtn = document.getElementById('openReviewModal');
    const closeBtn = document.querySelector('.close-modal');
    const stars = document.querySelectorAll('.star');
    const ratingInput = document.getElementById('ratingValue');
    const reviewComment = document.getElementById('reviewComment');
    const submitBtn = document.getElementById('submitReview');
    let selectedRating = 0;
    let hoverRating = 0;

    openBtn.addEventListener('click', () => {
      modal.style.display = 'block';
    });

    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
      resetRating();
    });

    window.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
        resetRating();
      }
    });

    stars.forEach(star => {
      star.addEventListener('click', (e) => {
        selectedRating = parseInt(e.currentTarget.getAttribute('data-value'));
        ratingInput.value = selectedRating;
        updateStars();
      });

      star.addEventListener('mouseover', (e) => {
        hoverRating = parseInt(e.currentTarget.getAttribute('data-value'));
        updateStars();
      });

      star.addEventListener('mouseout', () => {
        hoverRating = 0;
        updateStars();
      });
    });

    function updateStars() {
      const ratingToUse = hoverRating || selectedRating;
      stars.forEach(star => {
        const starValue = parseInt(star.getAttribute('data-value'));
        if (starValue <= ratingToUse) {
          star.classList.add('active');
        } else {
          star.classList.remove('active');
        }
      });
    }

    function resetRating() {
      selectedRating = 0;
      hoverRating = 0;
      ratingInput.value = '0';
      reviewComment.value = '';
      stars.forEach(star => star.classList.remove('active'));
    }

    submitBtn.addEventListener('click', () => {
      const rating = ratingInput.value;
      const comment = reviewComment.value.trim();

      if (!rating || rating === '0') {
        alert('Por favor selecciona una calificación con las estrellas');
        return;
      }

      if (!comment) {
        alert('Por favor escribe un comentario');
        return;
      }

      submitBtn.disabled = true;
      submitBtn.textContent = 'Enviando...';

      fetch( "https://codema.fun/actions/sendReview", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          rating: rating,
          comment: comment,
          id_user: <?= $_SESSION['id_user'] ?>})
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('¡Gracias por tu reseña!');
          modal.style.display = 'none';
          resetRating();
        } else {
          alert('Hubo un error al enviar tu reseña: ' + (data.message || 'Inténtalo de nuevo más tarde'));
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Hubo un error al enviar tu reseña');
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.textContent = 'Enviar';
      });
    });
  });
</script>