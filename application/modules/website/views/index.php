<!doctype html>
<html class="no-js" lang="en">
        <head>
        <base href="<?php echo base_url(); ?>">
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hospital Management </title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <link rel="shortcut icon" type="image/x-icon" href="front/img/favicon/favicon-16x16.png" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,400i,700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="front/css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="front/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="common/assets/bootstrap-datepicker/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="common/assets/bootstrap-timepicker/compiled/timepicker.css">
        <link rel="stylesheet" href="front/css/flexslider.css"/>
        <link href="front/assets/bxslider/jquery.bxslider.css" rel="stylesheet" />
        <link href="front/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
        <link rel="stylesheet" href="front/assets/revolution_slider/css/rs-style.css" media="screen">
        <link rel="stylesheet" href="front/assets/revolution_slider/rs-plugin/css/settings.css" media="screen">
        <link rel="stylesheet" href="front/css/animate/animate.min.css">
        <link rel="stylesheet" href="front/css/style.css">
        <link rel="stylesheet" href="front/css/responsive.css">

    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="20">


        <header>
            <nav class="navbar navbar-expand-lg py-3 fixed-top scrollTop bg-light">
                <div class="container">
                    <a class="navbar-brand" href="website#header">
                        HEALTH<span>WATCH </span>
                    </a>
                    <button class="navbar-toggler" data-toggle="collapse" data-target="#bar"> 
                        <span><i class="fa fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="bar">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link active" href="#header">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="website#account_-management">Book Patient Care</a></li>
                            <li class="nav-item"><a class="nav-link" href="website#service">Service</a></li>
                            <li class="nav-item"><a class="nav-link" href="website#package">Featured Case Manager</a></li>
                            <li class="nav-item"><a class="nav-link" href="website#footer">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>


        <section id="header" class="py-5">
            <!-- revolution slider start -->
            <div class="fullwidthbanner-container main-slider">
                <div class="fullwidthabnner">
                    <ul id="revolutionul" style="display:none;">
                        <!-- 1st slide -->

                        <style>


                            .slide_item_left{
                                top: 0px !important;
                                left: 0px !important;
                                background-size: contain !important;



                                position: absolute;
                                top: 0;
                                left: 0;
                                right: 0;
                                bottom: 0;
                                background-image: url("path/to/img");
                                background-repeat: no-repeat;
                                background-size: contain;


                            }

                            .slide_item_left img{
                                background-size: cover !important;
                            }
                            h1 {
                                font-size: 2.5rem !important;

                            </style> 


                            
                                    <li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="5000" data-thumb="">
                                        <div class="caption lfl slide_item_left"
                                             data-x="10"
                                             data-y="70"
                                             data-speed="400"
                                             data-start="0"
                                             data-easing="easeOutBack">
                                            <img src="uploads/1503411077revised-bhatia-homebanner-03.jpg" alt="Image 1">
                                        </div>
                                        <div class="home-content text-center">
                                            <h1 class="caption lfr wow slideInLeft"
                                                data-wow-duration="2s"
                                                data-x="100"
                                                data-y="220"
                                                >
                                                    Register Your Hospital Today                                            </h1>

                                            <h6 class="caption lfr wow slideInUp"
                                                data-wow-duration="2s"
                                                data-x="100"
                                                data-y="280"
                                                >
                                                    Run Your System in a Secure Environment                                            </h6>
                                        </div>
                                    </li>

                                    
                            <!-- 2nd slide  -->




                        </ul>
                        <div class="tp-bannertimer tp-top"></div>
                    </div>
                </div>
                <!-- revolution slider end -->



            </section>


            <section id="account_-management" class="py-5">
                <div class="content-lg">
                    <div class="container">
                        <div class="row py-5">
                            <div class="col-md-12 text-center">
                                <h1>HEALTH WATCH</h1>
                                <p>Best Hospital software</p>
                            </div>
                                                    </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="card-content">
                                            <i class="fa fa-phone phone"></i>
                                            <h6>EMERGENCY: +639177812361</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3" data-toggle="modal" data-target="#modal">
                                    <div class="card-body card-2nd">
                                        <div class="card-content">
                                            <i class="fa fa-calendar"></i>
                                            <h6>BOOK AN APPOINTMENT </h6>
                                        </div>

                                    </div>
                                </div>

                                <div class="modal" role="dialog" id="modal">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-body">

                                                <form action="website/addNew" method="post">

                                                    <label>Barangay:</label>
                                                     <select class="form-control" name="account_" id="aaccount_s">
                                                        <option value="">Select .....</option>
                                                                                                                    <option value="416">PARANAQUE CITY </option>
                                                                                                                            <option value="459">MUNTINLUPA CITY </option>
                                                                                                                            <option value="461">CLASSIQUE IDEAS </option>
                                                                                                                            <option value="462">BRGY VITALEZ </option>
                                                                                                                            <option value="463">AYALA ALABANG </option>
                                                                
                                                    </select>



                                                    <label for="exampleInputEmail1"> Patient</label>
                                                    <select class="form-control m-bot15 js-example-basic-single pos_select" id="pos_select" name="patient" value=''> 
                                                        <option value=" ">Select .....</option>
                                                        <option value="patient_id" style="color: #41cac0 !important;">Patient ID</option>
                                                        <option value="add_new" style="color: #41cac0 !important;">Add New</option>
                                                    </select>

                                                    <div class="pos_client_id clearfix">

                                                        <div class="col-md-12 payment pad_bot pull-right">
                                                            <div class="col-md-3 payment_label"> 
                                                                <label for="exampleInputEmail1"> Patient Id</label>
                                                            </div>
                                                            <div class="col-md-9"> 
                                                                <input type="text" class="form-control pay_in" name="patient_id" placeholder="">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="pos_client clearfix">

                                                        <label for="">Patient Name</label>
                                                        <input type="text" class="form-control" name="p_name">
                                                        <label for="">Patient Email</label>
                                                        <input type="email" class="form-control" name="p_email">
                                                        <label for="">Patient Phone</label>
                                                        <input type="text" class="form-control" name="p_phone">
                                                        <!-- <label for="">HOSPITAL PHONE</label>
                                                         <input type="text" class="form-control">-->
                                                        <label for="">Patient Gender</label>
                                                        <select class="form-control" name="p_gender">
                                                            <option value="Male"  > Male </option>   
                                                            <option value="Female"  > Female </option>
                                                            <option value="Others"  > Others </option>
                                                        </select>
                                                    </div>
                                                    <label for=""> Case Manager</label>
                                                    <select class="form-control" name="case_manager" id="acase_managers">
                                                        <option value="">Select .....</option>
                                                    </select>

                                                    <label for="">Date</label>
                                                    <input type="text" class="form-control default-date-picker" readonly="" id="date" name="date" id="" value='' placeholder="">
                                                    <label for="">Available Slots</label>
                                                    <select class="form-control m-bot15" name="time_slot" id="aslots" value=''> 

                                                    </select>
                                                    <label for=""> Remarks</label>
                                                    <input type="text" class="form-control" name="remarks" id="" value='' placeholder="">
                                                    <input type="hidden" name="request" value=''>

                                                    <button type="submit" name="submit" class="btn btn-primary mt-3 pull-right"> Submit</button>

                                                </form>


                                            </div>

                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="card-content">
                                            <i class="fa fa-heart heart"></i>
                                            <h6>24/7 SUPPORT</h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="service">

                <div class="content-lg">
                    <div class="container">
                        <div class="row py-5">
                            <div class="col-md-12 text-center">
                                <h1>OUR SERVICES</h1>
                                <h6 class="lead">Aenean nibh ante, lacinia non tincidunt nec, lobortis ut tellus. Sed in porta diam.</h6>
                            </div>
                        </div>

                        <div class="row text-center py-4">
                                                            <div class="col-md-6 justify-content-between">
                                    <div class="service-content-left">
                                      <!--  <img src=" " alt=""> -->

                                        <h4>Hospital Software</h4>
                                        <p>Hospital Software</p>

                                    </div>
                                </div>
                                                            <div class="col-md-6 justify-content-between">
                                    <div class="service-content-left">
                                      <!--  <img src=" " alt=""> -->

                                        <h4>Hospital Software</h4>
                                        <p>Hospital Software</p>

                                    </div>
                                </div>
                                                            <div class="col-md-6 justify-content-between">
                                    <div class="service-content-left">
                                      <!--  <img src=" " alt=""> -->

                                        <h4>Hospital Software</h4>
                                        <p>Hospital Software</p>

                                    </div>
                                </div>
                                                            <div class="col-md-6 justify-content-between">
                                    <div class="service-content-left">
                                      <!--  <img src=" " alt=""> -->

                                        <h4>Hospital Software</h4>
                                        <p>Hospital Software</p>

                                    </div>
                                </div>
                            
                        </div>

                    </div>
                </div>

            </section>


            <section id="package" class="py-5">
                <div class="content-lg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center py-5">
                                <h2>FEATURED DOCTOR</h2>
                                <p>We work with forward thinking clients to create beautiful, honest and amazing things that bring positive results.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container" id="case_managers">
                                <div class="row">
                                                                    </div>
                            </div>
                            <!--  <div class="col-md-3">
                                   <div class="card text-center wow bounceInLeft mb-3" data-wow-duration="2s">
                                       <div class="card-header">
                                           <h4>Pro pack</h4>
                                       </div>
                                       <div class="card-img">
                                           <img src="front/img/package/Account_-Management.jpg" class="img-fluid" alt="">
                                       </div>
                                       <div class="card-body">
       
                                           <p>finance_</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <button class="btn btn-dark">Get Now</button>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-3">
                                   <div class="card text-center wow pulse mb-3" data-wow-duration="2s">
                                       <div class="card-header">
                                           <h4>Pro pack</h4>
                                       </div>
                                       <div class="card-img">
                                           <img src="front/img/package/Account_-Management.jpg" class="img-fluid" alt="">
                                       </div>
                                       <div class="card-body">
       
                                           <p>finance_</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <button class="btn btn-dark">Get Now</button>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-3">
                                   <div class="card text-center text-center wow pulse mb-3" data-wow-duration="2s">
                                       <div class="card-header">
                                           <h4>Pro pack</h4>
                                       </div>
                                       <div class="card-img">
                                           <img src="front/img/package/Account_-Management.jpg" class="img-fluid" alt="">
                                       </div>
                                       <div class="card-body">
       
                                           <p>finance_</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <button class="btn btn-dark">Get Now</button>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-3">
                                   <div class="card text-center wow bounceInRight" data-wow-duration="2s">
                                       <div class="card-header">
                                           <h4>Pro pack</h4>
                                       </div>
                                       <div class="card-img">
                                           <img src="front/img/package/Account_-Management.jpg" class="img-fluid" alt="">
                                       </div>
                                       <div class="card-body">
       
                                           <p>finance_</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <p>patient_care</p>
                                           <button class="btn btn-dark">Get Now</button>
                                       </div>
                                   </div>
                               </div> -->
                        </div>
                    </div>
                </div>
            </section>



            <footer id="footer" class="py-5">
                <div class="content-lg">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="contact-info text-center">
                                    <h4>CONTACT INFO</h4>
                                    <p>Address: NCR, PHILIPPINES </p>
                                    <p>Phone: +639177812361</p>
                                    <p>Email: <span>hello@bayanhealth.ph</span> </p>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="latest-tweet">
                                    <h4 class="text-center">LATEST TWEET</h4>
                                    <div class="shape">
                                        <div class="cube"></div>
                                        <div class="row">
                                            <div class="col-md-2 col-sm-2 col-xs-2">
                                                <i class="fa fa-twitter"></i>
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                <p>Please follow <span><a href="https://www.twitter.com/">@casoft</a></span> for all future updates of us!</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="social-media text-center">
                                    <h4>STAY CONNETED</h4>

                                    <div class="social-icon">
                                        <ul>
                                                                                            <li class=""><a href="https://www.facebook.com/CASft"><i class="fa fa-facebook"></i></a></li>                                                                                             <li><a href="https://www.google.com/"><i class="fa fa-google-plus"></i></a></li>                                                                                             <li><a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a></li>                                                                                             <li><a href="https://www.youtube.com/"><i class="fa fa-youtube"></i></a></li> 
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>


            <script src="front/js/jquery.js"></script>
            <script src="front/js/bootstrap/bootstrap.min.js"></script>
            <script src="front/js/wow/wow.min.js"></script>
            <script src="front/js/smoothscroll/jquery.smoothscroll.min.js"></script>
            <script src="front/js/script.js"></script>
            <script type="text/javascript" src="common/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
            <script type="text/javascript" src="common/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
            <script src="front/assets/fancybox/source/jquery.fancybox.pack.js"></script>

            <script type="text/javascript" src="front/assets/revolution_slider/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
            <script type="text/javascript" src="front/assets/revolution_slider/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
            <script src="front/js/revulation-slide.js"></script>
            <script>
                $('.default-date-picker').datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true
                });
                $('#date').on('changeDate', function () {
                    $('#date').datepicker('hide');
                });
                $('#date1').on('changeDate', function () {
                    $('#date1').datepicker('hide');
                });</script>

            <script>
                $(document).ready(function () {
                    $('.timepicker-default').timepicker({defaultTime: 'value'});
                });</script>




            <script>
                $(document).ready(function () {
                    $('.pos_client').hide();
                    $('.pos_client_id').hide();
                    $(document.body).on('change', '#pos_select', function () {

                        var v = $("select.pos_select option:selected").val()
                        if (v == 'add_new') {
                            $('.pos_client').show();
                            $('.pos_client_id').hide();
                        } else if (v == 'patient_id') {
                            $('.pos_client_id').show();
                            $('.pos_client').hide();
                        } else {
                            $('.pos_client_id').hide();
                            $('.pos_client').hide();
                        }
                    });
                });</script>


            <script>
                $(document).ready(function () {
                    $('.patient_care').hide();
                    $(document.body).on('click', '#patient_care', function () {

                        if ($('.patient_care').is(":hidden")) {
                            $('.patient_care').show();
                        } else {
                            $('.patient_care').hide();
                        }
                    });
                });</script>






            <script type="text/javascript">
                $(document).ready(function () {
                    $("#acase_managers").change(function () {
                        // Get the record's ID via attribute  
                        var id = $('#patient_care_id').val();
                        var date = $('#date').val();
                        var case_managerr = $('#acase_managers').val();
                        $('#aslots').find('option').remove();
                        // $('#default').trigger("reset");
                        $.ajax({
                            url: 'website/getAvailableSlotByCase_managerByDateByJason?date=' + date + '&case_manager=' + case_managerr,
                            method: 'GET',
                            data: '',
                            dataType: 'json',
                        }).done(function (response) {
                            var slots = response.aslots;
                            $.each(slots, function (key, value) {
                                $('#aslots').append($('<option>').text(value).val(value)).end();
                            });
                            //   $("#default-step-1 .button-next").trigger("click");
                            if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                                $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                            }
                            // Populate the form fields with the data returned from server
                            //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
                        });
                    });
                });
                $(document).ready(function () {
                    var id = $('#patient_care_id').val();
                    var date = $('#date').val();
                    var case_managerr = $('#acase_managers').val();
                    $('#aslots').find('option').remove();
                    // $('#default').trigger("reset");
                    $.ajax({
                        url: 'website/getAvailableSlotByCase_managerByDateByJason?date=' + date + '&case_manager=' + case_managerr,
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).done(function (response) {
                        var slots = response.aslots;
                        $.each(response.aslots, function (key, value) {
                            $('#aslots').append($('<option>').text(value).val(value)).end();
                        });
                        $("#aslots").val(response.current_value)
                                .find("option[value=" + response.current_value + "]").attr('selected', true);
                        //   $("#default-step-1 .button-next").trigger("click");
                        if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                            $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                        }
                        // Populate the form fields with the data returned from server
                        //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
                    });
                });
                $(document).ready(function () {
                    $('#date').datepicker({
                        format: "dd-mm-yyyy",
                        autoclose: true,
                    })
                            //Listen for the change even on the input
                            .change(dateChanged)
                            .on('changeDate', dateChanged);
                });
                function dateChanged() {
                    // Get the record's ID via attribute  
                    var id = $('#patient_care_id').val();
                    var date = $('#date').val();
                    var case_managerr = $('#acase_managers').val();
                    $('#aslots').find('option').remove();
                    // $('#default').trigger("reset");
                    $.ajax({
                        url: 'website/getAvailableSlotByCase_managerByDateByJason?date=' + date + '&case_manager=' + case_managerr,
                        method: 'GET',
                        data: '',
                        dataType: 'json',
                    }).done(function (response) {
                        var slots = response.aslots;
                        $.each(response.aslots, function (key, value) {
                            $('#aslots').append($('<option>').text(value).val(value)).end();
                        });
                        //   $("#default-step-1 .button-next").trigger("click");
                        if ($('#aslots').has('option').length == 0) {                    //if it is blank. 
                            $('#aslots').append($('<option>').text('No Further Time Slots').val('Not Selected')).end();
                        }


                        // Populate the form fields with the data returned from server
                        //  $('#default').find('[name="staff"]').val(response.patient_care.staff).end()
                    });
                }

            </script>

            <script>

                $(document).ready(function () {
                    $('.caption img').removeAttr('style');
                    var windowH = $(window).width();
                    $('.caption img').css('width', (windowH) + 'px');
                    $('.caption img').css('height', '500px');
                });

            </script>
            <script>

                RevSlide.initRevolutionSlider();
                $(window).load(function () {
                    $('[data-zlname = reverse-effect]').mateHover({
                        position: 'y-reverse',
                        overlayStyle: 'rolling',
                        overlayBg: '#fff',
                        overlayOpacity: 0.7,
                        overlayEasing: 'easeOutCirc',
                        rollingPosition: 'top',
                        popupEasing: 'easeOutBack',
                        popup2Easing: 'easeOutBack'
                    });
                });
                $(window).load(function () {
                    $('.flexslider').flexslider({
                        animation: "slide",
                        start: function (slider) {
                            $('body').removeClass('loading');
                        }
                    });
                });
                //    fancybox
                jQuery(".fancybox").fancybox();
                $(function () {
                    $('a[href*=#]:not([href=#])').click(function () {
                        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                            var target = $(this.hash);
                            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                            if (target.length) {
                                $('html,body').animate({
                                    scrollTop: target.offset().top
                                }, 1000);
                                return false;
                            }
                        }
                    });
                });
            </script>

            <script type="text/javascript">
                $(document).ready(function () {
                    $("#aaccount_s").change(function () {
                        var id=$(this).val();
                        $.ajax({
                            url:"http://localhost/gem/website/get_case_managers_account_",
                            method:"POST",
                            data:{id:id},
                            async:true,
                            dataType:'JSON',
                            success: function(data) {
                                var html = '<option value="">Select .....</option>';
                                var i;
                                for(i=0; i<data.length; i++){
                                    html += '<option value='+data[i].id+'>'+data[i].name+'</option>';
                                }
                                $('#acase_managers').html(html);
                            }
                        });
                        return false;
                    });
                });
            </script>

        </body></html>