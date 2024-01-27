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
    $months = $_POST['months'] ?? [];
    $amounts = $_POST['amounts'] ?? [];

    $month_amounts = [];
    foreach ($months as $key => $item) {
        $month_amounts[] = [
            'month' => $item,
            'amount' => $amounts[$key] ?? 0,
        ];
    }
    $isCreate = $CMSNT->insert("packages", [
        'name' => check_string($_POST['name']),
        'number_link' => $_POST['number_link'],
        'content' => json_encode($_POST['content']),
        'months' => json_encode($_POST['months']),
        'amounts' => json_encode($_POST['amounts']),
        'month_amounts' => json_encode($month_amounts),
        'is_trial_package' => $_POST['is_trial_package']
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
    $months = $_POST['months'] ?? [];
    $amounts = $_POST['amounts'] ?? [];

    $month_amounts = [];
    foreach ($months as $key => $item) {
        $month_amounts[] = [
            'month' => $item,
            'amount' => $amounts[$key] ?? 0,
        ];
    }
    $isCreate = $CMSNT->update("packages", [
        'name' => check_string($_POST['name']),
        'number_link' => $_POST['number_link'],
        'content' => json_encode($_POST['content'] ?? []),
        'months' => json_encode($_POST['months'] ?? []),
        'amounts' => json_encode($_POST['amounts'] ?? []),
        'month_amounts' => json_encode($month_amounts),
        'is_trial_package' => $_POST['is_trial_package'] ?? 0
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
<!--                                <div class="form-group">-->
<!--                                    <label for="exampleInputEmail1">Thời hạn</label>-->
<!--                                    <input type="number" class="form-control"-->
<!--                                        placeholder="Nhập thời gian hết hạn của gói" name="expired" required>-->
<!--                                </div>-->
<!--                                <div class="form-group">-->
<!--                                    <label for="exampleInputEmail1">Số tiền</label>-->
<!--                                    <input type="number" class="form-control" placeholder="Nhập giá tiền của gói"-->
<!--                                        name="price" required>-->
<!--                                </div>-->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng link</label>
                                    <input type="number" class="form-control" placeholder="Nhập số link có thể dùng"
                                           name="number_link" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhập các nội dung hiển thị ở gói</label>
                                    <div id="dynamic-inputs">
                                        <div class="input-group mr-bottom">
                                            <input type="text" class="form-control" placeholder="Nhập mục" name="content[]" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-input">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="add-input">Thêm mục nội dung</button>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhập số tháng và tiền theo gói</label>
                                    <div id="dynamic-inputs-2">
                                        <div class="input-group mr-bottom">
                                            <input type="number" class="form-control" placeholder="Số tháng" name="months[]" required>
                                            <input type="number" class="form-control" placeholder="Số tiền" name="amounts[]" required>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-input-2">Xóa</button>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" id="add-input-2">Thêm mục tháng và tiền</button>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gói dùng thử</label>
                                    <input type="checkbox" class="form-control" value="1"
                                           name="is_trial_package" >
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
                                            <th>Tên gói</th>
                                            <th>Thông tin gói</th>
                                            <th>Các giá gói</th>
                                            <th>Số lượng link</th>
                                            <th>Gói dùng thử</th>
                                            <th>Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `packages` ORDER BY id DESC  ") as $row){
                                        $content = json_decode($row['content']) ?? [];
                                        $htmlContent = '';
                                        foreach ($content as $item) {
                                            $htmlContent .= '<p>★ '.$item.'</p>';
                                        }
                                        $moneyMonth = json_decode($row['month_amounts']) ?? [];
                                        $months = json_decode($row['months']) ?? [];
                                        $amounts = json_decode($row['amounts']) ?? [];
                                        $htmlMoneyMonth = '';
                                        foreach ($moneyMonth as $item) {
                                            $htmlMoneyMonth .= '<p>'.$item->month.' tháng - ' . format_currency($item->amount) .'</p>';
                                        }
                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$row['name'];?></td>
                                            <td><?=$htmlContent;?></td>
                                            <td><?=$htmlMoneyMonth?></td>
                                            <td><?=$row['number_link'];?></td>
                                            <td><?=$row['is_trial_package'] ? 'Bản Trải Nghiệm' : '';?></td>
                                            <td>
                                                <?php
                                                    foreach ($content as $item) {
                                                        echo '<input type="hidden" class="'.$row['id'].'-content" name="content[]" value="'.$item.'" >';
                                                    }
                                                    foreach ($moneyMonth as $item) {
                                                        echo '<input type="hidden" class="'.$row['id'].'-month_amounts" name="month_amounts[]" data-amount="'.$item->amount.'" data-month="'.$item->month.'" >';
                                                    }
                                                ?>
                                                <button aria-label="" style="color:white;" data-id="<?=$row['id'];?>"
                                                    data-name="<?=$row['name'];?>" data-expired="<?=$row['expired'];?>"
                                                    data-price="<?=$row['price'];?>"
                                                    data-trial="<?=$row['is_trial_package'];?>"
                                                    data-link="<?=$row['number_link'];?>"
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
                        $('#add-input').click(function () {
                            var inputGroup = $('<div class="input-group mr-bottom"></div>');
                            var input = $('<input type="text" class="form-control" placeholder="Nhập mục" name="content[]" required>');
                            var button = $('<button type="button" class="btn btn-danger remove-input">Xóa</button>');
                            button.click(function () {
                                $(this).closest('.input-group').remove();
                            });
                            inputGroup.append(input);
                            inputGroup.append($('<div class="input-group-append"></div>').append(button));
                            $('#dynamic-inputs').append(inputGroup);
                        });
                        $(document).on('click', '.remove-input', function () {
                            $(this).closest('.input-group').remove();
                        });

                        $('#add-input-2').click(function () {
                            var inputGroup = $('<div class="input-group mr-bottom"></div>');
                            var inputMonths = $('<input type="number" class="form-control" placeholder="Số tháng" name="months[]" required>');
                            var inputAmounts = $('<input type="number" class="form-control" placeholder="Số tiền" name="amounts[]" required>');
                            var button = $('<button type="button" class="btn btn-danger remove-input-2">Xóa</button>');
                            button.click(function () {
                                $(this).closest('.input-group').remove();
                            });
                            inputGroup.append(inputMonths);
                            inputGroup.append(inputAmounts);
                            inputGroup.append($('<div class="input-group-append"></div>').append(button));
                            $('#dynamic-inputs-2').append(inputGroup);
                        });
                        $(document).on('click', '.remove-input-2', function () {
                            $(this).closest('.input-group').remove();
                        });
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
<!--                    <div class="form-group">-->
<!--                        <label for="exampleInputEmail1">Thời hạn</label>-->
<!--                        <input type="number" class="form-control" placeholder="Nhập thời gian hết hạn của gói"-->
<!--                            id="expired" name="expired" required>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="exampleInputEmail1">Số tiền</label>-->
<!--                        <input type="number" class="form-control" placeholder="Nhập giá tiền của gói" id="price"-->
<!--                               name="price" required>-->
<!--                    </div>-->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng link</label>
                        <input type="number" class="form-control" placeholder="Nhập số link có thể dùng" id="number_link"
                            name="number_link" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nhập các nội dung hiển thị ở gói</label>
                        <div id="dynamic-inputs-edit">
                        </div>
                        <button type="button" class="btn btn-primary" id="add-input-edit">Thêm mục nội dung</button>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Nhập số tháng và tiền theo gói</label>
                        <div id="dynamic-inputs-2-edit">
                        </div>
                        <button type="button" class="btn btn-primary" id="add-input-2-edit">Thêm mục tháng và tiền</button>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Gói dùng thử</label>
                        <input type="checkbox" class="form-control" id="is_trial_package" value="1"
                            name="is_trial_package">
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
    $('#add-input-edit').click(function () {
        var inputGroup = $('<div class="input-group mr-bottom"></div>');
        var input = $('<input type="text" class="form-control" placeholder="Nhập mục" name="content[]" required>');
        var button = $('<button type="button" class="btn btn-danger remove-input-edit">Xóa</button>');
        button.click(function () {
            $(this).closest('.input-group').remove();
        });
        inputGroup.append(input);
        inputGroup.append($('<div class="input-group-append"></div>').append(button));
        $('#dynamic-inputs-edit').append(inputGroup);
    });
    $(document).on('click', '.remove-input-edit', function () {
        $(this).closest('.input-group').remove();
    });

    $('#add-input-2-edit').click(function () {
        var inputGroup = $('<div class="input-group mr-bottom"></div>');
        var inputMonths = $('<input type="number" class="form-control" placeholder="Số tháng" name="months[]" required>');
        var inputAmounts = $('<input type="number" class="form-control" placeholder="Số tiền" name="amounts[]" required>');
        var button = $('<button type="button" class="btn btn-danger remove-input-2-edit">Xóa</button>');
        button.click(function () {
            $(this).closest('.input-group').remove();
        });
        inputGroup.append(inputMonths);
        inputGroup.append(inputAmounts);
        inputGroup.append($('<div class="input-group-append"></div>').append(button));
        $('#dynamic-inputs-2-edit').append(inputGroup);
    });
    $(document).on('click', '.remove-input-2-edit', function () {
        $(this).closest('.input-group').remove();
    });
$(".edit").on("click", function() {
    $("#id").val($(this).attr("data-id"));
    $("#name").val($(this).attr("data-name"));
    $("#expired").val($(this).attr("data-expired"));
    $("#price").val($(this).attr("data-price"));
    $("#price").val($(this).attr("data-price"));
    $("#number_link").val($(this).attr("data-link"));
    if ($(this).attr("data-trial") == 1) {
        $("#is_trial_package").prop('checked', true);
    }
    var idRow = $(this).attr("data-id");
    $('.' + idRow + '-content').each(function () {
        var value = $(this).val();
        var inputGroup = $('<div class="input-group mr-bottom"></div>');
        var input = $('<input type="text" class="form-control" placeholder="Nhập mục" name="content[]" value="'+value+'" required>');
        var button = $('<button type="button" class="btn btn-danger remove-input-edit">Xóa</button>');
        button.click(function () {
            $(this).closest('.input-group').remove();
        });
        inputGroup.append(input);
        inputGroup.append($('<div class="input-group-append"></div>').append(button));
        $('#dynamic-inputs-edit').append(inputGroup);
    });
    $('.' + idRow + '-month_amounts').each(function () {
        var month = $(this).data('month');
        var amount = $(this).data('amount');
        var inputGroup = $('<div class="input-group mr-bottom"></div>');
        var inputMonths = $('<input type="number" class="form-control" placeholder="Số tháng" name="months[]" value="'+month+'" required>');
        var inputAmounts = $('<input type="number" class="form-control" placeholder="Số tiền" name="amounts[]" value="'+amount+'" required>');
        var button = $('<button type="button" class="btn btn-danger remove-input-2-edit">Xóa</button>');
        button.click(function () {
            $(this).closest('.input-group').remove();
        });
        inputGroup.append(inputMonths);
        inputGroup.append(inputAmounts);
        inputGroup.append($('<div class="input-group-append"></div>').append(button));
        $('#dynamic-inputs-2-edit').append(inputGroup);
    });

    $('#staticBackdrop').on('hidden.bs.modal', function () {
        $('#dynamic-inputs-edit').html('');
        $('#dynamic-inputs-2-edit').html('');
    });

    $("#staticBackdrop").modal();
});
</script>
<?php
require_once __DIR__.'/footer.php';
?>