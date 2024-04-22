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
</style>
<div id="wrapper-modal-edit-contact">
    <?php $this->load->view("customer/contactGroup/modalEditContact.php") ?>
</div>
<div id="wrapper-modal-edit">
</div>
<div class="wrapper wrapper-content bg-white">
    <div class="text-header col-md p-4">
        <h3 class="font-weight-bold">Manage Contact & Group</h3>
    </div>
    <div class="ibox-content p-4">
        <div class="card-body p-0 pt-4 pl-0 pr-0 pb-0 bg-white">
            <ul class="nav nav-tabs" id="pageTab<?=$idTabMenu?>" role="tablist">
                <li class="nav-item">
                    <a class="nav-link text-uppercase active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase header-tab<?=$idTabMenu?>" id="groupContact-tab" data-toggle="tab" href="#groupContact" role="tab" aria-controls="groupContact" aria-selected="false" onclick="getDataGroupContact()">Group Contact</a>
                </li>
            </ul>
        </div>
        <div class="card-body p-1">
            <div class="tab-content" id="pageTabContent">
                <div class="tab-pane fade active show" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="ibox-content mt-4">
                        <!-- Tabel ZingGrid -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTableContact<?=$idTabMenu?>">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Whatsapp</th>
                                        <th>Group Name</th>
                                        <th>Status</th>
                                        <th class="action-column">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!empty($dataContact)) {
                                            foreach ($dataContact as $index => $row) {
                                    ?>
                                        <tr>
                                        <?php
                                            $statusId;
                                            $statusBadge;
                                            if($row->StatusId == 'CTS1') {
                                                $statusId = 'Active';
                                                $statusBadge = 'badge-success';
                                            }
                                            if($row->StatusId == 'CTS2') {
                                                $statusId = 'Not Active';
                                                $statusBadge = 'badge-warning';
                                            }
                                        ?>
                                            <td><?= $index+1; ?></td>
                                            <td><?= $row->Name; ?></td>
                                            <td><?= $row->Email; ?></td>
                                            <td><?= $row->Phone; ?></td>
                                            <td><?= $row->Whatsapp; ?></td>
                                            <td><?= $row->GroupName; ?></td>
                                            <td><span class="badge <?= $statusBadge; ?>"><?= $statusId; ?></span></td>
                                            <td class="action-column">
                                                <!-- Tambahkan button action sesuai kebutuhan -->
                                                <i class="fa fa-pen-to-square fa-lg cursor-pointer pr-3" style="color:#00acc1;" title="Edit Data" onclick="editDataContact<?=$idTabMenu?>('<?= $row->Id; ?>')"></i>
                                                <!-- <i class="fa fa-trash fa-lg cursor-pointer" style="color:#00acc1;" title="Delete Data" onclick="deleteDataBill<?= $idTabMenu; ?>('')"></i> -->
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
                    </div>
                </div>
                <div class="tab-pane fade" id="groupContact" role="tabpanel" aria-labelledby="groupContact-tab">
                    <div class="ibox-content mt-4">
                        <!-- Tabel ZingGrid -->
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTableGroupContact<?=$idTabMenu?>">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Group Name</th>
                                        <th>Description</th>
                                        <th>Member</th>
                                        <th class="action-column">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td colspan="5" class="pt-3 pb-0 data-note-found"><span class="d-flex justify-content-center h5 text-secondary">Data Customer not Found</span></td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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

    function getDataGroupContact() {
        var base_url = '<?= base_url()?>';
        var idTabMenu = '<?= $idTabMenu?>';
        // $('.header-tab'+idTabMenu).hasClass('active');
        // console.log($('.header-tab'+idTabMenu).hasClass('active'));

        var requestData = {
            start:'start'
            // startDate: startDate,
            // endDate: endDate
        };
        var code = $('#dataTableGroupContact'+idTabMenu).children('tbody').text();
        var stripped_html = code.trim();
        // console.log(stripped_html);
        if(stripped_html == 'Data Customer not Found'){
            $('#dataTableGroupContact'+idTabMenu).children('tbody').html("");
            $.ajax({
                url: base_url+'customer/ContactGroupController/getDataGroup',
                method: 'POST',
                dataType: 'json',
                data: requestData,
                beforeSend: function() {
                    // Menampilkan elemen loading sebelum permintaan dikirim
                    // $('#overlayLoading').show();
                    // $('#overlay').show();
                },
                success: function (data) {
                    // Menyembunyikan elemen loading setelah data diterima
                    // $('#overlayLoading').hide();
                    // $('#overlay').hide();
                    if(data.length > 0){
                        // Clear data dari table
                        // $('#dataTableGroupContact<?=$idTabMenu?> tbody').empty();
                        // Masukkan data ke dalam tabel
                        $.each(data, function (index, value) {
                            //init variable
                            var StatusSubsribe = '';
                            var SubscribeBadge = '';
                            var StatusBilling = '';
                            var BillingBadge = '';
                            //kondisi untuk status bill dan subscribe
                            if(value.StatusSubsribe == 'CTS1'){
                                StatusSubsribe = 'Active';
                                SubscribeBadge = 'badge-success';
                            }
                            if(value.StatusSubsribe == 'CTS2'){
                                StatusSubsribe = 'Not Active';
                                SubscribeBadge = 'badge-warning';
                            }
                            // Gunakan moment.js untuk memformat tanggal
                            var DateSubsribe = moment(DateSubsribe).format('D MMMM YYYY');
                            $('#dataTableGroupContact<?=$idTabMenu?> tbody').append(`
                                <tr>
                                    <td>${index+1}</td>
                                    <td>${value.GroupName}</td>
                                    <td>${value.Description}</td>
                                    <td>${value.Member}</td>
                                    <td class="action-column">
                                        <!-- Tambahkan button action sesuai kebutuhan -->
                                        <i class="fa fa-pen-to-square fa-lg cursor-pointer pr-3" style="color:#00acc1;" title="Edit Data" onclick="editDataGroupContact<?=$idTabMenu?>('${value.Id}')"></i>
                                        <i class="fa fa-trash fa-lg cursor-pointer" style="color:#00acc1;" title="Delete Data" onclick="deleteDataGroupContact<?=$idTabMenu?>('${value.Id}')"></i>
                                    </td>
                                </tr>
                            `);
                        });
                    }else{
                        $('#dataTableGroupContact tbody').html(`<td colspan="12" class="pt-3 pb-0"><span class="d-flex justify-content-center h5 text-secondary">Data Customer not Found</span></td>`);
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


    }
    // Fungsi untuk mengambil data dari controller menggunakan AJAX
    function fetchData(filterData) {
        // Ganti dengan URL controller Anda 
        var url = base_url+'CustomerController/getListCsData';
        // var startDate = $('#filterDateCustomer').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
        // var endDate = $('#filterDateCustomer').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
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
            // requestData = filterData;
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
                    $('#dataTableUsers tbody').empty();
                    // Masukkan data ke dalam tabel
                    $.each(data, function (index, value) {
                        //init variable
                        var StatusSubsribe = '';
                        var SubscribeBadge = '';
                        var StatusBilling = '';
                        var BillingBadge = '';
                        //kondisi untuk status bill dan subscribe
                        if(value.StatusSubsribe == 'CRS1'){
                            StatusSubsribe = 'Active';
                            SubscribeBadge = 'badge-success';
                        }
                        if(value.StatusSubsribe == 'CRS2'){
                            StatusSubsribe = 'Not Active';
                            SubscribeBadge = 'badge-warning';
                        }
                        if(value.StatusBill == 'BLS1'){
                            StatusBilling = 'Not Paid';
                            BillingBadge = 'badge-success';
                        }
                        if(value.StatusBill == 'BLS2'){
                            StatusBilling = 'Not Paid';
                            BillingBadge = 'badge-warning';
                        }
                        // Gunakan moment.js untuk memformat tanggal
                        var DateSubsribe = moment(DateSubsribe).format('D MMMM YYYY');
                        $('#dataTableUsers tbody').append(`
                            <tr>
                                <td>${value.CustomerId}</td>
                                <td>${value.FirstName} `+` ${value.LastName}</td>
                                <td>${value.Whatsapp}</td>
                                <td>${value.RtRw}</td>
                                <td>${value.Subdistrict}</td>
                                <td>${value.Ward}</td>
                                <td>${value.City}</td>
                                <td>${value.ProductName}</td>
                                <td><span class="badge ${SubscribeBadge}">${StatusSubsribe}</span></td>
                                <td><span class="badge ${BillingBadge}">${StatusBilling}</span></td>
                                <td title="${value.DateSubsribe}">${DateSubsribe}</td>
                                <td class="action-column">
                                    <!-- Tambahkan button action sesuai kebutuhan -->
                                    <i class="fa fa-pen-to-square fa-lg cursor-pointer pr-3" style="color:#00acc1;" title="Edit Data" onclick="editData(${value.id})"></i>
                                    <i class="fa fa-trash fa-lg cursor-pointer" style="color:#00acc1;" title="Delete Data" onclick="deleteData(${value.id})"></i>
                                </td>
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

    function editDataContact<?=$idTabMenu?>($id){
        var base_url = '<?= base_url()?>';
        var url = base_url+'customer/ContactGroupController/getContactbyId';
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
                $('#overlayLoading').show();
                $('#overlay').show();
            },
            success: function (data) {
                // Menyembunyikan elemen loading setelah data diterima
                $('#overlayLoading').hide();
                $('#overlay').hide();
                if(data.length > 0){
                    $("#editContactModal<?=$idTabMenu;?>").modal("show");
                    var id = $('#editContactModal<?=$idTabMenu;?>').find('#id').val(data[0].Id);
                    var firstName = $('#editContactModal<?=$idTabMenu;?>').find('#firstName').val(data[0].FirstName);
                    var lastName = $('#editContactModal<?=$idTabMenu;?>').find('#lastName').val(data[0].LastName);
                    var email = $('#editContactModal<?=$idTabMenu;?>').find('#email').val(data[0].Email);
                    var phone = $('#editContactModal<?=$idTabMenu;?>').find('#phone').val(data[0].Phone);
                    var whatsapp = $('#editContactModal<?=$idTabMenu;?>').find('#whatsapp').val(data[0].Whatsapp);
                    var customerId = $('#editContactModal<?=$idTabMenu;?>').find('#customerId').val(data[0].CustomerId);
                    $('#saveEditContact<?=$idTabMenu;?>').click(function(event) {
                        event.preventDefault(); // Mencegah pengiriman formulir default

                        // Memanggil fungsi saveEditContact dengan mengirimkan id
                        saveEditContact<?=$idTabMenu;?>();
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
                }else{

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

</script>
