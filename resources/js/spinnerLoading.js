document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('environmentals'); // Selección del formulario
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Previene el envío inmediato del formulario
        document.getElementById('btn-send').classList.add('hidden');
        document.getElementById('loadingSpinner').classList.remove('hidden');

        // Esperar 1 segundos (1000 milisegundos)
        setTimeout(() => {
            form.submit(); // Envía el formulario después de 5 segundos
        }, 1000);
    });
});
