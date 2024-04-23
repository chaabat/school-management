$(document).ready(function() {
    $('#search').on('keyup', function() {
        var query = $(this).val();

        $.ajax({
            url: "/search-classes",
            type: "GET",
            data: { 'search': query },
            success: function(data) {
                $('.class-card').remove();
 
                if (data.length > 0) {
           
                    $('.search-not-found').hide();
                    
                   
                    data.forEach(classeData => {
                        const rowHtml = `
                            <div class="class-card border-4 border-[#fb5607] relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm">
                                <div class="bg-white py-4 px-3" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('photos/classe1.jpg') no-repeat center; background-size: cover;">
                                    <h1 class="text-3xl text-white text-center mb-2 font-bold font-mono">${classeData.name}</h1>
                                    <div class="flex justify-between">
                                        <a href="/classes/${classeData.id}/edit">
                                            <img src="/photos/update.png" class="h-6" alt="">
                                        </a>
                                        <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this subject?')) { document.getElementById('delete-form-${classeData.id}').submit(); }"><img src="/photos/delete.png" class="h-6" alt=""></a>
                                        <form id="delete-form-${classeData.id}" action="/classes/${classeData.id}" method="POST" style="display: none;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                        </form>
                                    </div>
                                </div>
                            </div>`;

                        $('.classData').append(rowHtml);
                    });
                } else {
                     
                    $('.search-not-found').show();
                }
            }
        });
    });
});
