document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.edit-subjectClasse');
    const idInput = document.getElementById('id');
    const classeInput = document.getElementById('classe');
    const subjectInput = document.getElementById('subject');

    editButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

     
            const subjectClasseId = this.getAttribute('data-class-id');
            const classeName = this.getAttribute('data-class-classe');
            const subjectName = this.getAttribute('data-class-subject');

         
            idInput.value = subjectClasseId;
            classeInput.value = classeName;
            subjectInput.value = subjectName;

            console.log(subjectClasseId, classeName, subjectName);
        });
    });
});