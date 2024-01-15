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
document.addEventListener('DOMContentLoaded', function () {
    var botonesAgregarCarrito = document.querySelectorAll('.agregar-carrito');
    botonesAgregarCarrito.forEach(function (boton) {
        boton.addEventListener('click', function () {
            var id = parseInt(this.closest('.catalog_card').getAttribute('data-id'));
            var nombre = this.closest('.catalog_card').getAttribute('data-nombre');
            var precio = parseFloat(this.closest('.catalog_card').getAttribute('data-precio'));
            agregarAlCarrito(id, nombre, precio);
        });
    });

    function agregarAlCarrito(id, nombre, precio) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './php/add_to_cart.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                //  document.getElementById('carrito').innerHTML = xhr.responseText;
            }
        };
        xhr.send('id=' + id + '&nombre=' + nombre + '&precio=' + precio);
    }
});
// END Add to cart, AJAX

// Delete from cart, AJAX
var botonesEleminarCarrito = document.querySelectorAll(".eliminar-item");
botonesEleminarCarrito.forEach(function (boton) {
    boton.addEventListener("click", function () {
        var liElement = this.parentNode;
        var idEliminar = this.getAttribute('data-id');
        eliminarVisualmenteDelCarrito(liElement);
        eliminarLogicamenteDelCarrito(idEliminar);
    });
});

function eliminarVisualmenteDelCarrito(li) {
    if (li) {
        li.remove();
    }
}

function eliminarLogicamenteDelCarrito(id){
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/delete_from_cart.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.ressponseText);
        }
    };
    xhr.send('eliminar_id=' + id);
}
//END Delete from cart, AJAX