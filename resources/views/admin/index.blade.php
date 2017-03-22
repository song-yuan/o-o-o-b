@extends('layouts.app')
@section('title', '快递单')
@section('styles')
@parent
@endsection
@section('content')
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
                            <a href="<?php echo url('admin/create');?>" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#admin_form">新 建</a>
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
                            <?php foreach($admins as $admin):?>
                            <tr>
                                <td><?php echo $admin->admin_id;?></td>
                                <td><?php echo $admin->name;?></td>
                                <td><?php echo $admin->display_name;?></td>
                                <td><?php echo $admin->description;?></td>
                                <td><?php echo $admin->created_at;?></td>
                                <td><?php echo $admin->updated_at;?></td>
                                <td>
                                    <a href="<?php echo url('admin/update', array($admin->admin_id));?>" data-toggle="modal" data-target="#admin_form">编辑</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="" style="text-align:right">
                        <?php echo $admins->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="admin_form" tabindex="-1" admin="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeIn">
                
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
$("#admin_form").on("hidden.bs.modal",function(e){$(this).removeData();});
$('#admin_form').on('click', '#submit_btn', function(){
    $.post($('#admin_form form').attr('action'),{
        'admin[name]': $('#admin_name').val(),
        'admin[display_name]': $('#admin_display_name').val(),
        'admin[description]': $('#admin_description').val(),
        '_token':'<?php echo csrf_token();?>'
    },function(data){
        if(typeof(data.status) == "undefined") {
            $('#admin_form .modal-content').html(data);
        }
        if(data.status == 'ok') {
            location.reload();
        }
    });
});
</script>
@endsection
@endsection