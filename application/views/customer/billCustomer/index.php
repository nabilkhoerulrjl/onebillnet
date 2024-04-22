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
        <div class="tools-table d-flex flex-row-reverse align-items-end justify-content-between mb-3">
            <div class="col-sm-3 d-flex align-items-center justify-content-end p-0">
                <input type="text" class="p-1 form-control form-control-sm p-2 mr-0" id="searchDataText<?=$idTabMenu;?>" placeholder="Search Data in Table" style="border-top: none; border-left: none; border-right: none; margin-right: 8px;">
            </div>
            <div id="exportButtons d-flex">
                <button type="button" id="selectAllBtn<?=$idTabMenu;?>" class="btn btn-outline-secondary btn-sm" 
                data-toggle="tooltip" data-placement="top" title="Copy Data" data-original-title="tooltip on top">
                    <i class="fa fa-square-check mr-1"></i>
                    Select All
                </button>
                <button type="button" id="csvButton" class="btn btn-outline-success btn-sm"
                data-toggle="Export to CSV" onclick="deleteSelectedData<?=$idTabMenu;?>()" data-placement="top" title="Export to CSV" data-original-title="Export to CSV">
                    <i class="fa fa-trash mr-1"></i>
                    Delete
                </button>
            </div>
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
                        <th class="d-none">Ref Id</th>
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
                        <tr data-reference-id="<?= $row->ReferenceId; ?>">
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
                            <td><input type="checkbox" id="checkboxBill<?=$idTabMenu;?>" class="checkboxBill cursor-pointer"></td>
                            <td class="d-none"><?= $row->ReferenceId; ?></td>
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
                                <i class="fa fa-trash fa-lg cursor-pointer" style="color:#00acc1;" title="Delete Data" onclick="deleteDataBill<?= $idTabMenu; ?>('<?= $row->ReferenceId; ?>')"></i>
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
            <ul class="pagination pagination<?=$idTabMenu;?> justify-content-end">
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
        
    // Search Data di table yang sudah di olah
    $('#searchDataText<?=$idTabMenu;?>').on('input', function () {
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
    // End Search Data di table yang sudah di olah

    function deleteDataBill<?= $idTabMenu; ?>($invId) {
        var base_url = '<?= base_url()?>';
        // Menyiapkan data untuk dikirim
        var requestData = {
            ReferenceId: $invId,
        };
        // Menggunakan jQuery untuk melakukan AJAX request
        $.ajax({
            url: base_url+'customer/BillCustomer_Controller/deleteBill',
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
                Swal.fire({
                    title: "Congratulations!",
                    text: "Your data has been delete!",
                    icon: "success"
                });
                fetchData();
            },
            error: function (error) {
                // Menyembunyikan elemen loading jika terjadi kesalahan
                Swal.fire({
                    title: "Attandace!",
                    text: "Your data failed to delete!",
                    icon: "failed"
                });
            }
        });
    }


    // buat trigger modal form add Bill
    $("#btnmodal<?=$idTabMenu;?>").on("click", function () {
        // Show the logout modal
        // alert('asdasdsa');
        $("#formAddBlModal<?=$idTabMenu;?>").modal("show");
    });

    // Function Refresh Data After insert Data
    function fetchData() {
        // Ganti dengan URL controller Anda 
        var base_url = '<?= base_url()?>';
        var url = base_url+'CustomerController/getListCsData';
        // Menyiapkan data untuk dikirim
        var requestData = '';
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
                            <tr data-reference-id="${value.ReferenceId}">
                                <td><input type="checkbox" id="checkboxBill<?=$idTabMenu;?>" class="checkboxBill cursor-pointer"></td>
                                <td class="d-none">${value.ReferenceId}</td>
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
                                    <i class="fa fa-trash fa-lg cursor-pointer" style="color:#00acc1;" title="Delete Data" onclick="deleteDataBill<?=$idTabMenu;?>('${value.ReferenceId}')"></i>
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
    // End Function Refresh Data After insert Data

    function formatRupiah(angka) {
        var angkaClear = angka.replace(/\D/g, '')
        var reverse = angkaClear.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var formatted = ribuan.join('.').split('').reverse().join('');
        return 'Rp ' + formatted.replace(/^[.]/, '');
    }

    $("#selectAllBtn<?=$idTabMenu;?>").click(function() {
        // Mengambil semua checkbox dengan class checkboxBill
        var checkboxes = $(".checkboxBill");

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

    function deleteSelectedData<?=$idTabMenu;?>() {
        var selectedData = getSelectedData();
        // Lakukan sesuatu dengan data yang dipilih, seperti mengirimnya ke server untuk dihapus
        console.log('222',selectedData);
        var base_url = '<?= base_url()?>';
        // Menyiapkan data untuk dikirim
        var requestData = {
            ReferenceId: selectedData,
        };
        // Menggunakan jQuery untuk melakukan AJAX request
        $.ajax({
            url: base_url+'customer/BillCustomer_Controller/deleteBill',
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
    }

    function getSelectedData() {
        var selectedData = [];

        // Loop melalui semua checkbox yang dicentang
        var checkboxes = document.querySelectorAll('#dataTableBill<?=$idTabMenu;?> .checkboxBill:checked');
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

</script>