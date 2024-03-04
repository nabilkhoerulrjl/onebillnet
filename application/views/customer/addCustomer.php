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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add Customer Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div class="card-content">
                    <form class="form form-vertical">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group has-icon-left">
                                        <label for="firstName"><i class="fa fa-user"></i> First Name <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                        <input type="text" class="form-control form-control-sm" placeholder="First Name" id="firstName" name="firstName" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group has-icon-left">
                                        <label for="lastName"><i class="fa fa-user"></i> Last Name <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <input type="text" class="form-control form-control-sm" placeholder="Last Name" id="lastName" name="lastName" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group has-icon-left">
                                        <label for="last-name"><i class="fa fa-address-card"></i> NIK</label>
                                        <div class="position-relative">
                                            <input type="number" class="form-control form-control-sm" placeholder="NIK Number" id="nikNumber" name="nikNumber" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group has-icon-left">
                                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                        <div class="position-relative">
                                        <input type="email" class="form-control form-control-sm" placeholder="Email" id="email" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group has-icon-left">
                                        <label for="whatsapp"><i class="fa fa-whatsapp"></i> WhatsApp <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                        <div class="row">
                                            <div class="col-md-3 col-lg-3 p-r-0">
                                                <input type="text" class="form-control form-control-sm" value="+62" id="countryCode" name="whatsapp" disabled required> 
                                            </div>
                                            <div class="col-md-9 col-lg-9 p-l-0">
                                                <input type="number" class="form-control form-control-sm" placeholder="WhatsApp Number" id="whatsapp" name="whatsapp" required>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
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
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group has-icon-left">
                                        <label for="cityBorn"><i class="fa fa-city"></i> City Born <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                        <input type="text" class="form-control form-control-sm" placeholder="City Born" id="cityBorn" name="cityBorn" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group has-icon-left">
                                        <label for="dateOfBirth"><i class="fa fa-calendar-days"></i> Date of Birth <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                        <input type="date" class="form-control form-control-sm cursor-pointer" placeholder="City Born" id="dateOfBirth" name="dateOfBirth" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group has-icon-left cursor-pointer" onchange="return checkImageSize()">
                                        <label for="myImage"><i class="fa fa-id-badge"></i> Image <span style="color:red;">*</span></label>
                                        <div class="position-relative form-control form-control-sm dot-text cursor-pointer">
                                            <input type="file" id="myImage" name="myImage" accept="image/png, image/jpg, image/jpeg" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group has-icon-left">
                                        <label for="gender"><i class="fa fa-venus-mars"></i> Gender <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <select class="form-control form-control-sm cursor-pointer" id="gender" name="typeTarget">
                                                <option value="">Select Gender</option>
                                                <option value="Laki-Laki">Laki - Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
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
                                <div class="col-6">
                                    <div class="form-group has-icon-left">
                                        <label for="province"><i class="fa fa-montain-sun"></i> Province <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <select class="form-control form-control-sm cursor-pointer" name="province" id="province">
                                            <option selected>Select Provinces</option>
                                            <option value="" disabled>
                                                    <span class="sr-only text-center">Loading...</span>
                                                </option>    
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group has-icon-left">
                                        <label for="city"><i class="fa fa-city"></i> City <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <select class="form-control form-control-sm cursor-pointer" name="city" id="city">
                                                <option selected disabled>Select City</option>
                                                <option value="" disabled>
                                                    <span class="sr-only text-center">Loading...</span>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group has-icon-left">
                                        <label for="kecamatan"><i class="fa fa-tree-city"></i> Kecamatan <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <select class="form-control form-control-sm cursor-pointer" name="kecamatan" id="kecamatan">
                                                <option selected disabled>Select Kecamatan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group has-icon-left">
                                        <label for="keluarahan"><i class="fa fa-tree-city"></i> Kelurahan <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                            <select class="form-control form-control-sm cursor-pointer" name="kelurahan" id="kelurahan">
                                                <option selected disabled>Select Kelurahan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group has-icon-left">
                                        <label for="rtrw"><i class="fa fa-user"></i> Rt/Rw <span style="color:red;">*</span></label>
                                        <div class="position-relative">
                                        <input type="text" class="form-control form-control-sm" placeholder="Rt/Rw" id="rtrw" name="rtrw" required>
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

    // Fungsi untuk mengisi elemen input select dengan data wilayah
    function fillSelect(selectElement, data, defaultText) {
        console.log(selectElement, data, defaultText);
      selectElement.empty(); // Kosongkan opsi sebelum mengisi yang baru
      
      // Tambahkan elemen default sebagai panduan
      selectElement.append($("<option>").val("").text(defaultText).prop("selected", true));

      // Isi elemen input select dengan data wilayah
      $.each(data, function(index, wilayah) {
        selectElement.append($("<option>").val(wilayah.id).text(wilayah.name));
      });
    }

    // Fungsi untuk mengisi elemen input select Kota/Kabupaten berdasarkan id provinsi
    function fillCitySelect(provinceId) {
      var fillCitySelect = $("#city");
      fillCitySelect.empty(); // Kosongkan opsi sebelum mengisi yang baru

      // Jika provinsi belum dipilih (nilai null atau kosong), tidak perlu mengambil data kota/kabupaten
      if (!provinceId) {
        return;
      }

      // Panggil API untuk mendapatkan data kota/kabupaten berdasarkan id provinsi
      var apiUrl = "https://nabilkhoerulrjl.github.io/api-wilayah-indonesia/api/regencies/" + provinceId + ".json";
      getData(apiUrl, function(data) {
        fillSelect(fillCitySelect, data, "Select City");
        // Setelah mengisi kota/kabupaten, panggil fungsi untuk mengisi kecamatan
        fillCitySelect.on('change', function() {
          var selectedCityId = $(this).val();
          fillKecamatanSelect(selectedCityId);
        });
      });
    }

    // Fungsi untuk mengisi elemen input select Kecamatan berdasarkan id kota/kabupaten
    function fillKecamatanSelect(cityId) {
      var kecamatanSelect = $("#kecamatan");
      kecamatanSelect.empty(); // Kosongkan opsi sebelum mengisi yang baru

      // Jika kota/kabupaten belum dipilih (nilai null atau kosong), tidak perlu mengambil data kecamatan
      if (!cityId) {
        return;
      }

      // Panggil API untuk mendapatkan data kecamatan berdasarkan id kota/kabupaten
      var apiUrl = "https://nabilkhoerulrjl.github.io/api-wilayah-indonesia/api/districts/" + cityId + ".json";
      getData(apiUrl, function(data) {
        fillSelect(kecamatanSelect, data, "Select Kecamatan");
        // Setelah mengisi kecamatan, panggil fungsi untuk mengisi kelurahan
        kecamatanSelect.on('change', function() {
          var selectedKecamatanId = $(this).val();
          fillKelurahanSelect(selectedKecamatanId);
        });
      });
    }

    // Fungsi untuk mengisi elemen input select Kelurahan berdasarkan id kecamatan
    function fillKelurahanSelect(kecamatanId) {
      var kelurahanSelect = $("#kelurahan");
      kelurahanSelect.empty(); // Kosongkan opsi sebelum mengisi yang baru

      // Jika kecamatan belum dipilih (nilai null atau kosong), tidak perlu mengambil data kelurahan
      if (!kecamatanId) {
        return;
      }

      // Panggil API untuk mendapatkan data kelurahan berdasarkan id kecamatan
      var apiUrl = "https://nabilkhoerulrjl.github.io/api-wilayah-indonesia/api/villages/" + kecamatanId + ".json";
      getData(apiUrl, function(data) {
        fillSelect(kelurahanSelect, data, "Select Kelurahan");
      });
    }

    // Panggil fungsi getData untuk mengambil data provinsi dan isi elemen select
    getData("https://nabilkhoerulrjl.github.io/api-wilayah-indonesia/api/provinces.json", function(data) {
        fillSelect($("#province"), data, "Select Provinces");
    //   fillSelect($("#province"), data);
      // Setelah mengisi provinsi, panggil fungsi untuk mengisi kota/kabupaten
      $("#province").on('change', function() {
        var selectedProvinsiId = $(this).val();
        console.log(selectedProvinsiId);
        fillCitySelect(selectedProvinsiId);
      });
    });

    

    $('#saveDataCustomer').on('click', function(e) {
        e.preventDefault(); // Menghentikan aksi default form submit

        // Mengambil nilai dari input form
        var firstName = $('#firstName').val();
        var lastName = $('#lastName').val();
        var nikNumber = $('#nikNumber').val();
        var email = $('#email').val();
        var countryCode = $('#countryCode').val();
        var whatsapp = $('#whatsapp').val();
        var product = $('#product').val();
        var cityBorn = $('#cityBorn').val();
        var dateOfBirth = $('#dateOfBirth').val();
        var image = $('#myImage')[0].files[0]; // Mendapatkan file gambar
        var gender = $('#gender').val();
        var contactGroup = $('#contactGroup').val(); // Adjust this based on your form structure
        var address = $('#address').val();
        var province = $('#province option:selected').text();
        var city = $('#city  option:selected').text();
        var kecamatan = $('#kecamatan  option:selected').text();
        var kelurahan = $('#kelurahan  option:selected').text();
        var rtRw = $('#rtrw').val();
        var formData = new FormData();
            formData.append('firstName', firstName);
            formData.append('lastName', lastName);
            formData.append('nikNumber', nikNumber);
            formData.append('email', email);
            formData.append('countryCode', countryCode);
            formData.append('whatsapp', whatsapp);
            formData.append('product', product);
            formData.append('cityborn', cityBorn);
            formData.append('dateOfBirth', dateOfBirth);
            formData.append('myImage', image);
            formData.append('gender', gender);
            formData.append('contactGroup', contactGroup);
            formData.append('address', address);
            formData.append('province', capitalizeWords(province));
            formData.append('city', capitalizeWords(city));
            formData.append('kecamatan', capitalizeWords(kecamatan));
            formData.append('kelurahan', capitalizeWords(kelurahan));
            formData.append('rtRw', rtRw);
            console.log('formData',formData);
            // Tampilkan data di console log
            // for (var pair of formData.entries()) {
            //     console.log(pair[0] + ', ' + capitalizeWords(pair[1]));
            // }

        if (!firstName || !lastName || !email || !countryCode || !whatsapp || !product || !cityBorn || !dateOfBirth || !image || !gender || !contactGroup || !address || !province || !city || !kecamatan || !kelurahan || !rtRw) {
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
                    // $('#overlayLoading').show();
                    // $('#overlay').show();
                },
                success: function(response) {
                    // Handle response dari Controller
                    console.log(response);
                    // Tambahan: Refresh halaman atau lakukan aksi lain jika diperlukan
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

</script>