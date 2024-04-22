document.querySelectorAll('.absence-btn').forEach(button => {
    button.addEventListener('click', function() {
        const form = button.closest('.absence-form');
        const formData = new FormData(form);
        formData.append('statut', button.dataset.statut);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const studentId = form.querySelector('input[name="user_id"]').value;
                const statusCell = document.getElementById('absence-status-' + studentId);
                if (button.dataset.statut === 'present') {
                    statusCell.innerHTML = '<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">Present</span>';
                } else {
                    statusCell.innerHTML = '<span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm">Absent</span>';
                }
             
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
