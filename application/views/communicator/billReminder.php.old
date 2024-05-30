
<script src="<?= base_url()?>public/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url()?>public/js/plugins/select2/select2.full.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style> -->
    .d-block {
        display:block;
    }

    .hidden {
        display: none;
    }

    .cursor-pointer {
        cursor: pointer;
    }
    /* .spiner-example {
        display: flex;
        justify-content: center;
        width: 100%;
        height: 100%;
        position: absolute;
        background-color: rgba(32, 33, 36, 0.6);
        z-index: 100;
        align-content: center;
        flex-direction: row;
        flex-wrap: wrap;
    } */

    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .loading-overlay p {
        margin-top: 10px;
    }

    .wrapper {
        position: relative;
    }

    .text-alert{
        color:red;
        font-weight: bold;
        font-size: 3vh;
    }
</style>
    <!-- Loading Overlay -->

<div class="wrapper wrapper-content" style="border: 3px solid white;">
    <div id="wrapper-popup"></div>
    <div class="loading-overlay" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="sk-spinner sk-spinner-wave">
            <div class="sk-rect1"></div>
            <div class="sk-rect2"></div>
            <div class="sk-rect3"></div>
            <div class="sk-rect4"></div>
            <div class="sk-rect5"></div>
        </div>
    </div>
    <div class="row justify-content-center">

        <div class="col-lg-11">
            <div class="alert alert-warning hidden">
                Kolom yang bertanda bintang merah wajib diinput
            </div>
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Form Send Billing Reminder <small>to your customer.</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <!-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a> -->
                        <!-- <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul> -->
                        <!-- <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a> -->
                    </div>
                </div>
                <div class="ibox-content" style="">
                    <form method="POST">
                        <div class="row  justify-content-center" style="justify-content: center !important;">
                            <div class="col-sm-12">
                                <div class="form-group row m-b-sm">
                                    <label class="col-sm-2 col-form-label">Media</label>
                                    <div class="col-sm-8 m-l-sm">
                                        <select class="form-control m-b-none" name="media" id="mediaSelect">
                                            <!-- <option>Whatsapp</option> -->
                                            <?php foreach ($dataConn as $item): 
                                                  if($item->MediaId == 'WHATP'): $mediaName = 'Whatsapp';endif;
                                                  if($item->MediaId == 'WHATP2'): $mediaName = 'Whatsapp2';endif;?>
                                                    <option value="<?= $item->MediaId ?>">
                                                        <?= $mediaName ?>
                                                    </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-sm-12">
                                <div class="form-group row m-b-sm">
                                    <label class="col-sm-2 col-form-label">From</label>
                                    <div class="col-sm-8 m-l-sm">
                                        <select class="form-control m-b-none" name="from" id="fromSelect">
                                            <!-- <option>085945751995</option> -->
                                            <?php foreach ($dataConn as $item): ?>
                                                <option value="<?= $item->UserName ?>" data-mediaid="<?= $item->MediaId ?>">
                                                    <?= $item->UserName ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="padding-bottom:0px !important;">
                                <div class="form-group row m-b-sm">
                                    <label class="col-sm-2 col-form-label" >Type Target</label>
                                    <div class="col-sm-8 m-l-sm">
                                        <select class="form-control m-b-none" name="typeTarget" onchange="toggleElements(this.value)">
                                            <option value="Input">Input</option>
                                            <option value="Contact">Contact</option>
                                            <option value="GroupContact">Group Contact</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row to-input">
                            <div class="col-sm-12" style="padding-bottom:0px !important;">
                                <div class="form-group row m-b-sm">
                                    <label class="col-sm-2 col-form-label">To <span style="color:red;">*</span></label>
                                    <div class="col-sm-8 m-l-sm">
                                        <input class="tagsinput form-control " name="toInput" type="text" value="" placeholder="Insert Number e.g 081xx" style="display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row to-contact hidden">
                            <div class="col-sm-12" style="padding-bottom:0px !important;">
                                <div class="form-group row m-b-sm">
                                    <label class="col-sm-2 col-form-label">To <span style="color:red;">*</span></label>
                                    <div class="col-sm-8 m-l-sm">
                                        <select class="form-control multiple-select" name="toContact" id="toContact" multiple="multiple" style="width: 100%">
                                            <!-- <option value="AL">Alabama</option>
                                                ...
                                            <option value="WY">Wyoming</option> -->
                                            <?php foreach ($dataContact as $item): ?>
                                                <option value="<?= $item->Id ?>" data-mediaid="">
                                                    <?= $item->Name ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row to-group-contact hidden">
                            <div class="col-sm-12" style="padding-bottom:0px !important;">
                                <div class="form-group row m-b-sm">
                                    <label class="col-sm-2 col-form-label">To <span style="color:red;">*</span></label>
                                    <div class="col-sm-8 m-l-sm">
                                    <select class="form-control multiple-select" name="toGroupContact" id="toContactGroup" multiple="multiple" style="width: 100%">
                                        <!-- <option value="AL">Alabama</option>
                                            ...
                                        <option value="WY">Wyoming</option> -->
                                        <?php foreach ($dataContactGroup as $item): ?>
                                            <option value="<?= $item->Id ?>" data-mediaid="">
                                                <?= $item->GroupName ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="padding-bottom:0px !important;">
                                <div class="form-group row m-b-sm">
                                    <label class="col-sm-2 col-form-label">Send Date</label>
                                    <div class="col-sm-8 m-l-sm">
                                        <input type="datetime-local" name="sendDate" class="form-control col-sm-12" id="sendDatePicker" />
                                        <small class="text-italic">This is only for scheduling messages, if you want to send it straight away, you don't need to fill it in</small>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-sm-12" style="padding-bottom:0px !important;">
                                <div class="form-group row m-b-sm">
                                    <label class="col-sm-2 col-form-label">Delay</label>
                                    <div class="col-sm-8 m-l-sm">
                                        <input type="text" name="delay" placeholder="Fill delay time send message per number e.g : 5-10" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="padding-bottom:0px !important;">
                                <div class="form-group row m-b-sm">
                                    <label class="col-sm-2 col-form-label">Subject <span style="color:red;">*</span></label>
                                    <div class="col-sm-8 m-l-sm">
                                        <input type="text" name="subject" placeholder="Fill Subject Message" class="form-control" require>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row message-template">
                            <div class="col-sm-12" style="padding-bottom:0px !important;">
                                <div class="form-group row m-b-sm">
                                    <label class="col-sm-2 col-form-label" >Message Template</label>
                                    <div class="col-sm-8 m-l-sm">
                                        <select class="form-control m-b-none" name="messageTemplate" id="templateMessage">
                                            <option value="">Select Template Message</option>
                                            <!-- <option value="Template">Reminder 7 hari</option> -->
                                            <?php foreach ($dataTemplate as $item): ?>
                                                <?php $metaData = json_decode($item->Meta, true); ?>
                                                <option value="<?= $item->Id ?>" data-mediaid="<?= $item->MediaId ?>" data-content="<?= htmlspecialchars($item->Content) ?>" data-params="<?= implode(', ', $metaData['params']) ?>" data-meta='<?= $item->Meta?>'>
                                                    <?= $item->Title ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row input-message m-b-lg hidden">
                            <div class="col-sm-12">
                                <div class="form-group row m-b-sm">
                                    <!-- <label class="col-sm-2 col-form-label">Value Variable</label> -->
                                    <div class="col-sm-8 m-l-sm">
                                        <input class="form-control " id="variableMessage" name="variableMessage" type="text" value="" placeholder="for variable custom e.g fonnte" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row input-message m-b-lg">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Message <span style="color:red;">*</span></label>
                                    <div class="col-sm-8 m-l-sm">
                                        <div class="input-group w-100 flex-nowrap">
                                            <span class="input-group-text white-bg" id="basic-addon1">
                                            <i class="fa fa-comment"></i>
                                            </span>
                                            <textarea name="message" id="message" class="form-control" cols="30" rows="10" placeholder="Write your message" require></textarea>
                                        </div>
                                        <!-- <small class="text-italic">Usable variable for custom : {name}, {var1}, {var2},...</small>
                                        <small id="buttonInfo" class="float-right cursor-pointer">Info</small> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>

                        <div class="row"> 
                            <div class="col-sm-12" style="padding-bottom:0px !important;">
                                <div class="form-group row m-b-xs">
                                    <div class="col-sm-12 m-l-sm">
                                        <!-- <button class="btn btn-white btn-sm" type="submit">Cancel</button> -->
                                        <button class="btn btn-primary btn-sm col-sm-2 float-right" type="submit">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Logout Info Variable-->
<div class="modal fade" id="infoVaribleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Table of param variable message</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table width='100%' border='1px'>
                    <tr>
                        <td>{CustomerName}</td>
                        <td>get name of contact customer</td>
                    </tr>
                    <tr>
                        <td>{BillingAmount}</td>
                        <td>get total bill</td>
                    </tr>
                    <tr>
                        <td>{DueDate}</td>
                        <td>Due date of billing</td>
                    </tr>
                    <tr>
                        <td>{DueDate}</td>
                        <td>Due Date Billing</td>
                    </tr>
                    <tr>
                        <td>{IdBilling}</td>
                        <td>Id Billing</td>
                    </tr>
                    <tr>
                        <td>{PeriodeBilling}</td>
                        <td>Periode Billing</td>
                    </tr>
                    <tr>
                        <td>{PacketName}</td>
                        <td>Packet name of customer</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Mainly scripts -->
<script src="<?= base_url()?>public/js/jquery-3.1.1.min.js"></script>
<script src="<?= base_url()?>public/js/popper.min.js"></script>
<script src="<?= base_url()?>public/js/bootstrap.js"></script>
<script src="<?= base_url()?>public/js/bootstrap.min.js"></script>
<script src="<?= base_url()?>public/js/inspinia.js"></script>
<script src="<?= base_url()?>public/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?= base_url()?>public/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Flot -->
<script src="<?= base_url()?>public/js/plugins/flot/jquery.flot.js"></script>
<script src="<?= base_url()?>public/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?= base_url()?>public/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="<?= base_url()?>public/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?= base_url()?>public/js/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?= base_url()?>public/js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="<?= base_url()?>public/js/plugins/flot/curvedLines.js"></script>
<!-- Peity -->
<script src="<?= base_url()?>public/js/plugins/peity/jquery.peity.min.js"></script>
<script src="<?= base_url()?>public/js/demo/peity-demo.js"></script>
<!-- Custom and plugin javascript -->
<script src="<?= base_url()?>public/js/inspinia.js"></script>
<script src="<?= base_url()?>public/js/plugins/pace/pace.min.js"></script>
<!-- jQuery UI -->
<script src="<?= base_url()?>public/js/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Jvectormap -->
<script src="<?= base_url()?>public/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= base_url()?>public/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- Sparkline -->
<script src="<?= base_url()?>public/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- Sparkline demo data  -->
<script src="<?= base_url()?>public/js/demo/sparkline-demo.js"></script>
<!-- ChartJS-->
<script src="<?= base_url()?>public/js/plugins/chartJs/Chart.min.js"></script>
<script src="<?= base_url()?>public/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url()?>public/js/plugins/select2/select2.full.min.js"></script>

<script>

    $(document).ready(function() {
        //Buat fungsi tagsinput
        $('.tagsinput').tagsinput({
                tagClass: 'label label-primary'
        });

        //Buat fungsi multiselect
        $('.multiple-select').select2();

        //Buat multiselect dan tagsinput agar kolom auto 100% saat awal di load
        $('.bootstrap-tagsinput').addClass('col-sm-12');
        $('.multiple-select').addClass('col-sm-12');

        //Buat fungsi select from data berdasarkan data apa yang di pilih oleh mediaselect
        $('#mediaSelect').change(function() {
            var selectedMediaId = $(this).val();
            $('#toContact').children().attr("data-mediaid",selectedMediaId);
            $('#toContactGroup').children().attr("data-mediaid",selectedMediaId);

            // Hide all options
            $('#fromSelect option').hide();

            // Show options that match the selected MediaId
            $('#fromSelect option[data-mediaid="' + selectedMediaId + '"]').show();

            // Auto select the first matching option
            $('#fromSelect option[data-mediaid="' + selectedMediaId + '"]:first').prop('selected', true);
        });
        // Hide options in 'From' select initially
        $('#fromSelect option').hide();

        //Buat fungsi modal info variable message
        $("#buttonInfo").on("click", function () {
            // Show the logout modal
            $("#infoVaribleModal").modal("show");
        });

        //Buat fungsi Apply message template to textarea message
        $('#templateMessage').change(function() {
            var selectedTemplateId = $(this).val();
            var selectedTemplateContent = $(this).find(':selected').data('content');
            var selectedTemplateParams = $(this).find(':selected').data('params');
            console.log(selectedTemplateId);
            console.log(selectedTemplateContent);
            console.log(selectedTemplateParams);

            // Set nilai textarea message berdasarkan konten template yang dipilih
            $('#message').val(selectedTemplateContent);
            // Set nilai input variableMessage berdasarkan params template yang dipilih
            $('#variableMessage').val(selectedTemplateParams);
        });
        // Hide options in 'From' select initially
        $('#fromSelect option').hide();

        // Untuk show hide templateMessage berdasarkan typetarget yang di pilih
        // Sembunyikan select template saat halaman dimuat
        $('.message-template').hide();

        $('select[name="typeTarget"]').change(function() {
            var selectedValue = $(this).val();
            var messageTemplateSelect = $('.message-template');

            // Jika 'Input' dipilih, sembunyikan select template
            if (selectedValue === 'Input') {
                messageTemplateSelect.hide();
            } else {
                // Selain 'Input', tampilkan select template
                messageTemplateSelect.show();
            }
        });
    });

    //Untuk menampilkan select to berdasarkan typetarget yang dipilih
    function toggleElements(selectedValue) {
        // $('.to-input, .to-contact, .to-group-contact').hide();
        if (selectedValue === 'Input') {
            $('.to-input').removeClass('hidden');
            $('.to-contact').addClass('hidden');
            $('.to-group-contact').addClass('hidden');
            $('.select2-selection__rendered').html('');
            // $('.to-group-contact').hide();
        } else if (selectedValue === 'Contact') {
            $('.tagsinput').tagsinput('removeAll');
            $('.to-input').addClass('hidden');
            $('.to-contact').removeClass('hidden');
            $('.to-group-contact').addClass('hidden');
            $('.select2-selection__rendered').html('');
            
        } else if (selectedValue === 'GroupContact') {
            $('.tagsinput').tagsinput('removeAll');
            $('.to-contact').addClass('hidden');
            $('.to-input').addClass('hidden');
            $('.to-group-contact').removeClass('hidden');
            $('.select2-selection__rendered').html('');
        }
    }

    $('form').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Ambil nilai dari elemen formulir
        var mediaId = $('#mediaSelect').val();
        var from = $('#fromSelect').val();
        var typeTarget = $('select[name="typeTarget"]').val();
        var toInput = $('input[name="toInput"]').val();
        var toContact = $('select[name="toContact"]').val();
        var toGroupContact = $('select[name="toGroupContact"]').val();
        var sendDate = $('input[name="sendDate"]').val();
        var delay = $('input[name="delay"]').val();
        var subject = $('input[name="subject"]').val();
        var messageTemplate = $('select[name="messageTemplate"]').val();
        var metaTemplate = $('select[name="messageTemplate"] option:selected').data('meta');
        var variableMessage = $('input[name="variableMessage"]').val();
        var message = $('textarea[name="message"]').val();
        var convertedVariable = replaceVarMessage(message, variableMessage);
        // Susun objek data
        var formData = {
            MediaId: mediaId,
            From: from,
            TypeTarget: typeTarget,
            ToInput: toInput,
            ToContact: toContact,
            ToGroupContact: toGroupContact,
            SendDate: sendDate,
            Delay: delay,
            Subject: subject,
            MessageTemplate: messageTemplate,
            MetaTemplate: metaTemplate,
            VariableMessage: variableMessage,
            Message: message,
            ConvertedVariable: convertedVariable.replacedData
        };
        var base_url = "<?php echo base_url(); ?>";
        // console.log(convertedVariable.replacedData);
        // console.log(formData);
        // console.log(base_url);
        var toMessage;
        if(toInput !== ''){
            toMessage = toInput;
        }else if(toContact !== ''){
            toMessage = toContact;
        }else if(toGroupContact !== ''){
            toMessage = toGroupContact;
        }
        if(subject !== '' && message !== '' && toMessage.length !== 0){
            $('.loading-overlay').show();
            // Kirim data menggunakan Ajax
            $.ajax({
                type: 'POST',
                url: base_url+'Message_Controller/sendMessage', // Ganti dengan URL controller Anda
                data: formData,
                success: function (response) {
                    // Handle the response from the controller
                    $('.loading-overlay').hide();
                    console.log(response);

                    // Jika Anda ingin melakukan sesuatu setelah berhasil mengirim data, tambahkan kode di sini
                },
                error: function (error) {
                    // Handle errors
                    console.log('Error:', error);
                }
            });
        }else{
            var htmlAlert = `<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-alert"><center>Please fill in all required fields!</center></div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Okey</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
            $('#wrapper-popup').html(htmlAlert);
            $("#alertModal").modal("show");
        }
        
        
    });

    
    function convertToBraces(inputString) {
        // Memisahkan string menjadi array berdasarkan koma dan spasi
        var variables = inputString.split(', ');

        // Menambahkan kurung kurawal pada setiap elemen array
        var variablesWithBraces = variables.map(function(variable) {
            return '{' + variable + '}';
        });

        // Menggabungkan kembali array menjadi string
        var result = variablesWithBraces.join(', ');

        return result;
    }
    
    function replaceVarMessage(data, variable) {
        // Membuat variabel pengganti untuk CustomerName
        var replacementMap = {
            '{name}': 'CustomerName',
        };
        var arrayVariable = variable.split(',');
        // Menemukan variabel yang ada dalam kurung kurawal
        var matches = data.match(/\{([^}]+)\}/g);
        // console.log(matches);

        // Membuat mapping otomatis berdasarkan variabel yang ditemukan
        if (matches) {
            matches.forEach(function(match, index) {
                if (!replacementMap[match]) {
                    // replacementMap[] = '{var' + (index + 1) + '}';
                    replacementMap[match] = arrayVariable[index];
                }
            });
        }
        // console.log('datakami',arrayVariable);

        // console.log('datakami',replacementMap);

        // Melakukan penggantian variabel
        for (var key in replacementMap) {
            if (replacementMap.hasOwnProperty(key)) {
                var regex = new RegExp(key, "g");
                data = data.replace(regex, replacementMap[key]);
                // console.log('datakami',data);
            }
        }
                // console.log('datakami',data);
        // Mendapatkan hanya data variabel yang ada di dalam kurung kurawal
        var onlyVariables = data.match(/\{([^}]+)\}/g);

        return {
            replacedData: data,
            onlyVariables: onlyVariables
        };
    }
</script>