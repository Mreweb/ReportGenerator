<?php $_DIR = base_url('assets/adminpanel/'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12">
                <div class="row hidden">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-red">
                            <div class="icon">
                                <i class="material-icons">shopping_cart</i>
                            </div>
                            <div class="content">
                                <div class="text">کارجویان</div>
                                <div class="number">1</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-indigo">
                            <div class="icon">
                                <i class="material-icons">face</i>
                            </div>
                            <div class="content">
                                <div class="text">سازمان ها</div>
                                <div class="number">1</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-purple">
                            <div class="icon">
                                <i class="material-icons">bookmark</i>
                            </div>
                            <div class="content">
                                <div class="text">حساب کاربری</div>
                                <div class="number">1</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-deep-purple">
                            <div class="icon">
                                <i class="material-icons">favorite</i>
                            </div>
                            <div class="content">
                                <div class="text">دفعات لاگین</div>
                                <div class="number">1</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>دسترسی های شما</h2>
                            </div>
                            <div class="body">
                                &nbsp;&nbsp;&nbsp;
                                <?php if (isAdminRole()) {
                                    echo '<label class="label label-success">';
                                    echo "مدیر سیستم";
                                    echo '</label>';
                                } ?>
                                &nbsp;&nbsp;&nbsp;
                                <?php if (isFoundationRole()) {
                                    echo '<label class="label label-success">';
                                    echo "موسسه ارزیابی";
                                    echo '</label>';
                                } ?>
                                &nbsp;&nbsp;&nbsp;
                                <?php if (isFoundationManagerRole()) {
                                    echo '<label class="label label-success">';
                                    echo "مدیر کانون";
                                    echo '</label>';
                                } ?>
                                &nbsp;&nbsp;&nbsp;
                                <?php if (isFoundationPlanManagerRole()) {
                                    echo '<label class="label label-success">';
                                    echo "مدیر برنامه";
                                    echo '</label>';
                                } ?>
                                &nbsp;&nbsp;&nbsp;
                                <?php if (isFoundationValuerRole()) {
                                    echo '<label class="label label-danger">';
                                    echo "ارزیاب";
                                    echo '</label>';
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <?php if(isset($_GET['error'])){ ?>
                    <h4 class="alert alert-danger rtl text-justify">
                        <?php echo $_GET['errorContent']; ?>
                    </h4>
                <?php } ?>
            </div>
        </div>
        <!-- #END# Widgets -->
    </div>
</section>
