// csrf tu musi byt bez toho mi hadzalo 419
function getCSRFToken() {
    return document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
}

// pridavanie spz; zaroven sa aj updatuje content bez refreshu
const submitButton = document.getElementById("submit-btn");
const formInput = document.getElementById("form-input");
submitButton.addEventListener("click", function () {
    fetch("/allowed-cars/" + formInput.value, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": getCSRFToken(),
        },
    }).then(function (response) {
        if (response.ok) {
            const firstChild =
                document.getElementById("cars").firstElementChild;

            // to co sa prida do db sa zaroven prida aj tu ale cez js (aby to sa to updatovalo bez refreshu)
            // prettier-ignore
            let html = `<div id="car-${+firstChild.getAttribute("data-record-id") + 1}" class="car allowed-overview-item" data-record-id="${+firstChild.getAttribute("data-record-id") + 1}">
                            <div class="carId--id">${formInput.value}</div>
                            <button class="delete-btn btn carId--deleteBtn" data-record-id="${+firstChild.getAttribute("data-record-id") + 1}">Delete</button>
                        </div>`;

            // reset "formu"
            document.getElementById("form-input").value = "";

            // samotne pridanie spz
            document
                .querySelector("#cars")
                .insertAdjacentHTML("afterbegin", html);
        }
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
