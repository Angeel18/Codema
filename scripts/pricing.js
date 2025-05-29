const plans = document.querySelectorAll("#plans .plan");
const data = document.getElementById("planData");

plans.forEach(plan => {
    plan.addEventListener("click", () => {
        const lis = plan.querySelectorAll(".data ul li");
        while (data.firstChild) {
            data.removeChild(data.firstChild);
        }
        lis.forEach((li) => {
            //   console.log(`${li.textContent}`);
            const p = document.createElement('p');
            p.textContent = li.textContent;
            data.appendChild(p);

            const hr = document.createElement('hr');
            data.appendChild(hr);
        });

    });
});

document.addEventListener("click", (e) => {
    const clickedInsidePlan = e.target.closest(".plan");
    if (!clickedInsidePlan) {
        while (data.firstChild) {
            data.removeChild(data.firstChild);
        }
    }

});