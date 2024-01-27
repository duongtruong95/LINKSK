<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login-admin.php';
$title = 'Domains | CMSNT Panel';
$header = '';
$footer = '';
require_once __DIR__.'/header.php';
require_once __DIR__.'/sidebar.php';
require_once __DIR__.'/../../includes/checkLicense.php';

if(isset($_POST['create']))
{
    if($CMSNT->site('status_demo') != 0)
    {
        die('<script type="text/javascript">if(!alert("Không được dùng chức năng này vì đây là trang web demo.")){window.history.back().location.reload();}</script>');
    }
    $isCreate = $CMSNT->insert("domains", [
        'user_id'   => $getUser['id'],
        'domain' => check_string($_POST['domain']),
        'share' => check_string($_POST['share']),
        'status' => check_string($_POST['status']),
        'createdate'    => gettime(),
        'updatedate'    => gettime()
    ]);
    if($isCreate)
    {
        admin_msg_success("Thêm tên miền thành công!", "", 1000);
    }
    else
    {
        die('<script type="text/javascript">if(!alert("Thêm tên miền thất bại, vui lòng thử lại!")){window.history.back().location.reload();}</script>');
    }
}
if(isset($_POST['save']))
{
    if($CMSNT->site('status_demo') != 0)
    {
        die('<script type="text/javascript">if(!alert("Không được dùng chức năng này vì đây là trang web demo.")){window.history.back().location.reload();}</script>');
    }
    $isCreate = $CMSNT->update("domains", [
        'domain' => check_string($_POST['domain']),
        'share' => check_string($_POST['share']),
        'status' => check_string($_POST['status']),
        'updatedate'    => gettime()
    ], " `id` = '".check_string($_POST['id'])."' ");
    if($isCreate)
    {
        admin_msg_success("Lưu gói thành công!", "", 1000);
    }
    else
    {
        die('<script type="text/javascript">if(!alert("Lưu gói thất bại, vui lòng thử lại!")){window.history.back().location.reload();}</script>');
    }
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Domains</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=BASE_URL('views/admin/index.php');?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Domains</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-6 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-folder-plus mr-1"></i>
                                THÊM DOMAIN
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
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Domain</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="text" class="form-control"
                                            placeholder="Nhập tên miền mới của bạn, VD: https://cmsnt.co/" name="domain"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Trạng thái</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select class="custom-select col-12" name="status" required>
                                            <option value="1"><?=display_domain(1);?></option>
                                            <option value="0"><?=display_domain(0);?></option>
                                            <option value="2"><?=display_domain(2);?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="share" value="1"
                                        id="share" checked>
                                    <label for="share" class="custom-control-label">Chia sẽ tên miền này cho mọi
                                        người</label>
                                </div>
                                <br>
                                <i>Tất cả thành viên trả phí đều có thể sử dụng domain này nếu bạn tích vào ô 'Chia sẽ
                                    tên miền này cho mọi
                                    người'</i>
                            </div>
                            <div class="card-footer clearfix">
                                <button type="submit" name="create" class="btn btn-primary"><i
                                        class="fas fa-plus mr-1"></i>THÊM NGAY</button>
                            </div>
                        </form>
                    </div>
                </section>
                <section class="col-lg-6 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-folder-plus mr-1"></i>
                                LƯU Ý
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
                        <form action="" method="POST">
                            <div class="card-body">
                                <ul>
                                    <li>Bạn cần thực hiện trỏ DNS domain về IP: <?=$_SERVER['SERVER_ADDR'];?></li>
                                    <li>Thêm Alias Domain theo hướng dẫn <a target="_blank"
                                            href="https://wiki.matbao.net/aliases-la-gi-huong-dan-cau-hinh-alias-domain-trong-cpanel/">tại
                                            đây</a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </section>
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list mr-1"></i>
                                DANH SÁCH DOMAIN
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
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="5%">#</th>
                                            <th>USERNAME</th>
                                            <th>DOMAIN</th>
                                            <th>SHARE</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `domains` ORDER BY id DESC  ") as $row){
                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td>
                                                <a
                                                    href="<?=BASE_URL('views/admin/edit-user.php?id='.$row['user_id']);?>"><?=getUser($row['user_id'], 'username');?></a>
                                            </td>
                                            <td><?=$row['domain'];?></td>
                                            <td><?=display_share_domain($row['share']);?></td>
                                            <td><?=display_domain($row['status']);?></td>
                                            <td>
                                                <button aria-label="" style="color:white;" data-id="<?=$row['id'];?>"
                                                    data-domain="<?=$row['domain'];?>"
                                                    data-status="<?=$row['status'];?>" data-share="<?=$row['share'];?>"
                                                    class="btn btn-info btn-icon-left m-b-10 edit" type="button">
                                                    <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                                                </button>
                                                <button aria-label="" style="color:white;" data-id="<?=$row['id'];?>"
                                                    class="btn btn-danger btn-icon-left m-b-10 delete" type="button">
                                                    <i class="fas fa-trash-alt mr-1"></i><span class="">Delete</span>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                    $(".delete").on("click", function() {
                        cuteAlert({
                            type: "question",
                            title: "Xác Nhận Xóa Domain",
                            message: "Bạn có chắc chắn muốn xóa domain này không? ",
                            confirmText: "Đồng Ý",
                            cancelText: "Hủy"
                        }).then((e) => {
                            if (e) {
                                $.ajax({
                                    url: "<?=BASE_URL('assets/ajaxs/admin/domain-delete.php');?>",
                                    method: "POST",
                                    dataType: "JSON",
                                    data: {
                                        id: $(this).data('id')
                                    },
                                    success: function(respone) {
                                        if (respone.status == 'success') {
                                            cuteToast({
                                                type: "success",
                                                message: respone.msg,
                                                timer: 5000
                                            });
                                            location.reload();
                                        } else {
                                            cuteAlert({
                                                type: "error",
                                                title: "Error",
                                                message: respone.msg,
                                                buttonText: "Okay"
                                            });
                                        }
                                    },
                                    error: function() {
                                        alert(html(response));
                                        location.reload();
                                    }
                                });
                            }
                        })
                    });
                    </script>
                </section>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>


<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="staticBackdrop" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                CHỈNH SỬA TÊN MIỀN
            </div>
            <form action="" method="POST">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-4 col-form-label">Domain</label>
                        <div class="col-sm-12 col-md-8">
                            <input type="text" class="form-control" placeholder="Nhập tên miền cần thêm" name="domain"
                                id="domain" required>
                            <input type="hidden" class="form-control" placeholder="Nhập tên gói cần tạo" name="id"
                                id="id" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-4 col-form-label">Trạng thái</label>
                        <div class="col-sm-12 col-md-8">
                            <select class="custom-select col-12" name="status" id="status" required>
                                <option value="0"><?=display_domain(0);?></option>
                                <option value="1"><?=display_domain(1);?></option>
                                <option value="2"><?=display_domain(2);?></option>
                            </select>
                        </div>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="share" value="1" id="shareedit">
                        <label for="shareedit" class="custom-control-label">Chia sẽ tên miền này cho mọi
                            người</label>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <button aria-label="" name="save" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                            class="fas fa-save mr-1"></i>Lưu Ngay</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-times mr-1"></i>Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<script type="text/javascript">
$(".edit").on("click", function() {
    $("#id").val($(this).attr("data-id"));
    $("#domain").val($(this).attr("data-domain"));
    $("#status").val($(this).attr("data-status"));
    if ($(this).attr("data-share") == 1) {
        document.getElementById("shareedit").checked = true;
    }
    $("#staticBackdrop").modal();
});
</script>
<?php
require_once __DIR__.'/footer.php';
?>