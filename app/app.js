// Burguer Menu
document.addEventListener('DOMContentLoaded', function () {
    var burguerMenu = document.getElementById("burguer_menu");
    var navItems = document.querySelector(".header-nav_items");
    burguerMenu.addEventListener("click", function () {
        if (navItems.style.maxHeight === "0rem" || navItems.style.maxHeight === "") {
            navItems.style.maxHeight = "100rem";
        } else {
            navItems.style.maxHeight = "0rem";
        }
    });
});
// END Burguer Menu

// Add to cart, AJAX
var botonesAgregarCarrito = document.querySelectorAll('.agregar-carrito');
botonesAgregarCarrito.forEach(function (boton) {
    boton.addEventListener('click', function () {
        var id = parseInt(this.closest('.catalog_card').getAttribute('data-id'));
        var nombre = this.closest('.catalog_card').getAttribute('data-nombre');
        var precio = parseFloat(this.closest('.catalog_card').getAttribute('data-precio'));
        var cantidad = parseInt(this.previousElementSibling.value);
        agregarAlCarrito(id, nombre, precio, cantidad);

        reiniciarValorInput(this.previousElementSibling);
        botonparrafo = this.querySelector("p");
        agregarAlCarritoAnimacion(botonparrafo);
    });
});

function agregarAlCarrito(id, nombre, precio, cantidad) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './php/add_to_cart.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            actualizarNumeroCarrito(xhr.responseText);
        }
    };
    xhr.send('id=' + id + '&nombre=' + nombre + '&precio=' + precio + "&cantidad=" + cantidad);
}

function actualizarNumeroCarrito(cantidad) {
    var numeroCarritoElement = document.getElementById('numero-carrito');
    numeroCarritoElement.innerText = cantidad;
}

function reiniciarValorInput(input) {
    input.value = 1;
}

function agregarAlCarritoAnimacion(parrafo) {
    parrafo.classList.add('fade-out');
    setTimeout(function () {
        parrafo.classList.remove('fade-out');
        parrafo.innerText = "Item added!";
    }, 500);

    setTimeout(function () {
        parrafo.classList.add('fade-out');
    }, 2000);

    setTimeout(function () {
        parrafo.classList.remove('fade-out');
        parrafo.innerText = "Add to cart.";
    }, 2500);
}


// END Add to cart, AJAX

// Delete from cart, AJAX
var botonesEleminarCarrito = document.querySelectorAll(".eliminar-item");
botonesEleminarCarrito.forEach(function (boton) {
    boton.addEventListener("click", function () {
        //var liElement = this.parentNode;
        var idEliminar = this.getAttribute('data-id');
        //eliminarVisualmenteDelCarrito(liElement);
        eliminarLogicamenteDelCarrito(idEliminar);
    });
});

function eliminarLogicamenteDelCarrito(id) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/delete_from_cart.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
            location.reload();
        }
    };
    xhr.send('eliminar_id=' + id);
}
//END Delete from cart, AJAX

// Update Cart
var botonesActualizarCarrito = document.querySelectorAll('.actualizar-cantidad');
botonesActualizarCarrito.forEach(function (boton) {
    boton.addEventListener('click', function () {
        var id = this.getAttribute('data-id');
        var inputId = 'cantidad-' + id;
        var cantidad = parseInt(document.getElementById(inputId).value);
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '../php/add_to_cart.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                location.reload();
            }
        };
        xhr.send('id=' + id + "&cantidad=" + cantidad + '&update=true');
    });
});
// END Update Cart