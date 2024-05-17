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
<div class="modal fade" id="formAddCSModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add Customer Form</h5>
                <button type="button" class="close" onclick="cleanForm<?=$idTabMenu;?>()" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form class="form form-vertical">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="firstName"><i class="fa fa-user"></i> First Name <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                        <input type="text" class="form-control form-control-sm" placeholder="First Name" id="firstName" name="firstName" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="lastName"><i class="fa fa-user"></i> Last Name <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control form-control-sm" placeholder="Last Name" id="lastName" name="lastName" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <label for="whatsapp"><i class="fa fa-whatsapp"></i> WhatsApp <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control form-control-sm" placeholder="WhatsApp Number e.g 628 or 08" id="whatsapp" name="whatsapp" required>
                                            <input type="hidden" class="form-control form-control-sm" value="+62" id="countryCode" name="whatsapp" disabled required> 
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
                                        <label for="product"><i class="fa fa-wifi"></i> Product <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <select class="form-control form-control-sm form-control-sm cursor-pointer" name="product" id="product" required>
                                                <option value="">Select Product Internet</option>
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
                                                <option value="">Select Contact Group</option>
                                                <option value="" disabled>
                                                    <span class="sr-only text-center">Loading...</span>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group has-icon-left">
                                        <label for="address"><i class="fa fa-user"></i> Address <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <textarea class="form-control form-control-sm" placeholder="Full Address" id="address" name="address" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" id="saveDataCustomer" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
    $(document).ready(function () {
        // bsCustomFileInput.init()
        // var urlDataProduct = ;
        var base_url = "<?php echo base_url(); ?>";
        $('#loaderProduct').hide();
        $("#product").click(function() {
            $.ajax({
                url: base_url+'ProductController/getListDataProduct',
                method: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    // Menampilkan elemen loading sebelum permintaan dikirim
                    $('#loaderProduct').show();
                    // $('#overlay').show();
                },
                success: function (data) {
                    $('#loaderProduct').show();
                    
                    console.log('urlDataProduct',data);
                    // Simpan indeks opsi yang dipilih sebelumnya
                    var selectedIndex = $('#product').prop('selectedIndex');
                    // Hapus semua option
                    $('#product').empty();
                    // Tambahkan opsi pertama
                    $('#product').append($("<option>").val("").text("Select Product Internet"));
                    // Tambahkan opsi baru
                    $.each(data, function(index, product) {
                        $('#product').append($("<option>").val(product.Id).text(product.Name));
                    });
                    // Pilih kembali opsi yang sebelumnya dipilih
                    $('#product').prop('selectedIndex', selectedIndex);
                }
            });
        });
        
        $("#contactGroup").click(function() {
            // alert('asdasd');
            $.ajax({
                url: base_url+'ContactGroupController/getListDataContactGroup',
                method: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    // Menampilkan elemen loading sebelum permintaan dikirim
                    // $('#overlayLoading').show();
                    // $('#overlay').show();
                },
                success: function (data) {
                    // console.log('urlDataProduct',data);
                    var selectedIndex = $('#contactGroup').prop('selectedIndex');
                    // Hapus semua option
                    $('#contactGroup').empty();
                    // Tambahkan opsi pertama
                    $('#contactGroup').append($("<option>").val("").text("Select Contact Group"));
                    // Tambahkan opsi baru
                    $.each(data, function(index, contacGroup) {
                        $('#contactGroup').append($("<option>").val(contacGroup.Id).text(contacGroup.GroupName));
                    });
                    // Pilih kembali opsi yang sebelumnya dipilih
                    $('#contactGroup').prop('selectedIndex', selectedIndex);
                }
            });
        });
    })

    function getData(url, callback) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
            callback(JSON.parse(xhr.responseText));
            }
        };
        xhr.open("GET", url, true);
        xhr.send();
    }
    // selectElement.append($("<option>").val("").text(defaultText).prop("selected", true));

    $('#saveDataCustomer').on('click', function(e) {
        e.preventDefault(); // Menghentikan aksi default form submit

        // Mengambil nilai dari input form
        var firstName = $('#firstName').val();
        var lastName = $('#lastName').val();
        var countryCode = $('#countryCode').val();
        var whatsapp = $('#whatsapp').val();
        var email = $('#email').val();
        var product = $('#product').val();
        var contactGroup = $('#contactGroup').val(); // Adjust this based on your form structure
        var address = $('#address').val();
        var formData = new FormData();
            formData.append('firstName', firstName);
            formData.append('lastName', lastName);
            formData.append('countryCode', countryCode);
            formData.append('whatsapp', whatsapp);
            formData.append('email', email);
            formData.append('product', product);
            formData.append('contactGroup', contactGroup);
            formData.append('address', address);
            console.log('formData',formData);
            // Tampilkan data di console log
            // for (var pair of formData.entries()) {
            //     console.log(pair[0] + ', ' + capitalizeWords(pair[1]));
            // }

        if (!firstName || !lastName || !countryCode || !whatsapp || !product || !address ) {
            // Jika ada setidaknya satu kolom yang kosong, lakukan sesuatu, contohnya:
            Swal.fire({
                title: 'Attention',
                text: 'Kolom bertanda bintang merah wajib di isi',
                icon: 'warning',
                button: true,
                confirmButtonColor: 'red',
            });
        } else {
            // Membuat objek FormData untuk mengirim file gambar
            console.log('Masuk');

            // Mengirim data ke Controller menggunakan AJAX
            $.ajax({
                url: base_url+'CustomerController/storeData', // Ganti dengan URL Controller CodeIgniter Anda
                type: 'POST',
                data: formData,
                processData: false, // Untuk mengirim file, harus diatur false
                contentType: false, // Untuk mengirim file, harus diatur false
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
                success: function(response) {
                    // Handle response dari Controller
                    console.log(response);
                    cleanForm<?=$idTabMenu;?>();
                    Swal.fire({
                        title: 'Success',
                        text: 'Data Customer Berhasil Ditambah',
                        icon: 'success',
                        confirmButtonColor: '#1abc9c',
                    });
                    // Refresh data
                    var startDate = $('#filterDateCustomer').data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:ss');
                    var endDate = $('#filterDateCustomer').data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:ss');
                    var filterData = {
                        startDate: startDate,
                        endDate: endDate
                    }
                    fetchData(filterData);
                },
                error: function(error) {
                    // Handle error
                    console.log(error);
                }
            });
        }
    });

    function capitalizeWords(str) {
        return str.toLowerCase().replace(/\b\w/g, function(match) {
            return match.toUpperCase();
        });
    }

    function checkImageSize() {
        var input = document.getElementById('myImage');

        if (input.files && input.files[0]) {
            var fileSize = input.files[0].size; // Ukuran file dalam byte
            var maxSizeInBytes = 1048576; // 1 MB dalam byte

            if (fileSize > maxSizeInBytes) {
                Swal.fire({
                    title: 'Upload Dibatalkan',
                    text: 'Ukuran file gambar tidak boleh lebih dari 1 MB.',
                    icon: 'warning',
                    button: true,
                    confirmButtonColor: 'red',
                });
                // Reset input file untuk menghindari pengiriman gambar yang terlalu besar
                input.value = '';
                return false; // Membatalkan pengiriman formulir
            }
        }

        return true; // Melanjutkan pengiriman formulir jika ukuran file sesuai
    }

    function cleanForm<?=$idTabMenu;?>() {
        // Bersihkan nilai dari semua input dan textarea di dalam formulir
        $('#firstName').val('');
        $('#lastName').val('');
        $('#whatsapp').val('');
        $('#email').val('');
        $('#product').val('');
        $('#contactGroup').val('');
        $('#address').val('');

        // Reset seleksi default pada select box
        $('#product').prop('selectedIndex', 0);
        $('#contactGroup').prop('selectedIndex', 0);
    }

</script>