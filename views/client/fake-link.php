<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login.php';
//require_once __DIR__.'/../../includes/login-admin.php';

$title = 'Fake Link Chống Spam | '.$CMSNT->site('title');
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
                            <h4>Fake link spam</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('');?>">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Fake link</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <h4 class="text-blue text-center h4">LƯU Ý</h4>
                <?=$CMSNT->site('fakelink_notice');?>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <?php
                    $result = $CMSNT->get_list("SELECT * FROM `links` WHERE `user_id` = '".$getUser['id']."' ORDER BY id DESC ");
                    $count = count($result);
                    ?>
                    <h4 class="text-blue h4">DANH SÁCH LINK</h4>
                    <h5 class="text-black h4">Số link còn lại có thể tạo: <?= $getUser['max_link'] > $count ? $getUser['max_link'] - $count : 0; ?> link</h5>
                    <p class="mb-0">
                    <?php
                    if ($getUser['max_link'] > $count) {
                        ?>
                        Bạn muốn tạo link mới? <a class="btn btn-primary"
                                                                  href="<?=BASE_URL('service/fake-link/create');?>">TẠO NGAY</a>
                    <?php } else { ?>
                    <p style="color: red; font-style: italic;">NOTE: <b>Bạn vui lòng mua thêm gói để có thể tạo link mới!</b></p>
                    <?php } ?>
                    </p>
                </div>
                <div class="pb-20 table-responsive">
                    <table class="table hover multiple-select-row data-table-export nowrap ">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">#</th>
                                <th class="datatable-nosort">Action</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Link fake</th>
                                <th>Link gốc</th>
                                <th>View</th>
                                <th>Status</th>
                                <th>Createdate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; foreach($CMSNT->get_list("SELECT * FROM `links` WHERE `user_id` = '".$getUser['id']."' ORDER BY `id` DESC ") as $row){?>
                            <tr>
                                <td class="table-plus"><?=$i++;?></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item"
                                                href="<?=BASE_URL('service/fake-link/view/'.$row['id']);?>"><i
                                                    class="icon-copy fa fa-desktop" aria-hidden="true"></i> View</a>
                                            <a class="dropdown-item"
                                                href="<?=BASE_URL('service/fake-link/edit/'.$row['id']);?>"><i
                                                    class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item clone" data-id="<?=$row['id'];?>" href="#"><i
                                                    class="dw dw-copy"></i> Clone</a>
                                            <a class="dropdown-item modal-clones" data-id="<?=$row['id'];?>"
                                                data-link="<?=$row['domain'].'/'.$row['url_fake'];?>"
                                                href="#"><i class="dw dw-copy"></i> Clone SLL</a>
                                            <a class="dropdown-item delete" data-id="<?=$row['id'];?>" href="#"><i
                                                    class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                                <td><?=$row['title'];?></td>
                                <td><?=$row['description'];?></td>
                                <td><img src="<?=BASE_URL($row['url_img']);?>" width="100px" /></td>
                                <td><a href="<?=$row['domain'].'/'.$row['url_fake'];?>"
                                        target="_blank"><?=$row['domain'].'/'.$row['url_fake'];?></a></td>
                                <td><a href="<?=$row['url_href'];?>" target="_blank"><?=$row['url_href'];?></a></td>
                                <td><i class="icon-copy fa fa-eye mr-1"
                                        aria-hidden="true"></i><?=format_cash($CMSNT->num_rows("SELECT * FROM `link_views` WHERE `link_id` = '".$row['id']."'  "));?></td>
                                <td><?=status_camp($row['status']);?></td>
                                <td><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Simple Datatable End -->
        </div>

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
                        url: "<?=BASE_URL("assets/ajaxs/client/delete-fake-link.php");?>",
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
        <script type="text/javascript">
        $(".clone").on("click", function() {
            $.ajax({
                url: "<?=BASE_URL("assets/ajaxs/client/clone-fake-link.php");?>",
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
        });
        </script>
        <!-- Modal Clones-->
        <div class="modal fade" id="modal-clones" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div id="thongbao"></div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">Link cần clone</label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control" id="link" readonly>
                                <input type="hidden" value="" readonly  class="form-control" id="id_clones">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-4 col-form-label">Số lượng cần clone</label>
                            <div class="col-sm-12 col-md-8">
                                <input type="text" class="form-control" value="1" id="amount_clones" >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="btn-clones">Tạo ngay</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <!-- Modal Success Clones-->
        <div class="modal fade" id="modal-success-clones" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-12 col-form-label">Danh sách link đã clone</label>
                            <div class="col-sm-12 col-md-12">
                                <textarea class="form-control" id="list_link" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger copy" data-clipboard-target="#list_link">Copy tất cả</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <script type="text/javascript">
        $(".modal-clones").on("click", function() {
            var btn = $(this);
            $("#link").val(btn.attr("data-link"));
            $("#id_clones").val(btn.attr("data-id"));
            $('#modal-clones').modal({
                keyboard: true,
                show: true
            });
        });
        </script>
        <script type="text/javascript">
        $("#btn-clones").on("click", function() {
            $.ajax({
                url: "<?=BASE_URL("assets/ajaxs/client/clones-fake-link.php");?>",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: $("#id_clones").val(),
                    amount: $("#amount_clones").val()
                },
                success: function(respone) {
                    if (respone.status == 'success') {
                        cuteToast({
                            type: "success",
                            message: respone.msg,
                            timer: 3000
                        });
                        $("#list_link").val(respone.list);
                        $('#modal-clones').modal('hide');
                        $('#modal-success-clones').modal('show');
                        //location.reload();
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
        });
        </script>
<?php
    require_once __DIR__.'/footer.php';
?>