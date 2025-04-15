import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// GENERAL API CALLER DE SELECTS
function callApi(apiName, selectClass, selectedValue = null) {
    fetch(apiName)
        .then(response => response.json())
        .then(data => {
            const selects = document.querySelectorAll(`select.${selectClass}`);
            selects.forEach(select => {
                select.innerHTML = ''; // Limpia opciones previas
                data.forEach(categoria => {
                    let option = document.createElement('option');
                    option.value = categoria.id;
                    option.textContent = categoria.nombre;
                    select.appendChild(option);
                });

                if (selectedValue) {
                    select.value = selectedValue;
                }
            });
        })
        .catch(error => console.error('Error al hacer la llamada a la API:', error));
}

// CALLBACK PARA OBTENER LOS DATOS DE UNA PRENDA
window.loadPrendaData = function(data) {
    callApi('/api/categorias', 'categoria_id', data.categoria_id);
    callApi('/api/marcas', 'marca_id', data.marca_id);
    callApi('/api/tallas', 'talla_id', data.talla_id);
    callApi('/api/colores', 'color_id', data.color_id);

    document.getElementById('id').value = data.id;
    document.getElementById('notas').value = data.notas;
    document.getElementById('previewImage').src = '/storage/' + data.imagen;
    document.getElementById('ocasion').value = data.ocasion;
    document.getElementById('mood').value = data.mood;
    document.getElementById('precio').value = data.precio;
    document.getElementById('moneda').value = data.moneda;
    document.getElementById('fecha_adquisicion').value = data.fecha_adquisicion;
    document.getElementById('estado').value = data.estado;

    const checkboxes = document.querySelectorAll(".checkbox-option");
    const hiddenInput = document.getElementById("selected-values");
    const dropdownText = document.getElementById("dropdown-text");

    let selectedValues = [];
    checkboxes.forEach(checkbox => {
        if (data.estacion.includes(checkbox.value)) {
            checkbox.checked = true;
            selectedValues.push(checkbox.value);
        }
    });

    hiddenInput.value = selectedValues.join(", ");
    dropdownText.textContent = selectedValues.length > 0 ? selectedValues.join(", ") : "Seleccionar";
}

// CALLBACK PARA OBTENER LOS DATOS DE UN OUTFIT
window.loadOutfitData = function(data) {

    document.getElementById('name').textContent = data.outfit.name;
    let prendasContainer = document.getElementById('prendas-container');
    if (prendasContainer) {
        prendasContainer.innerHTML = ''; // Limpia las imágenes anteriores
        
        data.prendas.forEach(prenda => {
            let img = document.createElement('img');
            img.src = `/storage/${prenda.imagen}`;
            img.alt = prenda.notas || 'Prenda';
            img.classList.add('w-32', 'h-32', 'object-cover');
            prendasContainer.appendChild(img);
        });
    } else {
        console.error("Contenedor de prendas no encontrado.");
    }

    const editButton = document.getElementById('editOutfitBtn');
    const deleteButton = document.getElementById('deleteOutfitBtn'); 
    editButton.onclick = function() {
        window.location.href = `/outfits/${data.outfit.id}/edit`;
    };
    deleteButton.onclick = function() {
        if (!confirm("¿Estás seguro de que deseas eliminar este outfit?")) {
            return;
        }
        const url = `/outfits/${data.outfit.id}`;
        borrarAJAX(url, 'outfit', 'seeoutfitModal')
    };

}
// borrar
function borrarAJAX(url, objeto, idModal) {

    console.log('entro')
    console.log('Intentando cerrar modal:', idModal);


    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(`${objeto} eliminada correctamente.`);
            closeModal(idModal);
            location.reload();
        } else {
            alert(`Error al eliminar ${objeto}.`);
        }
    })
    .catch(error => {
        console.error('Error al eliminar:', error);
        alert("Hubo un problema al eliminar.");
    });
}


// script para el preview d imagenes
document.addEventListener("DOMContentLoaded", function () {

    const imageUpload = document.getElementById('imageUpload');
    const labelImageUpload = document.querySelector("label[for='imageUpload']");
    const previewImage = document.getElementById('previewImage');
    const previewImageNw = document.getElementById('previewImageNw');

    if (imageUpload) {
        imageUpload.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (previewImage) {
                        previewImage.src = e.target.result;
                        previewImage.classList.remove('hidden');
                        uploadText.classList.add('hidden');
                    } else {
                        previewImageNw.src = e.target.result;
                        previewImageNw.classList.remove('hidden');
                        uploadText.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    }

    if (previewImage && previewImage.src) {
        labelImageUpload.classList.remove('border-2')
        previewImage.classList.remove('hidden');
        uploadText.classList.add('hidden');
    }

});


// script para modal d creacion + llamadas AJAX para la edicion de prendas
document.addEventListener("DOMContentLoaded", function () {

    // SELECT D ESTACION 
    const dropdownBtn = document.getElementById("dropdown-btn");
    const dropdownMenu = document.getElementById("dropdown-menu");
    const dropdownText = document.getElementById("dropdown-text");
    const checkboxes = document.querySelectorAll(".checkbox-option");
    const hiddenInput = document.getElementById("selected-values");
    // Alternar la visibilidad del dropdown
    dropdownBtn.addEventListener("click", function () {
        dropdownMenu.classList.toggle("hidden");
    });
    // Cerrar el dropdown si se hace clic fuera
    document.addEventListener("click", function (event) {
        if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add("hidden");
        }
    });
    // Manejar la selección de checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            let selected = Array.from(checkboxes)
                .filter(i => i.checked)
                .map(i => i.value);

            dropdownText.textContent = selected.length > 0 ? selected.join(", ") : "Selecciona estaciones";
            hiddenInput.value = selected.join(",");
        });
    });   
  
    // SIDEBAR
    window.openSidebar = function () {
        document.getElementById("sidebar").classList.remove("translate-x-full");
        document.getElementById("overlay").classList.remove("hidden");

        callApi('/api/categorias', 'categoria_id')
        callApi('/api/marcas', 'marca_id')
        callApi('/api/tallas', 'talla_id')
        callApi('/api/colores', 'color_id')
    }
    window.closeSidebar = function () {
        document.getElementById("sidebar").classList.add("translate-x-full");
        document.getElementById("overlay").classList.add("hidden");
    }

    // GUARDAR CAMBIOS (LLAMADA AJAX)
    document.getElementById('saveBtn').addEventListener("click", function (event) {
        event.preventDefault();  // Prevenir que el formulario sea enviado tradicionalmente
    
        const form = document.getElementById('updateForm');
        const formData = new FormData(form);
        const prendaId = document.getElementById('id').value;  // Asegúrate de obtener el ID correcto
        const url = `/closet/${prendaId}`;  // Aquí se construye la URL correcta
    
        fetch(url, {
            method: 'POST',  // Usa PUT para actualización
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal('prendaModal');
            } else {
                alert('Error al actualizar la prenda');
            }
        })
        .catch(error => {
            console.error('Error al guardar los cambios:', error);
            alert('Hubo un problema al guardar los cambios');
        });
    });
    
    // BORRAR ELEMENTO (LLAMADA AJAX)
    document.getElementById('deleteBtn').addEventListener("click", function (event) {
        event.preventDefault();
    
        const prendaId = document.getElementById('id').value;
        const url = `/closet/${prendaId}`;
    
        if (!confirm("¿Estás seguro de que deseas eliminar esta prenda?")) {
            return;
        }
    
        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Prenda eliminada correctamente.");
                closeModal();
                location.reload();
            } else {
                alert("Error al eliminar la prenda.");
            }
        })
        .catch(error => {
            console.error('Error al eliminar la prenda:', error);
            alert("Hubo un problema al eliminar la prenda.");
        });
    });
    
});

// ABRIR MODALES
window.openModal = function(modalId, apiCallUrl = null, apiParams = null, apiCallback = null) {

    // Abrir el modal especificado
    document.getElementById(modalId).classList.remove('hidden');
    
    // Si se proporciona una URL para la API, hacer la llamada
    if (apiCallUrl) {
        fetch(apiCallUrl, {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            // Si se pasa un callback, se ejecuta con los datos de la API
            if (apiCallback) {
                apiCallback(data); // Pasamos los datos a la función de callback
            }

            // Si hay parámetros adicionales para asignar valores
            if (apiParams) {
                apiParams.forEach(param => {
                    document.getElementById(param.elementId).value = data[param.field];
                });
            }
        })
        .catch(error => console.error('Error al cargar los datos del modal:', error));
    }
};

// CERRAR MODALES
window.closeModal = function(modalId) {
    document.getElementById(modalId).classList.add('hidden');
};



// SCRIPT PARA EL DRAG N DROP

let prendasEnCanvas = new Set();

window.allowDrop = function (event) {
    event.preventDefault();
};
window.drag = function (event) {
    let prendaId = event.target.closest("div").id;
    event.dataTransfer.setData("text", prendaId);
};
window.drop = function (event) {
    event.preventDefault();
    let prendaId = event.dataTransfer.getData("text");

    let container = document.getElementById("outfit-container");

    // Si la prenda ya está en el canvas (y no es un clon), no permitir duplicarla
    if (prendasEnCanvas.has(prendaId) && !prendaId.startsWith('outfit-')) {
        console.log(`❌ La prenda ${prendaId} ya está en el canvas y no se puede duplicar.`);
        return;
    }

    // Obtener el elemento original de la prenda
    let originalPrenda = document.getElementById(prendaId);

    // Si la prenda ya es un clon, simplemente moverla dentro del canvas
    if (prendaId.startsWith('outfit-')) {
        console.log(`🚫 La prenda ${prendaId} es un clon. Vamos a moverla.`);
        moverPrenda(event, originalPrenda);
        return;
    }

    // Crear un clon si viene del selector
    let clone = originalPrenda.cloneNode(true);
    clone.id = `outfit-${prendaId}`; // Nuevo ID para el clon
    clone.style.position = "absolute";

    let rect = container.getBoundingClientRect();
    let x = event.clientX - rect.left - (clone.clientWidth / 2);
    let y = event.clientY - rect.top - (clone.clientHeight / 2);

    clone.style.left = `${x}px`;
    clone.style.top = `${y}px`;



    // Agregar botón de eliminar
    let removeButton = document.createElement("button");
    removeButton.textContent = "X";
    removeButton.classList.add("eliminar-prenda");
    removeButton.onclick = function () {
        container.removeChild(clone);
        prendasEnCanvas.delete(prendaId);
        actualizarEstadoPrendas();
    };

    clone.appendChild(removeButton);
    clone.setAttribute("draggable", true);

    // Evento para mover prendas dentro del canvas sin duplicarlas
    clone.ondragstart = function (event) {
        event.dataTransfer.setData("text", clone.id);
    };

    container.appendChild(clone);

    clone.classList.add('bg-transparent');
    let boton = clone.querySelector('button:first-of-type');
    let img = clone.querySelector('img:first-of-type');
    if (boton) { // Verificar si se encontró el botón
        boton.classList.remove('p-4');
        boton.classList.remove('shadow-md');
        img.classList.add('bg-transparent');
        boton.classList.add('bg-transparent');
    }

    // Marcar la prenda original como usada
    prendasEnCanvas.add(prendaId);
    console.log(`✅ Prenda agregada al canvas: ${prendaId}`);
    actualizarEstadoPrendas();
};
function moverPrenda(event, prenda) {
    let container = document.getElementById("outfit-container");
    let rect = container.getBoundingClientRect();

    let x = event.clientX - rect.left - (prenda.clientWidth / 2);
    let y = event.clientY - rect.top - (prenda.clientHeight / 2);

    prenda.style.left = `${x}px`;
    prenda.style.top = `${y}px`;
    prenda.classList.remove('p-4')

    console.log(`🟢 Moviendo la prenda: ${prenda.id}`);
}
window.actualizarEstadoPrendas = function () {
    // Iterar sobre las prendas originales en el selector
    document.querySelectorAll(".prenda-item").forEach(item => {
        let prendaId = item.id;
        
        let boton = item.querySelector('button:first-of-type');
        let img = item.querySelector('img:first-of-type');

        if (prendasEnCanvas.has(prendaId) && !prendaId.startsWith('outfit-')) {
            // Si está en el canvas, aplicar la clase opacity-0
            boton.classList.remove("bg-white");
            boton.classList.add("bg-slate-400");
            img.style.opacity = '0.5'; 
            
            item.setAttribute("draggable", false);
            console.log(`🔵 La prenda ${prendaId} está en el canvas`);
        } else {
            
            boton.classList.add("bg-white");
            img.style.opacity = '1'; 

            item.setAttribute("draggable", true);  // Habilitar el arrastre
        }
    });
};
window.guardarOutfit = function () {
    let outfit = [];
    document.querySelectorAll("#outfit-container div").forEach(prenda => {
        let originalId = prenda.id.replace("outfit-", "");
        outfit.push(originalId);
    });

    if (outfit.length === 0) {
        alert("Por favor, añade al menos una prenda al outfit.");
        return;
    }

    // Seleccionar el formulario correctamente
    let form = document.getElementById("outfit-form");

    // Elimina cualquier input oculto previo (para evitar duplicados)
    document.querySelectorAll("input[name='prendas[]']").forEach(e => e.remove());

    // Agregar los nuevos inputs ocultos
    outfit.forEach(id => {
        let input = document.createElement("input");
        input.type = "hidden";
        input.name = "prendas[]"; // Laravel lo interpretará como un array
        input.value = id;
        form.appendChild(input);
    });

    // Enviar el formulario
    form.submit();
};
document.addEventListener("DOMContentLoaded", function () {
    let container = document.getElementById("outfit-container");
    let x = 50
    let y = 50

    prendasGuardadas.forEach(prenda => {
        let prendaId = `${prenda.id}`; // Asumiendo que cada prenda tiene un ID único

        console.log(prenda)
        // Crear un clon de la prenda en el canvas
        let originalPrenda = document.getElementById(prendaId);
        if (!originalPrenda) return;

        let clone = originalPrenda.cloneNode(true);
        clone.id = `outfit-${prendaId}`;
        clone.style.position = "absolute";

        // Agregar posición por defecto (puedes mejorarlo para guardar la posición original en la BD)
        clone.style.left = `${x}px`;
        clone.style.top = `${y}px`;

        // Agregar botón de eliminar
        let removeButton = document.createElement("button");
        removeButton.textContent = "X";
        removeButton.classList.add("eliminar-prenda");
        removeButton.onclick = function () {
            container.removeChild(clone);
            prendasEnCanvas.delete(prendaId);
            actualizarEstadoPrendas();
        };

        clone.appendChild(removeButton);
        clone.setAttribute("draggable", true);

        let boton = clone.querySelector('button:first-of-type');
        let img = clone.querySelector('img:first-of-type');
        if (boton) { // Verificar si se encontró el botón
            boton.classList.remove('p-4');
            boton.classList.remove('shadow-md');
            img.classList.add('bg-transparent');
            boton.classList.add('bg-transparent');
        }

        // Evento para mover dentro del canvas
        clone.ondragstart = function (event) {
            event.dataTransfer.setData("text", clone.id);
        };

        container.appendChild(clone);
        x+=150

        // Marcar la prenda original como usada
        prendasEnCanvas.add(prendaId);
    });

    actualizarEstadoPrendas();
});
