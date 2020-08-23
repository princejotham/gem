
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                 <?php echo lang('case_managers_commission'); ?>
            </header>
            <div class="space15"></div> 
            <div class="col-md-12">
                <div class="col-md-7">
                    <section class="panel-body">
                        <form role="form" action="finance/case_managersCommission" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="form-group">

                                <!--     <label class="control-label col-md-3">Date Range</label> -->
                                <div class="col-md-6">
                                    <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                        if (!empty($from)) {
                                            echo $from;
                                        }
                                        ?>" placeholder="<?php echo lang('date_from'); ?>">
                                        <span class="input-group-addon">To</span>
                                        <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                        if (!empty($to)) {
                                            echo $to;
                                        }
                                        ?>" placeholder="<?php echo lang('date_to'); ?>">
                                    </div>
                                    <div class="row"></div>
                                    <span class="help-block"></span> 
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>
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
                        <button class="export" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>     
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
                                <th><?php echo lang('case_manager_id'); ?></th>
                                <th><?php echo lang('case_manager'); ?></th>
                                <th><?php echo lang('commission'); ?></th>
                                <th><?php echo lang('total'); ?></th>
                                <th><?php echo lang('options'); ?></th>
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
                                <td><?php echo $settings->currency; ?>
                                    <?php
                                    foreach ($payments as $payment) {
                                        if ($payment->case_manager == $case_manager->id) {    
                                                $case_manager_amount[] = $payment->case_manager_amount;            
                                        }
                                    }
                                    if (!empty($case_manager_amount)) {
                                        $case_manager_total = array_sum($case_manager_amount);
                                        echo $case_manager_total;
                                    } else {
                                        $case_manager_total = 0;
                                        echo $case_manager_total;
                                    }
                                    ?>
                                </td>
                                <td><?php echo $settings->currency; ?>
                                    <?php

                                    $case_manager_gross = $case_manager_total;
                                    if (!empty($case_manager_gross)) {
                                        echo $case_manager_gross;
                                    } else {
                                        echo'0';
                                    }
                                    ?>
                                </td>
                                 <td> <a class="btn btn-info btn-xs invoicebutton" href="finance/docComDetails?id=<?php echo $case_manager->id; ?>"><i class="fa fa-file-text"></i> <?php echo lang('details'); ?> </a></td>
                            </tr>
                            <?php $case_manager_amount = NULL; ?>
                            <?php $case_manager_gross = NULL; ?>
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
