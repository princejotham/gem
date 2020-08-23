<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
              <i class="fa fa-money"></i>   <?php  echo lang('treatment_history'); ?>
            </header>
            <div class="space15"></div>
            <div class="col-md-12">
                <div class="col-md-7 panel-body">
                    <section>
                        <form role="form" class="f_report" action="patient_care/treatmentReport" method="post" enctype="multipart/form-data">
                            <div class="form-group">

                                <!--     <label class="control-label col-md-3">Date Range</label> -->
                                <div class="col-md-6">
                                    <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                        if (!empty($from)) {
                                            echo $from;
                                        }
                                        ?>" placeholder=" <?php  echo lang('date_from'); ?>">
                                        <span class="input-group-addon"><?php  echo lang('to'); ?></span>
                                        <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                        if (!empty($to)) {
                                            echo $to;
                                        }
                                        ?>" placeholder=" <?php  echo lang('date_to'); ?>">
                                    </div>
                                    <div class="row"></div>
                                    <span class="help-block"></span> 
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="submit" class="btn btn-info range_submit"> <?php  echo lang('submit'); ?></button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <div class="col-md-5">
                </div>
            </div>



            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <button class="export" onclick="javascript:window.print();">Print</button>     
                    </div>
                    <div class="space15">
                        <?php
                        if (!empty($from) && !empty($to)) {
                            echo "From $from To $to";
                        }
                        ?> 
                    </div>

                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php  echo lang('case_manager_id'); ?></th>
                                <th> <?php  echo lang('case_manager'); ?></th>
                                <th> <?php  echo lang('number_of_patient_treated'); ?></th>
                                <th> <?php  echo lang('actions'); ?></th>
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
                            .option_th{
                                width:18%;
                            }

                        </style>

                        <?php foreach ($case_managers as $case_manager) { ?>

                            <tr class="">
                                <td><?php echo $case_manager->id; ?></td>
                                <td><?php echo $case_manager->name; ?></td>
                                <td>
                                    <?php
                                    foreach ($patient_cares as $patient_care) {
                                        if ($patient_care->case_manager == $case_manager->id) {
                                         //   if ($payment->status == 'paid'|| $payment->status == 'paid-last') {
                                                $patient_care_number[] = 1;
                                         //   }
                                        }
                                    }
                                    if (!empty($patient_care_number)) {
                                        $patient_care_total = array_sum($patient_care_number);
                                        echo $patient_care_total;
                                    } else {
                                        $patient_care_total = 0;
                                        echo $patient_care_total;
                                    }
                                    ?>
                                </td>
                                 <td> <a class="btn btn-info btn-xs btn_width add_payment_button" style="width: 100px;" href="patient_care/getPatient_careByCase_managerId?id=<?php echo $case_manager->id; ?>"><i class="fa fa-money"></i>  <?php  echo lang('details'); ?></a></td>
                               
                               
                            </tr>
                            <?php $patient_care_number = NULL; ?>
                            <?php $patient_care_total = NULL; ?>
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
