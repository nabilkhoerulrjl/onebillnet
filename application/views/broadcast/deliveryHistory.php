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

    #filterDateMH .text-truncate,
    #filterDateMH .fa,
    #filterDateMH span {
        color: #373a3c; 
    }

    #filterDateMH:hover .text-truncate,
    #filterDateMH:hover .fa,
    #filterDateMH:hover span {
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
</style>
<?php $this->load->view("customer/addCustomer.php") ?>
<div class="wrapper wrapper-content bg-white">
    <div class="text-header col-md p-4">
        <h3 class="font-weight-bold">Message Delivery history</h3>
    </div>
    <div class="ibox-content p-4">
        <div class="tools-table d-flex align-items-end justify-content-between mb-3">
            <div id="exportButtons d-flex d-none">
                <!-- <button type="button" id="selectAllBtn" class="btn btn-outline-secondary btn-sm" 
                data-toggle="tooltip" data-placement="top" title="Copy Data" data-original-title="tooltip on top">
                    <i class="fa fa-square-check mr-1"></i>
                    Select All
                </button>
                <button type="button" id="csvButton" class="btn btn-outline-success btn-sm"
                data-toggle="Export to CSV" onclick="exportToCSV()" data-placement="top" title="Export to CSV" data-original-title="Export to CSV">
                    <i class="fa fa-share-from-square mr-1"></i>
                    Resend
                </button> -->
            </div>
            <div class="col-sm-3 d-flex align-items-center justify-content-end p-0">
                <input type="text" class="p-1 form-control form-control-sm p-2 mr-1" id="searchDataText" placeholder="Search Data in Table" style="border-top: none;border-left: none;border-right: none;margin-right: 8px;">
                <button id="btn-filter" class="btn btn-primary btn-sm active" type="button">
                    <i class="fa fa-filter"></i>
                </button>
            </div>
            <div id="filterSlider<?=$idTabMenu;?>" class="slider-menu" style="z-index:10;">
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
								<button id="filterDateMH" style="border-radius: 3px;" class="btn btn-outline-secondary bg-white form-control dropdown-toggle p-l-xs d-flex justify-content-between align-items-center" aria-expanded="true">
                                    <i class="fa fa-calendar-days pr-1"></i>
                                    <div class="text-truncate">
                                        <b>
                                        <span id="searchdatepick<?=$idTabMenu;?>" class="" style="font-size: 0.9em;" startdate="" enddate="">All</span>
                                        </b>
                                        <i style="padding-right: 5px;" class="fa fa-angle-down"></i>
                                    </div>
								</button>
							</div>
						</div>
                        <div class="row p-2">
                            <div class="col-sm-6">
                                <button id="resetFilter" class="btn btn-outline-secondary bg-white form-control">Reset Filter</button>
                            </div>
                            <div class="col-sm-6">
                                <button id="applyFilter" class="btn btn-primary form-control">Apply Filter</button>
                            </div>
                        </div>
					</div>
                </div>
            </div>
        </div>
        <div id="overlay" class="d-flex justify-content-center align-items-center flex-column">
            <div id="overlayLoading" class="spinner-border text-primary" style="width: 3rem;height: 3rem; display: none;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <span class="text-loading text-black font-weight-bold h5">Please wait...</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTableUsers">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Media</th>
                        <th>Subject</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Status</th>
                        <th>Send Date</th>
                        <th>ReSend Date</th>
                        <th>Remarks</th>
                        <!-- <th class="action-column">Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (!empty($dataHistory)) {
                            foreach ($dataHistory as $index => $row) {
                    ?>
                        <tr data-reference-id="<?= $row->Id; ?>">
                        <?php
                            $statusId;
                            $statusBadge;
                            $dtatusBilling = '';
                            if($row->StatusId == 'MES1') {
                                $statusId = 'New';
                                $statusBadge = 'badge-primary';
                            }
                            if($row->StatusId == 'MES2') {
                                $statusId = 'Sent';
                                $statusBadge = 'badge-success';
                            }
                            if($row->StatusId == 'MES3') {
                                $statusId = 'Received';
                                $statusBadge = 'badge-warning';
                            }
                            if($row->StatusId == 'MES4') {
                                $statusId = 'Sending';
                                $statusBadge = 'badge-secondary';
                            }
                            if($row->StatusId == 'MES5') {
                                $statusId = 'Send Failed';
                                $statusBadge = 'badge-danger';
                            }

                            if($row->MediaId == 'WHATP') {
                                $mediaName = 'whatsapp';
                                $media = '<i class="fa-brands fa-whatsapp"></i>';
                            }
                            $sendDate = strtotime($row->SendDate); 

                            $sendDateFormated = date('j F Y H:i', $sendDate);
                            if($row->ResendDate == ''){
                                $resendDateFormated = '-';
                            }else{
                                $resendDate = strtotime($row->ResendDate); 
                                $resendDateFormated = date('j F Y H:i', $resendDate);
                            }
                        ?>
                            <!-- <td><input type="checkbox" id="checkboxBill<?=$idTabMenu;?>" class="checkboxBill cursor-pointer"></td> -->
                            <!-- <td class="d-none"><?= $row->Id; ?></td> -->
                            <td><?= $index+1; ?></td>
                            <td title="<?=$mediaName?>"><?= $media; ?></td>
                            <td><?= $row->Subject; ?></td>
                            <td><?= $row->From; ?></td>                            
                            <td><?= $row->To; ?></td>
                            <td><span class="badge <?= $statusBadge; ?>"><?= $statusId; ?></span></td>
                            <td title="<?=$row->SendDate;?>"><?=$sendDateFormated;?></td>                             
                            <td title="<?=$row->ResendDate;?>"><?=$resendDateFormated;?></td>
                            <td><?= $row->Remarks; ?></td>

                            <!-- <td class="action-column"> -->
                                <!-- Tambahkan button action sesuai kebutuhan -->
                                <!-- <i class="fa fa-pen-to-square fa-lg cursor-pointer pr-3" style="color:#00acc1;" title="Edit Data" onclick="editData(${value.id})"></i> -->
                                <!-- <i class="fa fa-trash fa-lg cursor-pointer" style="color:#00acc1;" title="Delete Data" onclick="deleteDataBill<?= $idTabMenu; ?>('<?= $row->ReferenceId; ?>')"></i>
                            </td> -->
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

    });

    // Fungsi untuk mengambil data dari controller menggunakan AJAX
    function fetchData(filterData) {
        // Ganti dengan URL controller Anda 
        var url = base_url+'broadcast/DeliveryHistory_Controller/getRefreshData';
        console.log(filterData);
        // Menyiapkan data untuk dikirim
        var requestData = '';
        requestData = filterData;
        console.log('fetchData',requestData);

        // console.log(requestData);
        // Menggunakan jQuery untuk melakukan AJAX request
        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: filterData,
            beforeSend: function() {
                // Menampilkan elemen loading sebelum permintaan dikirim
                $('#overlayLoading').show();
                $('#overlay').show();
            },
            success: function (data) {
                        console.log(data);
                // Menyembunyikan elemen loading setelah data diterima
                if(data.length > 0){
                    // Clear data dari table
                    $('#dataTableUsers tbody').empty();
                    // Masukkan data ke dalam tabel
                    $.each(data, function (index, value) {
                        //init variable
                        var statusId;
                        var statusBadge;
                        if(value.StatusId == 'MES1') {
                            statusId = 'New';
                            statusBadge = 'badge-primary';
                        }
                        if(value.StatusId == 'MES2') {
                            statusId = 'Sent';
                            statusBadge = 'badge-success';
                        }
                        if(value.StatusId == 'MES3') {
                            statusId = 'Received';
                            statusBadge = 'badge-warning';
                        }
                        if(value.StatusId == 'MES4') {
                            statusId = 'Sending';
                            statusBadge = 'badge-secondary';
                        }
                        if(value.StatusId == 'MES5') {
                            statusId = 'Send Failed';
                            statusBadge = 'badge-danger';
                        }
                        // Gunakan moment.js untuk memformat tanggal
                        var sendDate    = moment(value.SendDate).format('D MMMM YYYY');
                        var resendDate  = moment(value.ModifyDate).format('D MMMM YYYY');
                        if(value.ModifyDate == ''){
                            resendDate = '-';
                        }
                        if(value.MediaId == 'WHATP') {
                            var mediaName = 'whatsapp';
                            var media = '<i class="fa-brands fa-whatsapp"></i>';
                        }
                        // <td><input type="checkbox" id="checkboxHistory" class="checkboxHistory cursor-pointer"></td>
                        // <td class="action-column">
                        //     <!-- Tambahkan button action sesuai kebutuhan -->
                        //     <i class="fa fa-pen-to-square fa-lg cursor-pointer pr-3" style="color:#00acc1;" title="Edit Data" onclick="editData(${value.id})"></i>
                        //     <i class="fa fa-trash fa-lg cursor-pointer" style="color:#00acc1;" title="Delete Data" onclick="deleteData(${value.id})"></i>
                        // </td>
                        $('#dataTableUsers tbody').append(`
                            <tr>
                                <td>${index+1}</td>
                                <td title="${mediaName}">${media}</td>
                                <td>${value.Subject}</td>
                                <td>${value.From}</td>
                                <td>${value.To}</td>
                                <td><span class="badge ${statusBadge}">${statusId}</span></td>
                                <td>${value.Status}</td>
                                <td title="${value.SendDate}">${sendDate}</td>
                                <td title="${value.ResendDate}">${resendDate}</td>
                                <td>${value.Remarks}</td>
                            </tr>
                        `);
                    });
                }else{
                    $('#dataTableUsers tbody').html(`<td colspan="12" class="pt-3 pb-0"><span class="d-flex justify-content-center h5 text-secondary">Data Customer not Found</span></td>`);
                }
                
            },
            error: function (error) {
                // Menyembunyikan elemen loading jika terjadi kesalahan
                $('#overlayLoading').hide();
                $('#overlay').hide();
                console.error('Error:', error);
            }
        });
    }
    var base_url = '<?= base_url()?>';
    // Fungsi untuk menampilkan modal
    function showExportModal() {
        $('#exportModal').modal('show');
    }

    // Fungsi untuk menyembunyikan modal
    function hideExportModal() {
        $('#exportModal').modal('hide');
    }

        
    $('#searchDataText').on('input', function () {
        // Ambil nilai dari input pencarian
        var searchValue = $(this).val().toLowerCase();

        // Fungsi untuk melakukan pencarian dan memfilter data di tabel HTML
        filterTableData(searchValue);
    });

    // Fungsi untuk memfilter data di tabel HTML
    function filterTableData(searchValue) {
        var table = document.getElementById('dataTableUsers');
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
        var startDate = $('#filterDateMH').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate = $('#filterDateMH').data('daterangepicker').endDate.format('YYYY-MM-DD');
        // Ambil semua baris tabel
        var rows = $("#dataTableUsers").find("tr");

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


    $("#selectAllBtn").click(function() {
        // Mengambil semua checkbox dengan class checkboxHistory
        var checkboxes = $(".checkboxHistory");

        // Memeriksa apakah semua checkbox terpilih
        var allChecked = checkboxes.length === checkboxes.filter(":checked").length;

        // Jika semua checkbox sudah terpilih, setel ulang (unchecked) semua checkbox
        if (allChecked) {
            checkboxes.prop("checked", false);
            $(this).html('<i class="fa fa-square-check mr-1"></i>Select All');
        } else {
            // Jika belum semua terpilih, setel semua checkbox terpilih
            checkboxes.prop("checked", true);
            $(this).html('<i class="fa fa-square mr-1"></i>Uncheck All');
        }
    });
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
    $('#filterDateMH').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            // 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 3 Months': [moment().subtract(3, 'months').startOf('day'), moment().endOf('day')]
        },
        "startDate": moment().subtract(3, 'months').startOf('day'),
        "endDate": moment().endOf('day'),
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
        var searchDateSpan = $('#searchdatepick<?=$idTabMenu;?>');
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
    $('#resetFilter').on('click', function () {
        resetFilter();
        $('#closeFilterBtn<?=$idTabMenu;?>').click();
    });

    // Event handler untuk button apply filter
    $('#applyFilter').on('click', function () {
        applyFilter();
        $('#closeFilterBtn<?=$idTabMenu;?>').click();
    });

    // Fungsi untuk mereset filter ke 1 tahun terakhir
    function resetFilter() {
        $('#filterDateMH').data('daterangepicker').setStartDate(moment().subtract(3, 'months').startOf('day'));
        $('#filterDateMH').data('daterangepicker').setEndDate(moment().endOf('day'));
        // Tambahkan fungsi untuk mengganti teks pada elemen span (jika diperlukan)
        updateSearchDateText();
        var startDate = $('#filterDateMH').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
        var endDate = $('#filterDateMH').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
        var filterData = {
            startDate: startDate,
            endDate: endDate
        }
        fetchData(filterData);
    }

    // Fungsi untuk mengambil nilai dari date range picker dan mengirimkannya ke AJAX
    function applyFilter() {
        var startDate = $('#filterDateMH').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
        var endDate = $('#filterDateMH').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
        var filterData = {
            startDate: startDate,
            endDate: endDate
        }
        fetchData(filterData);
    }

    // Fungsi untuk mengganti teks pada elemen span ketika di klik button reset
    function updateSearchDateText() {
        var searchDateSpan = $('#searchdatepick<?=$idTabMenu;?>');
        var startDate = $('#filterDateMH').data('daterangepicker').startDate;
        var endDate = $('#filterDateMH').data('daterangepicker').endDate;
        var label = $('#filterDateMH').data('daterangepicker').chosenLabel;

        var dateFormat = 'DD/MM/YYYY';
        var startDateText = startDate.format(dateFormat);
        var endDateText = endDate.format(dateFormat);
// '': [moment(), moment()],
//             // 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
//             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
//             // 'Last 30 Days': [moment().subtract(29, 'days'), moment()],
//             'This Month': [moment().startOf('month'), moment().endOf('month')],
//             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
//             'Last 3 Months': [moment().subtract(3, 'months').startOf('day'), moment().endOf('day')],
//             'Last Year': [moment().subtract(1, 'year').startOf('day'), moment().endOf('day').endOf('year')]
        if (label === 'Custom Range') {
            searchDateSpan.text(startDateText + ' - ' + endDateText);
        } else if(label == 'Today') {
            searchDateSpan.text("Today");
        } else if(label == 'Last 7 Days') {
            searchDateSpan.text("Last 7 Days");
        } else if(label == 'This Month') {
            searchDateSpan.text("This Month");
        } else if(label == 'Last Month') {
            searchDateSpan.text("Last Month");
        } else {
            searchDateSpan.text("Last 3 Months");
        }
        console.log(searchDateSpan.text);
        console.log(searchDateSpan.chosenLabel);
        searchDateSpan.attr('startdate', startDate.format('YYYY-MM-DD HH:mm:ss'));
        searchDateSpan.attr('enddate', endDate.format('YYYY-MM-DD HH:mm:ss'));
    }

    // buat trigger modal form add customer
    $("#btnmodal").on("click", function () {
        // Show the logout modal
        // alert('asdasdsa');
        $("#formAddCSModal").modal("show");
    });
</script>
