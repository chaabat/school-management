$("#search").on("keyup", function () {
    var query = $(this).val();

    $.ajax({
        url: "/subject-to-class/search",
        type: "GET",
        data: {
            query: query,
        },
        success: function (data) {
            $(".class-row").remove();
            $(".search-not-found").hide();

            if (data.length > 0) {
                data.forEach(function (subjectToClasse) {
                    var rowHtml = `
<tr class="class-row">
<td class="px-4 py-3 font-mono text-[#fb5607] font-bold">${subjectToClasse.id}</td>
<td class="px-4 py-3 font-mono text-black font-bold">${subjectToClasse.classe.name}</td>
<td class="px-4 py-3 font-mono text-black font-bold">${subjectToClasse.subject.name}</td>
<td class="px-4 py-3 font-mono text-black font-bold">${subjectToClasse.statut}</td>
<td class="px-4 py-3 font-mono text-black font-bold">${subjectToClasse.created_at}</td>
<td class="px-4 py-3">
<div class="flex space-x-4 items-right">
<a href="/subject-to-classe/${subjectToClasse.id}/edit">
<img src="/photos/update.png" class="h-6" alt="">
</a>
<button class="delete-class" data-class-id="${subjectToClasse.id}">
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
