<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h5 class="modal-title">Modal title</h5>
    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
</div>
<div class="modal-body">
    <div class="ibox-content">
        <form class="form-horizontal" method="POST" action="<?php echo url('admin/update', array($admin->id));?>">
            <input type="hidden" name="_token" value="<?php echo csrf_token();?>"/>
            <div class="form-group <?php if($errors->first('user_name')) echo 'has-error';?>">
                <label class="col-lg-2 control-label">姓名</label>
                <div class="col-lg-10">
                    <input type="text" id="admin_name" name="admin[user_name]" placeholder="姓名" value="<?php echo $admin->user_name;?>" class="form-control"> 
                    <span class="help-block m-b-none"><?php echo $errors->first('user_name');?></span>
                </div>
            </div>
            <div class="form-group <?php if($errors->first('email')) echo 'has-error';?>">
                <label class="col-lg-2 control-label">邮箱</label>
                <div class="col-lg-10">
                    <input type="text" id="admin_name" name="admin[email]" placeholder="邮箱" value="<?php echo $admin->email;?>" class="form-control"> 
                    <span class="help-block m-b-none"><?php echo $errors->first('email');?></span>
                </div>
            </div>
            <div class="form-group <?php if($errors->first('mobile')) echo 'has-error';?>">
                <label class="col-lg-2 control-label">手机</label>
                <div class="col-lg-10">
                    <input type="text" id="admin_display_name" name="admin[mobile]" placeholder="手机" value="<?php echo $admin->mobile;?>" class="form-control"> 
                    <span class="help-block m-b-none"><?php echo $errors->first('mobile');?></span>
                </div>
            </div>
            <div class="form-group <?php if($errors->first('password')) echo 'has-error';?>">
                <label class="col-lg-2 control-label">密码</label>
                <div class="col-lg-10">
                    <input type="text" id="admin_description" name="admin[password]" placeholder="密码" value="<?php echo $admin->password;?>" class="form-control"> 
                    <span class="help-block m-b-none"><?php echo $errors->first('password');?></span>
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