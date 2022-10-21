<?php $_DIR = base_url('assets/empanel/'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                            <div class="col-xs-12 col-sm-6 col-md-2">
                                <label for="inputOldPassword">رمز عبور فعلی</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" class="form-control ltr text-center"
                                               maxlength="12" minlength="3"
                                               id="inputOldPassword" name="inputOldPassword"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-2">
                                <label for="inputNewPassword">رمز عبور جدید</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" class="form-control ltr text-center"
                                               maxlength="12" minlength="3"
                                               id="inputNewPassword" name="inputNewPassword"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-2">
                                <label for="inputConfirmPassword">تکرار رمز عبور جدید</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" class="form-control ltr text-center"
                                               maxlength="12" minlength="3"
                                               id="inputConfirmPassword" name="inputConfirmPassword"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="button" id="updateAdminProfile" class="btn btn-primary waves-effect">ذخیره</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
