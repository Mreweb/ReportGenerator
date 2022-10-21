<?php $_DIR = base_url('assets/empanel/'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12">
                                <legend>اطلاعات مشتری</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputCustomerTitle">عنوان</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputCustomerTitle" name="inputCustomerTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputCustomerAddress">آدرس</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputCustomerAddress" name="inputCustomerAddress"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label for="inputDescriptionFile">فایل توضیحات</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" class="form-control"
                                                   id="inputDescriptionFile" name="inputDescriptionFile"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <label for="inputDescription">توضیحات</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   id="inputDescription" name="inputDescription"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>مشخصات رابط</legend>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label class="required" for="inputPersonFirstName">نام</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputPersonFirstName" name="inputPersonFirstName"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label class="required" for="inputPersonLastName">نام خانوادگی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputPersonLastName" name="inputPersonLastName"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label class="required" for="inputPersonNationalCode">کد ملی</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputPersonNationalCode" name="inputPersonNationalCode"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label class="required" for="inputPersonPhone">تلفن</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputPersonPhone" name="inputPersonPhone"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label class="required" for="inputUsername">نام کاربری</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputUsername" name="inputUsername"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-2">
                                    <label class="required" for="inputPassword">رمز عبور</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputPassword" name="inputPassword"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="col-xs-12 p-0">
                                <button type="button" id="addCustomer" class="btn btn-success waves-effect pull-left">ذخیره همه</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
