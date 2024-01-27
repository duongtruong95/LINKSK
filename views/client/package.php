<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login.php';
//require_once __DIR__.'/../../includes/login-admin.php';

$title = 'Bảng Giá | '.$CMSNT->site('title');
$header = '
';
$footer = '
';
require_once __DIR__.'/header.php';
require_once __DIR__.'/sidebar.php';
?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Bảng giá</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('');?>">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bảng giá</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="container px-0">
                <h4 class="mb-30 mt-30 text-blue h4">Bảng Giá Dịch Vụ</h4>
                <div class="row">
                    <?php foreach($CMSNT->get_list("SELECT * FROM `packages` ") as $row){?>
                    <div class="col-md-4 mb-30 card-info">
                        <div class="card-box pricing-card-style2">
                            <div class="pricing-card-header">
                                <div class="right">
                                    <div class="pricing-price">
                                        <h5  style="color: #1b00ff !important;
    font-size: 20px !important;
    font-weight: bold !important;"><?=$row['name'];?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="pricing-card-body">
                                <div class="pricing-points">
                                    <ul>
                                        <?php
                                           $content = json_decode($row['content']) ?? [];
                                            foreach ($content as $item) {
                                               echo '<li>'.$item.'</li>';
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <?php if (empty($row['is_trial_package'])) { ?>
                            <select class="select-month" name="month" id="<?='month_' . $row['id'];?>">
                                <?php
                                $moneyMonth = json_decode($row['month_amounts']) ?? [];
                                foreach ($moneyMonth as $item) {
                                    echo '<option value="' . $item->month .'-'. $item->amount . '">'.$item->month.' tháng ('.format_currency($item->amount).') </option>';
                                }
                                ?>
                            </select>
                             <?php } else { ?>
                                <div style="height: 60px"></div>
                             <?php } ?>
                            <?php if (($getUser['flg_trial_package'] != 1 && $row['is_trial_package'] == 1) || $row['is_trial_package'] != 1) { ?>
                            <div class="cta">
                                <a type="button" href="#" data-id="<?=$row['id'];?>" data-name="<?=$row['name'];?>"
                                    data-expired="<?=$row['expired'];?>"
                                    data-price="<?=$row['price'];?>"
                                    data-trial="<?=$row['is_trial_package'];?>"
                                    class="btn btn-primary btn-rounded btn-lg buy">MUA NGAY</a>
                            </div>
                            <?php } ?>
                            <?php if ($getUser['flg_trial_package'] == 1 && $row['is_trial_package'] == 1) { ?>
                                <div class="cta" style="max-width: unset; width: 100%; padding-bottom: 18px; font-weight: bold; color: red;
    text-align: center;">
                                    Bạn đã sử dụng gói dùng thử!
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade bs-example-modal-lg" id="staticBackdrop" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        XÁC NHẬN THANH TOÁN
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">Tên gói</label>
                            <div class="col-sm-12 col-md-8">
                                <input class="form-control" type="hidden" id="id" readonly>
                                <input class="form-control" type="hidden" id="total_money" readonly>
                                <input class="form-control" type="hidden" id="month" readonly>
                                <input class="form-control" type="text" id="name" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">Thời hạn</label>
                            <div class="col-sm-12 col-md-8">
                                <input class="form-control" type="text" id="expired" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">Số tiền thanh toán</label>
                            <div class="col-sm-12 col-md-8">
                                <input class="form-control" type="text" id="price" readonly>
                            </div>
                        </div>
                        <i>Thời gian sẽ được cộng dồn vào thời gian còn lại của bạn.</i>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="buy">Thanh Toán</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <script type="text/javascript">
        $(".buy").on("click", function() {
            $("#id").val($(this).attr("data-id"));
            $("#name").val($(this).attr("data-name"));
            if ($(this).attr("data-trial") == 1) {
                $("#price").val('0đ');
                $("#expired").val('1 ngày');
                amount = 0
            } else {
                var value = $('#month_'+$(this).attr("data-id")).val();
                var arr = value.split("-");
                var month = arr[0];
                var amount = arr[1];
                $("#price").val(amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' đ');

                $("#expired").val(month + ' tháng');
            }
            $("#total_money").val(amount);
            $("#month").val(month);
            $("#staticBackdrop").modal();
        });
        </script>
        <script type="text/javascript">
        $("#buy").on("click", function() {
            $('#buy').html('Đang xử lý').prop('disabled',
                true);
            $.ajax({
                url: "<?=BASE_URL("assets/ajaxs/client/buy-package.php");?>",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: $("#id").val(),
                    total_money: $('#total_money').val(),
                    month: $('#month').val(),
                },
                success: function(respone) {
                    if (respone.status == 'success') {
                        location.href = "<?=BASE_URL('Auth/Profile');?>";
                        cuteToast({
                            type: "success",
                            message: respone.msg,
                            timer: 5000
                        });
                        //$("#staticBackdrop").modal('hide');
                    } else {
                        cuteToast({
                            type: "error",
                            message: respone.msg,
                            timer: 5000
                        });
                    }
                    $('#buy').html('Thanh Toán').prop('disabled', false);
                },
                error: function() {
                    alert(html(response));
                    location.reload();
                }

            });
        });
        </script>
        <?php
require_once __DIR__.'/footer.php';
?>