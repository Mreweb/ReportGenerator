 <section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="col-xs-12 rtl p-0">
                    <div class="col-xs-12 card info-box p-0">
                        <div class="body">
                            <select id="inputOrderFATIds" multiple class="hidden">
                                <?php foreach ($FATIds as $id) { ?>
                                    <option value="<?php echo $id; ?>" selected>
                                        <?php echo $id; ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <div class="col-xs-12">
                                <label for="inputLastName">نام خانوادگی:</label>
                                <input type="text" class="input-search" id="inputLastName" />
                                <label for="inputNationalCode">کد ملی:</label>
                                <input type="text" class="input-search" id="inputNationalCode" />
                                <button type="button" id="searchButton" class="btn btn-info btn-circle waves-effect waves-circle waves-float pull-left btn-search">
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
                                    <th>نام و نام خانوداگی</th>
                                    <th class="fit">کد ملی</th>
                                    <th class="fit">تگ</th>
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
