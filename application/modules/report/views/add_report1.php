<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($report->id)) {
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_report');
                } else {
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('add_new_report');
                }
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="report/addReport1" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('select_type'); ?></label>
                                            <select class="form-control m-bot15 js-example-basic-single" name="select_type" value=''>
                                                <option value="PUI" >PUI</option>
                                                <option value="PUM" >PUM</option>
                                                <option value="Confirmed" >Confirmed</option>
                                            </select>
                                        </div>
                                        <div class="form-group">


                                            <label for="exampleInputEmail1">Name of Patient Contact</label>
                                            <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('description');
                                            }
                                            if (!empty($report->description)) {
                                                echo $report->description;
                                            }
                                            ?>' placeholder="">

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Patient ID</label>
                                            <select class="form-control m-bot15 js-example-basic-single" name="patient" value=''> 
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
                                            <select class="form-control m-bot15 js-example-basic-single" name="case_manager" value=''> 
                                                <?php foreach ($case_managers as $case_manager) { ?>
                                                    <option value="<?php echo $case_manager->name; ?>" <?php
                                                    if (!empty($setval)) {
                                                        if (set_value('case_manager') == $case_manager->name) {
                                                            echo 'selected';
                                                        }
                                                    }
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
                                            <input class="form-control form-control-inline input-medium default-date-picker" name="date"  size="16" type="text" value="<?php
                                            if (!empty($setval)) {
                                                echo set_value('date');
                                            }
                                            if (!empty($report->date)) {
                                                echo $report->date;
                                            }
                                            ?>" />

                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($report->id)) {
                                            echo $report->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
