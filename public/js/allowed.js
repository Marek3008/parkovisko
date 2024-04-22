const form = `<form action="" method="POST" id="popup-form">
                        <input type="text">
                        <input type="submit" value="submit">
                </form>`;

function addForm(){
    if(!document.getElementById('popup-form')){
        document.querySelector('.content').insertAdjacentHTML("afterbegin", form);
    }
}

document.addEventListener('DOMContentLoaded', function(){

    // csrf tu musi byt bez toho mi hadzalo 419
    function getCSRFToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    document.addEventListener('keypress', function(event){
        if(event.key == "Escape"){
            document.getElementById('popup-form').remove();
        }        
    });

    // document.addEventListener('click', function(event){
    //     document.getElementById('popup-form').remove();
    // });

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

    let addBtn = document.getElementById('add-btn');
});