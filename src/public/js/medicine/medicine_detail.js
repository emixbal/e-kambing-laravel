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
        alert()
    })
})