$(document).ready(function () {
    $("#modalAddMedecinesBtn").on("click", function () {
        $('#modalAddMedecines').modal("show")
    })

    $("#modalPindahKandangBtn").on("click", function () {
        $('#modalPindahKandang').modal("show")
    })

    $("#medecineOk").on("click", function () {
        var kambingId = $("#kambingId").val()
        var medicineId = $("#medecineOptions").find(":selected").val();
        var medicineDosing = $("#medicineDosing").val()

        if (!medicineDosing) {
            alert("Masukkan jumlah dosis yang diberikan terlebih dahulu")
            return
        }

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
                if (response.message != "ok") {
                    alert("Gagal simpan")
                    console.log(response);
                    return
                }
                $("#medicineIdSaved").val(medicineId)
                $('#modalAddMedecinesSuccess').modal("show")
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                alert("Gagal simpan")
            }
        });

        return;
    })

    $("#massMediciningBtnNo").on("click", function () {
        window.location.replace(`${base_url}/kambings/${kambingId}?histrory_view=medicine`);
    })
    
    $("#massMediciningBtnOk").on("click", function () {
        var medicineId = $("#medicineIdSaved").val()
        window.location.replace(`${base_url}/medicines/${medicineId}`);
    })

    $("#kandangOk").on("click", function () {
        var kambingId = $("#kambingId").val()
        var kandangId = $("#kandangOptions").find(":selected").val()

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_url}/kambings/pindah-kandang`,
            data: {
                kambingId, kandangId
            },
            type: "POST",
            success: function (response) {
                console.log(response);
                if (response.message != "ok") {
                    alert("Gagal simpan 1")
                    return
                }
                alert("behasil simpan")
                window.location.replace(`${base_url}/kambings/${kambingId}?histrory_view=kandang`);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                alert("Gagal simpan 2")
            }
        });

        return;
    })
})