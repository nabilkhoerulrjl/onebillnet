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
</style>
<div class="modal fade" id="formEditCSModal<?=$idTabMenu;?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Update Customer Form</h5>
                <button type="button" class="close" onclick="cleanFormEdit<?=$idTabMenu;?>()" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form class="form form-vertical">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left d-none">
                                        <input type="hidden" class="form-control form-control-sm cursor-text" id="id" name="id" value="">
                                        <input type="hidden" class="form-control form-control-sm cursor-text" id="contactId" name="contactId" value="">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="firstName"><i class="fa fa-user"></i> First Name</label>
                                        <div class="position-relative">
                                        <input type="text" class="form-control form-control-sm" placeholder="First Name" id="firstName" name="firstName">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="lastName"><i class="fa fa-user"></i> Last Name</label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control form-control-sm" placeholder="Last Name" id="lastName" name="lastName">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <label for="whatsapp"><i class="fa fa-whatsapp"></i> WhatsApp</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control form-control-sm" placeholder="WhatsApp Number e.g 628 or 08" id="whatsapp" name="whatsapp">
                                            <input type="hidden" class="form-control form-control-sm" value="+62" id="countryCode" name="whatsapp" disabled> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                        <div class="position-relative">
                                        <input type="email" class="form-control form-control-sm" placeholder="Email" id="email" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <label for="product"><i class="fa fa-wifi"></i> Product</label>
                                        <div class="position-relative">
                                            <select class="form-control form-control-sm form-control-sm cursor-pointer" name="product" id="product">
                                                <option value="" selected>Select Product Internet</option>
                                                <option value="" disabled>
                                                    <span class="sr-only text-center">Loading...</span>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <label for="contactGroup"><i class="fa fa-address-book"></i> Contact Group</label>
                                        <div class="position-relative">
                                            <select class="form-control form-control-sm cursor-pointer"  id="contactGroup" name="contactGroup">
                                                <option value="" selected>Select Contact Group</option>
                                                <option value="" disabled>
                                                    <span class="sr-only text-center">Loading...</span>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <label for="statusActive"><i class="fa fa-wifi"></i> Status</label>
                                        <div class="position-relative">
                                            <select class="form-control form-control-sm form-control-sm cursor-pointer" name="statusActive" id="statusActive">
                                                <option value="" selected>Select Status Customer</option>
                                                <option value="" disabled>
                                                    <span class="sr-only text-center">Loading...</span>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <label for="dateActive"><i class="fa fa-address-book"></i> Date Active</label>
                                        <div class="position-relative">
                                            <input type="date" class="form-control form-control-sm cursor-text" placeholder="Due Date" id="dateActive" name="dateActive">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="address"><i class="fa fa-user"></i> Address</label>
                                        <div class="position-relative">
                                            <textarea class="form-control form-control-sm" placeholder="Full Address" id="address" name="address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" id="saveEditCustomer<?=$idTabMenu;?>" class="btn btn-primary me-1 mb-1">Submit</button>
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
    function saveEditCustomer<?=$idTabMenu?>(){
        var base_url = '<?= base_url()?>';
        var url = base_url+'CustomerController/editCustomer';
        var id = $('#formEditCSModal<?=$idTabMenu;?>').find('#id').val();
        var contactId = $('#formEditCSModal<?=$idTabMenu;?>').find('#contactId').val();
        var firstName = $('#formEditCSModal<?=$idTabMenu;?>').find('#firstName').val();
        var lastName = $('#formEditCSModal<?=$idTabMenu;?>').find('#lastName').val();
        var whatsapp = $('#formEditCSModal<?=$idTabMenu;?>').find('#whatsapp').val();
        var email = $('#formEditCSModal<?=$idTabMenu;?>').find('#email').val();
        var product = $('#formEditCSModal<?=$idTabMenu;?>').find('#product').val()
        var contactGroup = $('#formEditCSModal<?=$idTabMenu;?>').find('#contactGroup').val();
        var statusActive = $('#formEditCSModal<?=$idTabMenu;?>').find('#statusActive').val();
        var dateActive = $('#formEditCSModal<?=$idTabMenu;?>').find('#dateActive').val();
        var address = $('#formEditCSModal<?=$idTabMenu;?>').find('#address').val();
            var requestData = {
                id: id,
                contactId: contactId,
                firstName: firstName,
                lastName: lastName,
                whatsapp: whatsapp,
                email: email,
                product: product,
                contactGroup: contactGroup,
                statusActive: statusActive,
                dateActive: dateActive,
                address: address,
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
                        var startDate = $('#filterDateCustomer').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
                        var endDate = $('#filterDateCustomer').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
                        var filterData = {
                            startDate: startDate,
                            endDate: endDate
                        }
                        fetchData(filterData);// Memanggil fungsi untuk memperbarui tabel

                        Swal.fire({
                            title: 'Success',
                            text: 'Data Customer Berhasil Diupdate',
                            icon: 'success',
                            confirmButtonColor: '#1abc9c',
                        });
                    }else{
                        Swal.fire({
                            title: 'Attention',
                            text: 'Data Customer Gagal Diupdate',
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

    $('#saveEditCustomer<?=$idTabMenu;?>').click(function(event) {
        event.preventDefault(); // Mencegah pengiriman formulir default
        // alert('asdasd');
        // Memanggil fungsi saveEditCustomer dengan mengirimkan id
        saveEditCustomer<?=$idTabMenu;?>();
    });
</script>