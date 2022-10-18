var anggota_id

$(document).ready(function () {
    $("#topup_btn").on("click", function () {
        anggota_id = $("#anggota_id").val()
        var nominal = $("#nominal").val()
        var keterangan = $("#keterangan").val()
        var password = $("#password").val()

        if(!nominal){
            alert("nominal harus diisi");
            return
        }

        if(isNaN(nominal)){
            alert("nominal harus berformat angka");
            return
        }
        
        if(!keterangan){
            alert("keterangan harus diisi");
            return
        }
        
        if(!password){
            alert("password harus diisi");
            return
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_url}/anggota/${anggota_id}/topup`,
            type: "POST",
            data: {
                nominal, keterangan, password
            },
            success: function (response) {
                if(!response){
                    alert("terjadi kesalahan")
                    return
                }
                if(response.status=="nok"){
                    alert(response.message)
                    return
                }
                alert("top up sukses")

                var transaction_id = response.data.transaction.id
                print(transaction_id)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                return
            }
        });

        function print(transaction_id){
        
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `${base_url}/pos/print_charge/${transaction_id}`,
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