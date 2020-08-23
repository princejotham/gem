
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('request_report'); ?>
                <div class="col-md-4 no-print pull-right"> 
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group pull-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new_report'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>Name of Patient Contact</th>
                                <th>Type</th>
                                <th><?php echo lang('case_manager'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th class="no-print"><?php echo lang('options'); ?></th>
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

                        <?php foreach ($reports as $report) { ?>
                            <tr class="">
                                <td><?php echo explode('*', $report->patient)[0]; ?></td>
                                <td> <?php echo $report->description; ?></td>
                                <td> <?php echo $report->types; ?></td>
                                <td><?php echo $report->case_manager; ?></td>
                                <td class="center"><?php echo $report->date; ?></td>
                                <td class="no-print">
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $report->id; ?>"><i class="fa fa-edit"></i> </button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="report/delete?id=<?php echo $report->id; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> </a>
                                </td>
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








<!-- Add Finance_ Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"> <?php echo lang('add_new_report'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="report/addReport2" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('select_type'); ?></label>
                       <select class="form-control m-bot15" name="select_type" value=''>
                            <option value="For Transport" >For Transport</option>
                            <option value="For Testing" >For Testing</option>
                            <option value="For Isolation" >For Isolation</option>
                        </select>
                    </div>
                    <div class="form-group">


                        <label for="exampleInputEmail1">Name of Patient Contact</label>
                        <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Patient ID</label>
                        <select class="form-control m-bot15" name="patient" value=''> 
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id . '*' . $patient->ion_user_id; ?>" <?php
                                if (!empty($report->patient)) {
                                    if (explode('*', $report->patient)[1] == $patient->ion_user_id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patient->id; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('case_manager'); ?></label>
                        <select class="form-control m-bot15" name="case_manager" value=''> 
                            <?php foreach ($case_managers as $case_manager) { ?>
                                <option value="<?php echo $case_manager->name; ?>" <?php
                                if (!empty($report->case_manager)) {
                                    if ($report->case_manager == $case_manager->name) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $case_manager->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" name="date"  size="16" type="text" readonly="" value="" />

                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Finance_ Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_request_report'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editReportForm" action="report/addReport2" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('select_type'); ?></label>
                         <select class="form-control m-bot15" name="select_type" value=''>
                            <option value="For Transport" >For Transport</option>
                            <option value="For Testing" >For Testing</option>
                            <option value="For Isolation" >For Isolation</option>
                        </select>
                    </div>
                    <div class="form-group">


                        <label for="exampleInputEmail1">Name of Patient Contact</label>
                        <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Patient ID</label>
                        <select class="form-control m-bot15" name="patient" value=''> 
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id . '*' . $patient->ion_user_id; ?>" <?php
                                if (!empty($report->patient)) {
                                    if (explode('*', $report->patient)[1] == $patient->ion_user_id) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $patient->id; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('case_manager'); ?></label>
                        <select class="form-control m-bot15" name="case_manager" value=''> 
                            <?php foreach ($case_managers as $case_manager) { ?>
                                <option value="<?php echo $case_manager->name; ?>" <?php
                                if (!empty($report->case_manager)) {
                                    if ($report->case_manager == $case_manager->name) {
                                        echo 'selected';
                                    }
                                }
                                ?> ><?php echo $case_manager->name; ?> </option>
                                    <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" name="date" readonly="" size="16" type="text" value="" />

                    </div>
                    <input type="hidden" name="id" value=''>
                     <div class="">
                        <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#editReportForm').trigger("reset");

                                                $.ajax({
                                                    url: 'report/editReportByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#editReportForm').find('[name="id"]').val(response.report.id).end()
                                                    // $('#editReportForm').find('[name="type"]').val(response.report.type).end()
                                                    $('#editReportForm').find('[name="select_type"]').val(response.report.select_type).end()
                                                    $('#editReportForm').find('[name="description"]').val(response.report.description).end()
                                                    $('#editReportForm').find('[name="patient"]').val(response.report.patient).end()
                                                    $('#editReportForm').find('[name="case_manager"]').val(response.report.case_manager).end()
                                                    $('#editReportForm').find('[name="date"]').val(response.report.date).end()
                                                    $('#myModal2').modal('show');
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
                        columns: [0, 1, 2, 3],
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
