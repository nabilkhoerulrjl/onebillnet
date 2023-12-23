<script src="<?= base_url()?>public/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url()?>public/js/plugins/select2/select2.full.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
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
</style>
<div class="card m-2">
    <div class="card-header">
        <h4>Broadcast Billing Reminder</h4>
    </div>
    <div class="card-body ml-5 mt-0 mr-5 mb-0">
    <form method="POST">
        <h5>Form Options</h5>
        <hr>
        <div class="row">
            <div class="col-md-6">
                
                    <div class="form-group">
                        <label class="col-form-label">Media</label>
                        <div class="">
                            <select class="form-control form-control-sm" name="media" id="mediaSelect">
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
                    <div class="form-group">
                        <label class="col-form-label">From</label>
                        <div class="">
                            <select class="form-control form-control-sm" name="from" id="fromSelect">
                                <!-- <option>085945751995</option> -->
                                <?php foreach ($dataConn as $item): ?>
                                    <option value="<?= $item->UserName ?>" data-mediaid="<?= $item->MediaId ?>">
                                        <?= $item->UserName ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Send Date</label>
                        <div class="">
                            <input type="datetime-local" name="sendDate" class="form-control form-control-sm col-sm-12" id="sendDatePicker" />
                            <small class="text-italic">This is only for scheduling messages, if you want to send it straight away, you don't need to fill it in</small>
                        </div>
                    </div>
                
            </div>
            <div class="col-md-6">
                
                    <div class="form-group">
                        <label class="col-form-label">Type Target</label>
                        <div class="">
                            <select class="form-control form-control-sm" name="typeTarget" onchange="toggleElements(this.value)">
                                <option value="Input">Input</option>
                                <option value="Contact">Contact</option>
                                <option value="GroupContact">Group Contact</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group to-input">
                        <label class="col-form-label">To <span style="color:red;">*</span></label>
                        <div class="">
                            <input class="tagsinput form-control form-control-sm d-none" name="toInput" type="text" value="" placeholder="Insert Number e.g 081xx">
                        </div>
                    </div>
                    <div class="form-group to-contact d-none">
                        <label class="col-form-label">To <span style="color:red;">*</span></label>
                        <div class="">
                            <select class="form-control form-control-sm multiple-select-contact" name="toContact" id="toContact" multiple="multiple" style="width: 100%">
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
                    <div class="form-group to-group-contact d-none">
                        <label class="col-form-label">To <span style="color:red;">*</span></label>
                        <div class="">
                        <select class="form-control form-control-sm multiple-select-group" name="toGroupContact" id="toContactGroup" multiple="multiple" style="width: 100%">
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
                    <div class="form-group">
                        <label class="col-form-label">Delay</label>
                        <div class="">
                            <input type="text" name="delay" placeholder="Fill delay time send message per number e.g : 5-10" class="form-control form-control-sm">
                        </div>
                    </div>
                
            </div>
        </div>
        <h5 class="mt-3">Form Message</h5>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label">Subject <span style="color:red;">*</span></label>
                    <div class="">
                        <input type="text" name="subject" placeholder="Fill Subject Message" class="form-control form-control-sm" require>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-form-label" >Message Template</label>
                    <div class="">
                        <select class="form-control form-control-sm m-b-none" name="messageTemplate" id="templateMessage">
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
            <div class="col-sm-12">
                <div class="form-group d-none">
                    <!-- <label class="col-sm-2 col-form-label">Value Variable</label> -->
                    <div class="">
                        <input class="form-control " id="variableMessage" name="variableMessage" type="text" value="" placeholder="for variable custom e.g fonnte" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label">Message <span style="color:red;">*</span></label>
                    <div class="">
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
            <div class="col-sm-12">
                <div class="form-group">
                    <button type="submit" class="btn  btn-primary p-3 mb-2 float-right">Send Message</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
<script src="<?= base_url()?>public/js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script src="<?= base_url()?>public/js/plugins/select2/select2.full.min.js"></script>
<script>

    $(document).ready(function() {
        //Buat fungsi tagsinput
        $('.tagsinput').tagsinput({
                tagClass: 'label label-primary'
        });

        //Buat fungsi multiselect
        $('.multiple-select-contact').select2({
            placeholder: "Select by Contact",
            allowClear: true
        });
        $('.multiple-select-group').select2({
            placeholder: "Select by Group Contact",
            allowClear: true
        });

        //Buat multiselect dan tagsinput agar kolom auto 100% saat awal di load
        // $('.bootstrap-tagsinput').addClass('form-control form-control-sm');
        $('.bootstrap-tagsinput').addClass('bg-white');
        $('.bootstrap-tagsinput').css({'border':'2px solid #d7d7d7'});
        $('.bootstrap-tagsinput').css({'height':'calc(1.5em + 0.5rem + 4px)'});
        $('.bootstrap-tagsinput').children('input').addClass('bg-white');
        $('.bootstrap-tagsinput').children('input').addClass('border-0');

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
            $('.to-input').removeClass('d-none');
            $('.to-contact').addClass('d-none');
            $('.to-group-contact').addClass('d-none');
            $('.select2-selection__rendered').html('');
            // $('.to-group-contact').hide();
        } else if (selectedValue === 'Contact') {
            $('.tagsinput').tagsinput('removeAll');
            $('.to-input').addClass('d-none');
            $('.to-contact').removeClass('d-none');
            $('.to-group-contact').addClass('d-none');
            $('.select2-selection__rendered').html('');
            
        } else if (selectedValue === 'GroupContact') {
            $('.tagsinput').tagsinput('removeAll');
            $('.to-contact').addClass('d-none');
            $('.to-input').addClass('d-none');
            $('.to-group-contact').removeClass('d-none');
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