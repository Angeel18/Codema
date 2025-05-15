



let data;
let user;
async function fetchProgress() {
  try {
    const response = await fetch(`actions/fetchProgress.php`, {
      method: "POST",
      headers: { "Content-Type": "application/json" }
    });
    data = await response.json();
    // console.log(data); // Descomenta para depuración si lo necesitas
  } catch (error) {
    console.error("Error en la petición:", error);
  }
}

async function paintGraph(){
    let dates=[];
    let exercisesDone=[];
    let sum=0;
// console.log(data.exercisesDone);
data.forEach(element => {
    exercisesDone.push(element.exercisesDone);
    dates.push(element.month);
    sum+=element.exercisesDone;
});
// console.log(data.exercisesDone);
    document.getElementById("exercises").textContent=sum;
  const ctx = document.getElementById('graph').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: dates,
      datasets: [{
        label: 'Exercises Done',
        data: exercisesDone,
        fill: false,
        backgroundColor: '#292653',  // Color de las barras
        borderColor: '#292653',  // Color del borde de las barras
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        x: { title: { display: true, text: 'Month' } },
        y: { title: { display: true, text: 'Amount' }, beginAtZero: true ,ticks: {
                        stepSize: 1  
                    }}
      }
    }
  });

}


async function fetchUser() {
  try {
    const response = await fetch(`actions/fetchUser.php`, {
      method: "POST",
      headers: { "Content-Type": "application/json" }
    });
    user = await response.json();
    // console.log(data); // Descomenta para depuración si lo necesitas
  } catch (error) {
    console.error("Error en la petición:", error);
  }
    
  const languagesStudied = new Set();
  user.forEach(element => {
    languagesStudied.add(element.languageName);
  });
//   console.log(uniqueArray);

 document.getElementById("languages").textContent = [...languagesStudied].join(', ');

  document.getElementById("nickname").textContent=user[0].nickname
  document.getElementById("level").textContent=user[0].level
  document.getElementById("experience").textContent=user[0].experience
  document.getElementById("activeSince").textContent=user[0].creationDate

}

async function initialize() {
  await fetchProgress();
   paintGraph();
   fetchUser()
}

initialize();