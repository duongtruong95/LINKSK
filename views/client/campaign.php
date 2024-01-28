<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login.php';
//require_once __DIR__.'/../../includes/login-admin.php';

$title = 'Bọc link VPCS | '.$CMSNT->site('title');
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
                            <h4>Bọc link VPCS</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('');?>">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Bọc link VPCS</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <h4 class="text-blue text-center h4">LƯU Ý</h4>
                <?=$CMSNT->site('boclink_notice');?>
            </div>
            <!-- Simple Datatable start -->
            <div class="card-box mb-30">
                <div class="pd-20">
                    <?php
                    $result = $CMSNT->get_list("SELECT * FROM `campaigns` WHERE `user_id` = '".$getUser['id']."' AND flg_old = 0 ORDER BY id DESC ");
                    $count = count($result);
                    ?>
                    <h4 class="text-blue h4">DANH SÁCH CHIẾN DỊCH</h4>
                    <h5 class="text-black h4">Số link còn lại có thể tạo: <?= $getUser['max_link'] > $count ? $getUser['max_link'] - $count : 0; ?> link</h5>
                    <p class="mb-0">
                    <?php
                    if ($getUser['max_link'] > $count) {
                        ?>
                        Bạn muốn tạo link mới? <a class="btn btn-primary"
                                                  href="<?=BASE_URL('service/campaign/create');?>">TẠO NGAY</a>
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
                                <th>Transition</th>
                                <th>Name</th>
                                <th>URL 1</th>
                                <th>URL 2</th>
                                <th>Create</th>
                                <th>Update</th>
                                <th>View</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; foreach($CMSNT->get_list("SELECT * FROM `campaigns` WHERE `user_id` = '".$getUser['id']."' ORDER BY id DESC ") as $row ) { ?>
                            <tr>
                                <td class="table-plus"><?=$i++;?></td>
                                <td><a href="<?=BASE_URL('service/campaign/view/'.$row['id']);?>"><?=$row['trans_id'];?></a></td>
                                <td><?=$row['name'];?></td>
                                <td><a href="<?=$row['url_1'];?>" target="_blank"><?=$row['url_1'];?></a></td>
                                <td><a href="<?=$row['url_2'];?>" target="_blank"><?=$row['url_2'];?></a></td>
                                <td><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                                <td><span class="badge badge-danger"><?=$row['updatedate'];?></span></td>
                                <td><i class="icon-copy fa fa-eye mr-1"
                                        aria-hidden="true"></i><?=format_cash($row['views']);?></td>
                                <td><?=status_camp($row['status']);?></td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            href="#" role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            <a class="dropdown-item"
                                                href="<?=BASE_URL('service/campaign/view/'.$row['id']);?>"><i
                                                    class="icon-copy fa fa-desktop" aria-hidden="true"></i> View</a>
                                            <a class="dropdown-item"
                                                href="<?=BASE_URL('service/campaign/edit/'.$row['id']);?>"><i
                                                    class="dw dw-edit2"></i> Edit</a>
                                            <a class="dropdown-item delete" data-id="<?=$row['id'];?>" href="#"><i
                                                    class="dw dw-delete-3"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
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
                title: "XÁC NHẬN XÓA CHIẾN DỊCH",
                message: "Bạn có chắc muốn xóa chiến dịch này không?",
                confirmText: "Đồng Ý",
                cancelText: "Hủy"
            }).then((e) => {
                if (e) {
                    $.ajax({
                        url: "<?=BASE_URL("assets/ajaxs/client/delete-campaign.php");?>",
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
        <?php
require_once __DIR__.'/footer.php';
?>