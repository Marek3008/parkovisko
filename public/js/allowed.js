function addForm(){
    document.getElementById('popup-form').style.display = "flex";
}

document.addEventListener('DOMContentLoaded', function(){

    // csrf tu musi byt bez toho mi hadzalo 419
    function getCSRFToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    // pridavanie spz; zaroven sa aj updatuje content bez refreshu
    const submitButton = document.getElementById('submit-btn');
    let formInput = document.getElementById('form-input');
    submitButton.addEventListener('click', function(){
        fetch('/allowed-cars/' + formInput.value, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': getCSRFToken()
            }
        }).then(function(response){
            if(response.ok){
                let firstChild = document.getElementById('cars').firstElementChild;

                // to co sa prida do db sa zaroven prida aj tu ale cez js (aby to sa to updatovalo bez refreshu)
                let html = `<div id="car-${firstChild.getAttribute('data-record-id') + 1}" style="display: flex">
                                <div>${formInput.value}</div>
                                <button class="delete-btn" style="margin-left: 10px" data-record-id="${firstChild.getAttribute('data-record-id') + 1}">delete</button>
                            </div>`;
                
                // reset "formu"
                document.getElementById('popup-form').style.display = "none";
                document.getElementById('form-input').value = "";

                // samotne pridanie spz
                document.querySelector('#cars').insertAdjacentHTML("afterbegin", html);

            }
        })
    });

    // vymazavanie spz
    let deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(function(button){
        button.addEventListener('click', function(){
            let recordId = this.getAttribute('data-record-id');

            fetch('/allowed-cars/' + recordId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': getCSRFToken()
                }
                
            }).then(function(response){
                if (response.ok){
                    document.getElementById('car-' + recordId).remove();
                }
            }).catch(function(error){
                console.error(error);
            });
        });
    });

    
});