const categoria = document.getElementById("categoria");
const habitacion = document.getElementById("habitacion");
const fechaInicio = document.getElementById("fecha_inicio");
const fechaFinal = document.getElementById("fecha_final");
const totalInput = document.getElementById("total");


// mostrar habitaciones
categoria.addEventListener("change", async () => {

    if (!categoria.value) {

        habitacion.innerHTML =
        `<option value="">Mantener actual</option>`;

        return;
    }

    try {

        const response = await fetch(
            `index.php?action=getRoomsByType&categoria_id=${categoria.value}`
        );

        const result = await response.json();

        habitacion.innerHTML =
        `<option value="">Mantener actual</option>`;

        if (result.ok && result.data.length > 0) {

            result.data.forEach(hab => {

                habitacion.innerHTML += `
                    <option value="${hab.id}" data-precio="${hab.precio}">
                        Habitación ${hab.numero} - $${hab.precio}
                    </option>
                `;
            });
        }

    } catch (error) {

        console.error("Error:", error);
    }
});


// calcular total
function calcularTotal() {

    const inicio = fechaInicio.value;
    const fin = fechaFinal.value;

    let precio = 0;

    const selected =
    habitacion.options[habitacion.selectedIndex];

    if (selected && selected.dataset.precio) {

        precio =
        parseFloat(selected.dataset.precio);

    } else {

        precio =
        parseFloat(document.body.dataset.precio);
    }

    if (!inicio || !fin || !precio) {

        totalInput.value = "$0";
        return;
    }

    const dias =
    (new Date(fin) - new Date(inicio))
    / (1000 * 60 * 60 * 24);

    if (dias <= 0) {

        totalInput.value = "$0";
        return;
    }

    const total = dias * precio;

    totalInput.value =
    "$" + total.toFixed(2);
}


// eventos
fechaInicio.addEventListener("change", calcularTotal);

fechaFinal.addEventListener("change", calcularTotal);

habitacion.addEventListener("change", calcularTotal);


// calcular apenas abra
calcularTotal();