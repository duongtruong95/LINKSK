<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login-admin.php';
$title = 'Ngân hàng | CMSNT Panel';
$header = '';
$footer = '';
require_once __DIR__.'/header.php';
require_once __DIR__.'/sidebar.php';
require_once __DIR__.'/../../includes/checkLicense.php';

if(isset($_POST['create']))
{
    $isCreate = $CMSNT->insert("banks", [
        'bank_name' => check_string($_POST['bank_name']),
        'account_name' => check_string($_POST['account_name']),
        'account_number' => check_string($_POST['account_number']),
        'branch' => check_string($_POST['branch'])
    ]);
    if($isCreate)
    {
        admin_msg_success("Thêm ngân hàng thành công!", "", 1000);
    }
    else
    {
        die('<script type="text/javascript">if(!alert("Thêm ngân hàng thất bại, vui lòng thử lại!")){window.history.back().location.reload();}</script>');
    }
}
if(isset($_POST['save']))
{
    $isCreate = $CMSNT->update("banks", [
        'bank_name' => check_string($_POST['bank_name']),
        'account_name' => check_string($_POST['account_name']),
        'account_number' => check_string($_POST['account_number']),
        'branch' => check_string($_POST['branch'])
    ], " `id` = '".check_string($_POST['id'])."' ");
    if($isCreate)
    {
        admin_msg_success("Lưu ngân hàng thành công!", "", 1000);
    }
    else
    {
        die('<script type="text/javascript">if(!alert("Lưu ngân hàng thất bại, vui lòng thử lại!")){window.history.back().location.reload();}</script>');
    }
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ngân hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=BASE_URL('views/admin/index.php');?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Ngân hàng</li>
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
                                THÊM NGÂN HÀNG
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
                                    <label for="exampleInputEmail1">Tên ngân hàng</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên ngân hàng cần thêm"
                                        name="bank_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên chủ tài khoản</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên chủ tài khoản của bạn"
                                        name="account_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số tài khoản</label>
                                    <input type="text" class="form-control" placeholder="Nhập số tài khoản của bạn"
                                        name="account_number" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chi nhánh</label>
                                    <input type="text" class="form-control" placeholder="Nhập chi nhánh nếu có"
                                        name="branch">
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <button type="submit" name="create" class="btn btn-primary"><i
                                        class="fas fa-plus mr-1"></i>TẠO NGAY</button>
                            </div>
                        </form>
                    </div>
                </section>
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list mr-1"></i>
                                DANH SÁCH NGÂN HÀNG
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
                                            <th>BANK NAME</th>
                                            <th>ACCOUNT NAME</th>
                                            <th>ACCOUNT NUMBER</th>
                                            <th>BRANCH</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `banks` ORDER BY id DESC  ") as $row){
                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$row['bank_name'];?></td>
                                            <td><?=$row['account_name'];?></td>
                                            <td><?=$row['account_number'];?></td>
                                            <td><?=$row['branch'];?></td>
                                            <td>
                                                <button aria-label="" style="color:white;" data-id="<?=$row['id'];?>"
                                                    data-bank_name="<?=$row['bank_name'];?>"
                                                    data-account_name="<?=$row['account_name'];?>"
                                                    data-account_number="<?=$row['account_number'];?>"
                                                    data-branch="<?=$row['branch'];?>"
                                                    class="btn btn-info btn-icon-left m-b-10 edit" type="button">
                                                    <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                                                </button>
                                                <button aria-label="" style="color:white;" data-id="<?=$row['id'];?>"
                                                    class="delete btn btn-danger btn-icon-left m-b-10" type="button">
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
                    <!-- Modal -->
                    <div class="modal fade bs-example-modal-lg" id="staticBackdrop" tabindex="-1" role="dialog"
                        aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    CHỈNH SỬA NGÂN HÀNG
                                </div>
                                <form action="" method="POST">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên ngân hàng</label>
                                            <input type="text" class="form-control"
                                                placeholder="Nhập tên ngân hàng cần thêm" id="bank_name"
                                                name="bank_name" required>
                                            <input type="hidden" name="id" id="id" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên chủ tài khoản</label>
                                            <input type="text" class="form-control"
                                                placeholder="Nhập tên chủ tài khoản của bạn" name="account_name"
                                                id="account_name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Số tài khoản</label>
                                            <input type="text" class="form-control"
                                                placeholder="Nhập số tài khoản của bạn" name="account_number"
                                                id="account_number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Chi nhánh</label>
                                            <input type="text" class="form-control" placeholder="Nhập chi nhánh nếu có"
                                                id="branch" name="branch">
                                        </div>
                                    </div>
                                    <div class="card-footer clearfix">
                                        <button aria-label="" name="save" class="btn btn-info btn-icon-left m-b-10"
                                            type="submit"><i class="fas fa-save mr-1"></i>Lưu Ngay</button>
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
                        $("#bank_name").val($(this).attr("data-bank_name"));
                        $("#account_name").val($(this).attr("data-account_name"));
                        $("#account_number").val($(this).attr("data-account_number"));
                        $("#branch").val($(this).attr("data-branch"));
                        $("#staticBackdrop").modal();
                    });
                    </script>
                    <script type="text/javascript">
                    $(".delete").on("click", function() {
                        cuteAlert({
                            type: "question",
                            title: "Xác Nhận Xóa Ngân Hàng",
                            message: "Bạn có chắc chắn muốn xóa ngân hàng này không? ",
                            confirmText: "Đồng Ý",
                            cancelText: "Hủy"
                        }).then((e) => {
                            if (e) {
                                $.ajax({
                                    url: "<?=BASE_URL("assets/ajaxs/admin/bank-delete.php");?>",
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



<?php
require_once __DIR__.'/footer.php';
?>