document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('register-form');

  form.addEventListener('submit', async (e) => {
    e.preventDefault(); // stop the normal form post

    const pwd = document.getElementById('reg-password').value;
    const confirm = document.getElementById('reg-confirm-password').value;

    // 1) password match check
    if (pwd !== confirm) {
      alert('Passwords do not match!');
      return;
    }

    // 2) gather all form data
    const formData = new FormData(form);
    // console.log(formData.get('sel-plan'));
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
        console.log(formData.get('sel-plan'));
        switch (formData.get('sel-plan')) {

          case '1':
            //en este caso es el plan gratis, crea un formulario, y envia los datos al login para logearse de forma automatica
            alert("Thank you for trying our services")
            const loginData = new FormData();
            loginData.append('email', formData.get('email'));
            loginData.append('password', formData.get('password'));

            const loginRes = await fetch('actions/sendLogin.php', {
              method: 'POST',
              body: loginData,
            });

            const loginJson = await loginRes.json();

            if (loginJson.successful) {
              window.location.href = 'https://codema.fun/'; // o dashboard
            } else {
              alert('Registro exitoso, pero no se pudo iniciar sesión automáticamente. Por favor, inicia sesión.');
              window.location.href = 'https://codema.fun/login.php';
            }
            // window.location.href = 'https://codema.fun/email/sendEmailRegister.php';

            break;

          default:
            //en caso de no cualqueir otro plan lo reenvia a payment y ahi se inicia la sesion
            form.action = 'https://codema.fun/payment/payment.php';
            form.method = 'POST';
            form.submit();
            break;
        }
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


async function selectedPlan() {
  const selectedPlan = document.getElementById("sel-plan");
  const params = new URLSearchParams(window.location.search);
  const plan = params.get('plan') ?? '';

  let data;
  try {
    const response = await fetch(`../actions/fetchPlan.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
    });

    data = await response.json();

    data.forEach(element => {
      let option = document.createElement("option");
      option.textContent = element.name + "-" + element.price + "€";
      option.value = element.idPlan;
      if (element.name == plan) {
        option.selected = true;
      }
      selectedPlan.appendChild(option);
    });

  } catch (error) {
    console.error("Error en la petición:", error);
  }
}

selectedPlan();