<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">

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
</style>
<div class="wrapper wrapper-content bg-white">
    <div class="text-header col-md p-4">
        <h3 class="font-weight-bold">Data Customers</h3>
    </div>
    <div class="ibox-content p-4">
        <div class="tools-table d-flex align-items-end justify-content-between mb-3">
            <div id="exportButtons d-flex">
                <button type="button" id="copyButton" class="btn btn-outline-secondary btn-sm" 
                data-toggle="tooltip" data-placement="top" title="Copy Data" data-original-title="tooltip on top">
                    <i class="fa fa-copy mr-1"></i>
                </button>
                <button type="button" id="csvButton" class="btn btn-outline-success btn-sm"
                data-toggle="Export to CSV" data-placement="top" title="Export to CSV" data-original-title="Export to CSV">
                    <i class="fa fa-file-excel mr-1"></i>
                </button>
                <button type="button" id="pdfButton" class="btn btn-outline-danger btn-sm"
                data-toggle="Export to PDF" data-placement="top" title="Export to PDF" data-original-title="Export to PDF">
                    <i class="fa fa-file-pdf mr-1"></i>
                </button>
                <button type="button" id="printButton" class="btn btn-outline-info btn-sm"
                data-toggle="Print" data-placement="top" title="Print" data-original-title="Print">
                    <i class="fa fa-paste mr-1"></i>
                </button>
            </div>
            <div class="col-sm-3 d-flex align-items-center justify-content-end p-0">
                <input type="text" class="p-1 form-control form-control-sm p-2 mr-1" id="searchDataText" placeholder="Search Data in Table" style="border-top: none;border-left: none;border-right: none;margin-right: 8px;">
                <button id="btn-filter" class="btn btn-primary btn-sm active" type="button">
                    <i class="fa fa-filter"></i>
                </button>
            </div>
        </div>
        <!-- Tabel ZingGrid -->
        <!-- Tombol untuk Ekspor Data -->
            <div class="table-responsive">
                <table class="table table-hover" id="dataTableUsers">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Whatsapp</th>
                            <th>RT/RW</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Kota</th>
                            <th>Product</th>
                            <th>Status Subsribe</th>
                            <th>Status Billing</th>
                            <th>Date Subsribe</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        <!-- search -->
        <!-- <zing-grid pager="10" sort viewport-stop onclick="test(index='id')"> -->
            <!-- Definisikan kolom dengan menentukan label secara kustom -->
            <!-- <zg-column index="id" header="ID"></zg-column>
            <zg-column index="nama" header="Nama"></zg-column>
            <zg-column index="whatsapp" header="WhatsApp"></zg-column>
            <zg-column index="rtrw" header="RT/RW"></zg-column>
            <zg-column index="keluarahan" header="Kelurahan"></zg-column>
            <zg-column index="kecamatan" header="Kecamatan"></zg-column>
            <zg-column index="kota" header="Kota"></zg-column>
            <zg-column index="productname" header="Product Name"></zg-column>
            <zg-column index="statuslangganan" header="Status Langganan"></zg-column>
            <zg-column index="statuspembayaran" header="Status Pembayaran"></zg-column>
            <zg-column index="tanggalregistrasi" header="Tanggal Registrasi"></zg-column>
            <zg-column type="">sadasdasdasd</zg-column>
            <zg-column type="edit" index="action"></zg-column>
            <zg-colgroup>
                <zg-column index="action">sadasd</zg-column>
                <zg-column index="action" type="element" type-element-tag-name="zg-button" type-element-attribute-name="action" onclick="test()"></zg-column>
            </zg-colgroup>
        </zing-grid> -->
    </div>
         <!-- Modal Bootstrap -->
    <div class="modal" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Exporting Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Please wait while the data is being exported...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Tambahkan library ZingGrid -->
    <script src="https://cdn.zinggrid.com/zinggrid.min.js"></script>
    <!-- Tambahkan library Papaparse untuk ekspor CSV -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
    <!-- Tambahkan library jsPDF untuk ekspor PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<!-- Page Scripts -->
<script>
    var base_url = '<?= base_url()?>';
    // Fungsi untuk menampilkan modal
    function showExportModal() {
        $('#exportModal').modal('show');
    }

    // Fungsi untuk menyembunyikan modal
    function hideExportModal() {
        $('#exportModal').modal('hide');
    }

    function handleEdit(event) {
    var selectedRowId = event.detail.row.id;
    // Lakukan sesuatu dengan ID yang dipilih, misalnya tampilkan form edit data, dll.
    console.log('Edit clicked for row with ID:', selectedRowId);
    // Contoh: Redirect ke halaman edit dengan menggunakan ID
    window.location.href = base_url + '/editData/' + selectedRowId;
}
        
    // Fungsi untuk mengambil data dari controller menggunakan AJAX
    function fetchData() {
        // Ganti dengan URL controller Anda
        var url = base_url+'/CustomerController/getListData';

        // Menggunakan jQuery untuk melakukan AJAX request
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                // Masukkan data ke dalam tabel
                $.each(data, function (index, value) {
                    $('#dataTableUsers tbody').append(`
                        <tr>
                            <td>${value.id}</td>
                            <td>${value.nama}</td>
                            <td>${value.whatsapp}</td>
                            <td>${value.rtrw}</td>
                            <td>${value.keluarahan}</td>
                            <td>${value.kecamatan}</td>
                            <td>${value.kota}</td>
                            <td>${value.productname}</td>
                            <td><span class="badge badge-success">${value.statuslangganan}</span></td>
                            <td><span class="badge badge-success">${value.statuspembayaran}</span></td>
                            <td>${value.tanggalregistrasi}</td>
                            <td>
                                <!-- Tambahkan button action sesuai kebutuhan -->
                                <i class="fa fa-pen-to-square fa-lg cursor-pointer pr-3" style="color:#00acc1;" title="Edit Data" onclick="editData(${value.id})"></i>
                                <i class="fa fa-trash fa-lg cursor-pointer" style="color:#00acc1;" title="Delete Data" onclick="deleteData(${value.id})"></i>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    // Menjalankan fungsi fetchData saat halaman dimuat
    $(document).ready(function () {
        fetchData();
    });

    // Mendapatkan referensi ke tombol-tombol ekspor
    var copyButton = document.getElementById('copyButton');
    var csvButton = document.getElementById('csvButton');
    var pdfButton = document.getElementById('pdfButton');
    var printButton = document.getElementById('printButton');

    // Menambahkan event listener untuk menangani ekspor data
    copyButton.addEventListener('click', function () {
        showExportModal();
        // ... (proses ekspor data)
        // Mendapatkan referensi ke elemen zing-grid
        var grid = document.querySelector('zing-grid');

        // Mendapatkan data dari zing-grid
        var data = grid.data;

        // Menyalin data ke clipboard
        navigator.clipboard.writeText(JSON.stringify(data)).then(function() {
            alert('Data copied to clipboard!');
        }).catch(function(err) {
            console.error('Error:', err);
        });
        hideExportModal();
        
    });

    csvButton.addEventListener('click', function () {
        showExportModal();

        // Mendapatkan referensi ke elemen zing-grid
        var grid = document.querySelector('zing-grid');

        // Mendapatkan data dari zing-grid
        var data = grid.data;

        // Mengkonversi data menjadi format CSV
        var csvContent = Papa.unparse(data);

        // Membuat elemen <a> untuk mengunduh data
        var encodedUri = encodeURI("data:text/csv;charset=utf-8," + csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "exported_data.csv");

        // Menyembunyikan elemen <a> dan memanggil fungsi klik
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        hideExportModal();

    });

    pdfButton.addEventListener('click', function () {
        // Mendapatkan referensi ke elemen zing-grid
        var grid = document.querySelector('zing-grid');

        // Mendapatkan data dari zing-grid
        var data = grid.data;

        // Mengkonversi data menjadi format PDF
        var pdf = new jsPDF();
        pdf.autoTable({ head: [grid.columns.map(col => col.label)], body: data });
        pdf.save('exported_data.pdf');
    });

    printButton.addEventListener('click', function () {
            window.print();
    });

    $('#searchInput').on('input', function () {
      // Ambil nilai dari input pencarian
      var searchValue = $(this).val().toLowerCase();

      // Fungsi untuk melakukan pencarian dan memfilter data di ZingGrid
      filterGridData(searchValue);
    });

    // Fungsi untuk memfilter data di ZingGrid
    function filterGridData(searchValue) {
      var grid = document.getElementById('customerGrid');
      
      // Lakukan filter pada setiap baris data
      grid.data.forEach(function (row) {
        var visible = Object.values(row).some(function (value) {
          return String(value).toLowerCase().includes(searchValue);
        });
        row.hidden = !visible;
      });

      // Perbarui tampilan ZingGrid
      grid.refresh();
    }

    function test(id){
        alert(id);
    }
</script>
