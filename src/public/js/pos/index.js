$(document).ready(function () {
    $('#anggota_detail').hide();
    $('#anggota_bayar').hide();
    var originalAnggotaBtn = document.getElementById("indikator_user_is_loading").innerHTML;

    $("#nomer_anggota").on("keyup", function () {
        $("#indikator_user_is_found").text("")
        $('#anggota_detail').hide();
        $('#anggota_bayar').hide();
        var nomer_anggota = $("#nomer_anggota").val()
        $("#indikator_user_is_loading").html('<i class="spinner-border spinner-border-sm"></i>');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_url}/pos/find_anggota`,

            type: "POST",
            data: {
                nomer_anggota:nomer_anggota
            },
            success: function (anggota) {
                if(anggota.length<1){
                    $('#anggota_detail').hide();
                    $('#anggota_bayar').hide();
                    
                    $("#indikator_user_is_found").text("user tidak ditemukan")
                    document.getElementById("indikator_user_is_loading").innerHTML = originalAnggotaBtn;
                    return;
                }

                document.getElementById("indikator_user_is_loading").innerHTML = originalAnggotaBtn;

                $("#id_anggota").val(anggota.id)
                $("#saldo").val((anggota.saldo)?anggota.saldo:0)

                $("#nomor_anggota_html").html(anggota.nomer_anggota)
                $("#nama_anggota_html").html(anggota.nama)
                $("#saldo_anggota_html").html((anggota.saldo_formated)?anggota.saldo_formated:0)

                $('#anggota_detail').show();
                $('#anggota_bayar').show();
                return
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
        return;
    })

    $("#nomer_anggota_btn").on("click", function () {
        var originalAnggotaBtn=document.getElementById("nomer_anggota_btn").innerHTML;
        document.getElementById("nomer_anggota_btn").innerHTML = originalAnggotaBtn;
        $("#nomer_anggota_btn").prop('disabled', false);

        $(this).prop("disabled", true);
    });

    $("#bayar_btn").on("click", function () {
        var id_anggota = $("#id_anggota").val()
        var saldo = parseInt($("#saldo").val())
        var nominal = parseInt($("#nominal").val())
        var password = $("#password").val()

        if(isNaN(nominal)){
            alert("nominal harus diisi")
            return
        }

        if((nominal<1)){
            alert("nominal tidak boleh 0")
            return
        }
        
        if(password==""){
            alert("password anggota harus diisi")
            return
        }
        
        if(nominal>saldo){
            alert("Saldo tidak cukup")
            return
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${base_url}/pos/charge/${id_anggota}`,
            type: "POST",
            data: {
                nominal, password
            },
            success: function (response) {
                if(!response){
                    alert("terjadi kesalahan...")
                    return
                }

                if(response.status=="nok"){
                    alert(response.message)
                    return
                }

                alert("sukses melakukan transaksi dengan voucher")

                var transaction_id = response.data.transaction.id
                print(transaction_id);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
        return
    })

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
                        window.location.replace(`${base_url}/pos`);
                    }
                }

                if(response){
                    var isPrint = await printDiv(response);
                    if(isPrint){
                        window.location.replace(`${base_url}/pos`);
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

function printDiv(content) {

    var newWin=window.open('','Print-Window');

    newWin.document.open();

    newWin.document.write('<html><body onload="window.print()">'+content+'</body></html>');

    newWin.document.close();

    setTimeout(function(){newWin.close();},10);

    return true

}