<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login-admin.php';
$title = 'Settings | CMSNT Panel';
$header = '
    <!-- CodeMirror -->
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/codemirror/theme/monokai.css">
    <!-- ckeditor -->
    <script src="'.BASE_URL('template/ckeditor/ckeditor.js').'"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
';
$footer = '
    <!-- CodeMirror -->
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/codemirror/codemirror.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/codemirror/mode/css/css.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/codemirror/mode/xml/xml.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <!-- Select2 -->
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/select2/js/select2.full.min.js"></script>
    <script>
    $(function () {
        $(".select2").select2()
        $(".select2bs4").select2({
            theme: "bootstrap4"
        });
    });
    </script>
';
require_once __DIR__.'/header.php';
require_once __DIR__.'/sidebar.php';
require_once __DIR__.'/../../includes/checkLicense.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=BASE_URL('views/admin/index.php');?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
    if(isset($_POST['SaveSettings']))
    {
        if($CMSNT->site('status_demo') != 0)
        {
            die('<script type="text/javascript">if(!alert("Không được dùng chức năng này vì đây là trang web demo.")){window.history.back().location.reload();}</script>');
        }
        foreach ($_POST as $key => $value)
        {
            $CMSNT->update("settings", array(
                'value' => $value
            ), " `name` = '$key' ");
        }
        die('<script type="text/javascript">if(!alert("Lưu thành công !")){window.history.back().location.reload();}</script>');
    } ?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-4 connectedSortable">
                    <form action="" method="POST">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-cogs mr-1"></i>
                                    CẤU HÌNH THÔNG TIN WEBSITE
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                            class="fas fa-expand"></i>
                                    </button>
                                    <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">License key</label>
                                    <input type="text" class="form-control" name="license_key"
                                        value="<?=$CMSNT->site('license_key');?>" placeholder="Nhập giấy phép kích hoạt mã nguồn.">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" class="form-control" name="title"
                                        value="<?=$CMSNT->site('title');?>" placeholder="VD: CMSNT.CO">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <input type="text" class="form-control" name="description"
                                        value="<?=$CMSNT->site('description');?>"
                                        placeholder="VD: Hệ thống bán mã nguồn website MMO uy tín">
                                </div>
                                <div class="form-group">
                                    <label>Keywords</label>
                                    <input type="text" class="form-control" name="keywords"
                                        value="<?=$CMSNT->site('keywords');?>"
                                        placeholder="VD: cmsnt, bán code, source code mmo">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Author</label>
                                    <input type="text" class="form-control" name="author"
                                        value="<?=$CMSNT->site('author');?>" placeholder="VD: CMSNT">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2bs4" name="status">
                                        <option <?=$CMSNT->site('status') == 1 ? 'selected' : '';?> value="1">ON
                                        </option>
                                        <option <?=$CMSNT->site('status') == 0 ? 'selected' : '';?> value="0">OFF
                                        </option>
                                    </select>
                                    <i>Chọn OFF website sẽ bật chế độ bảo trì</i>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email SMTP</label>
                                    <input type="email" class="form-control" name="email_smtp"
                                        value="<?=$CMSNT->site('email_smtp');?>" placeholder="Nhập địa chỉ Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password Email SMTP</label>
                                    <input type="text" class="form-control" name="pass_email_smtp"
                                        value="<?=$CMSNT->site('pass_email_smtp');?>" placeholder="Nhập mật khẩu Email">
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="SaveSettings" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                                        class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </div>
                        </div>
                    </form>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <form action="" method="POST">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-cogs mr-1"></i>
                                    CẤU HÌNH NẠP BANK AUTO
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                            class="fas fa-expand"></i>
                                    </button>
                                    <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2bs4" name="status_bank">
                                        <option <?=$CMSNT->site('status_bank') == 0 ? 'selected' : '';?> value="0">OFF
                                        </option>
                                        <option <?=$CMSNT->site('status_bank') == 1 ? 'selected' : '';?> value="1">ON
                                        </option>
                                    </select>
                                    <i>Chọn OFF hệ thống sẽ tạm dừng auto bank.</i>
                                </div>
                                <div class="form-group">
                                    <label>Ngân hàng</label>
                                    <select class="form-control select2bs4" name="type_bank">
                                        <option <?=$CMSNT->site('type_bank') == 'Vietcombank' ? 'selected' : '';?>
                                            value="Vietcombank">Vietcombank
                                        </option>
                                        <option <?=$CMSNT->site('type_bank') == 'Techcombank' ? 'selected' : '';?>
                                            value="Techcombank">Techcombank
                                        </option>
                                        <option <?=$CMSNT->site('type_bank') == 'MBBank' ? 'selected' : '';?>
                                            value="MBBank">MBBank
                                        </option>
                                        <option <?=$CMSNT->site('type_bank') == 'ACB' ? 'selected' : '';?>
                                            value="ACB">ACB
                                        </option>
                                        <option <?=$CMSNT->site('type_bank') == 'VPBank' ? 'selected' : '';?>
                                            value="VPBank">VPBank
                                        </option>
                                    </select>
                                    <i>Chọn ngân hàng bạn cần sử dụng.</i>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Token Bank</label>
                                    <input type="text" class="form-control" name="token_bank"
                                        value="<?=$CMSNT->site('token_bank');?>" placeholder="Nhập token ngân hàng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tài khoản</label>
                                    <input type="text" class="form-control" name="stk_bank"
                                        value="<?=$CMSNT->site('stk_bank');?>"
                                        placeholder="Nhập số tài khoản ngân hàng cần Auto">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1">Tên chủ tài khoản</label>
                                    <input type="text" class="form-control" name="name_bank"
                                        value="<?=$CMSNT->site('name_bank');?>"
                                        placeholder="Nhập tên chủ tài khoản ngân hàng">
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu Internet Banking</label>
                                    <input type="text" class="form-control" name="mk_bank"
                                        value="<?=$CMSNT->site('mk_bank');?>"
                                        placeholder="Nhập mật khẩu internet banking">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung nạp tiền</label>
                                    <input type="text" class="form-control" name="recharge_content"
                                        value="<?=$CMSNT->site('recharge_content');?>"
                                        placeholder="Nhập nội dung nạp tiền VD: naptien ">
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="SaveSettings" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                                        class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </div>
                        </div>
                    </form>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <form action="" method="POST">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-cogs mr-1"></i>
                                    CẤU HÌNH NẠP MOMO AUTO
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                            class="fas fa-expand"></i>
                                    </button>
                                    <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2bs4" name="status_momo">
                                        <option <?=$CMSNT->site('status_momo') == 0 ? 'selected' : '';?> value="0">OFF
                                        </option>
                                        <option <?=$CMSNT->site('status_momo') == 1 ? 'selected' : '';?> value="1">ON
                                        </option>
                                    </select>
                                    <i>Chọn OFF hệ thống sẽ tạm dừng auto momo.</i>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Token MOMO</label>
                                    <input type="text" class="form-control" name="token_momo"
                                        value="<?=$CMSNT->site('token_momo');?>" placeholder="Nhập token ví momo">
                                </div>
                                <!--<div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại ví</label>
                                    <input type="text" class="form-control" name="sdt_momo"
                                        value="<?=$CMSNT->site('sdt_momo');?>" placeholder="Nhập số điện thoại ví momo">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên chủ ví</label>
                                    <input type="text" class="form-control" name="name_momo"
                                        value="<?=$CMSNT->site('name_momo');?>" placeholder="Nhập tên chủ ví">
                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung nạp tiền</label>
                                    <input type="text" class="form-control" name="recharge_content"
                                        value="<?=$CMSNT->site('recharge_content');?>"
                                        placeholder="Nhập nội dung nạp tiền VD: naptien ">
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="SaveSettings" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                                        class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </div>
                        </div>
                    </form>
                </section>
                <section class="col-lg-12 connectedSortable">
                    <form action="" method="POST">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-cogs mr-1"></i>
                                    CẤU HÌNH NỘI DUNG
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                            class="fas fa-expand"></i>
                                    </button>
                                    <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thông báo toàn hệ thống</label>
                                    <textarea id="thongbao" name="thongbao"><?=$CMSNT->site('thongbao');?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ghi chú nạp tiền</label>
                                    <textarea id="recharge_notice"
                                        name="recharge_notice"><?=$CMSNT->site('recharge_notice');?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ghi chú công cụ Bọc Link Vpcs</label>
                                    <textarea id="boclink_notice"
                                        name="boclink_notice"><?=$CMSNT->site('boclink_notice');?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ghi chú công cụ Fake Link</label>
                                    <textarea id="fakelink_notice"
                                        name="fakelink_notice"><?=$CMSNT->site('fakelink_notice');?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ghi chú công cụ Rút Gọn Link</label>
                                    <textarea id="shortenlink_notice"
                                        name="fakelink_notice"><?=$CMSNT->site('shortenlink_notice');?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Javascript (chứa code live chat, google analytics, css trang trí web...)</label>
                                    <textarea id="codeMirrorDemo" placeholder="Chứa code live chat hoặc jquery trang trí..."
                                        name="javascript"><?=$CMSNT->site('javascript');?></textarea>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button name="SaveSettings" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                                        class="fas fa-save mr-1"></i>Lưu Ngay</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<script>
  $(function () {
    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
<!-- ckeditor -->
<script>
CKEDITOR.replace("recharge_notice");
CKEDITOR.replace("thongbao");
CKEDITOR.replace("boclink_notice");
CKEDITOR.replace("fakelink_notice");
CKEDITOR.replace("shortenlink_notice");
</script>
<?php
require_once __DIR__.'/footer.php';
?>