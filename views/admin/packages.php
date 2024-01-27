<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login-admin.php';
$title = 'Packages | CMSNT Panel';
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
    $isCreate = $CMSNT->insert("packages", [
        'name' => check_string($_POST['name']),
        'expired' => check_string($_POST['expired']),
        'price' => check_string($_POST['price'])
    ]);
    if($isCreate)
    {
        admin_msg_success("Thêm gói thành công!", "", 1000);
    }
    else
    {
        die('<script type="text/javascript">if(!alert("Thêm gói thất bại, vui lòng thử lại!")){window.history.back().location.reload();}</script>');
    }
}
if(isset($_POST['save']))
{
    if($CMSNT->site('status_demo') != 0)
    {
        die('<script type="text/javascript">if(!alert("Không được dùng chức năng này vì đây là trang web demo.")){window.history.back().location.reload();}</script>');
    }
    $isCreate = $CMSNT->update("packages", [
        'name' => check_string($_POST['name']),
        'expired' => check_string($_POST['expired']),
        'price' => check_string($_POST['price'])
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
                    <h1 class="m-0">Packages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=BASE_URL('views/admin/index.php');?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Packages</li>
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
                                THÊM GÓI
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
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên gói</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên gói cần tạo"
                                        name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thời hạn</label>
                                    <input type="number" class="form-control"
                                        placeholder="Nhập thời gian hết hạn của gói" name="expired" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tiền</label>
                                    <input type="number" class="form-control" placeholder="Nhập giá tiền của gói"
                                        name="price" required>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button type="submit" name="create" class="btn btn-primary"><i
                                        class="fas fa-plus mr-1"></i>THÊM NGAY</button>
                            </div>
                        </form>
                    </div>
                </section>
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list mr-1"></i>
                                DANH SÁCH GÓI
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
                                            <th>#</th>
                                            <th>NAME</th>
                                            <th>EXPIRED</th>
                                            <th>PRICE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `packages` ORDER BY id DESC  ") as $row){
                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$row['name'];?></td>
                                            <td><?=$row['expired'];?> ngày</td>
                                            <td><?=format_cash($row['price']);?>đ</td>
                                            <td>
                                                <button aria-label="" style="color:white;" data-id="<?=$row['id'];?>"
                                                    data-name="<?=$row['name'];?>" data-expired="<?=$row['expired'];?>"
                                                    data-price="<?=$row['price'];?>"
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
                            title: "Xác Nhận Xóa Package",
                            message: "Bạn có chắc chắn muốn xóa gói này không? ",
                            confirmText: "Đồng Ý",
                            cancelText: "Hủy"
                        }).then((e) => {
                            if (e) {
                                $.ajax({
                                    url: "<?=BASE_URL('assets/ajaxs/admin/package-delete.php');?>",
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
                CHỈNH SỬA GÓI
            </div>
            <form action="" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên gói</label>
                        <input type="text" class="form-control" placeholder="Nhập tên gói cần tạo" name="name" id="name"
                            required>
                        <input type="hidden" class="form-control" placeholder="Nhập tên gói cần tạo" name="id" id="id"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Thời hạn</label>
                        <input type="number" class="form-control" placeholder="Nhập thời gian hết hạn của gói"
                            id="expired" name="expired" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số tiền</label>
                        <input type="number" class="form-control" placeholder="Nhập giá tiền của gói" id="price"
                            name="price" required>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    <button aria-label="" name="save" class="btn btn-info btn-icon-left m-b-10" type="submit"><i
                            class="fas fa-save mr-1"></i>Lưu Ngay</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<script type="text/javascript">
$(".edit").on("click", function() {
    $("#id").val($(this).attr("data-id"));
    $("#name").val($(this).attr("data-name"));
    $("#expired").val($(this).attr("data-expired"));
    $("#price").val($(this).attr("data-price"));
    $("#staticBackdrop").modal();
});
</script>
<?php
require_once __DIR__.'/footer.php';
?>