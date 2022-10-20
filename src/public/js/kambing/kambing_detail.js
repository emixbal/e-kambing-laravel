$(document).ready(function () {
    $("#modalAddMedecinesBtn").on("click", function () {
        $('#modalAddMedecines').modal("show")
    })

    $("#medecineOk").on("click", function () {
        var kambingId = $("#kambingId").val()
        var medicineId = $("#medecineOptions").find(":selected").val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_url}/kambings/add-medicine`,
            data: {
                kambingId, medicineId
            },
            type: "POST",
            success: function (response) {
                if(response.message!="ok"){
                    alert("Gagal simpan")
                    return
                }
                alert("behasil simpan")
                window.location.replace(`${base_url}/kambings/${kambingId}`);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                alert("Gagal simpan")
            }
        });
        
        return;
    })
})