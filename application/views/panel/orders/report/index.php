<script src="<?php echo base_url('assets/ui/js/chartjs-3.7.1.js') ?>"></script>
<script src="<?php echo base_url('assets/ui/js/chartjs-plugin.js') ?>"></script>
<script src="<?php echo base_url('assets/ui/js/chartjs-data-labels.js') ?>"></script>
<style type="text/css">
    .area-info {
        display: inline-flex;
    }

    .area-info i {
        font-size: 50px;
        margin: 0px 5px;
    }

    .area-info b {
        font-size: 26px;
        margin: 10px 0;
    }

    .info strong {

    }

    .info b {
        background: #f7f703 !important;;
        padding: 6px 20px;
        display: inline-block;
        float: left;
        margin-bottom: 8px;
        border-radius: 5px;
        font-size: 14px;
    }

    .area-title {
        color: #0095ff !important;;
        font-size: 16px;
        margin: 0px;
        margin-bottom: 8px;
    }

    .area-content {
        text-align: justify;
        direction: revert;
        line-height: 20px;
        font-size: 12px;
    }

    .color-guid {
        display: inline-block;
        width: 100%;
    }

    .color-guid span {
        display: inline-block;
        width: 50px;
        border: 1px solid #9f9f9f !important;;
        float: left;
        height: 30px;
    }

    .level-1 {
        background-color: #fff !important;;
    }

    .level-2 {
        background-color: #C5E8B7 !important;;
    }

    .level-3 {
        background-color: #ABE098 !important;;
    }

    .level-4 {
        background-color: #83D475 !important;;
    }

    .level-5 {
        background-color: #57C84D !important;;
    }



    .sidebar, .navbar {
        display: none;
    }
    section.content {
        margin: 0 0 0 0 !important;
    }
    body,
    .body,
    .container-fluid,
    .container,
    .card
    {
        padding: 0 !important;
        margin: 0 !important;
    }
    @media print {
        canvas {
            min-height: 100%;
            max-width: 100%;
            max-height: 100%;
            height: auto!important;
            width: auto!important;
        }
    }
</style>
<input type="hidden" id="inputAreaId"  <?php  setInputValue($area['AreaId']);?>  />
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 rtl">
                <div class="row col-xs-12 card">
                    <div class="body">
                        <div class="col-xs-12 result-container">
                            <p class="text-center" style="font-size: 18px;margin: 10px;">بسمه تعالی</p>
                            <div class="col-xs-12">
                                <span class="pull-right area-info">
                                    <i class="material-icons">spellcheck</i>
                                    <b>نتایج ارزیابی</b>
                                </span>
                                <span class="pull-left info">
                                    <b>
                                        نام و نام خانوادگی:
                                        <strong class="text-danger"><?php echo $person['FirstName']." ".$person['LastName']; ?></strong>
                                    </b>
                                    <br>
                                    <b>
                                        شماره دوره:
                                        <strong class="text-danger"><?php echo $area['AreaTitle']; ?></strong>
                                    </b>
                                </span>
                            </div>
                            <div class="col-xs-12">
                                <h3 class="area-title"><?php echo $area['AreaTitle']; ?></h3>
                                <div class="area-content">
                                    اگر شما یک طراح هستین و یا با طراحی های گرافیکی سروکار دارید به متن های برخورده اید که با نام لورم ایپسوم شناخته می‌شوند. لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) متنی ساختگی و بدون معنی است که برای امتحان فونت و یا پر کردن فضا در یک طراحی گرافیکی و یا صنعت چاپ استفاده میشود. طراحان وب و گرافیک از این متن برای پرکردن صفحه و ارائه شکل کلی طرح استفاده می‌کنند.
                                    طراحان سایت هنگام طراحی قالب سایت معمولا با این موضوع رو برو هستند که محتوای اصلی صفحات آماده نیست. در نتیجه طرح کلی دید درستی به کار فرما نمیدهد. اگر طراح بخواهد دنبال متن های مرتبط بگردد تمرکزش از روی کار اصلی برداشته میشود و اینکار زمان بر خواهد بود. همچنین طراح به دنبال این است که پس از ارایه کار نظر دیگران را در مورد طراحی جویا شود و نمی‌خواهد افراد روی متن های موجود تمرکز کنند.

                                    اگر شما یک طراح هستین و یا با طراحی های گرافیکی سروکار دارید به متن های برخورده اید که با نام لورم ایپسوم شناخته می‌شوند. لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) متنی ساختگی و بدون معنی است که برای امتحان فونت و یا پر کردن فضا در یک طراحی گرافیکی و یا صنعت چاپ استفاده میشود. طراحان وب و گرافیک از این متن برای پرکردن صفحه و ارائه شکل کلی طرح استفاده می‌کنند.
                                    طراحان سایت هنگام طراحی قالب سایت معمولا با این موضوع رو برو هستند که محتوای اصلی صفحات آماده نیست. در نتیجه طرح کلی دید درستی به کار فرما نمیدهد. اگر طراح بخواهد دنبال متن های مرتبط بگردد تمرکزش از روی کار اصلی برداشته میشود و اینکار زمان بر خواهد بود. همچنین طراح به دنبال این است که پس از ارایه کار نظر دیگران را در مورد طراحی جویا شود و نمی‌خواهد افراد روی متن های موجود تمرکز کنند.
                                 </div>
                                <h3 class="area-title"><?php echo $area['AreaTitle']; ?></h3>
                                <div class="area-content">
                                    اگر شما یک طراح هستین و یا با طراحی های گرافیکی سروکار دارید به متن های برخورده اید که با نام لورم ایپسوم شناخته می‌شوند. لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) متنی ساختگی و بدون معنی است که برای امتحان فونت و یا پر کردن فضا در یک طراحی گرافیکی و یا صنعت چاپ استفاده میشود. طراحان وب و گرافیک از این متن برای پرکردن صفحه و ارائه شکل کلی طرح استفاده می‌کنند.
                                    طراحان سایت هنگام طراحی قالب سایت معمولا با این موضوع رو برو هستند که محتوای اصلی صفحات آماده نیست. در نتیجه طرح کلی دید درستی به کار فرما نمیدهد. اگر طراح بخواهد دنبال متن های مرتبط بگردد تمرکزش از روی کار اصلی برداشته میشود و اینکار زمان بر خواهد بود. همچنین طراح به دنبال این است که پس از ارایه کار نظر دیگران را در مورد طراحی جویا شود و نمی‌خواهد افراد روی متن های موجود تمرکز کنند.

                                    اگر شما یک طراح هستین و یا با طراحی های گرافیکی سروکار دارید به متن های برخورده اید که با نام لورم ایپسوم شناخته می‌شوند. لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) متنی ساختگی و بدون معنی است که برای امتحان فونت و یا پر کردن فضا در یک طراحی گرافیکی و یا صنعت چاپ استفاده میشود. طراحان وب و گرافیک از این متن برای پرکردن صفحه و ارائه شکل کلی طرح استفاده می‌کنند.
                                 </div>
                                <div class="col-xs-12 area-chart p-0">
                                    <div class="col-xs-12 color-guid p-0">
                                        <span class="level-1"></span>
                                        <span class="level-2"></span>
                                        <span class="level-3"></span>
                                        <span class="level-4"></span>
                                        <span class="level-5"></span>
                                    </div>
                                    <div class="col-xs-12 result-table p-0">
                                        <table>
                                                <tr>
                                                    <td class="fit text-center">مولفه</td>
                                                    <?php foreach ($areaItems as $item) { ?>
                                                        <td class="fit text-center"><?php echo $item['FATTitle']; ?></td>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <td class="fit text-center">نمره فرد</td>
                                                    <?php foreach ($personResult as $item) { ?>
                                                        <td class="fit text-center <?php echo pipExamResultLevel($item['FATScore']); ?>"><?php echo $item['FATScore']; ?></td>
                                                    <?php } ?>
                                                </tr>
                                                <tr>
                                                    <td class="fit text-center">میانگین سازمان</td>
                                                    <?php foreach ($Result as $item) { ?>
                                                        <td class="fit text-center   <?php echo pipExamResultLevel($item['AVG']); ?>"><?php echo round($item['AVG'] , 2); ?></td>
                                                    <?php } ?>
                                                </tr>
                                        </table>
                                    </div>
                                    <div class="col-xs-12 result-chart" style="height: 350px;">
                                        <h3  class="area-title">نتایج</h3>
                                        <canvas id="ReghbatMinMaxAvgChart" style="height: 350px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>