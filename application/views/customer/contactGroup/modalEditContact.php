<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .swal2-container {
        z-index: 10000;
    }

    .dot-text {
        /* width: 300px; Sesuaikan lebar dengan kebutuhan */
        white-space: nowrap; /* Mencegah teks untuk melipat (wrap) ke baris baru */
        overflow: hidden; /* Menyembunyikan teks yang melebihi batas elemen */
        text-overflow: ellipsis;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .cursor-text {
        cursor: text;
    }

    .select2-selection.select2-selection--multiple {
        border: 2px solid #d7d7d7 !important;
        border-radius: 0px !important;
        margin: 0px !important;
    }
    .select2.select2-container .select2-selection {
        border: 1px solid black;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        height: 34px;
        margin-bottom: 15px;
        outline: none !important;
        transition: all .15s ease-in-out;
    }
    .select2.select2-container .select2-selection--multiple .select2-selection__choice {
        background-color: #1ABC9C;
        border: 1px solid #ccc;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        margin: 4px 4px 0 0;
        padding: 0 6px 0 22px;
        height: 24px;
        line-height: 24px;
        font-size: 12px;
        position: relative;
    }

    .select2-selection__rendered,.select2.select2-container .select2-selection {
    overflow-y: auto;
    max-height: 50px; /* Sesuaikan dengan tinggi maksimum yang diinginkan */
}

    .multiple-select-customer {

    }
</style>
<div class="modal fade" id="editContactModal<?=$idTabMenu;?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form class="form form-vertical">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left d-none">
                                        <input type="hidden" class="form-control form-control-sm cursor-text" id="id" name="id" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="firstName"><i class="fa fa-user"></i> First Name</label>
                                        <input type="text" class="form-control form-control-sm cursor-text" id="firstName" name="firstName" value="" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="lastName"><i class="fa fa-user"></i> Last Name</label>
                                        <input type="text" class="form-control form-control-sm cursor-text" id="lastName" name="lastName" value="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="email"><i class="fa-solid fa-envelope"></i> Email</label>
                                        <div class="position-relative">
                                            <input type="email" class="form-control form-control-sm cursor-text" id="email" name="email" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="phone"><i class="fa-solid fa-phone"></i> Phone</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control form-control-sm cursor-text" id="phone" name="phone" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="whatsapp"><i class="fa-brands fa-whatsapp"></i> Whatsapp</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control form-control-sm cursor-text" id="whatsapp" name="whatsapp" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left d-none">
                                        <input type="hidden" class="form-control form-control-sm cursor-text" id="customerId" name="customerId" value="">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button id="saveEditContact<?=$idTabMenu;?>" class="btn btn-primary me-1 mb-1" >Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function saveEditContact<?=$idTabMenu?>(){
        var base_url = '<?= base_url()?>';
        var url = base_url+'customer/ContactGroupController/editContact';
        var id = $('#editContactModal<?=$idTabMenu;?>').find('#id').val();
        var firstName = $('#editContactModal<?=$idTabMenu;?>').find('#firstName').val();
        var lastName = $('#editContactModal<?=$idTabMenu;?>').find('#lastName').val();
        var email = $('#editContactModal<?=$idTabMenu;?>').find('#email').val();
        var phone = $('#editContactModal<?=$idTabMenu;?>').find('#phone').val();
        var whatsapp = $('#editContactModal<?=$idTabMenu;?>').find('#whatsapp').val();
        var customerId = $('#editContactModal<?=$idTabMenu;?>').find('#customerId').val();
            var requestData = {
                id: id,
                firstName: firstName,
                lastName: lastName,
                email: email,
                phone: phone,
                whatsapp: whatsapp,
                customerId: customerId,
            };
            console.log(requestData);
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: requestData,
                beforeSend: function() {
                    // Menampilkan elemen loading sebelum permintaan dikirim
                    Swal.fire({
                        title: 'Mohon Tunggu',
                        text: 'Proses sedang berlangsung...',
                        icon: 'info',
                        timer: 2000,
                        timerProgressBar: true,
                        button: false,
                    });
                },
                success: function (data) {
                    // Menyembunyikan elemen loading setelah data diterima
                    if(data.success == true){
                        // Perbarui tabel
                        refreshTableContact<?=$idTabMenu?>(); // Memanggil fungsi untuk memperbarui tabel

                        Swal.fire({
                            title: 'Berhasil Update Contact',
                            text: 'Data Contact berhasil diupdate',
                            icon: 'success',
                            confirmButtonColor: '#1abc9c',
                        });
                    }else{
                        Swal.fire({
                            title: 'Attention',
                            text: 'Data Contact gagal diupdate',
                            icon: 'error',
                            button: true,
                            confirmButtonColor: 'red',
                        });
                    }
                    
                },
                error: function (error) {
                    // Menyembunyikan elemen loading jika terjadi kesalahan
                    $('#overlayLoading').hide();
                    $('#overlay').hide();
                    console.error('Error:', error);
                }
            });

        // alert($id);

        return false; // Ini mencegah perilaku default tombol "Submit"
    }

    function refreshTableContact<?=$idTabMenu?>() {
        // Ambil data terbaru dari server dan perbarui tabel
        $.ajax({
            url: '<?= base_url()?>customer/ContactGroupController/refreshContactData',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Perbarui isi tabel dengan data terbaru
                var tableBody = $('#dataTableContact<?=$idTabMenu?> tbody');
                tableBody.empty(); // Kosongkan isi tabel sebelum memperbarui

                if (data.length > 0) {
                    // Jika ada data, tambahkan baris-baris baru ke dalam tabel
                    $.each(data, function (index, item) {
                        var statusBadge = (item.StatusId == 'CTS1') ? 'badge-success' : 'badge-warning';
                        var statusId = (item.StatusId == 'CTS1') ? 'Active' : 'Not Active';
                        var name = (item.Name != null) ? item.Name : '-';
                        var email = (item.Email != null) ? item.Email : '-';
                        var phone = (item.Phone != null) ? item.Phone : '-';
                        var whatsapp = (item.Whatsapp != null) ? item.Whatsapp : '-';
                        var groupName = (item.GroupName != null) ? item.GroupName : '-';
                        
                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + name + '</td>' +
                            '<td>' + email + '</td>' +
                            '<td>' + phone + '</td>' +
                            '<td>' + whatsapp + '</td>' +
                            '<td>' + groupName + '</td>' +
                            '<td><span class="badge ' + statusBadge + '">' + statusId + '</span></td>' +
                            '<td><i class="fa fa-pen-to-square fa-lg cursor-pointer pr-3" style="color:#00acc1;" title="Edit Data" onclick="editDataContact<?=$idTabMenu?>(' + item.Id + ')"></i><td>' + // Tambahkan tombol aksi sesuai kebutuhan
                            '</tr>';
                        tableBody.append(row);
                    });
                } else {
                    // Jika tidak ada data, tampilkan pesan "Data not found"
                    var noDataMsg = '<tr><td colspan="8" class="pt-3 pb-0">' +
                        '<span class="d-flex justify-content-center h5 text-secondary">Data Contact not Found</span>' +
                        '</td></tr>';
                    tableBody.append(noDataMsg);
                }
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

</script>