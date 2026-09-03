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