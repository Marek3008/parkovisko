const submitButton = document.getElementById("submit-btn");
const formInput = document.getElementById("form-input");
const errorContainer = document.getElementById("error-container");

// csrf tu musi byt bez toho mi hadzalo 419
function getCSRFToken() {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
}

async function getAllowedCars() {
    const response = await fetch("/request-allowed-cars");
    const result = await response.json();
    return result;
}


// pridavanie spz; zaroven sa aj updatuje content bez refreshu
submitButton.addEventListener("click", function () {
    fetch("/allowed-cars", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": getCSRFToken(),
            "Name" : formInput.value
        },
    })  
        .then(response => {
            if(response.status == 500){
                return response.json()
            }
            else{
                return {};
            }                            
        })
        .then(data => {
            if(data.error){
                throw new Error(data.error);
            }

            return getAllowedCars();
        })
        .then((models) => {
            document.getElementById("cars").innerHTML = "";
            errorContainer.innerHTML = "";
            formInput.value = "";
            models.forEach((element) => {
                const html = `<div id="car-${element.id}" class="overview-item car" data-record-id="${element.id}">
                                <div class="car--id">${element.spz}</div>
                                <button class="btn delete-btn car--deleteBtn" data-record-id="${element.id}">Delete</button>
                            </div>`;

                document
                    .getElementById("cars")
                    .insertAdjacentHTML("afterbegin", html);
            });
        })
        .catch(error => {
            errorContainer.innerHTML = error.message;
        });
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
