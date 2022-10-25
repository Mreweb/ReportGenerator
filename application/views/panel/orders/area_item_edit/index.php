<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12">
                            <input type="hidden" id="inputFATId"  <?php  setInputValue($areaItem['FATId']);?>  />
                            <fieldset class="col-xs-12">
                                <legend>ویرایش مولفه</legend>
                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <label class="required" for="inputFATTitle">عنوان مولفه</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control"
                                                <?php  setInputValue($areaItem['FATTitle']);?>
                                                   maxlength="80" minlength="3"
                                                   id="inputFATTitle" name="inputFATTitle"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <button id="edit" type="button"
                                            class="btn btn-success waves-effect pull-left">
                                        ذخیره
                                    </button>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>