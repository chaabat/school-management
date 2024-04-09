$('#search').on('keyup', function() {
    var query = $(this).val();

    $.ajax({
        url: "/classes/search",   
        type: "GET",
        data: { 'search': query },
        success: function(data) {
            $('.class-row').remove();
            $('.search-not-found').hide();

            if (data.length > 0) {
                data.forEach(function(classeData) {
                    var rowHtml = `
                        <tr class="class-row">
                            <td class="px-4 py-3 font-mono text-[#fb5607] font-bold">${classeData.id}</td>
                            <td class="px-4 py-3 font-mono text-black font-bold">${classeData.name}</td>
                            <td class="px-4 py-3 font-mono text-black font-bold">${classeData.statut}</td>
                            <td class="px-4 py-3 font-mono text-black font-bold">${classeData.created_at}</td>
                            <td class="px-4 py-3">
                                <div class="flex space-x-4 items-right">
                                    <span data-modal-target="update-modal" data-modal-toggle="update-modal">
                                        <a href="#" class="edit-class" data-class-id="${classeData.id}" data-class-name="${classeData.name}">
                                            <img src="/photos/update.png" class="h-6" alt="">
                                        </a>
                                    </span>
                                    <button class="delete-class" data-class-id="${classeData.id}">
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
