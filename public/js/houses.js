const submitButton = document.getElementById("submit-btn");
const nameInput = document.getElementById("house-name-input");
const locationInput = document.getElementById("house-location-input");
const errorContainer = document.getElementById("error-container");

function getCSRFToken() {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
}

async function getParkingHouses() {
    const response = await fetch("/request-parking-houses");
    const result = await response.json();
    return result;
}

submitButton.addEventListener("click", function () {
    fetch("/parkingHouses", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": getCSRFToken(),
            "Name": nameInput.value,
            "Location": locationInput.value
        },
    })
        .then(response => {
            if (response.status == 500) {
                return response.json()
            }
            else {
                return {};
            }
        })
        .then(data => {
            if (data.error) {
                throw new Error(data.error);
            }

            return getParkingHouses();
        })
        .then((models) => {
            document.getElementById("houses").innerHTML = "";
            errorContainer.innerHTML = "";
            nameInput.value = "";
            locationInput.value = "";

            models.forEach((element) => {
                const html = `<div id="house-${element.id}" class="overview-item house" data-record-id="${element.id}">
                                <div class="house--id">${element.id} ${element.name} ${element.location}</div>
                                <button class="btn delete-btn house--deleteBtn" data-record-id="${element.id}">Delete</button>
                            </div>`;

                document
                    .getElementById("houses")
                    .insertAdjacentHTML("beforeend", html);
            });
        })
        .catch(error => {
            errorContainer.innerHTML = error.message;
        });
});

// vymazavanie spz
document.querySelector("#houses").addEventListener("click", function (e) {
    if (e.target.classList.contains("delete-btn")) {
        const recordId = e.target.getAttribute("data-record-id");
        fetch("/parkingHouses/" + recordId, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": getCSRFToken(),
            },
        })
            .then(function (response) {
                if (response.ok) {
                    document.getElementById("house-" + recordId).remove();
                }
            })
            .catch(function (error) {
                console.error(error);
            });
    }
});