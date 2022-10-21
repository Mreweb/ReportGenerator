<?php $_DIR = base_url('assets/empanel/'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <fieldset class="col-xs-12">
                                <legend>اطلاعات سازمان</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputFoundationTitle">عنوان سازمان</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                   maxlength="80" minlength="3"
                                                   id="inputFoundationTitle" name="inputFoundationTitle"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="col-xs-12">
                                <legend>مشخصات رابط ( ادمین  )</legend>
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
                                <button type="button" id="addFoundation" class="btn btn-primary waves-effect">ذخیره</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="col-xs-12 template-activity-range hidden">
    <button class="btn btn-danger btn-sm waves-effect remove-form-part">
        <i class="material-icons">remove</i>
    </button>
    <div class="col-xs-12 col-sm-6 col-md-2 state-container">
        <label for="inputActivityRangeStates">استان</label>
        <div class="form-group">
            <div class="form-line">
                <select name="inputActivityRangeStates" class="btn-group bootstrap-select form-control show-tick state-select">
                    <option value="">-- انتخاب کنید --</option>
                    <?php foreach ($states as $state) { ?>
                        <option value="<?php echo $state['StateId']; ?>">
                            <?php echo $state['StateName']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-2 city-container">
        <label for="inputActivityRangeCities">شهرستان</label>
        <div class="form-group">
            <div class="form-line">
                <select name="inputActivityRangeCities" class="btn-group bootstrap-select form-control"></select>
            </div>
        </div>
    </div>
</div>