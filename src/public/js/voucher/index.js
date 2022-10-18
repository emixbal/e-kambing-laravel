$(document).ready(function () {
    $("#run_btn_modal").on("click", function () {
        $('#passwordModal').modal('show');
        return;
    })
    $("#run_btn").on("click", function () {
        var password = $("#password").val()

        if(password==""){
            alert("password required")
            return;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_url}/voucher/topup-listed/go`,
            type: "POST",
            data: {password},
            beforeSend: function() { 
                $('#loading_modal').modal('show');
                $('#passwordModal').modal('hide');
                return
            },
            complete: function() {
                $('#passwordModal').modal('hide');
                return
            },
            success: function (response) {
                $('#loading_modal').modal('hide');
                $("#password").val('');

                if(!response){
                    alert("terjadi kesalahan")
                    window.location.replace();
                    return
                }
                if(response.status=="nok"){
                    alert(response.message)
                    window.location.replace();
                    return
                }
                var file_id = response.topup_file_id
                print(file_id);
                $('#sukses_modal').modal('show');
                return
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                return
            }
        }); 

        function print(file_id){
        
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `${base_url}/voucher/topup-listed/print/${file_id}`,
                type: "POST",
                data: {},
                success: async function (response, textStatus, xhr) {
                    if(xhr.status){
                        if(xhr.status!=200){
                            alert("terjadi kesalahan");
                            window.location.replace(`${base_url}/anggota/${anggota_id}`);
                        }
                    }
    
                    if(response){
                        var isPrint = await printDiv(response);
                        if(isPrint){
                            window.location.replace(`${base_url}/anggota/${anggota_id}`);
                        }
                    }
                    
                    return
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    })
})

function printDiv(content) {

    var newWin=window.open('','Print-Window');

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">'+content+'</body></html>');

    newWin.document.close();

    setTimeout(function(){newWin.close();},10);

    return true

}