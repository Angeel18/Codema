// Script to handle contact form submission via fetch

document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('.contact-form');
  if (!form) return;

  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    const formData = new FormData(form);
    const email = formData.get('email');
    // Simple email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert('That\'s not a valid email.');
      return;
    }
    try {
      const response = await fetch('/actions/sendSupport.php', {
        method: 'POST',
        body: formData
      });
      const data = await response.json();
      if (data.success) {
        alert('Your message has been sent successfully!');
        form.reset();
      } else {
        alert('There was an error sending your message. Please try again.');
      }
    } catch (error) {
      alert('There was an error sending your message. Please try again.');
    }
  });
});
