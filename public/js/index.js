client.on("message", function (topic, message) {
    let route = parkingSlotsRoute;
    mqttData(route).then((models) => {
        models.forEach((element) => {
            console.log(element);
            const content = element.occupied == 1 ? "Occupied" : "Free";
            const elementToChange = document
                .getElementById(`${element.sensor.special_id}`)
                .querySelector(".parkingSlot--occupied");
            elementToChange.textContent = content;
            if (
                element.occupied == 1 &&
                elementToChange.classList.contains("free")
            ) {
                elementToChange.classList.remove("free");
                elementToChange.classList.add("occupied");
            } else if (
                element.occupied == 0 &&
                elementToChange.classList.contains("occupied")
            ) {
                elementToChange.classList.remove("occupied");
                elementToChange.classList.add("free");
            }
        });
        const freeSlotsCount = document.querySelector(".freeSlotsCount");
        // const count = models.reduce((a, b) => (b.occupied == 0 ? ++a : a), 0);
        // freeSlotsCount.textContent = `${count}/${models.length} free`;
        const count = models.filter((a) => a.occupied == 0);
        freeSlotsCount.textContent = `${count.length}/${models.length} free`;
    });

    route = parkedCarsRoute;
    const parkedCarsOverview = document.querySelector(".parkedCarsOverview");
    parkedCarsOverview.innerHTML = "";
    mqttData(route).then((models) => {
        models.forEach((element) => {
            const content = element.occupied == 1 ? "Occupied" : "Free";
            const html = `
            <div class="overview-item index-overview-item" id="${element.spz}">
                <div class="parked-car--id">${element.spz}</div>
            </div>`;
            parkedCarsOverview.insertAdjacentHTML("afterbegin", html);
        });
    });
});
