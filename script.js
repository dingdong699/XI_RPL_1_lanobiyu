function tampilkannama() {
    document.getElementById("namaAnggota").innerHTML = `
            <ol style="list-style-type: decimal; padding-left: 5%;">
                <li>lano (lanogmail.com)</li>
                <li>biyu (biyugmail.com)</li>
            </ol>

            <button onclick="location.reload()">
            tutup kembali
            </button>
        `;
}

function validasiform(){
    var tglmulai = document.getElementById('tgl_mulai')
    var tglselesai = document.getElementById('tgl_selesai')
    
    if(new date(tglselesai) < new Date(tglmulai)){
        alert('Tanggal Selesai Tidak Boleh Lebih Awal Dari Tanggal Mulai!');
    }

    return true;
}