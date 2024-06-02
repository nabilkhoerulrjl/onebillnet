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
        <!-- <style>		
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
		        max-width: 900px;
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
		</style> -->
    </head>
    <body>
        <div class = "invoice-wrapper" id = "print-area">
            <div class = "invoice">
                <div class = "invoice-container">
                    <div class = "invoice-head">
                        <div class = "invoice-head-top">
                            <div class = "invoice-head-top-left text-start">
                                <img src = "<?=$iconCompany;?>" width="80">
                                <h1 class="company-name"></h1>
                            </div>
                            <div class = "invoice-head-top-right text-end">
                                <span class="vendor-name">Support by</span>
                                <img src = "<?=$iconVendor;?>" width="80">
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-middle">
                            <div class = "invoice-head-middle-left text-start">
                                <p><span class = "text-bold">Date</span>: <?=date("d F Y", strtotime($dataInvoice[0]->InvDate));?></p>
                            </div>
                            <div class = "invoice-head-middle-right text-end">
                                <p><spanf class = "text-bold">Invoice No: </span><?=$dataInvoice[0]->InvoiceId;?></p>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-bottom">
                            <div class = "invoice-head-bottom-left">
                                <ul>
                                    <li class = 'text-bold'>Invoiced Dari:</li>
                                    <li>PT. <?=$dataInvoice[0]->ComName;?></li>
                                    <li max-width: 50%;><?=$dataInvoice[0]->ComAddress;?></li>
<!--                                    <li>kel. Bantarjati Kec. Bogor Utara,</li>
                                    <li>Kota Bogor 16153</li>-->
                                    <li>Phone : <?=$dataInvoice[0]->ComPhone;?></li>
                                    <li>Email : <?php if(isset($dataInvoice[0]->ComEmail) && $dataInvoice[0]->ComEmail != ''){echo $dataInvoice[0]->ComEmail;}else{echo '-';}?></li>
                                </ul>
                            </div>
                            <div class = "invoice-head-bottom-right">
                                <ul class = "text-end">
                                    <li class = 'text-bold'>Untuk:</li>
                                    <li><?=$dataInvoice[0]->FirstName;?> <?=$dataInvoice[0]->LastName;?></li>
                                    <li max-width: 50%;><?=$dataInvoice[0]->CsAddress;?></li>
                                    <li>Phone : <?=$dataInvoice[0]->CsPhone;?></li>
                                    <li>Email : <?php if(isset($dataInvoice[0]->CsEmail) && $dataInvoice[0]->CsEmail != ''){echo $dataInvoice[0]->CsEmail;}else{echo '-';}?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class = "overflow-view">
                        <div class = "invoice-body">
                            <table>
                                <thead>
                                    <tr>
                                        <td class = "text-bold">Product details</td>
                                        <td class = "text-bold">Description</td>
                                        <td class = "text-bold">QTY</td>
                                        <td class = "text-bold">Amount</td>
                                    </tr>
                                </thead>
                                <tbody>
               
                                    <tr>	
	                                    <td><?=$dataInvoice[0]->Product;?></td>
                                        <td><?=$dataInvoice[0]->Description;?></td>
                                        <td>1</td>
                                        <td class = "text-end"><?='Rp '.number_format($dataInvoice[0]->Amount, 0, ',', '.');?></td>
                                    </tr>
                                    <!-- <tr>
                                        <td colspan="4">10</td>
                                        <td>$500.00</td>
                                    </tr> -->
                                </tbody>
                            </table>
                            <div class = "invoice-body-bottom">
                                <div class = "invoice-body-info-item border-bottom">
                                    <div class = "info-item-td text-end text-bold">Sub Total:</div>
                                    <div class = "info-item-td text-end"><?='Rp '.number_format($dataInvoice[0]->Amount, 0, ',', '.');?></div>
                                </div>
                                <div class = "invoice-body-info-item border-bottom">
									<?php $ppn = (11 / 100) * $dataInvoice[0]->Amount; ?>
                                    <div class = "info-item-td text-end text-bold">Tax ppn 11%:</div>
                                    <div class = "info-item-td text-end"><?='Rp '.number_format($ppn, 0, ',', '.');?></div>
                                </div>
                                <div class = "invoice-body-info-item">
                                    <div class = "info-item-td text-end text-bold">Total:</div>
                                    <div class = "info-item-td text-end"><?='Rp '.number_format($dataInvoice[0]->Amount+$ppn, 0, ',', '.');?></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="px-14 text-sm text-neutral-700 m-t-3">
                        <p class="text-main font-bold">PAYMENT DETAILS</p>
                        <p>Bank Transfer</p>
                        <p>Banks of Bank Central Asia</p>
                        <p>Account Number: 123456678</p>
                        <p>A.N: PT Jirais Global Network</p>
                        <p>Online Payment</p>
                        <p>Payment Link: <a href="<?=$dataInvoice[0]->PaymentLink;?>" target="_blank">Payment</a></p>
                    </div>
                    <div class = "invoice-foot">
                        <p><span class = "text-bold text-center">NOTE:&nbsp;</span></p>
                        <!-- <p>Jatuh Tempo Pembayaran 5 Hari Setelah Invoice ini Terbit</p> -->
                        <p>Konfirmasi pembayaran bisa melalui WA admin Cantumkan Invoice Number/Customer ID</p>
                        <p>Contact Admin</p>
                        <p><?=$dataInvoice[0]->ComPhone;?></p>
                        <p><?=$dataInvoice[0]->ComEmail;?></p>
                    </div>
					<div class = "text-center">
						<div class = "invoice-btns">
							<button type = "button" class = "invoice-btn" onclick="printInvoice()">
								<span>
									<i class="fa-solid fa-download"></i>
								</span>
								<span>Download</span>
							</button>
						</div>
					</div>
                </div>
            </div>
        </div>
    </body>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script>
		// A $( document ).ready() block.
		$( document ).ready(function() {
			window.print();
		});
		function printInvoice(){
			window.print();
		}
	</script>
</html>