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
                        <a class="btn btn-xs btn-primary" href="<?php echo url('article/create');?>"><span class="fa fa-plus-square"></span> 新 增</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th width="10%">ID </th>
                                <th>标题 </th>
                                <th>分类 </th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($articles as $article):?>
                            <tr>
                                <td><?php echo $article->article_id;?></td>
                                <td><?php echo $article->category->name;?></td>
                                <td><?php echo $article->title;?></td>
                                <td><?php echo $article->created_at;?></td>
                                <td>
                                    <a href="<?php echo url('article/update', array($article->article_id));?>">编辑</a>
                                </td>
                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="" style="text-align:right">
                        <?php echo $articles->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
@endsection
@endsection