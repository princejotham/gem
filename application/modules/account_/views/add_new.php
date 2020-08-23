
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="col-md-7 row">
            <header class="panel-heading">
                <?php
                if (!empty($account_->id)) {
                    echo lang('edit_account_');
                } else {
                    echo lang('add_new_account_');
                }
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="col-lg-12">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <?php echo validation_errors(); ?>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                    <form role="form" action="account_/addNew" method="post" enctype="multipart/form-data">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                                <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='<?php
                                if (!empty($account_->name)) {
                                    echo $account_->name;
                                }
                                ?>' placeholder="">

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                                <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='<?php
                                if (!empty($account_->email)) {
                                    echo $account_->email;
                                }
                                ?>' placeholder="">
                            </div>
                            <div class="form-group">


                                <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                                <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">

                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                                <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='<?php
                                if (!empty($account_->address)) {
                                    echo $account_->address;
                                }
                                ?>' placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                                <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='<?php
                                if (!empty($account_->phone)) {
                                    echo $account_->phone;
                                }
                                ?>' placeholder="">
                            </div>

                            <?php
                            if (!empty($account_->id)) {
                                $this->db->where('account__id', $account_->id);
                                $settings = $this->db->get('settings')->row();
                            }
                            ?>

                            <div class="form-group"> 

                                <label for="exampleInputEmail1"> <?php echo lang('language'); ?></label>

                                <select class="form-control m-bot15" name="language" value=''>
                                    <option value="arabic" <?php
                                    if (!empty($settings->language)) {
                                        if ($settings->language == 'arabic') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('arabic'); ?> 
                                    </option>
                                    <option value="english" <?php
                                    if (!empty($settings->language)) {
                                        if ($settings->language == 'english') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('english'); ?> 
                                    </option>
                                    <option value="spanish" <?php
                                    if (!empty($settings->language)) {
                                        if ($settings->language == 'spanish') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('spanish'); ?>
                                    </option>
                                    <option value="french" <?php
                                    if (!empty($settings->language)) {
                                        if ($settings->language == 'french') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('french'); ?>
                                    </option>
                                    <option value="italian" <?php
                                    if (!empty($settings->language)) {
                                        if ($settings->language == 'italian') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('italian'); ?>
                                    </option>
                                    <option value="portuguese" <?php
                                    if (!empty($settings->language)) {
                                        if ($settings->language == 'portuguese') {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('portuguese'); ?>
                                    </option>
                                </select>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo lang('package'); ?></label>
                                <select class="form-control m-bot15 pos_select" id="pos_select" name="package" value='' required="">
                                    <option value=""> - - - </option>
                                    <option value="" <?php
                                    if (!empty($account_->id)) {
                                        if (empty($account_->package)) {
                                            echo 'selected';
                                        }
                                    }
                                    ?>><?php echo lang('select_manually'); ?></option>
                                            <?php foreach ($packages as $package) { ?>
                                        <option value="<?php echo $package->id; ?>" <?php
                                        if (!empty($setval)) {
                                            if ($package->name == set_value('package')) {
                                                echo 'selected';
                                            }
                                        }
                                        if (!empty($account_->package)) {
                                            if ($package->id == $account_->package) {
                                                echo 'selected';
                                            }
                                        }
                                        ?> > <?php echo $package->name; ?> </option>
                                            <?php } ?> 
                                </select>
                            </div>

                            <div class="form-group pos_client">
                                <label for="exampleInputEmail1"><?php echo lang('patient'); ?> <?php echo lang('limit'); ?></label>
                                <input type="text" class="form-control" name="p_limit" id="exampleInputEmail1" value='<?php
                                if (!empty($account_->p_limit)) {
                                    echo $account_->p_limit;
                                } else {
                                    echo '1000';
                                }
                                ?>' placeholder="Example: 1000" required="">
                            </div>

                            <div class="form-group pos_client">
                                <label for="exampleInputEmail1"><?php echo lang('case_manager'); ?> <?php echo lang('limit'); ?></label>
                                <input type="text" class="form-control" name="d_limit" id="exampleInputEmail1" value='<?php
                                if (!empty($account_->d_limit)) {
                                    echo $account_->d_limit;
                                } else {
                                    echo '500';
                                }
                                ?>' placeholder="Example: 1000" required="">
                            </div>










                            <div class="form-group pos_client"> 
                                <label for="exampleInputEmail1"> <?php echo lang('module_permission'); ?></label>
                                <br>
                                <input type='checkbox' value = "finance_" name="module[]"

                                       <?php
                                       if (!empty($account_->id)) {
                                           $modules = $this->account__model->getAccount_ById($account_->id)->module;
                                           $modules1 = explode(',', $modules);
                                           if (in_array('finance_', $modules1)) {
                                               echo 'checked';
                                           }
                                       } else {
                                           echo 'checked';
                                       }
                                       ?>
                                       > <?php echo lang('finance_'); ?>

                                <br>
                                <input type='checkbox' value = "patient_care" name="module[]"  <?php
                                if (!empty($account_->id)) {
                                    if (in_array('patient_care', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> Patient Care                              


                                <br>
                                <input type='checkbox' value = "lab" name="module[]"  <?php
                                if (!empty($account_->id)) {
                                    if (in_array('lab', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('lab_tests'); ?>
                                <br>
                                <input type='checkbox' value = "bed" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('bed', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('bed'); ?>

                                <br>
                                <input type='checkbox' value = "department" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('department', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('department'); ?>

                                <br>
                                <input type='checkbox' value = "case_manager" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('case_manager', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?> required=""> <?php echo lang('case_manager'); ?>

                                <br>
                                <input type='checkbox' value = "contact_list" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('contact_list', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('contact_list'); ?>

                                <br>
                                <input type='checkbox' value = "finance" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('finance', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('financial_activities'); ?>

                                <br>
                                <input type='checkbox' value = "pharmacy" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('pharmacy', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('pharmacy'); ?>

                                <br>
                                <input type='checkbox' value = "laboratorist" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('laboratorist', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('laboratorist'); ?>

                                <br>
                                <input type='checkbox' value = "medicine" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('medicine', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('medicine'); ?>

                                <br>
                                <input type='checkbox' value = "health_worker" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('health_worker', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('health_worker'); ?>

                                <br>
                                <input type='checkbox' value = "patient" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('patient', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?> required="" > <?php echo lang('patient'); ?>

                                <br>
                                <input type='checkbox' value = "pharmacist" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('pharmacist', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?> required=""> <?php echo lang('pharmacist'); ?>

                                <br>
                                <input type='checkbox' value = "prescription" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('prescription', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('prescription'); ?>

                                <br>
                                <input type='checkbox' value = "admin_comm" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('admin_comm', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('admin_comm'); ?>

                                <br>
                                <input type='checkbox' value = "report" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('report', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('report'); ?>


                                <br>
                                <input type='checkbox' value = "notice" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('notice', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('notice'); ?>


                                <br>
                                <input type='checkbox' value = "email" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('email', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('email'); ?>

                                <br>
                                <input type='checkbox' value = "sms" name="module[]" <?php
                                if (!empty($account_->id)) {
                                    if (in_array('sms', $modules1)) {
                                        echo 'checked';
                                    }
                                } else {
                                    echo 'checked';
                                }
                                ?>> <?php echo lang('sms'); ?>


                            </div>

                        </div>

                        <input type="hidden" name="id" value='<?php
                        if (!empty($account_->id)) {
                            echo $account_->id;
                        }
                        ?>'>
                        <div class="panel col-md-12">
                            <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </form>


                </div>
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
<?php
if (!empty($account_->id)) {
    if (empty($account_->package)) {
        ?>
                $('.pos_client').show();
    <?php } else { ?>
                $('.pos_client').hide();
        <?php
    }
} else {
    ?>
            $('.pos_client').hide();
<?php } ?>
        $(document.body).on('change', '#pos_select', function () {

            var v = $("select.pos_select option:selected").val()
            if (v == '') {
                $('.pos_client').show();
            } else {
                $('.pos_client').hide();
            }
        });

    });
</script>