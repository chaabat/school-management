$('#search').on('keyup', function() {
    var query = $(this).val();

    $.ajax({
        url: "/classes/search", // Set the URL directly without Blade syntax
        type: "GET",
        data: { 'search': query },
        success: function(data) {
            $('.class-row').remove();
            $('.search-not-found').hide();

            if (data.length > 0) {
                data.forEach(function(classData) {
                    var rowHtml = `
                        <tr class="class-row">
                            <td class="px-4 py-3 font-mono text-[#fb5607] font-bold">${classData.id}</td>
                            <td class="px-4 py-3 font-mono text-black font-bold">${classData.name}</td>
                            <td class="px-4 py-3 font-mono text-black font-bold">${classData.statut}</td>
                            <td class="px-4 py-3 font-mono text-black font-bold">${classData.created_at}</td>
                            <td class="px-4 py-3">
                                <div class="flex space-x-4 items-right">
                                    <span data-modal-target="update-modal" data-modal-toggle="update-modal">
                                        <a href="#" class="edit-class" data-class-id="${classData.id}" data-class-name="${classData.name}">
                                            <img src="/photos/update.png" class="h-6" alt="">
                                        </a>
                                    </span>
                                    <button class="delete-class" data-class-id="${classData.id}">
                                        <img src="/photos/delete.png" class="h-6" alt="">
                                    </button>
                                </div>
                            </td>
                        </tr>`;
                    $('tbody').append(rowHtml);
                });

                // Rebind event listeners for edit and delete buttons
                $('.edit-class').click(function() {
                    var classId = $(this).data('class-id');
                    var className = $(this).data('class-name');
                    $('#id').val(classId);
                    $('#name').val(className);
                });

                $('.delete-class').click(function() {
                    var classId = $(this).data('class-id');
                    if (confirm('Are you sure you want to delete this Class?')) {
                        $('form#delete-form-' + classId).submit();
                    }
                });
            } else {
                $('.search-not-found').show();
            }
        }
    });
});
