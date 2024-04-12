$(document).ready(function() {
    $('#search').on('keyup', function() {
        var query = $(this).val();

        $.ajax({
            url: "/search-parents", 
            type: "GET",
            data: {
                'search': query
            },
            success: function(data) {
                $('.parent-card').remove();
                $('.search-not-found').hide();

                if (data.length > 0) {
                    data.forEach(function(parent) {
                        var cardHtml = `<div class="parent-card bg-[#03045e] hover:bg-[#fb5607] flex flex-col items-center p-4  rounded-xl">
                        <img class="object-cover w-14 h-14 rounded-full ring-4 ring-white"
                            src="/users/${parent.picture}" alt="">
                        <h1 class="mt-4 text-xl font-semibold font-mono text-white capitalize dark:text-white group-hover:text-white">${parent.name}</h1>
                        <div class="flex mt-3 -mx-2 space-x-4">
                            <a href="/parents/${parent.id}"><img src="/photos/show.png" class="h-6" alt=""></a>
                            <a href="/parents/${parent.id}/edit"><img src="/photos/update.png" class="h-6" alt=""></a>
                            <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this parent?')) { document.getElementById('delete-form-${parent.id}').submit(); }"><img src="/photos/delete.png" class="h-6" alt=""></a>
                            <form id="delete-form-${parent.id}" action="/parents/${parent.id}" method="POST" style="display: none;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>
                    </div>`;

                        $('.grid').append(cardHtml);
                    });
                } else {
                    $('.search-not-found').show();
                }
            }
        });
    });
});