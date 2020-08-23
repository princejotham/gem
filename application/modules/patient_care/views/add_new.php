
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel col-md-6 row">
            <header class="panel-heading">
                <?php
                if (!empty($patient_care->id))
                    echo lang('edit_patient_care');
                else
                    echo lang('add_patient_care');
                ?>
            </header>


            <style>
                .panel{
                    background: transparent;
                }

                .payment_label {
                    margin-left: -2%;
                }

            </style>


            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <?php echo validation_errors(); ?>
                    <?php echo $this->session->flashdata('feedback'); ?>
                </div>
                <form role="form" action="patient_care/addNew" class="clearfix row" method="post" enctype="multipart/form-data">
                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15 js-example-basic-single pos_select" id="pos_select" name="patient" value=''> 
                                <option value=""><?php echo lang('select'); ?></option>
                                <option value="add_new" style="color: #41cac0 !important;"><?php echo lang('add_new'); ?></option>
                                <?php foreach ($patients as $patient) { ?>
                                    <option value="<?php echo $patient->id; ?>" <?php
                                    if (!empty($patient_care->patient)) {
                                        if ($patient_care->patient == $patient->id) {
                                            echo 'selected';
                                        }
                                    }
                                    ?> ><?php echo $patient->name; ?> </option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="pos_client clearfix">
                        <div class="col-md-8 payment pad_bot pull-right">
                            <div class="col-md-3 payment_label"> 
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                            </div>
                            <div class="col-md-9"> 
                                <input type="text" class="form-control pay_in" name="p_name" value='<?php
                                if (!empty($payment->p_name)) {
                                    echo $payment->p_name;
                                }
                                ?>' placeholder="">
                            </div>
                        </div>
                        <div class="col-md-8 payment pad_bot pull-right">
                            <div class="col-md-3 payment_label"> 
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                            </div>
                            <div class="col-md-9"> 
                                <input type="text" class="form-control pay_in" name="p_email" value='<?php
                                if (!empty($payment->p_email)) {
                                    echo $payment->p_email;
                                }
                                ?>' placeholder="">
                            </div>
                        </div>
                        <div class="col-md-8 payment pad_bot pull-right">
                            <div class="col-md-3 payment_label"> 
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                            </div>
                            <div class="col-md-9"> 
                                <input type="text" class="form-control pay_in" name="p_phone" value='<?php
                                if (!empty($payment->p_phone)) {
                                    echo $payment->p_phone;
                                }
                                ?>' placeholder="">
                            </div>
                        </div>
                        <div class="col-md-8 payment pad_bot pull-right">
                            <div class="col-md-3 payment_label"> 
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label>
                            </div>
                            <div class="col-md-9"> 
                                <input type="text" class="form-control pay_in" name="p_age" value='<?php
                                if (!empty($payment->p_age)) {
                                    echo $payment->p_age;
                                }
                                ?>' placeholder="">
                            </div>
                        </div> 
                        <div class="col-md-8 payment pad_bot pull-right">
                            <div class="col-md-3 payment_label"> 
                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                            </div>
                            <div class="col-md-9"> 
                                <select class="form-control m-bot15" name="p_gender" value=''>

                                    <option value="Male" <?php
                                    if (!empty($patient->sex)) {
                                        if ($patient->sex == 'Male') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Male </option>   
                                    <option value="Female" <?php
                                    if (!empty($patient->sex)) {
                                        if ($patient->sex == 'Female') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Female </option>
                                    <option value="Others" <?php
                                    if (!empty($patient->sex)) {
                                        if ($patient->sex == 'Others') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Others </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label for="exampleInputEmail1">  <?php echo lang('case_manager'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15 js-example-basic-single" id="acase_managers" name="case_manager" value=''>  
                                <option value=""><?php echo lang('select'); ?></option>
                                <?php foreach ($case_managers as $case_manager) { ?>
                                    <option value="<?php echo $case_manager->id; ?>"<?php
                                    if (!empty($patient_care->case_manager)) {
                                        if ($patient_care->case_manager == $case_manager->id) {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo $case_manager->name; ?> </option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <input type="text" class="form-control" id="date" readonly="" name="date" id="exampleInputEmail1" value='<?php
                            if (!empty($patient_care->date)) {
                                echo date('d-m-Y', $patient_care->date);
                            }
                            ?>' placeholder="">
                        </div>
                    </div>

                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label class=""><?php echo lang('available_slots'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15" name="time_slot" id="aslots" value=''> 

                            </select>
                        </div>
                    </div>


                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <input type="text" class="form-control" name="remarks" id="exampleInputEmail1" value='<?php
                            if (!empty($patient_care->address)) {
                                echo $patient_care->address;
                            }
                            ?>' placeholder="">
                        </div>
                    </div>


                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient_care'); ?> <?php echo lang('status'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15" name="status" value=''>
                                <option value="Pending Confirmation" <?php
                                if (!empty($patient_care->status)) {
                                    if ($patient_care->status == 'Pending Confirmation') {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo lang('pending_confirmation'); ?> </option> 
                                <option value="Confirmed" <?php
                                if (!empty($patient_care->status)) {
                                    if ($patient_care->status == 'Confirmed') {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo lang('confirmed'); ?> </option>
                                <option value="Treated" <?php
                                if (!empty($patient_care->status)) {
                                    if ($patient_care->status == 'Treated') {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo lang('treated'); ?> </option>
                                <option value="cancelled" <?php
                                if (!empty($patient_care->status)) {
                                    if ($patient_care->status == 'Treated') {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo lang('cancelled'); ?> </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                        </div>
                        <div class="col-md-9"> 
                            <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                        </div>
                    </div>






                    <input type="hidden" name="id" id="patient_care_id" value='<?php
                    if (!empty($patient_care->id)) {
                        echo $patient_care->id;
                    }
                    ?>'>

                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                        </div>
                        <div class="col-md-9"> 
                            <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                        </div>
                    </div>


                </form>
            </div>

        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->


<script src="common/js/codearistos.min.js"></script>

<script>
    $(document).ready(function () {
        $('.pos_client').hide();
        $(document.body).on('change', '#pos_select', function () {

            var v = $("select.pos_select option:selected").val()
            if (v == 'add_new') {
                $('.pos_client').show();
            } else {
                $('.pos_client').hide();
            }
        });

    });


</script>


<?php if (!empty($patient_care->id)) { ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#acase_managers").change(function () {
                // Get the record's ID via attribute  
                var id = $('#patient_care_id').val();
                var date = $('#date').val();
                var case_managerr = $('#acase_managers').val();
                $('#aslots').find('option').remove();
                // $('#default').trigger("reset");
                $.ajax({
                    url: 'schedule/getAvailableSlotByCase_managerByDateByPatient_careIdByJason?date=' + date + '&case_manager=' + case_managerr + '&patient_care_id=' + id,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).success(function (response) {
                    var slots = response.aslots;
                    $.each(slots, function (key, value) {
                        $('#aslots').append($('<option>').text(value).val(value)).end();
                    });
                    //   $("#default-step-1 .button-next").trigger("click");
                    if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                        $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                    }
                    // Populate the form fields with the data returned from server
                    //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
                });
            });

        });

        $(document).ready(function () {
            var id = $('#patient_care_id').val();
            var date = $('#date').val();
            var case_managerr = $('#acase_managers').val();
            $('#aslots').find('option').remove();
            // $('#default').trigger("reset");
            $.ajax({
                url: 'schedule/getAvailableSlotByCase_managerByDateByPatient_careIdByJason?date=' + date + '&case_manager=' + case_managerr + '&patient_care_id=' + id,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var slots = response.aslots;
                $.each(slots, function (key, value) {
                    $('#aslots').append($('<option>').text(value).val(value)).end();
                });

                $("#aslots").val(response.current_value)
                        .find("option[value=" + response.current_value + "]").attr('selected', true);

                //   $("#default-step-1 .button-next").trigger("click");
                if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                    $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                }
                // Populate the form fields with the data returned from server
                //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
            });

        });




        $(document).ready(function () {
            $('#date').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
            })
                    //Listen for the change even on the input
                    .change(dateChanged)
                    .on('changeDate', dateChanged);
        });

        function dateChanged() {
            // Get the record's ID via attribute  
            var id = $('#patient_care_id').val();
            var date = $('#date').val();
            var case_managerr = $('#acase_managers').val();
            $('#aslots').find('option').remove();
            // $('#default').trigger("reset");
            $.ajax({
                url: 'schedule/getAvailableSlotByCase_managerByDateByPatient_careIdByJason?date=' + date + '&case_manager=' + case_managerr + '&patient_care_id=' + id,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var slots = response.aslots;
                $.each(slots, function (key, value) {
                    $('#aslots').append($('<option>').text(value).val(value)).end();
                });
                //   $("#default-step-1 .button-next").trigger("click");
                if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                    $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                }


                // Populate the form fields with the data returned from server
                //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
            });

        }




    </script>

<?php } else { ?> 

    <script type="text/javascript">
        $(document).ready(function () {
            $("#acase_managers").change(function () {
                // Get the record's ID via attribute  
                var id = $('#patient_care_id').val();
                var date = $('#date').val();
                var case_managerr = $('#acase_managers').val();
                $('#aslots').find('option').remove();
                // $('#default').trigger("reset");
                $.ajax({
                    url: 'schedule/getAvailableSlotByCase_managerByDateByJason?date=' + date + '&case_manager=' + case_managerr,
                    method: 'GET',
                    data: '',
                    dataType: 'json',
                }).success(function (response) {
                    var slots = response.aslots;
                    $.each(slots, function (key, value) {
                        $('#aslots').append($('<option>').text(value).val(value)).end();
                    });
                    //   $("#default-step-1 .button-next").trigger("click");
                    if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                        $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                    }
                    // Populate the form fields with the data returned from server
                    //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
                });
            });

        });

        $(document).ready(function () {
            var id = $('#patient_care_id').val();
            var date = $('#date').val();
            var case_managerr = $('#acase_managers').val();
            $('#aslots').find('option').remove();
            // $('#default').trigger("reset");
            $.ajax({
                url: 'schedule/getAvailableSlotByCase_managerByDateByJason?date=' + date + '&case_manager=' + case_managerr,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var slots = response.aslots;
                $.each(slots, function (key, value) {
                    $('#aslots').append($('<option>').text(value).val(value)).end();
                });

                $("#aslots").val(response.current_value)
                        .find("option[value=" + response.current_value + "]").attr('selected', true);

                //   $("#default-step-1 .button-next").trigger("click");
                if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                    $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                }
                // Populate the form fields with the data returned from server
                //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
            });

        });




        $(document).ready(function () {
            $('#date').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
            })
                    //Listen for the change even on the input
                    .change(dateChanged)
                    .on('changeDate', dateChanged);
        });

        function dateChanged() {
            // Get the record's ID via attribute  
            var id = $('#patient_care_id').val();
            var date = $('#date').val();
            var case_managerr = $('#acase_managers').val();
            $('#aslots').find('option').remove();
            // $('#default').trigger("reset");
            $.ajax({
                url: 'schedule/getAvailableSlotByCase_managerByDateByJason?date=' + date + '&case_manager=' + case_managerr,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var slots = response.aslots;
                $.each(slots, function (key, value) {
                    $('#aslots').append($('<option>').text(value).val(value)).end();
                });
                //   $("#default-step-1 .button-next").trigger("click");
                if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                    $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                }


                // Populate the form fields with the data returned from server
                //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
            });

        }

    </script>

<?php } ?>








