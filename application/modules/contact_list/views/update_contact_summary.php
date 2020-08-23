<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
              <?php echo lang('edit_blood_quantity'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table "> 
                    <div class="clearfix">
                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <form role="form" action="contact_list/updateBloodBank" method="post" enctype="multipart/form-data">
                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"><?php echo lang('group'); ?></label>
                                            <input type="text" class="form-control" name="group" id="exampleInputEmail1" value='<?php
                                            if (!empty($contact_list->group)) {
                                                echo $contact_list->group;
                                            }
                                            ?>' placeholder="" disabled>    
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                                            <input type="text" class="form-control" name="status" id="exampleInputEmail1" value='<?php
                                            if (!empty($contact_list->status)) {
                                                echo $contact_list->status;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($contact_list->id)) {
                                            echo $contact_list->id;
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
