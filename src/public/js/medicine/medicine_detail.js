$(document).ready(function () {
    $("#searchBtn").on("click", function () {
        var kambingNumber = $("#kambingNumber").val()

        if(!kambingNumber){
            alert("masukkan nomer kambing")
            return
        }
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_url}/kambings/${kambingNumber}/check`,
            type: "GET",
            success: function (response) {
                if(!response.isValid){
                    alert("Tidak ditemukan")
                    return
                }

                $("#kambingNumberHtml").html(response.data.number)
                $("#kambingNameHtml").html(response.data.name)

                $("#kambingId").val(response.data.id)
                $("#kambingNumber").val("")
                $('#modalKambingDetail').modal("show")
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
        
        return;
    });

    $("#massMediciningBtnNo").on("click", function () {
        $('#modalKambingDetail').modal("hide")
    })

    $("#massMediciningBtnOk").on("click", function () {
        var kambingId = $("#kambingId").val()
        var medicineId = $("#medicineId").val();
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
                kambingId, medicineId, medicineDosing
            },
            type: "POST",
            success: function (response) {
                if (response.message != "ok") {
                    alert("Gagal simpan")
                    console.log(response);
                    return
                }
                // reset data
                $("#kambingNumberHtml").html("")
                $("#kambingNameHtml").html("")
                $("#kambingId").val("")

                $('#modalKambingDetail').modal("hide")

                alert("Data berhasil disimpan.")
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                alert("Gagal simpan")
            }
        });

        return;
    })
})