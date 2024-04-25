const submitButton = document.getElementById("submit-btn");
const formInput = document.getElementById("form-input");

// csrf tu musi byt bez toho mi hadzalo 419
function getCSRFToken() {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
}

async function getAllowedCars(){
    const response = await fetch('/request-allowed-cars');
    const result = await response.json();
    return result;
}

// ----- MARIO TOTO SOM TI PRIPRAVIL ----- (funguje to)
function validateInput(){
    if (!formInput.value) {
        console.log("napis nieco");
        return false;
    }
    if (formInput.value.length > 10) {
        console.log("je to dlhe");
        return false;
    }
    return true;
}

// pridavanie spz; zaroven sa aj updatuje content bez refreshu
submitButton.addEventListener("click", function () {
    if(validateInput()){
        fetch('/allowed-cars/' + formInput.value, {
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": getCSRFToken(),
            }
        }).then(() => {
            return getAllowedCars();
        }).then((models) => {
            document.getElementById('cars').innerHTML = "";
            models.forEach((element) => {
                const html = `<div id="car-${element.id}" class="car allowed-overview-item" data-record-id="${element.id}">
                                <div class="car--id">${element.spz}</div>
                                <button class="delete-btn btn car--deleteBtn" data-record-id="${element.id}">Delete</button>
                            </div>`;

                document.getElementById('cars').insertAdjacentHTML('afterbegin', html);
            });
        });
    }
});

// vymazavanie spz
document.querySelector("#cars").addEventListener("click", function (e) {
    if (e.target.classList.contains("delete-btn")) {
        const recordId = e.target.getAttribute("data-record-id");
        fetch("/allowed-cars/" + recordId, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": getCSRFToken(),
            },
        })
            .then(function (response) {
                if (response.ok) {
                    document.getElementById("car-" + recordId).remove();
                }
            })
            .catch(function (error) {
                console.error(error);
            });
    }
});
