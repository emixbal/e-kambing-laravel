$(document).ready(function () {
    $("#disable_ok").on("click", function () {
        var id = $(this).data("id");
        update(id)
    });

    function update(id) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_url}/anggota/${id}/disable`,
            type: "PUT",
            success: function (response) {
                window.location.replace(`${base_url}/anggota/${id}`);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
})