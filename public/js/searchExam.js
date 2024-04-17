$('#search').on('keyup', function() {
    var query = $(this).val();

    $.ajax({
        url: "/exams/search",   
        type: "GET",
        data: { 'search': query },
        success: function(data) {
            $('.exam').empty();  
            $('.search-not-found').hide();

            if (data.length > 0) {
                data.forEach(function(examData) {
                    var rowHtml = `
                    <div class="class-card border-4 border-[#fb5607] relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm">
                        <div class="bg-white py-4 px-3" style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('${examData.image}') no-repeat center;background-size:cover">
                            <h1 class="text-3xl text-white text-center mb-2 font-bold font-mono">${examData.name}</h1>
                            <div class="flex justify-between">
                            <a href="/exams/${examData.id}">
                            <img src="/photos/update.png" class="h-6" alt="">
                                 </a>
                                <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this Class ?')) { document.getElementById('delete-form-${examData.id}').submit(); }">
                                    <img src="/photos/delete.png" class="h-6" alt="">
                                </a>
                                <form id="delete-form-${examData.id}" action="/delete-class/${examData.id}" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </div>
                        </div>
                    </div>`;
                    $('.exam').append(rowHtml);
                });
            } else {
                $('.search-not-found').show();
            }
        }
    });
});
