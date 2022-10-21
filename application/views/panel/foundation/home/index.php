<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="col-xs-12 rtl p-0">
                    <div class="col-xs-12 card info-box p-0">
                        <div class="body">
                            <div class="col-xs-12">
                                <label for="inputFoundationTitle">عنوان سازمان:</label>
                                <input type="text" class="input-search" id="inputFoundationTitle"/>

                                <label for="inputIsActive">وضعیت</label>
                                <select id="inputIsActive">
                                    <option value=""> انتخاب کنید</option>
                                    <option value="1"> فعال</option>
                                    <option value="0"> غیرفعال</option>
                                </select>


                                <button type="button" id="searchButton"
                                        class="btn btn-info btn-circle waves-effect waves-circle waves-float pull-left btn-search">
                                    <i class="material-icons">search</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th class="fit">شناسه سازمان</th>
                                    <th>عنوان سازمان</th>
                                    <th class="fit">وضعیت</th>
                                    <th class="fit">تاریخ ثبت</th>
                                    <th class="fit">عملیات</th>
                                </tr>
                                </thead>
                                <tbody class="table-rows"></tbody>
                            </table>
                        </div>
                        <div class="col-xs-12">
                            <div class="pagination-holder clearfix">
                                <div id="light-pagination" class="pagination light-theme simple-pagination">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
