document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('register-form');

  form.addEventListener('submit', async (e) => {
    e.preventDefault(); // stop the normal form post

    const pwd     = document.getElementById('reg-password').value;
    const confirm = document.getElementById('reg-confirm-password').value;

    // 1) password match check
    if (pwd !== confirm) {
      alert('Passwords do not match!');
      return;
    }

    // 2) gather all form data
    const formData = new FormData(form);

    try {
      // 3) send to sendRegister.php
      const res = await fetch('actions/sendRegister.php', {
        method: 'POST',
        body: formData
      });

      const data = await res.json();

      if (data.error) {
        // field‐specific errors
        // e.g. data.error.email or data.error.nickname
        // you can display them however you like:
        alert(Object.entries(data.error).map(([key, value]) => `${key}: ${value}`).join('\n'));
      }
      else if (data.successful) {
        // registration succeeded!

        window.location.href = 'https://codema.fun/courses.php';
      }
      else {
        // unexpected response
        alert('Unknown response from server.');
      }
    } catch (err) {
      console.error(err);
      alert('There was a network or server error. Please try again later.');
    }
  });
});