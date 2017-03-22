<?php $__env->startSection('title', '快递单'); ?>
<?php $__env->startSection('styles'); ?>
@parent
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>快递单管理</h2>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo url('/');?>">首页</a>
            </li>
            <li class="active">
                <strong>快递单管理</strong>
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
                    <h5>快递单列表</h5>
                    <div class="pull-right">
                        <div class="input-group">
                            <a href="<?php echo url('role/create');?>" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#role_form">新 建</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>ID </th>
                                <th>名称</th>
                                <th>显示名称</th>
                                <th>描述</th>
                                <th>创建日期</th>
                                <th>修改日期</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($roles as $role):?>
                            <tr>
                                <td><?php echo $role->id;?></td>
                                <td><?php echo $role->name;?></td>
                                <td><?php echo $role->display_name;?></td>
                                <td><?php echo $role->description;?></td>
                                <td><?php echo $role->created_at;?></td>
                                <td><?php echo $role->updated_at;?></td>
                                <td>
                                    <a href="<?php echo url('role/update', array($role->id));?>" data-toggle="modal" data-target="#role_form">编辑</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="role_form" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeIn">
                
            </div>
        </div>
    </div>
</div>
<?php $__env->startSection('scripts'); ?>
@parent
<script>
$("#role_form").on("hidden.bs.modal",function(e){$(this).removeData();});
$('#role_form').on('click', '#submit_btn', function(){
    $.post($('#role_form form').attr('action'),{
        'role[name]': $('#role_name').val(),
        'role[display_name]': $('#role_display_name').val(),
        'role[description]': $('#role_description').val(),
        '_token':'<?php echo csrf_token();?>'
    },function(data){
        if(typeof(data.status) == "undefined") {
            $('#role_form .modal-content').html(data);
        }
        if(data.status == 'ok') {
            location.reload();
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>