let data;
async function fetchRanking() {
  try {
    const response = await fetch(`actions/fetchRanking.php`, {
      method: "POST",
      headers: { "Content-Type": "application/json" }
    });
    data = await response.json();
    // console.log(data); // Descomenta para depuración si lo necesitas
  } catch (error) {
    console.error("Error en la petición:", error);
  }
}

async function topScore(){
    let N1 = document.getElementById("top1Name");
    let N2 = document.getElementById("top2Name");
    let N3 = document.getElementById("top3Name");
    let S1 = document.getElementById("top1Score");
    let S2 = document.getElementById("top2Score");
    let S3 = document.getElementById("top3Score");

    N1.textContent=data[0].nickname;
    N2.textContent=data[1].nickname;
    N3.textContent=data[2].nickname;

    S1.textContent=data[0].points;
    S2.textContent=data[1].points;
    S3.textContent=data[2].points;
    let position=4;
    let tableBody=document.getElementById("tableBody");
    data.slice(3).forEach(user => {
      const tr=document.createElement("tr");

      const td1=document.createElement("td");
      const td2=document.createElement("td");
      const td3=document.createElement("td");
      const td4=document.createElement("td");

      td1.textContent=position;
      td2.textContent=user.nickname;
      td3.textContent=user.points;
      td4.textContent=user.level;
      position++;
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
      tr.appendChild(td4);

      tableBody.appendChild(tr);
    });
}

async function initialize() {
  await fetchRanking();
  topScore();
}

initialize();
