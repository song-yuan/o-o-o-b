<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h5 class="modal-title">Modal title</h5>
    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
</div>
<div class="modal-body">
    <div class="ibox-content">
        <form class="form-horizontal" method="POST" action="<?php echo url('permission/update', array($permission->id));?>">
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>"/>
            <div class="form-group <?php if($errors->first('name')) echo 'has-error';?>">
                <label class="col-lg-2 control-label">权限</label>
                <div class="col-lg-10">
                    <input type="text" id="permission_name" name="permission[name]" placeholder="权限" value="<?php echo $permission->name;?>" class="form-control"> 
                    <span class="help-block m-b-none"><?php echo $errors->first('name');?></span>
                </div>
            </div>
            <div class="form-group <?php if($errors->first('display_name')) echo 'has-error';?>">
                <label class="col-lg-2 control-label">名称</label>
                <div class="col-lg-10">
                    <input type="text" id="permission_display_name" name="permission[display_name]" placeholder="名称" value="<?php echo $permission->display_name;?>" class="form-control"> 
                    <span class="help-block m-b-none"><?php echo $errors->first('display_name');?></span>
                </div>
            </div>
            <div class="form-group <?php if($errors->first('description')) echo 'has-error';?>">
                <label class="col-lg-2 control-label">描述</label>
                <div class="col-lg-10">
                    <input type="text" id="permission_description" name="permission[description]" placeholder="描述" value="<?php echo $permission->description;?>" class="form-control"> 
                    <span class="help-block m-b-none"><?php echo $errors->first('description');?></span>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-2">
                    <a class="btn btn-primary" id="submit_btn">提 交</a>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
</div>