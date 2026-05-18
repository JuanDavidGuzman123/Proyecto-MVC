const categoria = document.getElementById("categoria");
const habitacion = document.getElementById("habitacion");
const fechaInicio = document.getElementById("fecha_inicio");
const fechaFinal = document.getElementById("fecha_final");
const totalInput = document.getElementById("total");
const form = document.querySelector("form");


// cargar las habitaciones
categoria.addEventListener("change", async () => {

    if (!categoria.value) {

        habitacion.innerHTML =
        `<option value="">Seleccione una habitación</option>`;

        return;
    }

    try {

        const response = await fetch(
            `index.php?action=getRoomsByType&categoria_id=${categoria.value}`
        );

        const result = await response.json();

        habitacion.innerHTML =
        `<option value="">Seleccione una habitación</option>`;

        if (result.ok && result.data.length > 0) {

            result.data.forEach(hab => {

                habitacion.innerHTML += `
                    <option 
                        value="${hab.id}" 
                        data-precio="${hab.precio}"
                    >
                        Habitación ${hab.numero} -
                        ${hab.descripcion} -
                        ${hab.numero_camas} camas -
                        $${hab.precio}
                    </option>
                `;
            });

        } else {

            habitacion.innerHTML +=
            `<option>No disponibles</option>`;
        }

    } catch (error) {

        console.error("Error:", error);
    }
});


// calcular total
function calcularTotal() {

    const inicio = fechaInicio.value;
    const fin = fechaFinal.value;

    const selected =
    habitacion.options[habitacion.selectedIndex];

    if (
        !inicio ||
        !fin ||
        !selected ||
        !selected.dataset.precio
    ) {

        totalInput.value = "$0";
        return;
    }

    const precio =
    parseFloat(selected.dataset.precio);

    const fecha1 = new Date(inicio);
    const fecha2 = new Date(fin);

    const dias =
    (fecha2 - fecha1) / (1000 * 60 * 60 * 24);

    if (dias <= 0) {

        totalInput.value = "$0";
        return;
    }

    const total = dias * precio;

    totalInput.value =
    "$" + total.toFixed(2);
}


fechaInicio.addEventListener("change", calcularTotal);

fechaFinal.addEventListener("change", calcularTotal);

habitacion.addEventListener("change", calcularTotal);


// validar fechas
const hoy = new Date().toISOString().split("T")[0];

fechaInicio.min = hoy;
fechaFinal.min = hoy;

fechaInicio.addEventListener("change", () => {

    fechaFinal.min = fechaInicio.value;
});


// validar formulario
form.addEventListener("submit", (e) => {

    if (!fechaInicio.value || !fechaFinal.value) {

        alert("Debes seleccionar ambas fechas");

        e.preventDefault();

        return;
    }

    if (fechaFinal.value <= fechaInicio.value) {

        alert(
            "La fecha final debe ser mayor a la fecha de inicio"
        );

        e.preventDefault();

        return;
    }

    const personas =
    document.getElementById("n_personas");

    if (!personas.value || personas.value < 1) {

        alert(
            "Debes ingresar un número válido de personas"
        );

        e.preventDefault();

        return;
    }

});