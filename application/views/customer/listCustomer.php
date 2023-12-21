<!-- <link href="<?= base_url()?>public/css/bootstrap.min.css" rel="stylesheet"> -->
<link href="<?= base_url()?>public/font-awesome/css/font-awesome.css" rel="stylesheet">

<link href="<?= base_url()?>public/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

<link href="<?= base_url()?>public/css/animate.css" rel="stylesheet">
<link href="<?= base_url()?>public/css/style.css" rel="stylesheet">
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
</style>
<div class="wrapper wrapper-content white-bg" style="border: 3px solid white;">
    <div class="text-header col-md">
        <h3 class="font-weight-bold">Data Customers</h3>
    </div>
    <div class="ibox-content">
        <div class="table-responsive ">
            <table id="customerTable" class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <!-- <th>Email</th> -->
                        <th>Whatsapp</th>
                        <th>RT/RW</th>
                        <th>Kelurahan</th>
                        <th>Kecamatan</th>
                        <th>Kota</th>
                        <th>Product Name</th>
                        <th>Status Langganan</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Registrasi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody><!-- Data dari AJAX akan dimasukkan di sini --></tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?= base_url()?>public/js/jquery-2.1.1.js"></script>
<script src="<?= base_url()?>public/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>public/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= base_url()?>public/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?= base_url()?>public/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?= base_url()?>public/js/inspinia.js"></script>
<script src="<?= base_url()?>public/js/plugins/pace/pace.min.js"></script>
<!-- Page Scripts -->
<script>
    var base_url = '<?= base_url()?>';
    $(document).ready(function () {
        // Inisialisasi DataTables
        var table = $('#customerTable').DataTable({
            // Konfigurasi DataTables sesuai kebutuhan
            "dom": '<"top-tool"f<"btn-filter">><"export-tool"lB>rt<"buttom-tool"ip><"clear">',
            "buttons": [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "lengthMenu": [10, 25, 50, 100],
            "language": {
                "lengthMenu": "Show _MENU_ entries ",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                },
                "search": "Search:"
            }
        });
        // AJAX untuk mengambil data dari controller
        $.ajax({
            url: base_url+'/CustomerController/getListData', // Ganti dengan URL controller Anda
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                $('.btn-filter').html(`<button id="btn-filter" class="btn btn-primary btn-sm active" type="button">
                                <i class="fa fa-filter"></i>
                                </button>`);
                console.log(data);
                // Masukkan data ke dalam tabel
                $.each(data, function (index, value) {
                    table.row.add([
                        value.id,
                        value.nama,
                        // value.email,
                        value.whatsapp,
                        value.rtrw,
                        value.keluarahan,
                        value.kecamatan,
                        value.kota,
                        value.productname,
                        value.statuslangganan,
                        value.statuspembayaran,
                        value.tanggalregistrasi,
                        '',
                        // Tambahkan sesuai kebutuhan
                    ]).draw(false);
                });
            }
        });
    });
</script>
