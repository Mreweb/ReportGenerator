<?php $_DIR = base_url('assets/empanel/'); ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <input <?php setInputValue($foundation['FoundationId']); ?>
                                    type="hidden" name="inputFoundationId" id="inputFoundationId"/>
                            <fieldset class="col-xs-12">
                                <legend>اطلاعات سازمان</legend>
                                <div class="col-xs-12 col-sm-6 col-md-4">
                                    <label class="required" for="inputFoundationTitle">عنوان سازمان</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input
                                                <?php setInputValue($foundation['FoundationTitle']); ?>
                                                    type="text" class="form-control"
                                                    maxlength="80" minlength="3"
                                                    disabled
                                                    id="inputFoundationTitle" name="inputFoundationTitle"/>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <h4 class="row col-xs-12 text-danger">
                                مشخصات رابط (در صورت نیاز اطلاعات رابط را ویرایش کرده و ذخیره کنید)
                            </h4>
                            <?php foreach ($foundationAdmin as $item) { ?>
                                    <form>
                                        <fieldset class="col-xs-12">
                                            <legend><?php echo $item['PersonFirstName']." ".$item['PersonLastName']; ?></legend>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <label class="required" for="inputPersonFirstName">نام</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"
                                                            <?php setInputValue($item['PersonFirstName']); ?>
                                                               maxlength="80" minlength="3"
                                                               id="inputPersonFirstName" name="inputPersonFirstName"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <label class="required" for="inputPersonLastName">نام خانوادگی</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"
                                                            <?php setInputValue($item['PersonLastName']); ?>
                                                               maxlength="80" minlength="3"
                                                               id="inputPersonLastName" name="inputPersonLastName"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <label class="required" for="inputPersonNationalCode">کد ملی</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"
                                                            <?php setInputValue($item['PersonNationalCode']); ?>
                                                               maxlength="80" minlength="3"
                                                               id="inputPersonNationalCode" name="inputPersonNationalCode"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <label class="required" for="inputPersonPhone">تلفن</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"
                                                            <?php setInputValue($item['PersonPhone']); ?>
                                                               maxlength="80" minlength="3"
                                                               id="inputPersonPhone" name="inputPersonPhone"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <label class="required" for="inputUsername">نام کاربری</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"
                                                            <?php setInputValue($item['Username']); ?>
                                                               maxlength="80" minlength="3"
                                                               id="inputUsername" name="inputUsername"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4">
                                                <label for="inputPassword">رمز عبور (در صورت نیاز تغییر دهید)</label>
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control"
                                                               maxlength="80" minlength="3"
                                                               id="inputPassword" name="inputPassword"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 p-0">
                                                <button data-person-id="<?php echo $item['PersonId']; ?>"
                                                        type="button" class="btn btn-primary waves-effect update-account">
                                                    ذخیره
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>