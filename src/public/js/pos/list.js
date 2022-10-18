$(document).ready(function () {
    $("#is_pdf_btn").on("click", function () {
        var month = $("#month").val();

        if(!month){
            alert("Pilih bulan terlebih dahulu")
            return;
        }

        var year = $("#year").val();
        var url = `${base_url}/pos/transactions/pdf?month=${month}&year=${year}`;

        window.open(url, '_blank').focus();
        return;
    })
})