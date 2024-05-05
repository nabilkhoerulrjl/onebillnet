<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
       	<link rel="stylesheet" href="<?= base_url()?>/public/css/style-invoice-pdf.css">
        <style>		
		    *,
		    *::after,
		    *::before {
		        padding: 0;
		        margin: 0;
		        box-sizing: border-box;
		    }
		
		    :root {
		        --blue-color: #0c2f54;
		        --dark-color: #535b61;
		        --white-color: #fff;
		    }
		
		    ul {
		        list-style-type: none;
		    }
		
		    ul li {
		        margin: 2px 0;
		    }
		
		    /* text colors */
		    .text-dark {
		        color: var(--dark-color);
		    }
		
		    .text-blue {
		        color: var(--blue-color);
		    }
		
		    .text-end {
		        text-align: right;
		    }
		
		    .text-center {
		        text-align: center;
		    }
		
		    .text-start {
		        text-align: left;
		    }
		
		    .text-bold {
		        font-weight: 700;
		    }
		
		    /* hr line */
		    .hr {
		        height: 1px;
		        background-color: rgba(0, 0, 0, 0.1);
		    }
		
		    /* border-bottom */
		    .border-bottom {
		        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
		    }
		
		    body {
		        font-family: 'Poppins', sans-serif;
		        color: var(--dark-color);
		        font-size: 14px;
		    }
		
		    .invoice-wrapper {
		        min-height: 100vh;
		        /* background-color: rgba(0, 0, 0, 0.1); */
		        padding-top: 20px;
		        padding-bottom: 20px;
		    }
		
		    .invoice {
		        max-width: 850px;
		        margin-right: auto;
		        margin-left: auto;
		        background-color: var(--white-color);
		        padding: 50px;
		        border: 1px solid rgba(0, 0, 0, 0.2);
		        border-radius: 5px;
		        min-height: 920px;
		    }
		
		    .invoice-head-top-left {
		        display: flex;
		        flex-direction: row;
		        align-items: center;
		    }
		
		    .invoice-head-top-left img {
		        width: 70px;
		    }
		
		    .invoice-head-top-left .corps-name,
		    .invoice-head-top-left h1 {
		        font-size: 20px;
		    }
		
		    .invoice-head-top-right {
		        display: flex;
		    }
		
		    .invoice-head-top-right .support-name {
		        font-size: 1.3vw;
		        padding-left: 2px;
		        padding-right: 2px;
		    }
		
		    .invoice-head-top-right img {
		        width: 120px;
		    }
		
		    .invoice-head-top-right h3 {
		        font-weight: 500;
		        font-size: 27px;
		        color: var(--blue-color);
		    }
		
		    .invoice-head-middle,
		    .invoice-head-bottom {
		        padding: 16px 0;
		    }
		
		    .invoice-body {
		        border: 1px solid rgba(0, 0, 0, 0.1);
		        border-radius: 4px;
		        overflow: hidden;
		    }
		
		    .invoice-body table {
		        border-collapse: collapse;
		        border-radius: 4px;
		        width: 100%;
		    }
		
		    .invoice-body table td,
		    .invoice-body table th {
		        padding: 12px;
		    }
		
		    .invoice-body table tr {
		        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
		    }
		
		    .invoice-body table thead {
		        background-color: rgba(0, 0, 0, 0.02);
		    }
		
		    .invoice-body-info-item {
		        display: grid;
		        grid-template-columns: 80% 20%;
		    }
		
		    .invoice-body-info-item .info-item-td {
		        padding: 12px;
		        background-color: rgba(0, 0, 0, 0.02);
		    }
		
		    .invoice-foot {
		        padding: 30px 0;
		    }
		
		    .invoice-foot p {
		        font-size: 12px;
		    }
		
		    .invoice-btns {
		        margin-top: 20px;
		        display: flex;
		        justify-content: center;
		    }
		
		    .invoice-btn {
		        padding: 3px 9px;
		        color: var(--dark-color);
		        font-family: inherit;
		        border: 1px solid rgba(0, 0, 0, 0.1);
		        cursor: pointer;
		    }
		
		    .invoice-head-top {
		        display: flex;
		        flex-direction: row;
		        justify-content: space-between;
		        align-items: center;
		    }
		
		    .invoice-head-middle,
		    .invoice-head-bottom {
		        display: grid;
		        grid-template-columns: repeat(2, 1fr);
		        padding-bottom: 10px;
		    }
		
		    .m-t-3 {
		        margin-top: 3vw;
		    }
		
		    .font-bold {
		        font-weight: bold;
		    }
		
		    @media screen and (max-width: 992px) {
		        .invoice {
		            padding: 40px;
		        }
		    }
		
		    @media screen and (max-width: 576px) {
		
		        /* .invoice-head-top, */
		        .invoice-head-middle,
		        .invoice-head-bottom {
		            grid-template-columns: repeat(1, 1fr);
		        }
		
		        .invoice-head-bottom-right {
		            margin-top: 12px;
		            margin-bottom: 12px;
		        }
		
		        .invoice * {
		            text-align: left;
		        }
		
		        .invoice {
		            padding: 28px;
		        }
		    }
		
		    .overflow-view {
		        overflow-x: scroll;
		    }
		
		    .invoice-body {
		        min-width: 600px;
		    }
		
		    @media print {
		        .print-area {
		            visibility: visible;
		            width: 100%;
		            /* position: absolute; */
		            left: 0;
		            top: 0;
		            overflow: hidden;
		        }
		
		        .overflow-view {
		            overflow-x: hidden;
		        }
		
		        .invoice-btns {
		            display: none;
		        }
		    }
		</style>
    </head>
    <body>
        <div class = "invoice-wrapper" id = "print-area" style="background-color:pink;">
            <section class="invoice">
    <form action="http://[::1]/jirais/customerclient/bill" method="post">
        <div style="margin-left: 5px;" class="row">
            <div class="col-xs-12">
            <h2 class="page-header">
            <img src="http://[::1]/jirais/assets/img/logo.png" style="width:4%"><strong> PT. Jirais Global Network</strong><text style="font-size:0.8vw">  Support by</text><img src="http://[::1]/jirais/assets/img/logo-asnet.png" style="width:8%"><text style="font-size:0.8vw">
            <small style="margin-right: 5px;" class="pull-right">Dicetak Tanggal : </small>
            </text></h2>
            </div>

        </div>

        <div style="margin-left: 5px;" class="row invoice-info">
            <div class="col-sm-4 invoice-col">
            Dari
            <address>
            <strong>Jirais Global Network</strong><br>
            Jl. Ceremai ujung no.14 rt.02 rw.12<br>
            kel.bantarjati kec.bogor utara, Kota Bogor 16153<br>
            Phone: 082123002023 <br>
            Email: jiraisglobalnetwork@gmail.com  <br>
            </address>
            <input type="hidden" name="vendorid" value="">
            <input type="hidden" name="onu" value="">
            <input type="hidden" name="sn" value="">
            </div>

            <div class="col-sm-4 invoice-col">
            Untuk
            <address>
            <text><strong>Test</strong></text><br>
            Ciremai Ujung RT 04/04 <br>
            Desa Ciawi Kec Ciawi, Kota Bogor (16722)<br>
            <input type="hidden" name="namacst" value="Test" <="" input="">
            <input type="hidden" name="desa" value="1" <="" input="">
            <input type="hidden" name="kecamatan" value="1" <="" input="">
            <input type="hidden" name="kota" value="2" <="" input="">
            <input type="hidden" name="pos" value="3" <="" input="">
            <input type="hidden" name="nohp" value="081987817611" <="" input="">
            Phone: 081987817611<br>
            Email: -            </address>
            </div>

            <div class="col-sm-4 invoice-col">
            <input type="hidden" name="invoice" value="IN2405050001">
            Invoice No : <b>IN2405050001</b><br>
            <br>
            <text>Customer ID: <b> JGN/00000001</b></text><br>
            <input type="hidden" name="cust_id" value="JGN/00000001">
            <input type="hidden" name="id_cust" value="48">
            <text>Jatuh Tempo: <b> 2024-May-10 </b></text><br>
            <input type="hidden" name="due_date" value="2024-05-10" <="" input="">
            </div>

        </div>


        <div style="margin-left: 5px;" class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Description</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><text>Paket10 Mb Up to</text></td>
                            <input type="hidden" name="namapaket" value="Paket10 Mb Up to">
                            <input type="hidden" name="paket" value="91">
                            <td>Prabayar Paket 10 Mbps up to<br>0000-00-00 s/d 0000-00-00</td>
                            <input type="hidden" name="start_date" value="0000-00-00">
                            <input type="hidden" name="end_date" value="0000-00-00">
                            <input type="hidden" name="harga" value="150000">
                            <td>Rp. 150,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <div style="margin-left: 5px;" class="row">
            <div class="col-xs-6">
            <p class="lead">Metode Pembayaran:</p>
                <p> Bank Transfer </p>
                <p><strong></strong></p><h5><strong>Bank Mandiri KC Kapten Muslihat Bogor No. Rekening 133-00-0512882-2 A/N Usaha Adi Sanggoro</strong></h5><p></p>
                <!--
                <p><strong><h5>Bank Syariah Indonesia 7207926536 a/n PT. Electronic Technology Indonesia</h5></strong></p>
                <p>Pembayaran bisa Melalui QRIS a/n <strong>Electrotech Id </strong> scan QRcode Berikut :</p>
                <p style="margin-left: 105px;"><img style="max-height: 160px;" src="http://[::1]/jirais/assets/img/qris.jpg"></p>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
-->
                Jatuh Tempo Pembayaran 5 Hari Setelah Invoice ini Terbit<br>
                Konfirmasi pembayaran bisa melalui WA admin Cantumkan Invoice Number/Customer ID <br>
                Kontak admin : 08515670304 / electrotechdotid@gmail.com.
            <p></p>
        </div>

        <div class="col-xs-6">
            <div class="table-responsive">
                <h3>
                        </h3><h3>
                        </h3><table class="table">
                    <tbody><tr><th style="width:50%"><h5><strong>PPN 11%</strong></h5></th>
                        <td>
                            <h5>Rp. 16,500</h5>
                        </td>
                        </tr>
                        </tbody>
                        <tbody><tr><th style="width:50%"><h4><strong>Total Pembayaran:</strong></h4></th>
                        <td>
                            <h4><strong>Rp. 166,500</strong></h4>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        </div>


        <div class="row no-print">
            <div class="col-xs-12">
                <a onclick="window.print()" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                    <button type="submit" name="billing" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                    </button>
            </div>
        </div>
    </form>    
</section>
        </div>
    </body>
</html>