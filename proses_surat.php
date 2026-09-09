<?php
//masukkan library domPDF
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

//instansiasi objek dompdf
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //ambil data dari form html
    $nama         = htmlspecialchars($_POST['nama']);
    $nis          = htmlspecialchars($_POST['nis']);
    $kelas        = htmlspecialchars($_POST['kelas']);
    $alasan       = htmlspecialchars($_POST['alasan']);
    $tgl_mulai    = date('d F Y', strtotime($_POST['tgl_mulai']));
    $tgl_selesai  = date('d F Y', strtotime($_POST['tgl_selesai']));
    $keterangan   = htmlspecialchars($_POST['keterangan']);
    $tgl_sekarang = date('d F Y');

//template halaman pdf
$html = '
   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak surat</title>  
    <style>
        body{
            font-family: "Times New Roman";
            font-size: 12pt;
            margin: 20px;
            }
            .kop{
                font-family: "century gothic";
                text-align: center;
                border-bottom: 3px double #000; 
                padding-bottom: 10px;
                margin-bottom: 20px;
            }
            .kop h2{
                 margin: 0;
                 font-size: 16pt;
                 text-transform: uppercase;
            }
            .kop p{
                  margin: 2px;
                  font-size: 10pt;
            }
            .title{
                 text-align: center;
                 font-weight: bold;
                 text-decoration: underline;
                 margin-bottom: 25px;
            }
            .content{
                 line-height: 1.6;
                 text-align: justify;
            }
            .table-data{
                 margin: 15px 0 15px 30px;
                 width: 100%;
            }
            .table-data td{
                 padding: 4px 0;
                 vertical-align: top;
            }
            .ttd-container{
                 width: 100%;
                 margin-top: 50px;
             }
            .ttd-box{
                 float: right;
                 width: 200px;
                 text-align: center;
            }
    </style>
   </head>
   <body>
    <div class="kop">
         <h2>|SMK TEXMACO SEMARANG</h2>
         <p>Jl.Raya Mangkang Kulon | Telp: (024) 223-8889</p>
    </div>
    <div class="title">SURAT IZIN MENINGGALKAN KELAS<div>

    <div class="content">
          <p>Yang bertanda tangan di bawah ini :</p>
         <table class="table-data">
            <tr>
                <td width="130">Nama</td>
                <td width="15">:</td>
                <td><b>' . $nama . '</b></td>
            </tr>
            <tr>
                <td width="130">NIS</td>
                <td>:</td>
                <td>' . $nis . '</td>
            </tr>
            <tr>
                <td width="130">Kelas</td>
                <td>:</td>
                <td>' . $kelas . '</td>
            </tr>
            </table>

        <p>Bermaksud untuk mengajukan izin meninggalkan kelas, pada tangga </b> ' . $tgl_mulai . '<b> sampai dengan </b> ' . $tgl_selesai . '</b> dikarenakan <b> . $alasan . </b> </p>
        ' . (isset($keterangan) ? '<p>Detail keterangan : ' . $keterangan . '</p>' : '') . '
        <p>Demikian surat izin ini saya buat. Terimakasih atas perhatian Bapak/Ibu, saya ucapkan Terimakasih</p>

        <div class="ttd-container">
           <div class="ttd_box">
               <p>Semarang, ' . $tgl_sekarang . ' <br>Hormat Saya,</p>
               <p><b>' . $nama . '</b></p>
   </body>
     </html>
     ';

     $options = new Options();
     $options->set('isRemoteEnabled', true);

     $dompdf = new Dompdf($options);
     $dompdf->loadHtml($html);
     $dompdf->setPaper('A4', 'portrait');
     $dompdf->render();

     $dompdf->stream('surat_izin_' . str_replace(' ', '_', $nama) . ".pdf", ["Attachment" => false]);
     
}
?>