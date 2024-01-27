<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login-admin.php';
$title = 'Menus | CMSNT Panel';
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
    $isCreate = $CMSNT->insert("menus", [
        'name'          => check_string($_POST['name']),
        'href'          => check_string($_POST['href']),
        'icon'          => $_POST['icon'],
        'target'        => isset($_POST['target']) ? check_string($_POST['target']) : '',
        'createdate'    => gettime(),
        'updatedate'    => gettime()
    ]);
    if($isCreate)
    {
        admin_msg_success("Thêm menu thành công!", "", 1000);
    }
    else
    {
        die('<script type="text/javascript">if(!alert("Thêm menu thất bại, vui lòng thử lại!")){window.history.back().location.reload();}</script>');
    }
}
if(isset($_POST['save']))
{
    if($CMSNT->site('status_demo') != 0)
    {
        die('<script type="text/javascript">if(!alert("Không được dùng chức năng này vì đây là trang web demo.")){window.history.back().location.reload();}</script>');
    }
    $isCreate = $CMSNT->update("menus", [
        'name'      => check_string($_POST['name']),
        'href'      => check_string($_POST['href']),
        'icon'      => $_POST['icon'],
        'target'    => isset($_POST['target']) ? check_string($_POST['target']) : '',
        'updatedate'=> gettime()
    ], " `id` = '".check_string($_POST['id'])."' ");
    if($isCreate)
    {
        admin_msg_success("Lưu menu thành công!", "", 1000);
    }
    else
    {
        die('<script type="text/javascript">if(!alert("Lưu menu thất bại, vui lòng thử lại!")){window.history.back().location.reload();}</script>');
    }
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Menus</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=BASE_URL('views/admin/index.php');?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Menus</li>
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
                                TẠO MENU MỚI
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
                                    <label for="exampleInputEmail1">Tên menu</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên menu cần tạo"
                                        name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Liên kết</label>
                                    <input type="text" class="form-control"
                                        placeholder="Nhập địa chỉ liên kết cần tới khi click vào menu này" name="href"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Icon menu</label>
                                    <input type="text" class="form-control"
                                        placeholder='Ví dụ: <i class="icon-copy dw dw-bookmark"></i>' name="icon"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tìm thêm icon tại đây</label>
                                    <a target="_blank"
                                            href="<?=BASE_URL('views/client/icons.php');?>"><?=BASE_URL('views/client/icons.php');?></a>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="target" value="_blank"
                                        id="customCheckbox2" checked>
                                    <label for="customCheckbox2" class="custom-control-label">Mở tab mới khi
                                        click</label>
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
                                DANH SÁCH MENU
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
                                            <th>HREF</th>
                                            <th>ICON</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `menus` ORDER BY id DESC  ") as $row){
                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$row['name'];?></td>
                                            <td><a href="<?=$row['href'];?>" target="_blank"><?=$row['href'];?></a></td>
                                            <td><textarea class="form-control" rows="1"
                                                    readonly><?=$row['icon'];?></textarea></td>
                                            <td>
                                                <button aria-label="" style="color:white;" data-id="<?=$row['id'];?>"
                                                    data-name="<?=$row['name'];?>" data-href="<?=$row['href'];?>"
                                                    data-icon='<?=$row['icon'];?>' data-target="<?=$row['target'];?>"
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
                            title: "Xác Nhận Xóa Menu",
                            message: "Bạn có chắc chắn muốn xóa menu này không? ",
                            confirmText: "Đồng Ý",
                            cancelText: "Hủy"
                        }).then((e) => {
                            if (e) {
                                $.ajax({
                                    url: "<?=BASE_URL('assets/ajaxs/admin/menu-delete.php');?>",
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
                CHỈNH SỬA MENU
            </div>
            <form action="" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên menu</label>
                        <input type="text" class="form-control" placeholder="Nhập tên menu cần tạo" id="name"
                            name="name" required>
                        <input type="hidden" class="form-control" placeholder="Nhập tên menu cần tạo" id="id" name="id"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Liên kết</label>
                        <input type="text" class="form-control"
                            placeholder="Nhập địa chỉ liên kết cần tới khi click vào menu này" name="href" id="href"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Icon menu</label>
                        <input type="text" class="form-control"
                            placeholder='Ví dụ: <i class="icon-copy dw dw-bookmark"></i>' name="icon" id="icon"
                            required>
                        <i>Tìm thêm icon tại đây: <a target="_blank"
                                href="<?=BASE_URL('views/client/icons.php');?>"><?=BASE_URL('views/client/icons.php');?></a></i>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="target" value="_blank" id="target">
                        <label for="target" class="custom-control-label">Mở tab mới khi click</label>
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
    $("#name").val($(this).attr("data-name"));
    $("#href").val($(this).attr("data-href"));
    $("#icon").val($(this).attr("data-icon"));
    if ($(this).attr("data-target") == "_blank") {
        document.getElementById("target").checked = true;
    }
    $("#staticBackdrop").modal();
});
</script>
<?php
require_once __DIR__.'/footer.php';
?>