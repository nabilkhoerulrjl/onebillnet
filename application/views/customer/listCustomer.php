<!-- CSS Sweetalert2 -->
<link href="<?= base_url()?>/public/css/plugins/sweetalert/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
 <!-- pdfmake files: -->
  <script src='https://cdn.jsdelivr.net/npm/pdfmake@latest/build/pdfmake.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/pdfmake@latest/build/vfs_fonts.min.js'></script>
  <!-- html-to-pdfmake file: -->
  <script src="https://cdn.jsdelivr.net/npm/html-to-pdfmake/browser.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url()?>/public/css/plugins/daterangepicker/daterangepicker.css" />
<style>
    /* Gaya CSS tambahan sesuai kebutuhan aplikasi Anda */
    .top-tool {
        position: relative;
        display: flex;
        width: 100%;
        justify-content: flex-end;
        align-items: center;
        margin-bottom: 20px;
    }

    .input-sm {
        border-radius: 3px;
        /* border: none; */
        background: whitesmoke;
    }

    .export-tool {
        position: relative;
        display: flex;
        width: 100%;
        justify-content: space-between;
        margin-bottom: 5px;
    }

    #btn-filter<?=$idTabMenu;?> {
        padding: 5px 9px;
    }

    .buttom-tool {
        display: flex;
        width: 100%;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .cursor-pointer{
        cursor:pointer;
    }

    /* CSS untuk slider menu */
    .slider-menu {
        position: absolute;
        /* top: 35%; */
        right: -300px; /* Atur posisi awal di luar layar */
        width: 300px;
        /* height: 30%; */
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        transition: right 0.3s ease-in-out;
    }

    .slider-menu.show {
        right: 0; /* Pindahkan ke dalam layar saat ditampilkan */
    }

    #filterDateCustomer<?=$idTabMenu;?> .text-truncate,
    #filterDateCustomer<?=$idTabMenu;?> .fa,
    #filterDateCustomer<?=$idTabMenu;?> span {
        color: #373a3c; 
    }

    #filterDateCustomer<?=$idTabMenu;?>:hover .text-truncate,
    #filterDateCustomer<?=$idTabMenu;?>:hover .fa,
    #filterDateCustomer<?=$idTabMenu;?>:hover span {
        color: #373a3c; 
    }

    .daterangepicker td.available:hover, .daterangepicker td.available.active {
        background-color: #1abc9c;
    }

    .daterangepicker td.in-range, .daterangepicker td.active {
        background-color: rgba(26, 188, 156, 0.1);
    }

    .daterangepicker td.in-range, .daterangepicker td.active {
        border-color: #1abc9c;
    }

    #resetFilter<?=$idTabMenu;?>:hover {
        color: #373a3c; 
    }

    #overlay {
        display: none !important;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgb(0 0 0 / 8%); /* Warna latar belakang transparan */
        z-index: 9999;
    }

    .cursor-pointer {
        cursor:pointer;
    }
</style>
<?php $this->load->view("customer/addCustomer.php") ?>
<?php $this->load->view("customer/EditCustomer.php") ?>
<div class="wrapper wrapper-content bg-white">
    <div class="text-header col-md p-4">
        <h3 class="font-weight-bold">Data Customers</h3>
    </div>
    <div class="ibox-content p-4">
        <div class="wrapper-btn-add d-flex align-items-end justify-content-between pb-2">
            <div id="actionButton d-flex">
                <button type="button" id="selectAllBtn<?=$idTabMenu;?>" class="btn btn-outline-secondary btn-sm" 
                data-toggle="tooltip" data-placement="top" title="Select All Data" data-original-title="tooltip on top">
                    <i class="fa fa-square-check mr-1"></i>
                    All
                </button>
                <button type="button" id="invoiceButton" class="btn btn-outline-primary btn-sm"
                data-toggle="Generate Selected Invoice Bill" onclick="generateInvBill<?=$idTabMenu;?>()" data-placement="top" title="Generate Selected Invoice Bill" data-original-title="Generate Selected Invoice Bill">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                </button>
                <!-- <button type="button" id="UnsubsCsButton" class="btn btn-outline-danger btn-sm"
                data-toggle="Unsubsribe Customer Selected Data" onclick="deleteSelectedData<?=$idTabMenu;?>()" data-placement="top" title="Unsubsribe Customer Selected Data" data-original-title="Unsubsribe Customer Selected Data">
                    <i class="fa fa-ban mr-1"></i>
                </button> -->
            </div>
            <button type="button" class="btn btn-sm btn-primary" id="btnmodal">
                <i class="fa fa-user-plus fa-sm pr-1"></i>Add Customer
            </button>
        </div>
        <div class="tools-table d-flex align-items-end justify-content-between mb-3">
            <div id="exportButtons d-flex">
                <button type="button" id="copyButton" class="btn btn-outline-secondary btn-sm" 
                data-toggle="tooltip" data-placement="top" title="Copy Data" data-original-title="tooltip on top">
                    <i class="fa fa-copy mr-1"></i>
                </button>
                <button type="button" id="csvButton" class="btn btn-outline-success btn-sm"
                data-toggle="Export to CSV" onclick="exportToCSV()" data-placement="top" title="Export to CSV" data-original-title="Export to CSV">
                    <i class="fa fa-file-excel mr-1"></i>
                </button>
                <button type="button" id="pdfButton" class="btn btn-outline-danger btn-sm"
                data-toggle="Export to PDF" onclick="exportToPdf()" data-placement="top" title="Export to PDF" data-original-title="Export to PDF">
                    <i class="fa fa-file-pdf mr-1"></i>
                </button>
                <button type="button" id="printButton" class="btn btn-outline-info btn-sm"
                data-toggle="Print" onclick="printTable()" data-placement="top" title="Print" data-original-title="Print">
                    <i class="fa fa-print mr-1"></i>
                </button>
            </div>
            <div class="col-sm-3 d-flex align-items-center justify-content-end p-0">
                <input type="text" class="p-1 form-control form-control-sm p-2 mr-1" id="searchDataText<?=$idTabMenu;?>" placeholder="Search Data in Table" style="border-top: none;border-left: none;border-right: none;margin-right: 8px;">
                <button id="btn-filter<?=$idTabMenu;?>" class="btn btn-primary btn-sm active" type="button">
                    <i class="fa fa-filter"></i>
                </button>
            </div>
            
        </div>
        <div id="overlay" class="d-flex justify-content-center align-items-center flex-column">
            <div id="overlayLoading" class="spinner-border text-primary" style="width: 3rem;height: 3rem; display: none;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <span class="text-loading text-black font-weight-bold h5">Please wait...</span>
        </div>
        
        <!-- Tabel ZingGrid -->
        <div class="table-responsive">
            <div id="filterSlider<?=$idTabMenu;?>" class="slider-menu"  style="z-index:10;">
                <div class="sidebar-title d-flex align-items-center justify-content-between p-3" style="background: #f6f6f6;border-bottom: 1px solid #e7eaec;">
                    <div><i class="fa fa-filter fa-lg pr-1"></i><b>Filter Data</b></div>
                    <button type="button" class="close"  id="closeFilterBtn<?=$idTabMenu;?>" class="close-btn">
                        <i class="fa fa-x fa-xs"></i>
                    </button>
				</div>
                <div id="sidebarBodyFilter<?=$idTabMenu;?>">
                    <div class="setings-item b-none p-box">
						<div class="row p-2">
							<div class="col-sm-12">
								<button id="filterDateCustomer<?=$idTabMenu;?>" style="border-radius: 3px;" class="btn btn-outline-secondary bg-white form-control dropdown-toggle p-l-xs d-flex justify-content-between align-items-center" aria-expanded="true">
                                    <i class="fa fa-calendar-days pr-1"></i>
                                    <div class="text-truncate">
                                        <b>
                                        <span id="searchdatepick" class="" style="font-size: 0.9em;" startdate="" enddate="">All</span>
                                        </b>
                                        <i style="padding-right: 5px;" class="fa fa-angle-down"></i>
                                    </div>
								</button>
							</div>
						</div>
                        <div class="row p-2">
                            <div class="col-sm-6">
                                <button id="resetFilter<?=$idTabMenu;?>" class="btn btn-outline-secondary bg-white form-control">Reset Filter</button>
                            </div>
                            <div class="col-sm-6">
                                <button id="applyFilter<?=$idTabMenu;?>" class="btn btn-primary form-control">Apply Filter</button>
                            </div>
                        </div>
					</div>
                </div>
            </div>
            <table class="table table-hover" id="dataTableCS<?=$idTabMenu;?>">
                <thead>
                    <tr>
                        <th class="d-none">Ref Id</th>
                        <th></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>Whatsapp</th>
                        <th>Email</th>
                        <th>Product</th>
                        <th>Status</th>
                        <th>Date Active</th>
                        <th>Address</th>
                        <th class="action-column">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="pagination-container mt-3">
            <ul class="pagination pagination<?=$idTabMenu;?> justify-content-end">
                <!-- Tombol paginasi akan ditambahkan di sini -->
            </ul>
        </div>
    </div>
</div>
<iframe id="printFrame" style="display: none;"></iframe>
<!-- JS moment -->
<script type="text/javascript" src="<?= base_url()?>/public/js/plugins/moment/moment.min.js"></script>
<!-- JS daterangepicker -->
<script type="text/javascript" src="<?= base_url()?>/public/js/plugins/daterangepicker/daterangepicker.js"></script>
<!-- JS printThis -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
<!-- JS html2pdf -->
<script src="https://unpkg.com/html2pdf.js@0.10.0/dist/html2pdf.bundle.js"></script>
<!-- JS Clipboard.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.10/clipboard.min.js"></script>
<!-- JS Sweetalert2 -->
<script src="<?= base_url()?>/public/js/plugins/sweetalert/sweetalert2.all.min.js"></script>
<!-- Page Scripts -->
<script>
    // Menjalankan fungsi fetchData saat halaman dimuat
    $(document).ready(function () {
        var startDate = moment().subtract(1, 'year').startOf('day').format('YYYY-MM-DD HH:mm:ss');
        var endDate = moment().endOf('day').endOf('year').format('YYYY-MM-DD HH:mm:ss');
        
        var filterData = {
            startDate: startDate,
            endDate: endDate
        }
        // console.log('filterData',filterData);

        // fetchData(filterData);
        fetchData(filterData);
    });
    var base_url = '<?= base_url()?>';
    // Fungsi untuk menampilkan modal
    function showExportModal() {
        $('#exportModal').modal('show');
    }

    // Fungsi untuk menyembunyikan modal
    function hideExportModal() {
        $('#exportModal').modal('hide');
    }
        
    // Fungsi untuk mengambil data dari controller menggunakan AJAX
    function fetchData(filterData) {
        // Ganti dengan URL controller Anda 
        var url = base_url+'CustomerController/getListCsData';
        // var startDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
        // var endDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
        // if(startDate == null){
        //     startDate = moment().subtract(1, 'year').startOf('day').format('YYYY-MM-DD HH:mm:ss');
        // }
        // if(endDate == null){
        //     endDate = moment().endOf('day').endOf('year').format('YYYY-MM-DD HH:mm:ss');
        // }
        // console.log(filterData);
        // Menyiapkan data untuk dikirim
        var requestData = '';
        // if(filterData == "") {
        //     requestData = {
        //         startDate: startDate,
        //         endDate: endDate
        //     };
        // }else{
            requestData = filterData;
            // console.log('fetchData',requestData);
        // }

        // console.log(requestData);
        // Menggunakan jQuery untuk melakukan AJAX request
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: requestData,
            beforeSend: function() {
                // Menampilkan elemen loading sebelum permintaan dikirim
                $('#overlayLoading').show();
                $('#overlay').show();
            },
            success: function (data) {
                // Menyembunyikan elemen loading setelah data diterima
                $('#overlayLoading').hide();
                $('#overlay').hide();
                if(data.length > 0){
                    // Clear data dari table
                    $('#dataTableCS<?=$idTabMenu;?> tbody').empty();
                    // Masukkan data ke dalam tabel
                    $.each(data, function (index, value) {
                        //init variable
                        var StatusSubsribe = '';
                        var SubscribeBadge = '';
                        var StatusBilling = '';
                        //kondisi untuk status bill dan subscribe
                        if(value.StatusActive == 'CRS1'){
                            StatusSubsribe = 'Active';
                            SubscribeBadge = 'badge-success';
                        }
                        if(value.StatusActive == 'CRS2'){
                            StatusSubsribe = 'InActive';
                            SubscribeBadge = 'badge-secondary';
                        }
                        if(value.StatusActive == 'CRS3'){
                            StatusSubsribe = 'InActive';
                            SubscribeBadge = 'badge-warning';
                        }
                        if(value.StatusBill == 'BLS1'){
                            StatusBilling = 'Not Paid';
                            BillingBadge = 'badge-danger';
                        }
                        if(value.StatusBill == 'BLS2'){
                            StatusBilling = 'Not Paid';
                            BillingBadge = 'badge-dark';
                        }
                        // Gunakan moment.js untuk memformat tanggal
                        var DateActive = moment(DateActive).format('D MMMM YYYY');
                        $('#dataTableCS<?=$idTabMenu;?> tbody').append(`
                            <tr data-reference-id="${value.Id}">
                                <td><input type="checkbox" id="checkboxCs<?=$idTabMenu;?>" class="checkboxCs cursor-pointer"></td>
                                <td class="d-none">${value.Id}</td>
                                <td>${index+1}</td>
                                <td>${value.FirstName} `+` ${value.LastName}</td>
                                <td>${value.Whatsapp}</td>
                                <td>${value.Email}</td>                                <td>${value.ProductName}</td>
                                <td><span class="badge ${SubscribeBadge}">${StatusSubsribe}</span></td>
                                <td title="${value.DateActive}">${DateActive}</td>
                                <td title="${value.Address}">${value.Address}</td>
                                <td class="action-column">
                                    <!-- Tambahkan button action sesuai kebutuhan -->
                                    <i class="fa fa-pen-to-square fa-lg cursor-pointer pr-3" style="color:#00acc1;" title="Edit Data" onclick="editDataCs<?=$idTabMenu?>('${value.Id}')"></i>
                                    <!-- <i class="fa fa-circle-info fa-lg cursor-pointer pr-3" style="color:#00acc1;" title="Detail Data" onclick="detailDataCs<?=$idTabMenu?>('${value.Id}')"></i> -->
                                    <!-- <i class="fa fa-ban fa-lg cursor-pointer" style="color:red;" title="Unsubsribe Customer" onclick="deleteDataCs<?=$idTabMenu?>('${value.Id}')"></i> -->
                                </td>
                            </tr>
                        `);
                    });
                }else{
                    $('#dataTableCS<?=$idTabMenu;?> tbody').html(`<td colspan="12" class="pt-3 pb-0"><span class="d-flex justify-content-center h5 text-secondary">Data Customer not Found</span></td>`);
                }

                // Pagging TableCS
                var itemsPerPage = 15; // Jumlah item per halaman
                var $tableRows = $('#dataTableCS<?=$idTabMenu;?> tbody tr');
                var totalItems = $tableRows.length;
                var totalPages = Math.ceil(totalItems / itemsPerPage);
                var currentPage = 1;
                var maxVisiblePages = 5;

                // Fungsi untuk menampilkan item pada halaman tertentu
                function showPage<?=$idTabMenu;?>(page) {
                    $tableRows.hide().slice((page - 1) * itemsPerPage, page * itemsPerPage).show();
                }

                // Fungsi untuk menampilkan tombol paginasi
                function showPagination<?=$idTabMenu;?>() {
                    $('.pagination<?=$idTabMenu;?>').empty();

                    if (totalPages > maxVisiblePages) {
                        var startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                        var endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                        if (startPage > 1) {
                            $('.pagination<?=$idTabMenu;?>').append('<li class="page-item"><a class="page-link" href="#">Previous</a></li>');
                        }

                        for (var i = startPage; i <= endPage; i++) {
                            $('.pagination<?=$idTabMenu;?>').append('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>');
                        }

                        if (endPage < totalPages) {
                            $('.pagination<?=$idTabMenu;?>').append('<li class="page-item"><a class="page-link" href="#">Next</a></li>');
                        }
                    } else {
                        for (var i = 1; i <= totalPages; i++) {
                            $('.pagination<?=$idTabMenu;?>').append('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>');
                        }
                    }

                    $('.pagination<?=$idTabMenu;?> li').removeClass('active');
                    $('.pagination<?=$idTabMenu;?> li:contains(' + currentPage + ')').addClass('active');
                    
                    var container = $('html,body');
                    scrollDown(container);
                }

                // Inisialisasi tampilan halaman pertama dan tombol paginasi
                showPage<?=$idTabMenu;?>(currentPage);
                showPagination<?=$idTabMenu;?>();

                // Handle klik pada tombol paginasi
                $(document).on('click', '.pagination<?=$idTabMenu;?> a', function (e) {
                    e.preventDefault();
                    var pageText = $(this).text();

                    if (pageText === 'Previous') {
                        currentPage = Math.max(1, currentPage - 1);
                    } else if (pageText === 'Next') {
                        currentPage = Math.min(totalPages, currentPage + 1);
                    } else {
                        currentPage = parseInt(pageText);
                    }

                    showPage<?=$idTabMenu;?>(currentPage);
                    showPagination<?=$idTabMenu;?>();
                });
                // End Pagging TableBill
                
            },
            error: function (error) {
                // Menyembunyikan elemen loading jika terjadi kesalahan
                $('#overlayLoading').hide();
                $('#overlay').hide();
                console.error('Error:', error);
            }
        });
    }

        
    $('#searchDataText<?=$idTabMenu;?>').on('input', function () {
        // Ambil nilai dari input pencarian
        var searchValue = $(this).val().toLowerCase();

        // Fungsi untuk melakukan pencarian dan memfilter data di tabel HTML
        filterTableData(searchValue);
    });

    // Fungsi untuk memfilter data di tabel HTML
    function filterTableData(searchValue) {
        var table = document.getElementById('dataTableCS<?=$idTabMenu;?>');
        console.log(table);

        // Ambil semua baris dalam tabel, kecuali baris header
        var rows = table.getElementsByTagName('tr');

        // Iterasi melalui setiap baris data
        for (var i = 1; i < rows.length; i++) { // Dimulai dari 1 untuk menghindari baris header
            var row = rows[i];
            var visible = false;

            // Ambil semua sel dalam baris
            var cells = row.getElementsByTagName('td');

            // Loop melalui setiap sel dan periksa nilainya
            for (var j = 0; j < cells.length; j++) {
                var cellValue = cells[j].innerText.toLowerCase();
                if (cellValue.includes(searchValue)) {
                    visible = true;
                    break; // Hentikan pencarian jika nilai ditemukan dalam salah satu sel
                }
            }

            // Terapkan properti CSS untuk menampilkan atau menyembunyikan baris
            row.style.display = visible ? '' : 'none';
        }
    }

    function exportToCSV() {
        // Tampilkan alert "Mohon Tunggu"
        Swal.fire({
            title: 'Mohon Tunggu',
            text: 'Proses sedang berlangsung...',
            icon: 'info',
            timer: 2000,
            timerProgressBar: true,
            button: false,
            confirmButtonColor: '#1abc9c',
        });
        var startDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').endDate.format('YYYY-MM-DD');
        // Ambil semua baris tabel
        var rows = $("#dataTableCS<?=$idTabMenu;?>").find("tr");

        // Ambil header CSV (hanya sekali)
        var headerRow = rows.first().children().not(".action-column").map(function() {
            return $(this).text();
        }).get().join(",") + "\n";

        // Tambahkan header ke CSV
        var csv = headerRow;

        // Tambahkan data CSV (tanpa header lagi)
        rows.each(function(i, row) {
            if (i > 0) { // Mulai dari baris kedua (skip header)
                csv += $(row).children().not(".action-column").map(function() {
                    return $(this).text();
                }).get().join(",") + "\n";
            }
        });

        // Buat link download CSV
        var blob = new Blob([csv], { type: "text/csv;charset=utf-8" });
        var link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = "DataCustomer_Periode_"+startDate+"[to]"+endDate+".csv"; // Sesuaikan nama file CSV

        // Tampilkan link download CSV
        $(document.body).append(link);
        link.click(); // Langsung klik link untuk memulai download
        // Tampilkan alert "Berhasil Print"
        Swal.fire({
            title: 'Berhasil Export CSV',
            text: 'Data Customers berhasil diexport to csv!',
            icon: 'success',
            confirmButtonColor: '#1abc9c',
        });
    }

    function printTable() {
        // Tampilkan alert "Mohon Tunggu"
        Swal.fire({
            title: 'Mohon Tunggu',
            text: 'Proses sedang berlangsung...',
            icon: 'info',
            timer: 2000,
            timerProgressBar: true,
            button: false,
            confirmButtonColor: '#1abc9c',
        });

        // Sembunyikan kolom Action untuk print
        $(".action-column", "#dataTableCS<?=$idTabMenu;?>").hide();

        // Konfigurasi print
        $("#dataTableCS<?=$idTabMenu;?>").printThis({
            pageTitle: "Data Customers",
            header: "<h3>Data Customers</h3>",
            style: "table { table-layout: fixed; width: 100%; }",
            orientation: "landscape",
            afterPrint: function() {
                // Tampilkan kembali kolom Action setelah print
                $(".action-column", "#dataTableCS<?=$idTabMenu;?>").show();

                // Tampilkan alert "Berhasil Print"
                Swal.fire({
                    title: 'Berhasil Print',
                    text: 'Data Customers berhasil dicetak!',
                    icon: 'success',
                    confirmButtonColor: '#1abc9c',
                });
            }
        });
    }

    function exportToPdf() {
        // Tampilkan alert "Mohon Tunggu"
        Swal.fire({
            title: 'Mohon Tunggu',
            text: 'Proses sedang berlangsung...',
            icon: 'info',
            timer: 2000,
            timerProgressBar: true,
            button: false,
            confirmButtonColor: '#1abc9c',
        });
        var element = document.getElementById("dataTableCS<?=$idTabMenu;?>");

        const columnsToExclude = document.querySelectorAll('.action-column');
        columnsToExclude.forEach(column => column.remove());
        // Atur properti pdf
        var pdfOptions = {
            margin: 10,
            filename: 'data_export.pdf',
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'A2', orientation: 'portrait' },
            output: 'blob'  // Tentukan output sebagai blob
        };

        // Buat objek untuk ekspor pdf
        var pdfExporter = new html2pdf(element, pdfOptions);

        // Ekspor ke PDF
        pdfExporter.toPdf().then(function (pdfBlob) {
            // Unduh file PDF
            var link = document.createElement('a');
            link.href = URL.createObjectURL(pdfBlob);
            link.download = pdfOptions.filename;
            link.click();
        });
        // Tampilkan alert "Berhasil Print"
        Swal.fire({
            title: 'Berhasil Export PDF',
            text: 'Data Customers berhasil diexport to pdf!',
            icon: 'success',
            confirmButtonColor: '#1abc9c',
        });
    }


    $("#copyButton").click(function() {
        // Tampilkan alert "Mohon Tunggu"
        Swal.fire({
            title: 'Mohon Tunggu',
            text: 'Proses sedang berlangsung...',
            icon: 'info',
            timer: 2000,
            timerProgressBar: true,
            button: false,
            confirmButtonColor: '#1abc9c', // Warna biru
        });
        var rows = [];
        var table = $("#dataTableCS<?=$idTabMenu;?>");
        var headers = $("thead th", table).map(function() {
        return $(this).text().trim();
        }).get();

        $("tbody tr", table).each(function() {
        var rowData = {};
        $("td:not(.action-column)", this).each(function(index) {
            rowData[headers[index]] = $(this).text().trim();
        });
        rows.push(rowData);
        });

        var csvData = "";
        csvData += Object.keys(rows[0]).filter(header => header !== 'Action').join('\t') + '\r\n';
        $.each(rows, function(i, row) {
        var values = Object.values(row).filter((value, index) => Object.keys(rows[0])[index] !== 'Action');
        csvData += values.join('\t') + '\r\n';
        });

        new ClipboardJS('#copyButton', {
        text: function() {
            return csvData;
        }
        }).on('success', function(e) {
            // Tampilkan alert "Berhasil Print"
            Swal.fire({
                title: 'Berhasil Copy',
                text: 'Data Customers berhasil dicopy!',
                icon: 'success',
                confirmButtonColor: '#1abc9c', // Warna biru
                // cancelButtonColor: '#d33', // Warna merah (jika ada tombol Cancel)
            });
        }).on('error', function(e) {
        // alert('Failed to copy data');
        });
    });
    /* Ini pake vanilla JS
        function copyToClipboard() {
        var rows = [];
        var table = document.getElementById("dataTableCS<?=$idTabMenu;?>");
        var headers = Array.from(table.querySelectorAll("thead th")).map(th => th.innerText.trim());

        Array.from(table.querySelectorAll("tbody tr")).forEach(row => {
            var rowData = {};
            Array.from(row.cells).forEach((cell, index) => {
                if (!cell.classList.contains('action-column')) {
                    rowData[headers[index]] = cell.innerText.trim();
                }
            });
            rows.push(rowData);
        });

        var csvData = '';
        csvData += Object.keys(rows[0]).filter(header => header !== 'Action').join('\t') + '\r\n';
        for (var i = 0; i < rows.length; i++) {
            var values = Object.values(rows[i]).filter((value, index) => Object.keys(rows[0])[index] !== 'Action');
            csvData += values.join('\t') + '\r\n';
        }

        var clipboard = new ClipboardJS('#copyButton', {
            text: function () {
                return csvData;
            }
        });

        clipboard.on('success', function (e) {
            alert('Data copied to clipboard');
        });

        clipboard.on('error', function (e) {
            alert('Failed to copy data');
        });
    }*/

    $('#btn-filter<?=$idTabMenu;?>').click(function() {
        // Toggle kelas 'show' untuk menampilkan atau menyembunyikan slider menu
        $("#filterSlider<?=$idTabMenu;?>").toggleClass("show");
    });
    // Bind event click pada tombol close
    $("#closeFilterBtn<?=$idTabMenu;?>").click(function() {
        // Sembunyikan slider menu dengan menghapus kelas "show"
        $("#filterSlider<?=$idTabMenu;?>").removeClass("show");
    });

    // searchDateFilter.click(function() {
    //     $( "#filterDateRage" ).click();
    // });
    // Mendapatkan tanggal saat ini
    $('#filterDateCustomer<?=$idTabMenu;?>').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            // 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            '2 Months': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'months').endOf('month').add(1, 'months').endOf('month')], // Tambahkan rentang waktu 2 bulan
            'Last Year': [moment().subtract(1, 'year').startOf('day'), moment().endOf('day').endOf('year')]
        },
        "startDate": moment().subtract(1, 'year').startOf('day'),
        "endDate": moment().endOf('day').endOf('year'),
        "drops": "auto",
            "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "daysOfWeek": ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            "monthNames": ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            "firstDay": 1
        }
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        
        // Mendapatkan elemen span
        var searchDateSpan = $('#searchdatepick');
        // Menentukan format tanggal yang sesuai
        var dateFormat = 'DD/MM/YYYY';
        var startDateText = start.format(dateFormat);
        var endDateText = end.format(dateFormat);

        // Memperbarui teks pada elemen span sesuai dengan pilihan tanggal
        if (label === 'Custom Range') {
            searchDateSpan.text(startDateText + ' - ' + endDateText);
        } else {
            searchDateSpan.text(label);
        }

        // Tambahan: Memperbarui atribut startdate dan enddate jika diperlukan
        searchDateSpan.attr('startdate', start.format('YYYY-MM-DD HH:mm:ss'));
        searchDateSpan.attr('enddate', end.format('YYYY-MM-DD HH:mm:ss'));
    });

        // Panggil fungsi updateSearchDateText<?=$idTabMenu;?> saat halaman dimuat
        $(document).ready(function () {
        updateSearchDateText<?=$idTabMenu;?>();
    });

    // Event handler untuk button reset filter
    $('#resetFilter<?=$idTabMenu;?>').on('click', function () {
        resetFilter();
        $('#closeFilterBtn<?=$idTabMenu;?>').click();
    });

    // Event handler untuk button apply filter
    $('#applyFilter<?=$idTabMenu;?>').on('click', function () {
        applyFilter();
        $('#closeFilterBtn<?=$idTabMenu;?>').click();
    });

    // Fungsi untuk mereset filter ke 1 tahun terakhir
    function resetFilter() {
        $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').setStartDate(moment().subtract(1, 'year').startOf('day'));
        $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').setEndDate(moment().endOf('day').endOf('year'));
        // Tambahkan fungsi untuk mengganti teks pada elemen span (jika diperlukan)
        updateSearchDateText<?=$idTabMenu;?>();
        var startDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
        var endDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
        var filterData = {
            startDate: startDate,
            endDate: endDate
        }
        fetchData(filterData);
    }

    // Fungsi untuk mengambil nilai dari date range picker dan mengirimkannya ke AJAX
    function applyFilter() {
        var startDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
        var endDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
        var filterData = {
            startDate: startDate,
            endDate: endDate
        }
        fetchData(filterData);
    }

    // Fungsi untuk mengganti teks pada elemen span ketika di klik button reset
    function updateSearchDateText<?=$idTabMenu;?>() {
        var searchDateSpan = $('#searchdatepick');
        var startDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').startDate;
        var endDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').endDate;
        var label = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').chosenLabel;

        var dateFormat = 'DD/MM/YYYY';
        var startDateText = startDate.format(dateFormat);
        var endDateText = endDate.format(dateFormat);

        if (label === 'Custom Range') {
            searchDateSpan.text(startDateText + ' - ' + endDateText);
        } else {
            searchDateSpan.text("Last Year");
        }

        searchDateSpan.attr('startdate', startDate.format('YYYY-MM-DD HH:mm:ss'));
        searchDateSpan.attr('enddate', endDate.format('YYYY-MM-DD HH:mm:ss'));
    }

    // buat trigger modal form add customer
    $("#btnmodal").on("click", function () {
        // Show the logout modal
        // alert('asdasdsa');
        $("#formAddCSModal").modal("show");
    });

    // buat trigger modal form add customer
    // $("#btnmodal").on("click", function () {
    //     // Show the logout modal
    //     // alert('asdasdsa');
    //     $("#formEditCSModal").modal("show");
    // });

    function deleteDataCs<?=$idTabMenu?>(id){
        Swal.fire({
            title: 'Do you want to delete this data?',
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'Yes',
            denyButtonText: 'No',
            customClass: {
                actions: 'my-actions',
                // cancelButton: 'order-1 right-gap',
                confirmButton: 'order-2',
                denyButton: 'order-3',
        },
        }).then((result) => {
            if (result.isConfirmed) {
                var base_url = '<?= base_url()?>';
                var url = base_url+'CustomerController/deleteCustomer';
                var requestData = {
                    Id: id,
                };

                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    data: requestData,
                    beforeSend: function() {
                        // Menampilkan pemberitahuan Swal saat permintaan dikirim
                        Swal.fire({
                            title: 'Loading',
                            icon: "info",
                            text: 'Please wait...',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                        });
                    },
                    success: function (data) {
                        // Menyembunyikan pemberitahuan Swal setelah permintaan berhasil
                        Swal.close();
                        console.log(data.success);
                        if(data.success == true){
                            // Refresh data table agar menjadi terbaru
                            var startDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
                            var endDate = $('#filterDateCustomer<?=$idTabMenu;?>').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
                            var filterData = {
                                startDate: startDate,
                                endDate: endDate
                            }
                            fetchData(filterData);
                            // Tampilkan pemberitahuan Swal bahwa data berhasil dihapus
                            Swal.fire('Data deleted successfully', '', 'success');
                        } else {
                            // Tampilkan pemberitahuan Swal bahwa terjadi kesalahan
                            Swal.fire('Error', 'Failed to delete data', 'error');
                        }
                        // if(data.length > 0){
                        //     $("#editContactModal<?=$idTabMenu;?>").modal("show");
                        //     var id = $('#editContactModal<?=$idTabMenu;?>').find('#id').val(data[0].Id);
                        //     var firstName = $('#editContactModal<?=$idTabMenu;?>').find('#firstName').val(data[0].FirstName);
                        //     var lastName = $('#editContactModal<?=$idTabMenu;?>').find('#lastName').val(data[0].LastName);
                        //     var email = $('#editContactModal<?=$idTabMenu;?>').find('#email').val(data[0].Email);
                        //     var phone = $('#editContactModal<?=$idTabMenu;?>').find('#phone').val(data[0].Phone);
                        //     var whatsapp = $('#editContactModal<?=$idTabMenu;?>').find('#whatsapp').val(data[0].Whatsapp);
                        //     var customerId = $('#editContactModal<?=$idTabMenu;?>').find('#customerId').val(data[0].CustomerId);
                        //     $('#saveEditContact<?=$idTabMenu;?>').click(function(event) {
                        //         event.preventDefault(); // Mencegah pengiriman formulir default

                        //         // Memanggil fungsi saveEditContact dengan mengirimkan id
                        //         saveEditContact<?=$idTabMenu;?>();
                        //     });

                        //     // var requestData = {
                        //     //     id: id,
                        //     //     firstName: firstName,
                        //     //     lastName: lastName,
                        //     //     email: email,
                        //     //     phone: phone,
                        //     //     whatsapp: whatsapp,
                        //     // };



                        //     console.log(data[0]);
                        //     console.log(requestData);
                        // }else{

                        // }
                    },
                    error: function (error) {
                        // Menyembunyikan elemen loading jika terjadi kesalahan
                        $('#overlayLoading').hide();
                        $('#overlay').hide();
                        console.error('Error:', error);
                    }
                });
                // Swal.fire('Saved!', '', 'success');
            } else if (result.isDenied) {
                // Swal.fire('Changes are not saved', '', 'info')
            }
        })
    }

    function editDataCs<?=$idTabMenu?>($id){
        var base_url = '<?= base_url()?>';
        var url = base_url+'CustomerController/getCustomerById';
        var requestData = {
            Id: $id,
        };

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: requestData,
            beforeSend: function() {
                // Menampilkan elemen loading sebelum permintaan dikirim
                Swal.fire({
                    title: 'Loading',
                    icon: "info",
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
            },
            success: function (data) {
                // Menyembunyikan elemen loading setelah data diterima
                console.log(data);
                console.log(formatDate(data.ActiveDate));
                Swal.close();
                // if(data.length > 0){
                $("#formEditCSModal<?=$idTabMenu;?>").modal("show");
                // Memasukkan data ke dalam elemen input modal
                $("#formEditCSModal<?=$idTabMenu;?>").modal("show");
                $('#formEditCSModal<?=$idTabMenu;?>').find('#id').val(data.Id);
                $('#formEditCSModal<?=$idTabMenu;?>').find('#contactId').val(data.ContactId);
                $('#formEditCSModal<?=$idTabMenu;?>').find('#firstName').val(data.FirstName);
                $('#formEditCSModal<?=$idTabMenu;?>').find('#lastName').val(data.LastName);
                $('#formEditCSModal<?=$idTabMenu;?>').find('#whatsapp').val(data.Whatsapp);
                $('#formEditCSModal<?=$idTabMenu;?>').find('#email').val(data.Email);
                $('#formEditCSModal<?=$idTabMenu;?>').find('#address').val(data.Address);
                $('#formEditCSModal<?=$idTabMenu;?>').find('#dateActive').val(formatDate(data.ActiveDate));

                // Ambil dan isi data produk, grup kontak, dan status aktif
                $.ajax({
                    url: 'ProductController/getListDataProduct',
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        var productSelect = $('#formEditCSModal<?=$idTabMenu;?>').find('#product');
                        console.log(productSelect);
                        productSelect.empty();
                        $.each(response, function(index, product) {
                            productSelect.append($('<option>', {
                                value: product.Id,
                                text: product.Name
                            }));
                        });
                        productSelect.val(data.ProductId); // Set nilai pilihan produk sesuai dengan data yang diterima
                    },
                    error: function(error) {
                        console.error('Error fetching product data:', error);
                    }
                });

                 // Ambil elemen contactGroup
                var contactGroupSelect = $('#formEditCSModal<?=$idTabMenu;?>').find('#contactGroup');

                // Periksa apakah elemen contactGroup kosong atau tidak memiliki data
                var isContactGroupEmpty = contactGroupSelect.children().length === 0;
                // console.log(contactGroupSelect.children().length);
                // Bersihkan pilihan sebelum menambahkan yang baru
                contactGroupSelect.empty(); 

                // Tambahkan opsi "Select Contact Group" sebagai opsi default yang terpilih jika elemen kosong atau tidak memiliki data
                if (isContactGroupEmpty == false) {
                    contactGroupSelect.append($('<option>', {
                        value: '',
                        text: 'Select Contact Group',
                        selected: true // Menetapkan opsi ini sebagai opsi default yang terpilih
                    }));
                }

                // Ambil data grup kontak
                $.ajax({
                    url: 'ContactGroupController/getListDataContactGroup',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Tambahkan opsi untuk setiap grup kontak jika data tidak null
                        if (response && response.length > 0) {
                            $.each(response, function(index, contactGroup) {
                                contactGroupSelect.append($('<option>', {
                                    value: contactGroup.Id,
                                    text: contactGroup.GroupName
                                }));
                            });
                        }

                        // Set nilai pilihan grup kontak sesuai dengan data yang diterima, jika ada
                        contactGroupSelect.val(data.GroupContactId);
                    },
                    error: function(error) {
                        console.error('Error fetching contact group data:', error);
                    }
                });

                $.ajax({
                    url: 'ReferenceController/getStatusCustomer',
                    method: 'POST',
                    dataType: 'json',
                    success: function(response) {
                        var statusActiveSelect = $('#formEditCSModal<?=$idTabMenu;?>').find('#statusActive');
                        console.log(statusActiveSelect);
                        statusActiveSelect.empty();
                        var statusText;
                        $.each(response, function(index, statusActive) {

                            if(statusActive.Code == 'CRS1'){
                                statusText = 'Active';
                                SubscribeBadge = 'badge-success';
                            }
                            if(statusActive.Code == 'CRS2'){
                                statusText = 'InActive';
                                SubscribeBadge = 'badge-secondary';
                            }
                            if(statusActive.Code == 'CRS3'){
                                statusText = 'Pending';
                                SubscribeBadge = 'badge-warning';
                            }
                            if(statusActive.Code == 'CRS4'){
                                statusText = 'Suspended';
                                SubscribeBadge = 'badge-danger';
                            }
                            if(statusActive.Code == 'CRS5'){
                                statusText = 'Stopped';
                                SubscribeBadge = 'badge-dark';
                            }
                            statusActiveSelect.append($('<option>', {
                                value: statusActive.Code,
                                text: statusText
                            }));
                        });
                        statusActiveSelect.val(data.StatusActive); // Set nilai pilihan status aktif sesuai dengan data yang diterima
                    },
                    error: function(error) {
                        console.error('Error fetching active status data:', error);
                    }
                });

                    // var requestData = {
                    //     id: id,
                    //     firstName: firstName,
                    //     lastName: lastName,
                    //     email: email,
                    //     phone: phone,
                    //     whatsapp: whatsapp,
                    // };



                    console.log(data[0]);
                    console.log(requestData);
                // }else{

                // }
                
            },
            error: function (error) {
                // Menyembunyikan elemen loading jika terjadi kesalahan
                $('#overlayLoading').hide();
                $('#overlay').hide();
                console.error('Error:', error);
            }
        });
        
    }

    $("#selectAllBtn<?=$idTabMenu;?>").click(function() {
        // Mengambil semua checkbox dengan class checkboxCs
        var checkboxes = $(".checkboxCs");

        // Memeriksa apakah semua checkbox terpilih
        var allChecked = checkboxes.length === checkboxes.filter(":checked").length;

        // Jika semua checkbox sudah terpilih, setel ulang (unchecked) semua checkbox
        if (allChecked) {
            checkboxes.prop("checked", false);
            $(this).html('<i class="fa fa-square-check mr-1"></i>All');
        } else {
            // Jika belum semua terpilih, setel semua checkbox terpilih
            checkboxes.prop("checked", true);
            $(this).html('<i class="fa fa-square mr-1"></i>Uncheck');
        }
    });

    function deleteSelectedData<?=$idTabMenu;?>() {
        var selectedData = getSelectedData<?=$idTabMenu;?>();
        // Lakukan sesuatu dengan data yang dipilih, seperti mengirimnya ke server untuk dihapus
        console.log('222',selectedData);
        if(selectedData.length > 0 ){
            var base_url = '<?= base_url()?>';
            // Menyiapkan data untuk dikirim
            var requestData = {
                ReferenceId: selectedData,
            };
            // Menggunakan jQuery untuk melakukan AJAX request
            $.ajax({
                url: base_url+'Customer_Controller/deleteCustomer',
                method: 'POST',
                dataType: 'json',
                data: requestData,
                beforeSend: function() {
                    // Menampilkan elemen loading sebelum permintaan dikirim
                    Swal.fire({
                        title: 'Loading',
                        icon: "info",
                        text: 'Please wait...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                    });
                },
                success: function (data) {
                    console.log(data);
                    console.log(typeof data);
                    var status;
                    if(typeof data == 'object'){
                        status = data.status;
                    }
                    if(typeof data == 'array'){
                        status = data[0].status;
                    }

                    if(status == 'success') {
                        Swal.fire({
                            title: "Congratulations!",
                            text: "Your data has been delete!",
                            icon: "success"
                        });
                        fetchData();
                    }else{
                        Swal.fire({
                            title: "Attandace!",
                            text: "Your data failed to delete!",
                            icon: "failed"
                        });
                    }

                }
                // error: function (error) {
                //     // Menyembunyikan elemen loading jika terjadi kesalahan
                //     Swal.fire({
                //         title: "Attandace!",
                //         text: "Your data failed to delete!",
                //         icon: "failed"
                //     });
                // }
            });
        }else{
            Swal.fire({
                title: "Attandace!",
                text: "Please select data before delete!",
                icon: "failed"
            });
        }
        
    }

    function generateInvBill<?=$idTabMenu;?>() {
        var selectedData = getSelectedData<?=$idTabMenu;?>();
        // Lakukan sesuatu dengan data yang dipilih, seperti mengirimnya ke server untuk dihapus
        if(selectedData.length > 0 ){
            Swal.fire({
                title: "Enter Periode Invoice Bill",
                html: '<input type="month" class="form-control form-control-sm cursor-pointer" id="periodeBill" name="periodeBill" required>',
                showCancelButton: true,
                confirmButtonText: "Generate",
                preConfirm: () => {
                    const periode = document.getElementById('periodeBill').value;
                    const requestData = {
                        Periode: periode,
                        CustomerId: selectedData,
                    };
                    console.log(requestData);
                    // Menggunakan jQuery untuk melakukan AJAX request
                    $.ajax({
                        url: base_url + 'customer/BillCustomer_Controller/createBillInv', // Ganti dengan URL endpoint yang sesuai
                        method: 'POST',
                        dataType: 'json',
                        data: requestData,
                        beforeSend: function () {
                            // Menampilkan elemen loading sebelum permintaan dikirim
                            Swal.fire({
                                title: 'Loading',
                                icon: "info",
                                text: 'Please wait...',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                            });
                        },
                        success: function (data) {
                            // console.log('data',data);
                            // Periksa tipe data yang diterima
                            if (Array.isArray(data)) {
                                status = data[0].status;
                            } else if (typeof data === 'object') {
                                status = data.status;
                            } else {
                                status = 'failed';
                            }

                            if (status === 'success') {
                                Swal.fire({
                                    title: "Congratulations!",
                                    text: "Invoice tagihan berhasil dibuat!",
                                    icon: "success"
                                });
                                // fetchData(); // Panggil fungsi untuk memperbarui data setelah berhasil menghapus
                            } else if(status === 'info'){
                                Swal.fire({
                                    title: "Attendance!",
                                    text: "Data Invoice tagihan sudah dibuat sebelumnya!",
                                    icon: "info"
                                });
                            }else{
                                Swal.fire({
                                    title: "Attendance!",
                                    text: "Invoice tagihan gagal dibuat!",
                                    icon: "error"
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            // Menampilkan pesan kesalahan jika terjadi kesalahan dalam permintaan Ajax
                            Swal.fire({
                                title: "Attendance!",
                                text: "Invoice tagihan gagal dibuat!",
                                icon: "error"
                            });
                        }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            });
        }else{
            Swal.fire({
                title: "Attandace!",
                text: "Please select data before delete!",
                icon: "failed"
            });
        }
    }

    function getSelectedData<?=$idTabMenu;?>() {
        var selectedData = [];
        // Loop melalui semua checkbox yang dicentang
        var checkboxes = document.querySelectorAll('#dataTableCS<?=$idTabMenu;?> .checkboxCs:checked');
        checkboxes.forEach(function (checkbox) {
            // Dapatkan baris terkait dengan checkbox yang dicentang
            var row = checkbox.closest('tr');

            // Dapatkan nilai ReferenceId dari atribut data
            var referenceId = row.getAttribute('data-reference-id');

            // Tambahkan nilai ReferenceId ke dalam array
            selectedData.push(referenceId);
        });

        // Kembalikan array data yang dipilih
        return selectedData;
    }

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return String([year, month, day].join('-'));
    }

    function renderInvoiceToPDF(template) {
        var docDefinition = {
            content: [
                {
                    html: template.html()
                }
            ]
        };

        pdfMake.createPdf(docDefinition).getBase64(function(encodedString) {
            // Simpan konten PDF ke dalam database
            console.log('encodedString',encodedString);
            // $.ajax({
            //     url: 'url_to_save_pdf_to_database',
            //     method: 'POST',
            //     data: { pdf_content: encodedString },
            //     success: function(saveResponse) {
            //         // Handle success response
            //     },
            //     error: function(xhr, status, error) {
            //         // Handle error
            //     }
            // });
        });
    }

    function scrollDown(container) {
        setTimeout(function() {
            var container = container;
            var scrollHeight = $(document).height();
            container.animate({ scrollTop: scrollHeight }, 1000);
        }, 100); // Penundaan 100ms
    }
</script>
