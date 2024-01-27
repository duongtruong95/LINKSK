<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login-admin.php';
$title = 'Fake Link | CMSNT Panel';
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
                    <h1 class="m-0">Quản lý fake link</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=BASE_URL('views/admin/index.php');?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Quản lý fake link</li>
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
                                DANH SÁCH CHIẾN DỊCH
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
                                            <th class="table-plus datatable-nosort">#</th>
                                            <th>Username</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Link Fake</th>
                                            <th>Link Gốc</th>
                                            <th>Views</th>
                                            <th>Status</th>
                                            <th>Createdate</th>
                                            <th class="datatable-nosort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0; foreach($CMSNT->get_list("SELECT * FROM `links` ORDER BY `id` DESC ") as $row){?>
                                        <tr>
                                            <td class="table-plus"><?=$i++;?></td>
                                            <td>
                                                <a
                                                    href="<?=BASE_URL('views/admin/edit-user.php?id='.$row['user_id']);?>"><?=getUser($row['user_id'], 'username');?></a>
                                            </td>
                                            <td><?=$row['title'];?></td>
                                            <td><?=$row['description'];?></td>
                                            <td><img src="<?=BASE_URL($row['url_img']);?>" width="100px" /></td>
                                            <td><a href="<?=BASE_URL('i/'.$row['url_fake']);?>"
                                                    target="_blank"><?=BASE_URL('i/'.$row['url_fake']);?></a></td>
                                            <td><a href="<?=$row['url_href'];?>"
                                                    target="_blank"><?=$row['url_href'];?></a></td>
                                            <td><i class="icon-copy fa fa-eye mr-1"
                                                    aria-hidden="true"></i><?=format_cash($CMSNT->num_rows("SELECT * FROM `link_views` WHERE `link_id` = '".$row['id']."'  "));?></td>
                                            <td><?=status_camp($row['status']);?></td>
                                            <td><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                                            <td>
                                                <button class="btn btn-danger delete" data-id="<?=$row['id'];?>"
                                                    type="button"><i class="fas fa-trash mr-1"></i>Delete</button>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="table-plus datatable-nosort">#</th>
                                            <th>Username</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Link Fake</th>
                                            <th>Link Gốc</th>
                                            <th>Views</th>
                                            <th>Status</th>
                                            <th>Createdate</th>
                                            <th class="datatable-nosort">Action</th>
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

<script type="text/javascript">
$(".delete").on("click", function() {
    cuteAlert({
        type: "question",
        title: "XÁC NHẬN XÓA LINK",
        message: "Bạn có chắc muốn xóa link này không?",
        confirmText: "Đồng Ý",
        cancelText: "Hủy"
    }).then((e) => {
        if (e) {
            $.ajax({
                url: "<?=BASE_URL("assets/ajaxs/admin/delete-fake-link.php");?>",
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
                            timer: 3000
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

<script>
$(function() {
    $("#example1").DataTable({
        "responsive": false,
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