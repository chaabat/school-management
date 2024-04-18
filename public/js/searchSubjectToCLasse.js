$("#search").on("keyup", function () {
    var query = $(this).val();

    $.ajax({
        url: "/search-subject-to-class",
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
<a href="/subject-to-class/${subjectToClasse.id}/edit">
<img src="/photos/update.png" class="h-6" alt="">
</a>
<a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this subject?')) { document.getElementById('delete-form-${subjectToClasse.id}').submit(); }">
                                        <img src="/photos/delete.png" class="h-6" alt="">
                                    </a>
                                    <form id="delete-form-${subjectToClasse.id}" action="/subject-to-class/${subjectToClasse.id}" method="POST" style="display: none;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">
                                    </form>
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
