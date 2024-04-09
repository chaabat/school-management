$('#search').on('keyup', function() {
    var query = $(this).val();

    $.ajax({
        url: "/subjects/search", // Set the URL directly without Blade syntax
        type: "GET",
        data: { 'search': query },
        success: function(data) {
            $('.class-row').remove();
            $('.search-not-found').hide();

            if (data.length > 0) {
                data.forEach(function(subjectData) {
                    var rowHtml = `
                        <tr class="class-row">
                            <td class="px-4 py-3 font-mono text-[#fb5607] font-bold">${subjectData.id}</td>
                            <td class="px-4 py-3 font-mono text-black font-bold">${subjectData.name}</td>
                            <td class="px-4 py-3 font-mono text-black font-bold">${subjectData.statut}</td>
                            <td class="px-4 py-3 font-mono text-black font-bold">${subjectData.created_at}</td>
                            <td class="px-4 py-3">
                                <div class="flex space-x-4 items-right">
                                    <span data-modal-target="update-modal" data-modal-toggle="update-modal">
                                        <a href="#" class="edit-class" data-class-id="${subjectData.id}" data-class-name="${subjectData.name}">
                                            <img src="/photos/update.png" class="h-6" alt="">
                                        </a>
                                    </span>
                                    <button class="delete-class" data-class-id="${subjectData.id}">
                                        <img src="/photos/delete.png" class="h-6" alt="">
                                    </button>
                                </div>
                            </td>
                        </tr>`;
                    $('tbody').append(rowHtml);
                });

              
            } else {
                $('.search-not-found').show();
            }
        }
    });
});
