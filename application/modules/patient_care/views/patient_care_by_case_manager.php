
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-8">
            <header class="panel-heading">
                 <?php echo lang('patient_cares'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <button class="export" onclick="javascript:window.print();">Print</button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php echo lang('id'); ?></th>
                                <th> <?php echo lang('patient'); ?></th>
                                <th> <?php echo lang('date-time'); ?></th>
                                <th> <?php echo lang('remarks'); ?></th>
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
                            if ($patient_care->case_manager == $case_manager_id) {
                                ?>
                                <tr class="">
                                    <td ><?php echo $patient_care->id; ?></td>
                                    <td> <?php echo $this->db->get_where('patient', array('id' => $patient_care->patient))->row()->name; ?></td>
                                    <td class="center"><?php echo date('d-m-Y', $patient_care->date); ?> => <?php echo $patient_care->time_slot; ?></td>
                                    <td>
                                        <?php echo $patient_care->remarks; ?>
                                    </td> 
                                    <td>
                                        <!--
                                        <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $patient_care->id; ?>"><i class="fa fa-edit"> <?php echo lang('edit'); ?></i></button>   
                                        -->
                                        <a class="btn btn-info btn-xs btn_width delete_button" href="patient_care/delete?id=<?php echo $patient_care->id; ?>&case_manager_id=<?php echo $patient_care->case_manager; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> </i></a>
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
        
        
        
         <section class="col-md-4">
            <header class="panel-heading">
                 <?php echo lang('case_manager'); ?>
            </header>
           

            <section class="">
                <div class="panel-body profile">
                    <a href="#" class="task-thumb" style="margin-right: 10px;">
                        <img src="<?php if(!empty($mmrcase_manager->img_url)){echo $mmrcase_manager->img_url;}else{echo 'uploads/favicon.png';} ?>" height="100" width="100">
                    </a>
                    <div class="task-thumb-details">
                        <h1><a href="#"><?php echo $mmrcase_manager->name; ?></a></h1>
                        <p><?php echo $mmrcase_manager->profile; ?></p>
                    </div>
                </div>
                <table class="table table-hover personal-task">
                    <tbody>
                        <tr>
                            <td>
                                <i class=" fa fa-envelope"></i>
                            </td>
                            <td><?php echo $mmrcase_manager->email; ?></td>

                        </tr>
                        <tr>
                            <td>
                                <i class="fa fa-phone"></i>
                            </td>
                            <td><?php echo $mmrcase_manager->phone; ?></td>

                        </tr>

                    </tbody>
                </table>
            </section>
        </section>
        
        
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->




<!-- Add Patient_care Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php echo lang('add_patient_care'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient_care/addNew" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="col-md-3"> 
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15" name="patient" value=''> 
                                <option value="">Select .....</option>
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
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-3"> 
                            <label for="exampleInputEmail1">  <?php echo lang('case_manager'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15" name="case_manager" value=''>  
                                <option value="">Select .....</option>
                                <?php foreach ($case_managers as $case_manager) { ?>
                                    <option value="<?php echo $case_manager->id; ?>"<?php
                                    if (!empty($payment->case_manager)) {
                                        if ($payment->case_manager == $case_manager->id) {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo $case_manager->name; ?> </option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date-time'); ?></label>
                        <div data-date="" class="input-group date form_datetime-meridian">
                            <div class="input-group-btn"> 
                                <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                                <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                            </div>
                            <input type="text" class="form-control" readonly="" name="date" id="exampleInputEmail1" value='<?php
                            if (!empty($patient_care->date)) {
                                echo $patient_care->date;
                            }
                            ?>' placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks" id="exampleInputEmail1" value='<?php
                        if (!empty($patient_care->address)) {
                            echo $patient_care->address;
                        }
                        ?>' placeholder="">
                    </div>



                    <input type="hidden" name="id" value=''>


                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient_care Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i>  <?php echo lang('edit_patient_care'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPatient_careForm" action="patient_care/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-3"> 
                            <label for="exampleInputEmail1"> <?php echo lang('paient'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15" name="patient" value=''> 
                                <option value="">Select .....</option>
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
                    </div>
                    <div class="form-group">
                        <div class="col-md-3"> 
                            <label for="exampleInputEmail1">  <?php echo lang('case_manager'); ?></label>
                        </div>
                        <div class="col-md-9"> 
                            <select class="form-control m-bot15" name="case_manager" value=''>  
                                <option value="">Select .....</option>
                                <?php foreach ($case_managers as $case_manager) { ?>
                                    <option value="<?php echo $case_manager->id; ?>"<?php
                                    if (!empty($payment->case_manager)) {
                                        if ($payment->case_manager == $case_manager->id) {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo $case_manager->name; ?> </option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date-time'); ?></label>
                        <div data-date="" class="input-group date form_datetime-meridian">
                            <div class="input-group-btn"> 
                                <button type="button" class="btn btn-info date-set"><i class="fa fa-calendar"></i></button>
                                <button type="button" class="btn btn-danger date-reset"><i class="fa fa-times"></i></button>
                            </div>
                            <input type="text" class="form-control" readonly="" name="date" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                        <input type="text" class="form-control" name="remarks" id="exampleInputEmail1" value='' placeholder="">
                    </div>



                    <input type="hidden" name="id" value=''>


                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
                                    $(document).ready(function () {
                                        $(".editbutton").click(function (e) {
                                            e.preventDefault(e);
                                            // Get the record's ID via attribute  
                                            var iid = $(this).attr('data-id');
                                            $('#editPatient_careForm').trigger("reset");
                                            $('#myModal2').modal('show');
                                            $.ajax({
                                                url: 'patient_care/editPatient_careByJason?id=' + iid,
                                                method: 'GET',
                                                data: '',
                                                dataType: 'json',
                                            }).success(function (response) {
                                                // Populate the form fields with the data returned from server
                                                $('#editPatient_careForm').find('[name="id"]').val(response.patient_care.id).end()
                                                $('#editPatient_careForm').find('[name="patient"]').val(response.patient_care.patient).end()
                                                $('#editPatient_careForm').find('[name="case_manager"]').val(response.patient_care.case_manager).end()
                                                $('#editPatient_careForm').find('[name="date"]').val(response.patient_care.date).end()
                                                $('#editPatient_careForm').find('[name="remarks"]').val(response.patient_care.remarks).end()
                                            });
                                        });
                                    });
</script>


<script>
    $(document).ready(function () {
      var table =  $('#editable-sample').DataTable({
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
                        columns: [0,1, 2, 3],
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
    });
</script>


<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>