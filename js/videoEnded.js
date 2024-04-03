document.addEventListener('DOMContentLoaded',() => {
    document.getElementById('videoPlayer').addEventListener('ended', function() {
        const input = document.getElementById('idCourse').value

        // Crear un objeto FormData para enviar los datos
        var formData = new FormData();
        formData.append('data', input);
        

        // Configurar la solicitud POST
        var requestOptions = {
            method: 'POST',
            body: formData
        };

        // Realizar la solicitud fetch
        fetch('/views/courseVideo.php', requestOptions)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud POST');
                }
                console.log('Solicitud POST completada con éxito');
            })
            .catch(error => {
                console.error('Error en la solicitud POST:', error.message);
            });    
       
    });
})