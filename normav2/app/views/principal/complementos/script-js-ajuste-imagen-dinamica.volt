<script>
    // Espera a que el DOM esté completamente cargado
    document.addEventListener("DOMContentLoaded", function() {
        let htmlHeight = document.documentElement.scrollHeight;

        // Encuentra el contenedor según tus condiciones
        let container;
        if (document.getElementById('container-form-datos')) {
            container = document.getElementById('container-form-datos');
        } else if (document.getElementById('container-mensaje-bienvenida')) {
            container = document.getElementById('container-mensaje-bienvenida');
        } else if (document.querySelector('.container-mensaje')) {
            container = document.querySelector('.container-mensaje');
        }

        // Si se encuentra el contenedor
        if (container) {
            let height = htmlHeight; // Usa la altura del body
            height=height+50;
            // console.log(height+"alto");
            let fondo3 = document.querySelector('.fondoCustomJs');

            if (fondo3) {
                fondo3.style.setProperty('height', height + "px", 'important');
            }
        }
    });
</script>
