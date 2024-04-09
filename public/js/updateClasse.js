document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-class');
    const idInput = document.getElementById('id');
    const nameInput = document.getElementById('name');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const classId = this.getAttribute('data-class-id');
            const className = this.getAttribute('data-class-name');

            idInput.value = classId;
            nameInput.value = className;

            console.log(classId, className);
        });
    });
});