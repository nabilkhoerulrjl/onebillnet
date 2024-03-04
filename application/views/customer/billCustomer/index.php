<!-- CSS Sweetalert2 -->
<link href="<?= base_url()?>/public/css/plugins/sweetalert/sweetalert2.min.css" rel="stylesheet">
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

    #btn-filter {
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
        top: 35%;
        right: -300px; /* Atur posisi awal di luar layar */
        width: 300px;
        height: 30%;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        transition: right 0.3s ease-in-out;
    }

    .slider-menu.show {
        right: 0; /* Pindahkan ke dalam layar saat ditampilkan */
    }

    #filterDateCustomer .text-truncate,
    #filterDateCustomer .fa,
    #filterDateCustomer span {
        color: #373a3c; 
    }

    #filterDateCustomer:hover .text-truncate,
    #filterDateCustomer:hover .fa,
    #filterDateCustomer:hover span {
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

    #resetFilter:hover {
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

    .truncate-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<?php $this->load->view("customer/billCustomer/addBill.php") ?>
<div class="wrapper wrapper-content bg-white">
    <div class="text-header col-md p-4">
        <h3 class="font-weight-bold">Data Bill Customers</h3>
    </div>
    <div class="ibox-content p-4">
        <div class="wrapper-btn-add d-flex justify-content-end pb-2">
            <button type="button" class="btn btn-sm btn-primary" id="btnmodal<?=$idTabMenu;?>">
                <i class="fa fa-file-invoice-dollar fa-sm pr-1"></i>Add Bill
            </button>
        </div>
        <div id="overlay" class="d-flex justify-content-center align-items-center flex-column">
            <div id="overlayLoading" class="spinner-border text-primary" style="width: 3rem;height: 3rem; display: none;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <span class="text-loading text-black font-weight-bold h5">Please wait...</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTableBill<?=$idTabMenu;?>">
                <thead>
                    <tr>
                        <th>Inv Id</th>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Periode</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Payment Link</th>
                        <th>Expiry Date</th>
                        <th class="action-column">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (!empty($dataBill)) {
                            foreach ($dataBill as $index => $row) {
                    ?>
                        <tr>
                        <?php
                            $statusId;
                            $statusBadge;
                            $dtatusBilling = '';
                            if($row->StatusId == 'BLS1') {
                                $statusId = 'Paid';
                                $statusBadge = 'badge-success';
                            }
                            if($row->StatusId == 'BLS2') {
                                $statusId = 'UnPaid';
                                $statusBadge = 'badge-warning';
                            }
                            $periode = strtotime($row->Periode); 
                            $dueDate = strtotime($row->DueDate); 
                            $expiryDate = strtotime($row->ExpiryDate); 

                            $periodeFormated = date('F Y', $periode);
                            $dueDateFormated = date('j F Y H:i', $dueDate);
                            $expiryDateFormated = date('j F Y H:i', $expiryDate);
                        ?>
                            <td><?= $row->ExternalId; ?></td>
                            <td><?= $row->FirstName.' '.$row->LastName; ?></td>
                            <td><?= $row->ProductName; ?></td>
                            <td><?= 'Rp ' . number_format($row->Amount, 0, ',', '.'); ?></td>
                            <td><?= $periodeFormated; ?></td>
                            <td title="<?=$row->DueDate;?>"><?= $dueDateFormated; ?></td>
                            <td><span class="badge <?= $statusBadge; ?>"><?= $statusId; ?></span></td>
                            <td><span class="truncate-text" title="<?=$row->PaymentLink ;?>"><?= $row->PaymentLink; ?></span></td>
                            <td title="<?=$row->ExpiryDate;?>"><?=$expiryDateFormated;?></td> 
                            <td class="action-column">
                                <!-- Tambahkan button action sesuai kebutuhan -->
                                <!-- <i class="fa fa-pen-to-square fa-lg cursor-pointer pr-3" style="color:#00acc1;" title="Edit Data" onclick="editData(${value.id})"></i> -->
                                <i class="fa fa-trash fa-lg cursor-pointer" style="color:#00acc1;" title="Delete Data" onclick="deleteDataBill<?= $idTabMenu; ?>(<?= $row->ExternalId; ?>)"></i>
                            </td>
                        <tr>
                    <?php
                            }
                        } else {
                            echo '<td colspan="10" class="pt-3 pb-0"><span class="d-flex justify-content-center h5 text-secondary">Data Bill not Found</span></td>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-container mt-3">
            <ul class="pagination justify-content-end">
                <!-- Tombol paginasi akan ditambahkan di sini -->
            </ul>
        </div>
    </div>
</div>
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
        
        var idTabMenu = '<?= $idTabMenu; ?>';
        // Pagging TableBill
        var itemsPerPage = 15; // Jumlah item per halaman
        var $tableRows = $('#dataTableBill<?=$idTabMenu;?> tbody tr');
        var totalItems = $tableRows.length;
        var totalPages = Math.ceil(totalItems / itemsPerPage);
        var currentPage = 1;
        var maxVisiblePages = 5;

        // Fungsi untuk menampilkan item pada halaman tertentu
        function showPage(page) {
            $tableRows.hide().slice((page - 1) * itemsPerPage, page * itemsPerPage).show();
        }

        // Fungsi untuk menampilkan tombol paginasi
        function showPagination() {
            $('.pagination').empty();

            if (totalPages > maxVisiblePages) {
                var startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                var endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

                if (startPage > 1) {
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#">Previous</a></li>');
                }

                for (var i = startPage; i <= endPage; i++) {
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>');
                }

                if (endPage < totalPages) {
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#">Next</a></li>');
                }
            } else {
                for (var i = 1; i <= totalPages; i++) {
                    $('.pagination').append('<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>');
                }
            }

            $('.pagination li').removeClass('active');
            $('.pagination li:contains(' + currentPage + ')').addClass('active');
        }

        // Inisialisasi tampilan halaman pertama dan tombol paginasi
        showPage(currentPage);
        showPagination();

        // Handle klik pada tombol paginasi
        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            var pageText = $(this).text();

            if (pageText === 'Previous') {
                currentPage = Math.max(1, currentPage - 1);
            } else if (pageText === 'Next') {
                currentPage = Math.min(totalPages, currentPage + 1);
            } else {
                currentPage = parseInt(pageText);
            }

            showPage(currentPage);
            showPagination();
        });
        // End Pagging TableBill
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
    

        
    $('#searchDataText').on('input', function () {
        // Ambil nilai dari input pencarian
        var searchValue = $(this).val().toLowerCase();

        // Fungsi untuk melakukan pencarian dan memfilter data di tabel HTML
        filterTableData(searchValue);
    });

    // Fungsi untuk memfilter data di tabel HTML
    function filterTableData(searchValue) {
        var table = document.getElementById('dataTableBill<?=$idTabMenu;?>');
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
        var startDate = $('#filterDateCustomer').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate = $('#filterDateCustomer').data('daterangepicker').endDate.format('YYYY-MM-DD');
        // Ambil semua baris tabel
        var rows = $("#dataTableBill<?=$idTabMenu;?>").find("tr");

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
        $(".action-column", "#dataTableUsers").hide();

        // Konfigurasi print
        $("#dataTableUsers").printThis({
            pageTitle: "Data Customers",
            header: "<h3>Data Customers</h3>",
            style: "table { table-layout: fixed; width: 100%; }",
            orientation: "landscape",
            afterPrint: function() {
                // Tampilkan kembali kolom Action setelah print
                $(".action-column", "#dataTableUsers").show();

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
        var element = document.getElementById("dataTableUsers");

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
        var table = $("#dataTableUsers");
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
        alert('Failed to copy data');
        });
    });
    function deleteDataBill<?= $idTabMenu; ?>($invId) {
        alert($invId);
    }
    /* Ini pake vanilla JS
        function copyToClipboard() {
        var rows = [];
        var table = document.getElementById("dataTableUsers");
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

    $('#btn-filter').click(function() {
        // Toggle kelas 'show' untuk menampilkan atau menyembunyikan slider menu
        $("#filterSlider").toggleClass("show");
    });
    // Bind event click pada tombol close
    $("#closeFilterBtn").click(function() {
        // Sembunyikan slider menu dengan menghapus kelas "show"
        $("#filterSlider").removeClass("show");
    });

    // searchDateFilter.click(function() {
    //     $( "#filterDateRage" ).click();
    // });
    // Mendapatkan tanggal saat ini
    $('#filterDateCustomer').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            // 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
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

        // Panggil fungsi updateSearchDateText saat halaman dimuat
        $(document).ready(function () {
        updateSearchDateText();
    });

    // Event handler untuk button reset filter
    // $('#resetFilter').on('click', function () {
    //     resetFilter();
    //     $('#closeFilterBtn').click();
    // });

    // // Event handler untuk button apply filter
    // $('#applyFilter').on('click', function () {
    //     applyFilter();
    //     $('#closeFilterBtn').click();
    // });

    // Fungsi untuk mereset filter ke 1 tahun terakhir
    // function resetFilter() {
    //     $('#filterDateCustomer').data('daterangepicker').setStartDate(moment().subtract(1, 'year').startOf('day'));
    //     $('#filterDateCustomer').data('daterangepicker').setEndDate(moment().endOf('day').endOf('year'));
    //     // Tambahkan fungsi untuk mengganti teks pada elemen span (jika diperlukan)
    //     updateSearchDateText();
    //     var startDate = $('#filterDateCustomer').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
    //     var endDate = $('#filterDateCustomer').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
    //     var filterData = {
    //         startDate: startDate,
    //         endDate: endDate
    //     }
    //     fetchData(filterData);
    // }

    // Fungsi untuk mengambil nilai dari date range picker dan mengirimkannya ke AJAX
    // function applyFilter() {
    //     var startDate = $('#filterDateCustomer').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
    //     var endDate = $('#filterDateCustomer').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
    //     var filterData = {
    //         startDate: startDate,
    //         endDate: endDate
    //     }
    //     fetchData(filterData);
    // }

    // Fungsi untuk mengganti teks pada elemen span ketika di klik button reset
    function updateSearchDateText() {
        var searchDateSpan = $('#searchdatepick');
        var startDate = $('#filterDateCustomer').data('daterangepicker').startDate;
        var endDate = $('#filterDateCustomer').data('daterangepicker').endDate;
        var label = $('#filterDateCustomer').data('daterangepicker').chosenLabel;

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
    $("#btnmodal<?=$idTabMenu;?>").on("click", function () {
        // Show the logout modal
        // alert('asdasdsa');
        $("#formAddBlModal<?=$idTabMenu;?>").modal("show");
    });

    function fetchData() {
        // Ganti dengan URL controller Anda 
        var base_url = '<?= base_url()?>';
        var url = base_url+'CustomerController/getListData';
        // console.log(filterData);
        // Menyiapkan data untuk dikirim
        var requestData = '';
        // requestData = filterData;
        console.log('fetchData',base_url);

        // console.log('fetchData',requestData);
        // console.log(requestData);
        // Menggunakan jQuery untuk melakukan AJAX request
        $.ajax({
            url: base_url+'customer/BillCustomer_Controller/getListBillData',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log('fetchData',data);
                // Menyembunyikan elemen loading setelah data diterima
                // $('#overlayLoading').hide();
                // $('#overlay').hide();
                if(data.length > 0){
                    // Clear data dari table
                    $('#dataTableBill<?=$idTabMenu;?> tbody').empty();
                    // Masukkan data ke dalam tabel
                    $.each(data, function (index, value) {
                        //init variable
                        var StatusId = '';
                        var SubscribeBadge = '';
                        var StatusBilling = '';
                        var BillingBadge = '';
                        //kondisi untuk status bill dan subscribe
                        if(value.StatusId == 'BLS1'){
                            StatusBilling = 'Paid';
                            BillingBadge = 'badge-success';
                        }
                        if(value.StatusId == 'BLS2'){
                            StatusBilling = 'Not Paid';
                            BillingBadge = 'badge-warning';
                        }
                        // Gunakan moment.js untuk memformat tanggal
                        var periode = moment(value.Periode).format('MMMM YYYY');
                        var dueDate = moment(value.DueDate).format('D MMMM YYYY hh:mm');
                        var expiryDate = moment(value.ExpiryDate).format('D MMMM YYYY hh:mm');
                        $('#dataTableBill<?=$idTabMenu;?> tbody').append(`
                            <tr>
                                <td>${value.ExternalId}</td>
                                <td>${value.FirstName} `+` ${value.LastName}</td>
                                <td>${value.ProductName}</td>
                                <td>${formatRupiah(value.Amount)}</td>
                                <td title="${value.Periode}">${periode}</td>
                                <td title="${value.DueDate}">${dueDate}</td>
                                <td><span class="badge ${BillingBadge}">${StatusBilling}</span></td>
                                <td>${value.PaymentLink}</td>
                                <td title="${value.ExpiryDate}">${expiryDate}</td>
                                <td class="action-column">
                                    <!-- Tambahkan button action sesuai kebutuhan -->
                                    <i class="fa fa-pen-to-square fa-lg cursor-pointer pr-3" style="color:#00acc1;" title="Edit Data" onclick="editData(${value.id})"></i>
                                    <i class="fa fa-trash fa-lg cursor-pointer" style="color:#00acc1;" title="Delete Data" onclick="deleteData(${value.id})"></i>
                                </td>
                            </tr>
                        `);
                    });
                }else{
                    $('#dataTableBill<?=$idTabMenu;?> tbody').html(`<td colspan="12" class="pt-3 pb-0"><span class="d-flex justify-content-center h5 text-secondary">Data Customer not Found</span></td>`);
                }
                
            },
            error: function (error) {
                // Menyembunyikan elemen loading jika terjadi kesalahan
                // $('#overlayLoading').hide();
                // $('#overlay').hide();
                console.error('Error:', error);
            }
        });
    }

    function formatRupiah(angka) {
        var angkaClear = angka.replace(/\D/g, '')
        var reverse = angkaClear.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var formatted = ribuan.join('.').split('').reverse().join('');
        return 'Rp ' + formatted.replace(/^[.]/, '');
    }
</script>