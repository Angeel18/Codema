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
    color: gold;
    transform: scale(1.1);
  }

  /* Estilos del modal */
  .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }

  .modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border-radius: 8px;
    width: 80%;
    max-width: 500px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .modal-header h2 {
    margin: 0;
    color: #333;
  }

  .close-modal {
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    color: #aaa;
  }

  .close-modal:hover {
    color: #333;
  }

  .stars-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
  }

  .star {
    cursor: pointer;
    margin: 0 5px;
    color: #ccc;
    transition: all 0.2s ease;
  }

  .star:hover,
  .star.active {
    color: gold;
    transform: scale(1.1);
  }

  #reviewComment {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    resize: vertical;
    margin-bottom: 20px;
  }

  .submit-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
  }

  .submit-btn:hover {
    background-color: #45a049;
  }

  .submit-btn:disabled {
    background-color: #cccccc;
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