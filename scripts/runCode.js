const resultContainer = document.getElementById('result-container');


async function runPythonCode(code) {
    // console.log("a");  

  resultContainer.textContent = ''; // Limpiar resultados anteriores
  const input = document.getElementById('user-input').value;
  // console.log("a");
  try {
    const response = await fetch('./Python/compiladorPython.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ code, input })
    });
    const result = await response.text();
    resultContainer.textContent = result;
  } catch (error) {
    resultContainer.textContent = 'Error al enviar código al servidor:\n' + error;
  }
}

async function runJavascriptCode(code) {
  console.clear();

  const resultContainer = document.getElementById('result-container');
  resultContainer.textContent = ''; // Limpiar resultados anteriores

  const originalConsoleLog = console.log;

  try {
    // Redefinir console.log para capturar salidas
    console.log = function (...args) {
      originalConsoleLog(...args); // También imprime en la consola real
      const message = args.join(' ');
      resultContainer.textContent += message + '\n';
    };

    eval(code); // Ejecutar el código del usuario

  } catch (error) {
    resultContainer.textContent += error + '\n';

  } finally {
    // Restaurar console.log al original
    console.log = originalConsoleLog;
  }
}

async function runJavaCode(code) {
  resultContainer.textContent = ''; // Limpiar resultados anteriores
  const input = document.getElementById('user-input').value;

  try {
    const response = await fetch('./Java/compiladorJava.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ code, input }) // Enviar código e input
    });

    const result = await response.text();
    resultContainer.textContent = result;
  } catch (error) {
    resultContainer.textContent = 'Error al enviar código al servidor:\n' + error;
  }
}

async function runHtmlCode(code) {
  const resultContainer = document.getElementById('result-container');
  resultContainer.innerHTML = '<iframe id="html-preview" style="width:100%; height:100%; border:none;"></iframe>';

  const iframe = document.getElementById('html-preview');
  const iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
  
  iframeDoc.open();
  iframeDoc.write(code);
  iframeDoc.close();
}

export{runJavaCode , runJavascriptCode, runPythonCode , runHtmlCode}