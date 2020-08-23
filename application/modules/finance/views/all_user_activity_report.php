
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('activities_by'); ?> <strong style="color: #009988; text-transform: capitalize;" ><?php echo lang('all_users'); ?></strong> (<?php echo lang('today'); ?>)
            </header>
            <div class="panel-body">
                <header class="panel-heading">
                    <?php echo lang('today'); ?> <?php echo lang('report'); ?>
                </header>
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-samples">
                        <thead>
                            <tr>
                                <th class="option_th" style="width: 20%"><?php echo lang('user'); ?> <?php echo lang('name'); ?></th>
                                <th class="option_th" style="width: 20%"><?php echo lang('bill_amount'); ?></th>
                                <th class="option_th" style="width: 20%"><?php echo lang('payment_received'); ?></th>
                                <th class="option_th" style="width: 20%"><?php echo lang('due_amount'); ?></th>
                                <th class="option_th no-print" style="width: 20%"><?php echo lang('options'); ?></th>
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
                                width:33%;
                            }
                            .clearfix{
                                margin-bottom: 50px;
                            }
                        </style>
                        <?php foreach ($finance_s as $finance_) { ?>
                            <tr class="">
                                <td><?php echo $finance_->name; ?></td>
                                <td><?php echo $settings->currency; ?><?php
                                    $total = array();
                                    $ot_total = array();

                                    $finance__ion_user_id = $finance_->ion_user_id;
                                    foreach ($payments as $payment) {
                                        if ($payment->user == $finance__ion_user_id) {
                                            $total[] = $payment->gross_total;
                                        }
                                    }
                                    foreach ($ot_payments as $ot_payment) {
                                        if ($ot_payment->user == $finance__ion_user_id) {
                                            $ot_total[] = $ot_payment->gross_total;
                                        }
                                    }

                                    $total = array_sum($total);
                                    if (empty($total)) {
                                        $total = 0;
                                    }

                                    $ot_total = array_sum($ot_total);
                                    if (empty($ot_total)) {
                                        $ot_total = 0;
                                    }

                                    echo $bill_total = $total + $ot_total;
                                    ?>
                                </td>
                                <td><?php echo $settings->currency; ?><?php
                                    $deposit_total = array();
                                    foreach ($deposits as $deposit) {
                                        if ($deposit->user == $finance__ion_user_id) {
                                            $deposit_total[] = $deposit->deposited_amount;
                                        }
                                    }

                                    $deposit_total = array_sum($deposit_total);
                                    if (empty($deposit_total)) {
                                        $deposit_total = 0;
                                    }
                                    echo $deposit_total;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $bill_total - $deposit_total; ?>
                                </td>
                                <td class="no-print">
                                    <a class="btn btn-info btn-xs btn_width add_payment_button" style="width: 100px;" href="finance/allUserActivityReport?user=<?php echo $finance__ion_user_id; ?>"><i class="fa fa-info"></i> Details</a>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php foreach ($admin_comms as $admin_comm) { ?>
                            <tr class="">
                                <td><?php echo $admin_comm->name; ?></td>
                                <td><?php echo $settings->currency; ?><?php
                                    $total_admin_comm = array();
                                    $ot_total_admin_comm = array();

                                    $admin_comm_ion_user_id = $admin_comm->ion_user_id;
                                    foreach ($payments as $payment1) {
                                        if ($payment1->user == $admin_comm_ion_user_id) {
                                            $total_admin_comm[] = $payment1->gross_total;
                                        }
                                    }
                                    foreach ($ot_payments as $ot_payment1) {
                                        if ($ot_payment1->user == $admin_comm_ion_user_id) {
                                            $ot_total_admin_comm[] = $ot_payment1->gross_total;
                                        }
                                    }

                                    $total_admin_comm = array_sum($total_admin_comm);
                                    if (empty($total_admin_comm)) {
                                        $total_admin_comm = 0;
                                    }

                                    $ot_total_admin_comm = array_sum($ot_total_admin_comm);
                                    if (empty($ot_total_admin_comm)) {
                                        $ot_total_admin_comm = 0;
                                    }

                                    echo $bill_total_admin_comm = $total_admin_comm + $ot_total_admin_comm;
                                    ?>
                                </td>
                                <td><?php echo $settings->currency; ?><?php
                                    $deposit_total_admin_comm = array();
                                    foreach ($deposits as $deposit) {
                                        if ($deposit->user == $admin_comm_ion_user_id) {
                                            $deposit_total_admin_comm[] = $deposit->deposited_amount;
                                        }
                                    }

                                    $deposit_total_admin_comm = array_sum($deposit_total_admin_comm);
                                    if (empty($deposit_total_admin_comm)) {
                                        $deposit_total_admin_comm = 0;
                                    }
                                    echo $deposit_total_admin_comm;
                                    ?>
                                </td>
                                <td>
                                    <?php echo $bill_total_admin_comm - $deposit_total_admin_comm; ?>
                                </td>
                                <td class="no-print">
                                    <a class="btn btn-info btn-xs btn_width add_payment_button" style="width: 100px;" href="finance/allUserActivityReport?user=<?php echo $admin_comm_ion_user_id; ?>"><i class="fa fa-info"></i> Details</a>
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



<script>
    $(document).ready(function () {
        $('#editable-samplee').DataTable();
    });
</script>




