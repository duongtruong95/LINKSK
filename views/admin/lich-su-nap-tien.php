<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login-admin.php';
$title = 'Lịch sử nạp tiền | CMSNT Panel';
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

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lịch sử nạp tiền</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=BASE_URL('views/admin/index.php');?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Lịch sử nạp tiền</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-history mr-1"></i>
                                LỊCH SỬ NẠP BANK AUTO
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
                                            <th>MÃ GD</th>
                                            <th>NGÂN HÀNG</th>
                                            <th>MONEY</th>
                                            <th>NỘI DUNG</th>
                                            <th>THỜI GIAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; foreach($CMSNT->get_list(" SELECT * FROM `bank_logs` ORDER BY id DESC ") as $row){ ?>
                                        <tr>
                                            <td width="5%"><?=$i++;?></td>
                                            <td>
                                                <a href="<?=BASE_URL('views/admin/edit-user.php?id='.$row['user_id']);?>"><?=getUser($row['user_id'], 'username');?></a>
                                            </td>
                                            <td><?=$row['tid'];?></td>
                                            <td><?=$row['bank_name'];?></td>
                                            <td><?=$row['amount'];?></td>
                                            <td><?=$row['description'];?></td>
                                            <td><?=$row['time'];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-history mr-1"></i>
                                LỊCH SỬ NẠP MOMO AUTO
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
                                <table id="example2" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>USERNAME</th>
                                            <th>MÃ GD</th>
                                            <th>SDT</th>
                                            <th>TÊN</th>
                                            <th>MONEY</th>
                                            <th>NỘI DUNG</th>
                                            <th>THỜI GIAN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; foreach($CMSNT->get_list(" SELECT * FROM `momo_logs` ORDER BY id DESC ") as $row){ ?>
                                        <tr>
                                            <td width="5%"><?=$i++;?></td>
                                            <td>
                                                <a href="<?=BASE_URL('views/admin/edit-user.php?id='.$row['user_id']);?>"><?=getUser($row['user_id'], 'username');?></a>
                                            </td>
                                            <td><?=$row['tranId'];?></td>
                                            <td><?=$row['partnerId'];?></td>
                                            <td><?=$row['partnerName'];?></td>
                                            <td><?=$row['amount'];?></td>
                                            <td><?=$row['comment'];?></td>
                                            <td><?=$row['time'];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
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



<script>
$(function() {
    $("#example1").DataTable({
        "responsive": false,
        "lengthChange": false,
        "searching": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $("#example2").DataTable({
        "responsive": false,
        "lengthChange": false,
        "searching": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
});
</script>
<?php
require_once __DIR__.'/footer.php';
?>