 <section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="col-xs-12 rtl p-0">
                    <div class="col-xs-12 card info-box p-0">
                        <div class="body">
                            <div class="col-xs-12">
                                <label for="inputStateId">استان:</label>
                                <select name="inputStateId" id="inputStateId">
                                    <option value="">همه</option>
                                    <?php foreach ($states as $item) { ?>
                                        <option value="<?php echo $item['StateId']; ?>">
                                            <?php echo $item['StateName']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <button type="button"
                                        id="searchButton"
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
                                    <th class="fit">#</th>
                                    <th>استان</th>
                                    <th class="fit">شهرستان ها</th>
                                    <th class="fit">ویرایش</th>
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
