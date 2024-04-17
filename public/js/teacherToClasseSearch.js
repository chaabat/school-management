$("#search").on("keyup", function () {
    var query = $(this).val();

    $.ajax({
        url: "/teacher-to-classe/search",
        type: "GET",
        data: {
            query: query,
        },
        success: function (data) {
            $(".class-row").remove();
            $(".search-not-found").hide();

            if (data.length > 0) {
                data.forEach(function (result) {
                    var rowHtml = `
                                     <tr class="class-row">
                                     <td class="px-4 py-3 font-mono text-[#fb5607] font-bold">${result.id}</td>
                                     <td class="px-4 py-3 font-mono text-black font-bold">${result.classe.name}</td>
                                    <td class="px-4 py-3 font-mono text-black font-bold">${result.user.name}</td>
                                <td class="px-4 py-3 font-mono text-black font-bold">${result.statut}</td>
                          <td class="px-4 py-3 font-mono text-black font-bold">${result.created_at}</td>
                               <td class="px-4 py-3">
                           <div class="flex space-x-4 items-right">
                           <a href="/teacher-to-classe/${result.id}/edit">
                           <img src="/photos/update.png" class="h-6" alt="">
                       </a>
<button class="delete-class" data-class-id="${result.id}">
    <img src="/photos/delete.png" class="h-6" alt="">
</button>
</div>
</td>
</tr>`;
                    $("tbody").append(rowHtml);
                });
            } else {
                $(".search-not-found").show();
            }
        },
    });
});
