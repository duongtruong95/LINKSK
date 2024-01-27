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
                    <div class="col-md-4 mb-30">
                        <div class="card-box pricing-card-style2">
                            <div class="pricing-card-header">
                                <div class="left">
                                    <h5><?=$row['name'];?></h5>
                                </div>
                                <div class="right">
                                    <div class="pricing-price">
                                        <?=format_currency($row['price']);?><span><?=$row['expired'];?> ngày</span>
                                    </div>
                                </div>
                            </div>
                            <div class="pricing-card-body">
                                <div class="pricing-points">
                                    <ul>
                                        <li>Rút gọn liên kết </li>
                                        <li>Bọc link VPCS</li>
                                        <li>Fake link spam</li>
                                        <li>Hỗ trợ riêng</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="cta">
                                <a type="button" href="#" data-id="<?=$row['id'];?>" data-name="<?=$row['name'];?>"
                                    data-expired="<?=$row['expired'];?>"
                                    data-price="<?=format_currency($row['price']);?>"
                                    class="btn btn-primary btn-rounded btn-lg buy">MUA
                                    NGAY</a>
                            </div>
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
            $("#expired").val($(this).attr("data-expired") + ' ngày');
            $("#price").val($(this).attr("data-price"));
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
                    id: $("#id").val()
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