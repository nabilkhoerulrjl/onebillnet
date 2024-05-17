<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- <script src="<?= base_url()?>public/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url()?>public/js/plugins/select2/select2.full.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

<style>

</style>
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
<div class="modal fade" id="formAddBlModal<?=$idTabMenu;?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add Bill Invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form class="form form-vertical">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="customer"><i class="fa fa-user"></i> Customer <span style="color:red;">*</span></label>
                                        <!-- <div class="position-relative"> -->
                                            <select class="form-control form-control-sm multiple-select-customer" name="customer" id="customer" multiple="multiple" style="width: 100%">
                                                <option value="">Select Customers</option>
                                            </select>
                                        <!-- </div> -->
                                    </div>
                                </div>
                                <!-- <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="amount"><i class="fa fa-money-bill-1-wave"></i> Amount <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control form-control-sm" placeholder="Amount" id="amount" name="amount" data-origin="" required>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="periode"><i class="fa-solid fa-calendar"></i> Periode <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <input type="month" class="form-control form-control-sm cursor-text" id="periode" name="periode" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="dueDate"><i class="fa fa-calendar-days"></i> Due Date <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <input type="date" class="form-control form-control-sm cursor-text" placeholder="Due Date" id="dueDate" name="dueDate" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="statusPayment">Status</label>
                                        <div class="position-relative">
                                        <input type="text" class="form-control form-control-sm" value="Unpaid" data="BLS2" placeholder="Status Payment" id="statusPayment" name="statusPayment" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="descriptions">Descriptions </label>
                                        <div class="position-relative">
                                            <textarea class="form-control form-control-sm" placeholder="Descriptions" id="descriptions" name="descriptions" required></textarea>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" id="saveDataBill" class="btn btn-primary me-1 mb-1">Add</button>
                                    <button type="reset" id="resetDataBill" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url()?>public/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url()?>public/js/plugins/select2/select2.full.min.js"></script>
<script src="<?= base_url()?>public/js/plugins/accounting/accounting.min.js"></script>
<script>
    $(document).ready(function () {
        // bsCustomFileInput.init()
        // var urlDataProduct = ;
        var base_url = "<?php echo base_url(); ?>";

        $.ajax({
            url: base_url + 'CustomerController/getAllData',
            dataType: 'json',
            method: 'GET',
            beforeSend: function() {
                $('.loaderCustomer').show();
            },
            success: function(data) {
                $('.loaderCustomer').hide();
                var select = $('.multiple-select-customer');

                // Tambahkan opsi "Select All"
                select.append('<option value="all">Select All</option>');

                // Tambahkan data ke dalam select option
                $.each(data, function(index, item) {
                    console.log(item.FirstName);
                    select.append('<option value="' + item.Id + '">' + item.FirstName + ' ' + item.LastName + '</option>');
                });
            },
            error: function(err) {
                console.log('Error:', err);
            }
        });

        $('.multiple-select-customer').select2({
            placeholder: "Select Customers",
            allowClear: true,
            dropdownParent: $('#formAddBlModal<?=$idTabMenu;?>'),
        });

        // Tambahkan event listener untuk menangani pemilihan "Select All"
        $('.multiple-select-customer').on('change', function () {
            if ($(this).val() && $(this).val().includes('all')) {
                $(this).val('').trigger('change.select2');
                $(this).find('option:first-child').prop('selected', false);
                $(this).find('option:not(:first-child)').prop('selected', 'selected').end().trigger('change.select2');
            }
        });

        // });

        // Fungsi untuk memformat angka menjadi format rupiah
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            var formattedValue = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + formattedValue;
        }

        // Fungsi untuk menghapus karakter selain angka
        function cleanNonNumeric(input) {
            return input.replace(/\D/g, '');
        }

        // Event listener ketika input diubah
        $('#amount').on('input', function() {
            // Ambil nilai input
            var inputValue = $(this).val();

            // Hapus karakter selain angka saat memulai pengisian ulang input
            if (inputValue.charAt(0) === 'R' || inputValue.charAt(0) === 'r') {
            inputValue = cleanNonNumeric(inputValue.substring(2));
            }

            // Bersihkan karakter selain angka
            var numericValue = cleanNonNumeric(inputValue);

            // kirim angka tanpa format ke attribute data
            $('#amount').attr("data-origin",numericValue);
            console.log(numericValue);
            // Format angka menjadi rupiah
            var formattedValue = formatRupiah(numericValue);

            // Set nilai input dengan format rupiah
            $(this).val(formattedValue);
        });

        $('#periode').on('input', function() {
            // Ambil nilai input
            var inputValue = $(this).val();

            // Ambil tahun dan bulan dari nilai input
            var selectedYear = inputValue.substring(0, 4);
            var selectedMonth = inputValue.substring(5);

            // Tampilkan nilai tahun dan bulan di konsol (gantilah dengan penggunaan data sesuai kebutuhan)
            console.log('Selected Year: ' + selectedYear);
            console.log('Selected Month: ' + selectedMonth);
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
        });

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

        $('#saveDataBill').on('click', function(e) {
            e.preventDefault(); // Menghentikan aksi default form submit

            // Mengambil nilai dari input form
            var periode = $('#periode').val();
            var customerId = $('select[name="customer"]').val();
            var customerIdArr = [];
            customerIdArr.push(customerId);

            if(customerId[0] == 'all'){
                customerId = customerId.filter(function(customer) {
                    return customer !== "all";
                });
            }

            var formData = new FormData();
                formData.append('CustomerId', customerIdArr);
                formData.append('Periode', periode);

            if (!customerId || !periode) {
                // Jika ada setidaknya satu kolom yang kosong, lakukan sesuatu, contohnya:
                Swal.fire({
                    title: 'Attention',
                    text: 'Kolom bertanda bintang merah wajib di isi',
                    icon: 'warning',
                    button: true,
                    confirmButtonColor: 'red',
                });
            } else {
                // Mengirim data ke Controller menggunakan AJAX
                $.ajax({
                    url: base_url+'customer/BillCustomer_Controller/createBillInv', // Ganti dengan URL Controller CodeIgniter Anda
                    type: 'POST',
                    data: formData,
                    processData: false, // Untuk mengirim file, harus diatur false
                    contentType: false, // Untuk mengirim file, harus diatur false
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
                    success: function(response) {
                        // responseObject = response;
                        if(response){
                            var responseObject = JSON.parse(response);
                        }
                        // Handle response dari Controller
                        // if(responseObject.status == 'success') {
                        //     Swal.fire({
                        //         title: "Congratulations!",
                        //         text: "Your data has been save!",
                        //         icon: "success"
                        //     });
                        //     fetchData();
                        // }
                        if (responseObject.status === 'success') {
                            Swal.fire({
                                title: "Congratulations!",
                                text: "Invoice tagihan berhasil dibuat!",
                                icon: "success"
                            });
                            // $('#resetDataBill').on('click', function(e) {
                            // $('select[name="customer"]').val();
                            $('select[name="customer"]').val('').trigger('change');
                            // $('#amount').attr('data-origin','');
                            $('#periode').val('');
                            // });
                            fetchData(1);
                            // fetchData(); // Panggil fungsi untuk memperbarui data setelah berhasil menghapus
                        } else if(responseObject.status === 'info'){
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
                        // Tambahan: Refresh halaman atau lakukan aksi lain jika diperlukan
                    }
                });
            }
        });

        $('#resetDataBill').on('click', function(e) {
            $('select[name="customer"]').val(null).trigger('change');
            // $('#amount').attr('data-origin','');
            $('#').val('');
            $('#dueDate').val('');
            $('#statusPayment').attr('data');
            $('#descriptions').val('');
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

    // function cleanForm<?=$idTabMenu;?>() {
    //     // Bersihkan nilai dari semua input dan textarea di dalam formulir
    //     $('#firstName').val('');
    //     $('#lastName').val('');
    //     $('#whatsapp').val('');
    //     $('#email').val('');
    //     $('#product').val('');
    //     $('#contactGroup').val('');
    //     $('#address').val('');

    //     // Reset seleksi default pada select box
    //     $('#product').prop('selectedIndex', 0);
    //     $('#contactGroup').prop('selectedIndex', 0);
    // }

</script>