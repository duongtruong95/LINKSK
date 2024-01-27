<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../functions/dashboard.php';
//require_once __DIR__.'/../../includes/login.php';
require_once __DIR__.'/../../includes/login-admin.php';

$title = 'Dashbroad | CMSNT Panel';
$header = '
    <!-- DataTables -->
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
';
$footer = '
    <!-- DataTables  & Plugins -->
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/jszip/jszip.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/pdfmake/pdfmake.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/pdfmake/vfs_fonts.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-primary" type="button" data-toggle="modal"
                            data-target="#modal-default">CẬP NHẬT PHIÊN BẢN</button>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div id="thongbao"></div>
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?=format_currency(total_deposit());?>
                            </h3>
                            <p>Tổng tiền nạp</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?=format_currency($CMSNT->get_row("SELECT SUM(`money`) FROM `users` ")['SUM(`money`)']);?>
                            </h3>

                            <p>Số dư còn lại</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?=format_cash(total_users());?></h3>
                            <p>Thành Viên</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?=format_cash($CMSNT->num_rows("SELECT * FROM `campaigns` ") + $CMSNT->num_rows("SELECT * FROM `links` "));?>
                            </h3>
                            <p>Lượt sử dụng dịch vụ</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-globe-asia"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Đang online</span>
                            <span class="info-box-number">
                                <?=format_cash(total_online());?>
                                <small>user</small>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-globe-asia"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Online hôm nay</span>
                            <span class="info-box-number">
                                <?=format_cash(total_online_today());?>
                                <small>user</small>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-globe-asia"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Online trong tuần</span>
                            <span class="info-box-number">
                                <?=format_cash(total_online_week());?>
                                <small>user</small>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-globe-asia"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Online trong tháng</span>
                            <span class="info-box-number">
                                <?=format_cash(total_online_month());?>
                                <small>user</small>
                            </span>
                        </div>
                    </div>
                </div>
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                TỔNG NẠP HÔM NAY
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
                            <div class="chart">
                                <canvas id="TongNapToDay"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                TỔNG NẠP TUẦN NÀY
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
                            <div class="chart">
                                <canvas id="TongNapTrongTuan"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                TỔNG NẠP THÁNG NÀY
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
                            <div class="chart">
                                <canvas id="TongNapTrongThang"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-4 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="fa-solid fa-eye mr-1"></i>
                                READERS
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
                             <div id="live-online-fakelink"></div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-history mr-1"></i>
                                LỊCH SỬ DÒNG TIỀN GẦN ĐÂY
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
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>USERNAME</th>
                                            <th>SỐ TIỀN TRƯỚC</th>
                                            <th>SỐ TIỀN THAY ĐỔI</th>
                                            <th>SỐ TIỀN HIỆN TẠI</th>
                                            <th>THỜI GIAN</th>
                                            <th>NỘI DUNG</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `dongtien` ORDER BY id DESC LIMIT 500 ") as $row){
                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td>
                                                <a
                                                    href="<?=BASE_URL('views/admin/edit-user.php?id='.$row['user_id']);?>"><?=getUser($row['user_id'], 'username');?></a>
                                            </td>
                                            <td><b style="color: yellow;"><?=format_cash($row['sotientruoc']);?></b></td>
                                            <td><b style="color: red;"><?=format_cash($row['sotienthaydoi']);?></b></td>
                                            <td><b style="color: green;"><?=format_cash($row['sotiensau']);?></b></td>
                                            <td><span class="badge badge-dark"><?=$row['thoigian'];?></span></td>
                                            <td><?=$row['noidung'];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>STT</th>
                                            <th>USERNAME</th>
                                            <th>SỐ TIỀN TRƯỚC</th>
                                            <th>SỐ TIỀN THAY ĐỔI</th>
                                            <th>SỐ TIỀN HIỆN TẠI</th>
                                            <th>THỜI GIAN</th>
                                            <th>NỘI DUNG</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cập nhật phiên bản</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Phiên bản hiện tại của bạn là <b style="color: yellow;font-size:20px"><?=$config['version'];?></b>
                    phiên bản mới nhất
                    <b
                        style="color:#ff5667;font-size:20px"><?php echo $new_version = file_get_contents('http://api.cmsnt.co/version.php?version='.$config['project']);?></b>.
                </p>
                <p>Chi tiết bản cập nhật:</p>
                <ul>
                    <li>...</li>
                </ul>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <button type="button" id="update" class="btn btn-primary">Cập nhật ngay</button>
            </div>
        </div>
    </div>
</div>


<!-- ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO: 0947838128 | FACEBOOK: FB.COM/NTGTANETWORK -->
<script type="text/javascript">
$("#update").on("click", function() {
    $('#update').html(
        'Đang tải bản cập nhật <div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div>'
    ).prop('disabled',
        true);
    Swal.fire({
        title: 'UPDATE',
        text: 'Đang tải bản cập nhật vui lòng đợi...',
        imageUrl: 'https://c.tenor.com/VLLJuwYmqkkAAAAM/error-wait.gif',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
    })
    $.ajax({
        url: "<?=BASE_URL("Update.php");?>",
        method: "POST",
        data: {
            type: 'update'
        },
        success: function(response) {
            $("#thongbao").html(response);
            $('#update').html(
                    'Cập nhật ngay')
                .prop('disabled', false);
        }
    });
});
</script>


<script>
$(function() {
    var donutChartCanvas = $('#TongNapToDay').get(0).getContext('2d')
    var donutData = {
        labels: [
            'Nạp tiền từ ngân hàng',
            'Nạp tiền từ ví momo',
        ],
        datasets: [{
            data: [
                <?=$CMSNT->get_row("SELECT SUM(`amount`) FROM `bank_logs` WHERE `time` >= DATE(NOW()) AND `time` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`amount`)'];?>,
                <?=$CMSNT->get_row("SELECT SUM(`amount`) FROM `momo_logs` WHERE `time` >= DATE(NOW()) AND `time` < DATE(NOW()) + INTERVAL 1 DAY ")['SUM(`amount`)'];?>,
            ],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }]
    }
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })
})
</script>
<script>
$(function() {
    var donutChartCanvas = $('#TongNapTrongTuan').get(0).getContext('2d')
    var donutData = {
        labels: [
            'Nạp tiền từ ngân hàng',
            'Nạp tiền từ ví momo',
        ],
        datasets: [{
            data: [
                <?=$CMSNT->get_row("SELECT SUM(`amount`) FROM `bank_logs` WHERE WEEK(time, 1) = WEEK(CURDATE(), 1) ")['SUM(`amount`)'];?>,
                <?=$CMSNT->get_row("SELECT SUM(`amount`) FROM `momo_logs` WHERE WEEK(time, 1) = WEEK(CURDATE(), 1) ")['SUM(`amount`)'];?>,
            ],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }]
    }
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })
})
</script>
<script>
$(function() {
    var donutChartCanvas = $('#TongNapTrongThang').get(0).getContext('2d')
    var donutData = {
        labels: [
            'Nạp tiền từ ngân hàng',
            'Nạp tiền từ ví momo',
        ],
        datasets: [{
            data: [
                <?=$CMSNT->get_row("SELECT SUM(`amount`) FROM `bank_logs` WHERE YEAR(time) = ".date('Y')." AND MONTH(time) = ".date('m')." ")['SUM(`amount`)'];?>,
                <?=$CMSNT->get_row("SELECT SUM(`amount`) FROM `momo_logs` WHERE YEAR(time) = ".date('Y')." AND MONTH(time) = ".date('m')." ")['SUM(`amount`)'];?>,
            ],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }]
    }
    var donutOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    new Chart(donutChartCanvas, {
        type: 'doughnut',
        data: donutData,
        options: donutOptions
    })
})
</script>

<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "searching": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>

<?php
require_once __DIR__.'/footer.php';
?>

<?php if($new_version != $config['version']){?>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(e => {
        showlog()
    }, 1000)
});

function showlog() {
    $('#modal-default').modal({
        keyboard: true,
        show: true
    });
}
</script>
<?php }?>


<script type="text/javascript">
function loadOnlineFakeLink()
{
    $.ajax({
        url: "<?=BASE_URL('assets/ajaxs/admin/live-online-fakelink.php');?>",
        type: "GET",
        dateType: "text",
        data: {},
        success: function(result) {
            $('#live-online-fakelink').html(result);
        }
    });
}
setInterval(function() { $('#live-online-fakelink').load(loadOnlineFakeLink()); }, 2000);
</script>