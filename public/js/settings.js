const errorContainer = document.getElementById('error-container');

function getCSRFToken() {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
}


document.querySelector('#sensors').addEventListener("click", async (e) => {
    if (e.target.classList.contains('changeBtn')) {
        const sensorId = e.target.getAttribute('btn-id');
        const sensor = document.getElementById('sensor-' + sensorId);

        try {
            const response = await fetch('/settings/change-sensor/' + sensorId, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": getCSRFToken(),
                    "Name": sensor.value
                }
            });

            errorContainer.innerHTML = "";

            if (response.status === 500) {
                const data = await response.json();
                if (data.error) {
                    throw new Error(data.error);
                }
            }
        } catch (e) {
            errorContainer.innerHTML = e.message;
        }
    }
});

document.getElementById('change-button').addEventListener('click', () => {
    const selectedMode = document.getElementById('mode').value

    fetch('/settings/change-mode/' + selectedMode, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": getCSRFToken(),
        }
    })
})