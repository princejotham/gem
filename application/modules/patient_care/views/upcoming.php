
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('upcoming'); ?> <?php echo lang('patient_cares'); ?>
                <div class="col-md-4 clearfix pull-right custom_buttons">
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i>   <?php echo lang('add_patient_care'); ?> 
                            </button>
                        </div>
                    </a>
                    <button class="export" onclick="javascript:window.print();">Print</button>  
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('id'); ?></th>
                                <th> <?php echo lang('patient'); ?></th>
                                <th> <?php echo lang('case_manager'); ?></th>
                                <th> <?php echo lang('date-time'); ?></th>
                                <th> <?php echo lang('remarks'); ?></th>
                                <th> <?php echo lang('status'); ?></th>
                                <th> <?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>

                        <style>

                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }

                        </style>

                        <?php
                        foreach ($patient_cares as $patient_care) {
                            if ($patient_care->date > strtotime(date('Y-m-d'))) {
                                ?>
                                <tr class="">
                                    <td ><?php echo $patient_care->id; ?></td>
                                    <td> <?php echo $this->db->get_where('patient', array('id' => $patient_care->patient))->row()->name; ?></td>
                                    <td><?php
                                        if (!empty($patient_care->case_manager)) {
                                            echo $this->db->get_where('case_manager', array('id' => $patient_care->case_manager))->row()->name;
                                        }
                                        ?></td>
                                    <td class="center"><?php echo date('d-m-Y', $patient_care->date); ?> : <?php echo $patient_care->s_time; ?> - <?php echo $patient_care->e_time; ?></td>
                                    <td>
                                        <?php echo $patient_care->remarks; ?>
                                    </td>
                                    <td>
                                        <?php echo $patient_care->status; ?>
                                    </td>
                                    <td>
                                        <button id="" data-toggle="modal" class="btn btn-info btn-xs btn_width sms" data-id="<?php echo $patient_care->id; ?>">SMS</button>
                                        <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $patient_care->id; ?>"><i class="fa fa-edit"> <?php echo lang('edit'); ?></i></button>   
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="patient_care/delete?id=<?php echo $patient_care->id; ?>" <?php echo lang('delete'); ?> onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i></a>
                                        <?php if ($patient_care->status == 'Confirmed') { ?>
                                            <a class="btn btn-info btn-xs btn_width detailsbutton" href="meeting/instantLive?id=<?php echo $patient_care->id; ?>" <?php echo lang('live'); ?> target="_blank" onclick="return confirm('Are you sure you want to start a live meeting with this patient? SMS and Email will be sent to the Patient.');"><i class="fa fa-headphones"> <?php echo lang('live'); ?></i></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>




                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->





<!-- Add Patient_care Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add_patient_care'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient_care/addNew" method="post" class="clearfix" enctype="multipart/form-data">
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single pos_select" id="pos_select" name="patient" value=''> 
                            <option value="">Select</option>
                            <option value="add_new" style="color: #41cac0 !important;"><?php echo lang('add_new'); ?></option>
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id; ?>" <?php
                                if (!empty($payment->patient)) {
                                    if ($payment->patient == $patient->id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patient->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="pos_client clearfix col-md-6">
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_email" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_phone" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_age" value='' placeholder="">
                        </div> 
                        <div class="payment pad_bot"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                            <select class="form-control" name="p_gender" value=''>

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
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('case_manager'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single" id="acase_managers" name="case_manager" value=''>  
                            <option value="">Select</option>
                            <?php foreach ($case_managers as $case_manager) { ?>
                                <option value="<?php echo $case_manager->id; ?>"><?php echo $case_manager->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" id="date" readonly="" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">Available Slots</label>
                        <select class="form-control m-bot15" name="time_slot" id="aslots" value=''> 

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('patient_care'); ?> <?php echo lang('status'); ?></label> 
                        <select class="form-control m-bot15" name="status" value=''>
                            <option value="Pending Confirmation" <?php
                            ?> > <?php echo lang('pending_confirmation'); ?> </option>
                            <option value="Confirmed" <?php
                            ?> > <?php echo lang('confirmed'); ?> </option>
                            <option value="Treated" <?php
                            ?> > <?php echo lang('treated'); ?> </option>
                            <option value="Cancelled" <?php
                            ?> > <?php echo lang('cancelled'); ?> </option>
                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="col-md-6 panel">
                        <label> <?php echo lang('send_sms'); ?>  </label> <br>
                        <input type="checkbox" name="sms" class="" value="sms">  <?php echo lang('yes'); ?>
                    </div>
                    <div class="col-md-12 panel">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient_care Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('edit_patient_care'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" id="editPatient_careForm" action="patient_care/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single pos_select patient" id="pos_select" name="patient" value=''> 
                            <option value="">Select</option>
                            <option value="add_new" style="color: #41cac0 !important;"><?php echo lang('add_new'); ?></option>
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id; ?>" <?php
                                if (!empty($payment->patient)) {
                                    if ($payment->patient == $patient->id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patient->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="pos_client clearfix col-md-6">
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_email" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                            <input type="text" class="form-control pay_in" name="p_phone" value='' placeholder="">
                        </div>
                        <div class="payment pad_bot pull-right">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label> 
                            <input type="text" class="form-control pay_in" name="p_age" value='' placeholder="">
                        </div> 
                        <div class="payment pad_bot"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                            <select class="form-control" name="p_gender" value=''>

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
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('case_manager'); ?></label> 
                        <select class="form-control m-bot15 js-example-basic-single case_manager" id="acase_managers1" name="case_manager" value=''>  
                            <option value="">Select</option>
                            <?php foreach ($case_managers as $case_manager) { ?>
                                <option value="<?php echo $case_manager->id; ?>"><?php echo $case_manager->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control default-date-picker" id="date1" readonly="" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">Available Slots</label>
                        <select class="form-control m-bot15" name="time_slot" id="aslots1" value=''> 

                        </select>
                    </div>
                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('patient_care'); ?> <?php echo lang('status'); ?></label> 
                        <select class="form-control m-bot15" name="status" value=''>
                            <option value="Pending Confirmation" <?php
                            ?> > <?php echo lang('pending_confirmation'); ?> </option>
                            <option value="Confirmed" <?php
                            ?> > <?php echo lang('confirmed'); ?> </option>
                            <option value="Treated" <?php
                            ?> > <?php echo lang('treated'); ?> </option>
                            <option value="Cancelled" <?php
                            ?> > <?php echo lang('cancelled'); ?> </option>
                        </select>
                    </div>

                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="col-md-6 panel">
                        <label> <?php echo lang('send_sms'); ?> ? </label> <br>
                        <input type="checkbox" name="sms" class="" value="sms">  <?php echo lang('yes'); ?>
                    </div>
                    <input type="hidden" name="id" id="patient_care_id" value=''>
                    <div class="col-md-12 panel">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-location-arrow"></i> <?php echo lang('send_sms_to_patient'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="sendSmsToVolunteer" action="sms/patient_careReminder" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <p><?php echo lang('reminder_message'); ?></p>
                    </div>
                    <input type="hidden" id="id" value="" name="id">
                    <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('yes'); ?></button>
                    <button type="submit" name="submit" class="btn btn-info invoicebutton" data-dismiss="modal" aria-hidden="true"><?php echo lang('cancel'); ?></button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                                            $(document).ready(function () {
                                                                $(".editbutton").click(function (e) {
                                                                    e.preventDefault(e);
                                                                    // Get the record's ID via attribute  
                                                                    var iid = $(this).attr('data-id');
                                                                    var id = $(this).attr('data-id');

                                                                    $('#editPatient_careForm').trigger("reset");
                                                                    $('#myModal2').modal('show');
                                                                    $.ajax({
                                                                        url: 'patient_care/editPatient_careByJason?id=' + iid,
                                                                        method: 'GET',
                                                                        data: '',
                                                                        dataType: 'json',
                                                                    }).success(function (response) {
                                                                        var de = response.patient_care.date * 1000;
                                                                        var d = new Date(de);
                                                                        var da = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
                                                                        // Populate the form fields with the data returned from server
                                                                        $('#editPatient_careForm').find('[name="id"]').val(response.patient_care.id).end()
                                                                        $('#editPatient_careForm').find('[name="patient"]').val(response.patient_care.patient).end()
                                                                        $('#editPatient_careForm').find('[name="case_manager"]').val(response.patient_care.case_manager).end()
                                                                        $('#editPatient_careForm').find('[name="date"]').val(da).end()
                                                                        $('#editPatient_careForm').find('[name="status"]').val(response.patient_care.status).end()
                                                                        $('#editPatient_careForm').find('[name="remarks"]').val(response.patient_care.remarks).end()

                                                                        $('.js-example-basic-single.case_manager').val(response.patient_care.case_manager).trigger('change');
                                                                        $('.js-example-basic-single.patient').val(response.patient_care.patient).trigger('change');




                                                                        var date = $('#date1').val();
                                                                        var case_managerr = $('#acase_managers1').val();
                                                                        var patient_care_id = $('#patient_care_id').val();
                                                                        // $('#default').trigger("reset");
                                                                        $.ajax({
                                                                            url: 'schedule/getAvailableSlotByCase_managerByDateByPatient_careIdByJason?date=' + date + '&case_manager=' + case_managerr + '&patient_care_id=' + patient_care_id,
                                                                            method: 'GET',
                                                                            data: '',
                                                                            dataType: 'json',
                                                                        }).success(function (response) {
                                                                            $('#aslots1').find('option').remove();
                                                                            var slots = response.aslots;
                                                                            $.each(slots, function (key, value) {
                                                                                $('#aslots1').append($('<option>').text(value).val(value)).end();
                                                                            });

                                                                            $("#aslots1").val(response.current_value)
                                                                                    .find("option[value=" + response.current_value + "]").attr('selected', true);
                                                                            //  $('#aslots1 option[value=' + response.current_value + ']').attr("selected", "selected");
                                                                            //   $("#default-step-1 .button-next").trigger("click");
                                                                            if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                                                                                $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                                                                            }
                                                                            // Populate the form fields with the data returned from server
                                                                            //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
                                                                        });
                                                                    });
                                                                });
                                                            });
</script>




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




<script>
    $(document).ready(function () {
        var table = $('#editable-sample').DataTable({
            responsive: true,
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5],
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            iDisplayLength: -1,
            "order": [[0, "desc"]],

            "language": {
                "lengthMenu": "_MENU_",
                search: "_INPUT_",
                "url": "common/assets/DataTables/languages/<?php echo $this->language; ?>.json"
            }
        });
        table.buttons().container().appendTo('.custom_buttons');
    });
</script>





<script type="text/javascript">
    $(document).ready(function () {
        $("#acase_managers").change(function () {
            // Get the record's ID via attribute  
            var iid = $('#date').val();
            var case_managerr = $('#acase_managers').val();
            $('#aslots').find('option').remove();
            // $('#default').trigger("reset");
            $.ajax({
                url: 'schedule/getAvailableSlotByCase_managerByDateByJason?date=' + iid + '&case_manager=' + case_managerr,
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
        var iid = $('#date').val();
        var case_managerr = $('#acase_managers').val();
        $('#aslots').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByCase_managerByDateByJason?date=' + iid + '&case_manager=' + case_managerr,
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
        var iid = $('#date').val();
        var case_managerr = $('#acase_managers').val();
        $('#aslots').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByCase_managerByDateByJason?date=' + iid + '&case_manager=' + case_managerr,
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












<script type="text/javascript">
    $(document).ready(function () {
        $("#acase_managers1").change(function () {
            // Get the record's ID via attribute 
            var id = $('#patient_care_id').val();
            var date = $('#date1').val();
            var case_managerr = $('#acase_managers1').val();
            $('#aslots1').find('option').remove();
            // $('#default').trigger("reset");
            $.ajax({
                url: 'schedule/getAvailableSlotByCase_managerByDateByPatient_careIdByJason?date=' + date + '&case_manager=' + case_managerr + '&patient_care_id=' + id,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                var slots = response.aslots;
                $.each(slots, function (key, value) {
                    $('#aslots1').append($('<option>').text(value).val(value)).end();
                });
                //   $("#default-step-1 .button-next").trigger("click");
                if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                    $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                }
                // Populate the form fields with the data returned from server
                //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
            });
        });
    });

    $(document).ready(function () {
        var id = $('#patient_care_id').val();
        var date = $('#date1').val();
        var case_managerr = $('#acase_managers1').val();
        $('#aslots1').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByCase_managerByDateByPatient_careIdByJason?date=' + date + '&case_manager=' + case_managerr + '&patient_care_id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots1').append($('<option>').text(value).val(value)).end();
            });
            //   $("#default-step-1 .button-next").trigger("click");
            if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }
            // Populate the form fields with the data returned from server
            //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
        });

    });




    $(document).ready(function () {
        $('#date1').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
        })
                //Listen for the change even on the input
                .change(dateChanged1)
                .on('changeDate', dateChanged1);
    });

    function dateChanged1() {
        // Get the record's ID via attribute  
        var id = $('#patient_care_id').val();
        var iid = $('#date1').val();
        var case_managerr = $('#acase_managers1').val();
        $('#aslots1').find('option').remove();
        // $('#default').trigger("reset");
        $.ajax({
            url: 'schedule/getAvailableSlotByCase_managerByDateByPatient_careIdByJason?date=' + iid + '&case_manager=' + case_managerr + '&patient_care_id=' + id,
            method: 'GET',
            data: '',
            dataType: 'json',
        }).success(function (response) {
            var slots = response.aslots;
            $.each(slots, function (key, value) {
                $('#aslots1').append($('<option>').text(value).val(value)).end();
            });
            //   $("#default-step-1 .button-next").trigger("click");
            if ($('#aslots1').has('option').length == 0) {                    //if it is blank. 
                $('#aslots1').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
            }


            // Populate the form fields with the data returned from server
            //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
        });

    }




</script>







<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
