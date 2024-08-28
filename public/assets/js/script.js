//Changes user's color bootstrap badges ( removes text ) for small screens
window.addEventListener('DOMContentLoaded', function() {
    
    //Checks at least one time the width of the screen
    if (window.innerWidth <= 580) {

        this.document.querySelectorAll('.badge-color')
        .forEach(badge_color =>{

            badge_color.textContent=' ';
        });
    };


    
 // Constantly checks the screen width to adjust the classes of
 // the span elements 
 // ( using arrow function this time )

    this.addEventListener('resize', ()=> {
    
        if (window.innerWidth <= 580) {//580 refers to pixels
            
            //Selects all four span elements by their common class
            this.document.querySelectorAll('.badge-color')
            .forEach(badge_color =>{
                
                //Removes span text, making it smaller for small screens
                badge_color.textContent=' ';
            });
    
        }else{
    
          //Selects all four span elements by their common class
            this.document.querySelectorAll('.badge-color')
                .forEach(badge_color=>{

                    //Checks each span id and sets back
                    //their color text based on their id

                    if(badge_color.id === 'azul'){
                        badge_color.textContent = "Azul";
                    
                    }else if (badge_color.id === 'vermelho') {
                        badge_color.textContent = "Vermelho";
                    
                    }else if (badge_color.id === 'amarelo') {
                        badge_color.textContent = "Amarelo";
                    
                    }else if (badge_color.id === 'verde') {
                        badge_color.textContent = "Verde";
                    
                    };
            });
            };
    });
});
//========================================================





//DELETE buttons
if (document.querySelector('.btn-delete')) {

    document.querySelectorAll('.btn-delete').forEach((btn) => {

        btn.addEventListener('click', (e) => {
            e.preventDefault();

            Swal.fire({
                title: "Tem certeza que quer deletar o usuário?",
                text: "Isso não pode ser revertido!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, quero deletar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Produto deletado!",
                        text: "O produto foi deletado com sucesso.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = btn.href;
                    });

                };
            });
        });
    });

};
//========================================================




//TURNED ON
//Input treatment for views "create-user" and "update-user"

if (document.querySelector('form')) {

    const inputName = document.querySelector('.input-name');
    const inputEmail = document.querySelector('.input-email');

    const alertError = document.querySelector('.js-alert-error');


    //Validation here
    document.querySelectorAll('form').forEach((form => {

        form.addEventListener('submit', (event) => {
        

            let hasError = false;
            alertError.classList.add('d-none');
            alertError.innerHTML = '';

            // Validação do Nome
            if (inputName) {
                
                if (inputName.value.trim() === '') {
                    hasError = true;
                    showError(inputName, 'Por favor, insira seu nome completo.');
                } else {
                    removeError(inputName);
                }
            }

            // Validação do Email
            if (inputEmail) {            
                if (inputEmail.value.trim() === '') {
                    hasError = true;
                    showError(inputEmail, 'Por favor, insira seu email.');
                } else if (!validateEmail(inputEmail.value)) {
                    hasError = true;
                    showError(inputEmail, 'Por favor, insira um email válido.');
                } else {
                    removeError(inputEmail);
                }
            }

           

            if (hasError) {
                console.log(hasError);
                event.preventDefault();
                alertError.classList.remove('d-none');
                alertError.innerHTML = 'Por favor, corrija os erros antes de continuar.';
            }


        });
    }))

    function showError(input, message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.innerHTML = message;
        input.classList.add('is-invalid');
        if (input.nextElementSibling) {
            input.nextElementSibling.remove();
        }
        input.insertAdjacentElement('afterend', errorDiv);
    }

    function removeError(input) {
        input.classList.remove('is-invalid');
        if (input.nextElementSibling) {
            input.nextElementSibling.remove();
        }
    }

    function validateEmail(email) {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()\[\]\\.,;:\s@"]+\.)+[^<>()\[\]\\.,;:\s@"]{2,})$/i;
        return re.test(String(email).toLowerCase());
    }
}
//========================================================
