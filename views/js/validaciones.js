document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {

        let errores = {};

        const document_type_id = document.querySelector("[name='document_type_id']").value;
        const document_number = document.querySelector("[name='document_number']").value.trim();
        const name = document.querySelector("[name='name']").value.trim();
        const last_name = document.querySelector("[name='last_name']").value.trim();
        const phone = document.querySelector("[name='phone']").value.trim();
        const email = document.querySelector("[name='email']").value.trim();
        const password = document.querySelector("[name='password']").value;

        
        const soloLetras = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        const soloNumeros = /^[0-9]+$/;
        const emailRegex = /^\S+@\S+\.\S+$/;
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{6,}$/;

        
        document.querySelectorAll(".error").forEach(el => el.textContent = "");

        

        if (document_type_id === "") {
            errores.document_type_id = "El tipo de documento es requerido";
        }

        if (document_number === "") {
            errores.document_number = "El número de documento es requerido";
        } else if (!soloNumeros.test(document_number)) {
            errores.document_number = "Solo se permiten números";
        }

        if (name === "") {
            errores.name = "El nombre es requerido";
        } else if (!soloLetras.test(name)) {
            errores.name = "Solo se permiten letras";
        }

        if (last_name === "") {
            errores.last_name = "El apellido es requerido";
        } else if (!soloLetras.test(last_name)) {
            errores.last_name = "Solo se permiten letras";
        }

        if (phone === "") {
            errores.phone = "El teléfono es requerido";
        } else if (!soloNumeros.test(phone)) {
            errores.phone = "Solo se permiten números";
        }

        if (email === "") {
            errores.email = "El email es requerido";
        } else if (!emailRegex.test(email)) {
            errores.email = "El email no es válido";
        }

        if (password === "") {
            errores.password = "La contraseña es requerida";
        } else if (!passwordRegex.test(password)) {
            errores.password = "Debe tener mínimo 6 caracteres, 1 mayúscula, 1 minúscula y 1 carácter especial";
        }

        // Esta mierda muestra los errores
        if (Object.keys(errores).length > 0) {
            e.preventDefault();

            for (let campo in errores) {
                let spanError = document.querySelector(`#error-${campo}`);
                if (spanError) {
                    spanError.textContent = errores[campo];
                }
            }
        }

    });

});