<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('time_schedule'); ?> 
                <div class="col-md-4 clearfix pull-right">
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i>  <?php echo lang('add_new'); ?> 
                            </button>
                        </div>
                    </a>  
                </div>
            </header>

            <div class="panel-body">
                <div class="adv-table editable-table">
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> <?php echo lang('case_manager'); ?></th>
                                <th> <?php echo lang('weekday'); ?></th>
                                <th> <?php echo lang('start_time'); ?></th>
                                <th> <?php echo lang('end_time'); ?></th>
                                <th> <?php echo lang('duration'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Case_manager'))) { ?>
                                    <th> <?php echo lang('options'); ?></th>
                                <?php } ?>

                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                            $i = 0;
                            foreach ($schedules as $schedule) {
                                $i = $i + 1;
                                ?>
                                <tr class="">
                                    <td style=""> <?php echo $i; ?></td> 
                                    <td> <?php echo $this->case_manager_model->getCase_managerById($schedule->case_manager)->name; ?></td>
                                    <td> <?php echo $schedule->weekday; ?></td> 
                                    <td><?php echo $schedule->s_time; ?></td>
                                    <td><?php echo $schedule->e_time; ?></td>
                                    <td><?php echo $schedule->duration * 5 . ' ' . lang('minitues'); ?></td>
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Case_manager'))) { ?>
                                        <td>
                                            <!--
                                            <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $schedule->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                            -->
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteSchedule?id=<?php echo $schedule->id; ?>&case_manager=<?php echo $schedule->case_manager; ?>&weekday=<?php echo $schedule->weekday; ?>&all=all" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i> <?php echo lang('delete'); ?></a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
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




<!-- Add Time Slot Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">  <?php echo lang('add'); ?> <?php echo lang('schedule'); ?></h4>
            </div>
            <div class="modal-body row">
                <form role="form" action="schedule/addSchedule" class="clearfix" method="post" enctype="multipart/form-data">

                    <div class="col-md-6 panel">
                        <label for="exampleInputEmail1">  <?php echo lang('case_manager'); ?></label>
                        <select class="form-control m-bot15 js-example-basic-single" name="case_manager" value=''>  
                            <option value="">Select .....</option>
                            <?php foreach ($case_managers as $case_manager) { ?>
                                <option value="<?php echo $case_manager->id; ?>"><?php echo $case_manager->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <select class="form-control m-bot15" id="weekday" name="weekday" value=''> 
                            <option value="Friday"><?php echo lang('friday') ?></option>
                            <option value="Saturday"><?php echo lang('saturday') ?></option>
                            <option value="Sunday"><?php echo lang('sunday') ?></option>
                            <option value="Monday"><?php echo lang('monday') ?></option>
                            <option value="Tuesday"><?php echo lang('tuesday') ?></option>
                            <option value="Wednesday"><?php echo lang('wednesday') ?></option>
                            <option value="Thursday"><?php echo lang('thursday') ?></option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="s_time" id="exampleInputEmail1" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="e_time" id="exampleInputEmail1" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleInputEmail1"><?php echo lang('patient_care') ?> <?php echo lang('duration') ?> </label>
                        <select class="form-control m-bot15" name="duration" value=''>

                            <option value="3" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '3') {
                                    echo 'selected';
                                }
                            }
                            ?> > 15 Minitues </option>

                            <option value="4" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '4') {
                                    echo 'selected';
                                }
                            }
                            ?> > 20 Minitues </option>

                            <option value="6" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '6') {
                                    echo 'selected';
                                }
                            }
                            ?> > 30 Minitues </option>

                            <option value="9" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '9') {
                                    echo 'selected';
                                }
                            }
                            ?> > 45 Minitues </option>

                            <option value="12" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '12') {
                                    echo 'selected';
                                }
                            }
                            ?> > 60 Minitues </option>

                        </select>
                    </div>

                    <input type="hidden" name="redirect" value='schedule'>
                    <input type="hidden" name="id" value=''>

                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info pull-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Time Slot Modal-->





<!-- Edit Time Slot Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('edit'); ?>  <?php echo lang('time_slot'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editTimeSlotForm" action="schedule/addSchedule" method="post" enctype="multipart/form-data">

                    <div class="col-md-12 panel">
                        <div class="col-md-3 payment_label"> 
                            <label for="exampleInputEmail1">  <?php echo lang('case_manager'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15 js-example-basic-single" name="case_manager" value=''>  
                                <option value="">Select .....</option>
                                <?php foreach ($case_managers as $case_manager) { ?>
                                    <option value="<?php echo $case_manager->id; ?>"<?php
                                    if (!empty($schedule->case_manager)) {
                                        if ($schedule->case_manager == $case_manager->id) {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo $case_manager->name; ?> </option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="s_time" id="exampleInputEmail1" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control timepicker-default" name="e_time" id="exampleInputEmail1" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <select class="form-control m-bot15" id="weekday" name="weekday" value=''> 
                                <option value="Friday"><?php echo lang('friday') ?></option>
                                <option value="Saturday"><?php echo lang('saturday') ?></option>
                                <option value="Sunday"><?php echo lang('sunday') ?></option>
                                <option value="Monday"><?php echo lang('monday') ?></option>
                                <option value="Tuesday"><?php echo lang('tuesday') ?></option>
                                <option value="Wednesday"><?php echo lang('wednesday') ?></option>
                                <option value="Thursday"><?php echo lang('thursday') ?></option>
                            </select>

                        </div>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('patient_care') ?> <?php echo lang('duration') ?> </label>
                        <select class="form-control m-bot15" name="duration" value=''>

                            <option value="3" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '3') {
                                    echo 'selected';
                                }
                            }
                            ?> > 15 Minitues </option>

                            <option value="4" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '4') {
                                    echo 'selected';
                                }
                            }
                            ?> > 20 Minitues </option>

                            <option value="6" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '6') {
                                    echo 'selected';
                                }
                            }
                            ?> > 30 Minitues </option>

                            <option value="9" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '9') {
                                    echo 'selected';
                                }
                            }
                            ?> > 45 Minitues </option>

                            <option value="12" <?php
                            if (!empty($settings->duration)) {
                                if ($settings->duration == '12') {
                                    echo 'selected';
                                }
                            }
                            ?> > 60 Minitues </option>

                        </select>
                    </div>

                    <input type="hidden" name="redirect" value='schedule'>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Time Slot Modal-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#editTimeSlotForm').trigger("reset");
                                                $('#myModal2').modal('show');
                                                $.ajax({
                                                    url: 'schedule/editScheduleByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#editTimeSlotForm').find('[name="id"]').val(response.schedule.id).end()
                                                    $('#editTimeSlotForm').find('[name="s_time"]').val(response.schedule.s_time).end()
                                                    $('#editTimeSlotForm').find('[name="e_time"]').val(response.schedule.e_time).end()
                                                    $('#editTimeSlotForm').find('[name="weekday"]').val(response.schedule.weekday).end()
                                                });
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
                        columns: [0, 1, 2, 3, 4, 5, 6],
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
            },

        });

        table.buttons().container()
                .appendTo('.custom_buttons');
    });
</script>


<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
