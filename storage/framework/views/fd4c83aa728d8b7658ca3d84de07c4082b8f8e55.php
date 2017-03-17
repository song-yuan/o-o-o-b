<?php $__env->startSection('title', '注册会员'); ?>
<?php $__env->startSection('content'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Static Tables</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a>Tables</a>
            </li>
            <li class="active">
                <strong>Static Tables</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>注册会员列表</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-3 pull-right">
                            <form>
                            <div class="input-group">
                                <input type="text" name="mobile" value="<?php echo $mobile;?>" placeholder="Search" class="input-sm form-control">
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-sm btn-primary"> 搜索 </button> 
                                </span>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th></th>
                                <th>ID </th>
                                <th>姓名 </th>
                                <th>手机</th>
                                <th>邮箱</th>
                                <th>日期</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($users as $user):?>
                            <tr>
                                <td><input type="checkbox" class="i-checks" name="input[]" value="<?php echo $user->user_id;?>"></td>
                                <td><?php echo $user->user_id;?></td>
                                <td><?php echo $user->user_name;?></td>
                                <td><?php echo $user->mobile;?></td>
                                <td><?php echo $user->email;?></td>
                                <td><?php echo $user->created_at;?></td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="" style="text-align:right">
                        <?php echo $users->appends(array('mobile' => $mobile))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="bill_log" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeIn">

            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('scripts'); ?>
@parent
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>