document.addEventListener("DOMContentLoaded", function () {
    fetch('../ville.json')
        .then(response => response.json())
        .then(data => {
            const departSelect = document.getElementById('ville');
            
            data.forEach(city => {
                const option = document.createElement('option');
                option.value = city.ville;
                option.textContent = city.ville;
                departSelect.appendChild(option);
            });

           
        })
        .catch(error => console.error('Error fetching JSON:', error));
});