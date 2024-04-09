document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-subject');
    const idInput = document.getElementById('id');
    const nameInput = document.getElementById('name');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const subjectId = this.getAttribute('data-subject-id');
            const subjectName = this.getAttribute('data-subject-name');

            idInput.value = subjectId;
            nameInput.value = subjectName;

            console.log(subjectId, subjectName);
        });
    });
});