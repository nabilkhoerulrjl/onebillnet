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

    .img-lunas {
        position: absolute;
        /* left: 1px; */
        top: 4em;
        right: 4em;
        transform: rotate(23deg);
    }
</style>
<div class="modal fade" id="formPayBlModal<?=$idTabMenu;?>" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="payBillModalLabel">Pay Bill</h5>
                <button type="button" class="close-modal-pay-bill" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form class="form form-vertical">
                        <div class="form-body">
                            
                            <div class="d-flex justify-content-end wrapper-img-lunas">
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <li class="reference-id d-none" id="referenceId" value=""></li>
                                        <label for="customer">Tagihan Atas Nama : </label>
                                        <li class="name-customer"></li>
                                    </div>
                                    <div class="form-group has-icon-left">
                                        <label for="customer">Deskripsi : </label>
                                        <li class="product"></li>
                                    </div>
                                    <div class="form-group has-icon-left">
                                        <label for="customer">Harga : </label>
                                        <li class="price"></li>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <div class="position-relative">
                                            <label for="paymentMethod"><i class="fa-solid fa-wallet"></i> Metode Pembayaran <span style="color:red;">*</span></label>
                                            <select class="form-control form-control-sm" name="paymentMethod" id="paymentMethod">
                                                <option value="">Pilih Pembayaran</option>
                                                <option value="Transfer Manual">Transfer Manual</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Xendit">Xendit</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group has-icon-left">
                                        <label for="payDate"><i class="fa-solid fa-calendar"></i> Tanggal Bayar <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <input type="datetime-local" class="form-control form-control-sm cursor-text" id="payDate" name="payDate" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" id="payBill<?=$idTabMenu;?>" class="btn btn-primary me-1 mb-1"><i class="fa-solid fa-money-bill-1-wave"></i> Pay</button>
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
                    // console.log(item.FirstName);
                    select.append('<option value="' + item.Id + '">' + item.FirstName + ' ' + item.LastName + '</option>');
                });
            },
            error: function(err) {
                console.log('Error:', err);
            }
        });
        
    });

    $('#payBill<?=$idTabMenu;?>').on('click', function(e) {
        e.preventDefault(); // Menghentikan aksi default form submit

        // Mengambil nilai dari input form
        var referenceId = $('#referenceId').text();
        var payDate = formatTimestamp($('#payDate').val());
        var paymentMethod = $('select[name="paymentMethod"]').val();
        console.log(referenceId,payDate,paymentMethod);
        //var formData = new FormData();
            //formData.append('ReferenceId', referenceId);
            //formData.append('PaymentMethod', paymentMethod);
            //formData.append('PaymentDate', payDate);
        var formData = {
            ReferenceId:referenceId,
            PaymentMethod:paymentMethod,
            PaymentDate:payDate
        }

        if (!payDate || !paymentMethod) {
            // Jika ada setidaknya satu kolom yang kosong, lakukan sesuatu, contohnya:
            Swal.fire({
                title: 'Attention',
                text: 'Kolom bertanda bintang merah wajib di isi',
                icon: 'warning',
                button: true,
                confirmButtonColor: 'red',
            });
        } else {
            var base_url = "<?php echo base_url(); ?>";
            // Mengirim data ke Controller menggunakan AJAX
            $.ajax({
                url: base_url+'customer/BillCustomer_Controller/payBill', // Ganti dengan URL Controller CodeIgniter Anda
                type: 'POST',
                data: formData,
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
                    console.log(response);

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
                            text: "Horee🥳, Kamu berhasil update status tagihan pelanggan🤗.",
                            icon: "success"
                        });
                        
                        var currentPage = parseInt($('.pageNumber<?=$idTabMenu;?>.active').data('page'));
                        fetchData(currentPage);
                        $(".reference-id").text(); // Sesuaikan dengan struktur response;
                        $(".name-customer").text(); // Sesuaikan dengan struktur response;
                        $(".product").text(); // Sesuaikan dengan struktur response;
                        $(".price").text();
                        $('select[name="paymentMethod"]').val('').trigger('change');
                        $('#payDate').val('');
                        $(".close-modal-pay-bill").trigger("click");
                        // fetchData(); // Panggil fungsi untuk memperbarui data setelah berhasil menghapus
                    } else{
                        Swal.fire({
                            title: "Attendance!",
                            text: "Yahh☹️, Kamu gagal update status tagihan pelanggan😭!",
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

    function formatTimestamp(timestamp) {
        // Pecah timestamp asli menjadi bagian tanggal dan waktu
        const datePart = timestamp.split('T')[0];  // Ambil bagian tanggal sebelum 'T'
        const timePart = timestamp.split('T')[1];  // Ambil bagian waktu setelah 'T'

        // Tentukan format yang diinginkan, misalnya ubah hanya bulan dan hari
        const newDatePart = datePart.replace(/-\d{2}-\d{2}/, '-02-05'); // Ubah ke 5 Februari

        // Gabungkan kembali bagian tanggal yang baru dengan waktu yang asli
        return `${newDatePart} ${timePart}:00`; // Tambahkan detik '00' ke waktu
    }

</script>