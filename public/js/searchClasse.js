$('#search').on('keyup', function() {
    var query = $(this).val();

    $.ajax({
        url: "/classes/search",   
        type: "GET",
        data: { 'search': query },
        success: function(data) {
            $('.grid').empty();  
            $('.search-not-found').hide();

            if (data.length > 0) {
                data.forEach(function(classeData) {
                    var rowHtml = `
                    <div class="class-card border-4 border-[#fb5607] relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm">
                        <div class="bg-white py-4 px-3" style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('${classeData.image}') no-repeat center;background-size:cover">
                            <h1 class="text-3xl text-white text-center mb-2 font-bold font-mono">${classeData.name}</h1>
                            <div class="flex justify-between">
                                <span data-modal-target="update-modal" data-modal-toggle="update-modal">
                                    <a href="#" class="edit-class" data-class-id="${classeData.id}" data-class-name="${classeData.name}">
                                        <img src="/photos/update.png" class="h-6" alt="">
                                    </a>
                                </span>
                                <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this Class ?')) { document.getElementById('delete-form-${classeData.id}').submit(); }">
                                    <img src="/photos/delete.png" class="h-6" alt="">
                                </a>
                                <form id="delete-form-${classeData.id}" action="/delete-class/${classeData.id}" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </div>
                        </div>
                    </div>`;
                    $('.grid').append(rowHtml);
                });
            } else {
                $('.search-not-found').show();
            }
        }
    });
});
