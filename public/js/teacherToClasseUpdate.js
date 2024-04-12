document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-teacherClasse');
    const idInput = document.getElementById('id');
    const classeInput = document.getElementById('classe');
    const teacherInput = document.getElementById('teacher');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

     
            const teacherClasseId = this.getAttribute('data-class-id');
            const classeName = this.getAttribute('data-class-classe');
            const teacherName = this.getAttribute('data-class-teacher');

         
            idInput.value = teacherClasseId;
            classeInput.value = classeName;
            teacherInput.value = teacherName;

            console.log(teacherClasseId, classeName, teacherName);
        });
    });
});