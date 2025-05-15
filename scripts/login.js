// example fetch for login
const form = document.querySelector('.auth-form');
form.addEventListener('submit', async e => {
  e.preventDefault();
  const formData = new FormData(form);

  try {
    const res = await fetch('actions/sendLogin.php', {
      method: 'POST',
      body: formData
    });
    const data = await res.json();

    if (data.error) {
      alert(Object.values(data.error).join('\n'));
    } else if (data.successful) {
      window.location.href = 'https://codema.fun/';
      // redirect or load dashboard...
    }
  } catch (err) {
    console.error(err);
    alert('Server error. Please try again.');
  }
});
