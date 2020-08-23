<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7 row">
            <header class="panel-heading">
                <?php
                if (!empty($contact_list->id))
                    echo lang('add_contact_list');
                else
                    echo lang('add_new_contact_list');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table row">
                    <div class="clearfix">
                        <?php echo validation_errors(); ?>
                        <form role="form" action="contact_list/addContact_list" class="clearfix" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-5">
                                <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('name');
                                }
                                if (!empty($contact_list->name)) {
                                    echo $contact_list->name;
                                }
                                ?>' placeholder="">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('contact_group'); ?></label>
                                <select class="form-control m-bot15" name="group" value=''>
                                    <?php foreach ($groups as $group) { ?>
                                        <option value="<?php echo $group->group; ?>" <?php
                                        if (!empty($setval)) {
                                            if ($group->group == set_value('group')) {
                                                echo 'selected';
                                            }
                                        }
                                        if (!empty($contact_list->group)) {
                                            if ($group->group == $contact_list->group) {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > <?php echo $group->group; ?> </option>
                                            <?php } ?> 
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1"><?php echo lang('age'); ?></label>
                                <input type="text" class="form-control" name="age" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('age');
                                }
                                if (!empty($contact_list->age)) {
                                    echo $contact_list->age;
                                }
                                ?>' placeholder="">
                            </div>
                             <div class="form-group col-md-5">
                                <label for="exampleInputEmail1"><?php echo lang('last_donation_date'); ?></label>
                                <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="ldd" value="<?php
                                if (!empty($setval)) {
                                    echo set_value('ldd');
                                }
                                if (!empty($contact_list->ldd)) {
                                    echo $contact_list->ldd;
                                }
                                ?>" placeholder="">
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('phone');
                                }
                                if (!empty($contact_list->phone)) {
                                    echo $contact_list->phone;
                                }
                                ?>' placeholder="">
                            </div>
                            
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                                <select class="form-control m-bot15" name="sex" value=''>
                                    <option value="Male" <?php
                                    if (!empty($setval)) {
                                        if (set_value('sex') == 'Male') {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($contact_list->sex)) {
                                        if ($contact_list->sex == 'Male') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Male </option>
                                    <option value="Female" <?php
                                    if (!empty($setval)) {
                                        if (set_value('sex') == 'Female') {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($contact_list->sex)) {
                                        if ($contact_list->sex == 'Female') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Female </option>
                                    <option value="Others" <?php
                                    if (!empty($setval)) {
                                        if (set_value('sex') == 'Others') {
                                            echo 'selected';
                                        }
                                    }
                                    if (!empty($contact_list->sex)) {
                                        if ($contact_list->sex == 'Others') {
                                            echo 'selected';
                                        }
                                    }
                                    ?> > Others </option>
                                </select>
                            </div>
                           
                            
                            <div class="form-group col-md-3">
                                <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                if (!empty($setval)) {
                                    echo set_value('email');
                                }
                                if (!empty($contact_list->email)) {
                                    echo $contact_list->email;
                                }
                                ?>' placeholder="">
                            </div>

                            <input type="hidden" name="id" value='<?php
                            if (!empty($contact_list->id)) {
                                echo $contact_list->id;
                            }
                            ?>'>
                            
                            <div class="form-group col-md-12">
                               <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
