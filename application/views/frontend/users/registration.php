<style>
    body{
        background-color: #f5f5f5;
    }
    .ui.button {
        width: 100%;
        text-decoration: none;
            cursor: pointer;
            display: inline-block;
            min-height: 1em;
            outline: 0;
            border: none;
            background: #e0e1e2;
            color: #fff;
            margin: 0 .25em 0 0;
            padding: .78571429em 1.5em;
            text-shadow: none;
            font-weight: 700;
            line-height: 1em;
            font-style: normal;
            text-align: center;
            border-radius: .28571429rem;
            user-select: none;
            -webkit-transition: opacity .1s ease,background-color .1s ease,color .1s ease,box-shadow .1s ease,background .1s ease;
            transition: opacity .1s ease,background-color .1s ease,color .1s ease,box-shadow .1s ease,background .1s ease;
            will-change: '';
    }
    .ui.facebook.button {
        background-color: #3b5998;
        text-shadow: none;
    }
    .ui.facebook.button:hover {
        background-color: #334d84;
        text-shadow: none;
    }
    .panel-default {
        border-color: #ddd;
    }
    .ui.facebook.button, .ui.google.plus.button, .ui.instagram.button, .ui.pinterest.button, .ui.twitter.button, .ui.vk.button, .ui.youtube.button {
        background-image: none;
        box-shadow: 0 0 0 0 rgba(34,36,38,.15) inset;
        color: #fff;
    }
    .panel-default>.panel-heading {
        background-image: url({{url('assets/image/login_bg.png')}});

    }
    .panel-heading {
        padding: 5px 5px;
    }
    .login_box {

        margin: 56px auto;
        padding: 15px 15px 0;
    }
    .t_mid {
        text-align: center;
    }
    .g_right {
       margin-top: -5px;
        float: right;
    }
    .logo-login{
        margin: 0 auto 20px auto;
    }
    .t_gray {

        color: #9e9e9e;
    }
    .login_box .sign_up_btn, .login_box .login_btn {
        background-color: #fff;
        color: #424242;
        padding: 10px 25px;
    }
    .form-horizontal .form-group {
        margin-right: -15px;
        margin-left: -15px;
    }
    .site-titles{
        margin-top: 0px;
        margin-bottom: 20px;
        color: #165a96;
    }
    .form-group {
        margin-bottom: 5px;
    }
    .help-block {
        font-size: 12px;
        color: #ef0808;
    }
</style>

<div class="container" style="padding: 20px 0 60px;">
<div class="row">
        <div class="col-md-8 col-md-offset-2 ">
            <div class="panel panel-default login_box">

                <div class="panel-body">
                    <?php  if(!empty($success_msg)){ ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            คุณทำการลงทะเบียน สำเร็จเรียบร้อยแล้ว กรุณา login เข้าสู่ระบบ
                        </div>
                    <?php }elseif(!empty($error_msg)){ ?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            มีบางอย่างผิดพลาด
                        </div>
                     <?php } ?>

                    <h4 class="site-titles text-center" > สมัครสมาชิกเข้าสู่ระบบ </h4>
                    <hr style="margin-bottom: 10px;">

                    <form class="form-horizontal" method="POST" action="">
                        <div class="col-md-6">
                            <!--
                                <div class="form-group">
                                    <div style="margin-bottom: 16px;">
                                        <a href="redirect" class=" ui facebook fluid button"><i class="fa fa-facebook icon-fa " style=""></i> สมัครด้วย Facebook</a>
                                    </div>
                                </div> 
                                <div>
                                    <p class="t_mid" style="margin: 0 0 0px;">หรือ</p>
                                </div>
                            -->
                            <div class="form-group">
                                <div class="col-md-12 ">
                                    <label for="name" class=" control-label">ชื่อ-นามสกุล</label>
                                    <input id="name" type="text" class="form-control" name="name" 
                                    value="<?php echo !empty($user['name'])?$user['name']:''; ?>" required>
                                    <?php echo form_error('name','<span class="help-block"><strong>','</strong></span>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 ">
                                    <label for="email" class=" control-label">อีเมล์</label>
                                    <input id="email" type="email" class="form-control" name="email" 
                                    value="<?php echo !empty($user['email'])?$user['email']:''; ?>" required>
                                    <?php echo form_error('email','<span class="help-block"><strong>','</strong></span>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 ">
                                    <label for="password" class=" control-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <?php echo form_error('password','<span class="help-block"><strong>','</strong></span>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 ">
                                    <label for="password-confirm" class=" control-label">Confirm Password</label>
                                    <?php echo form_error('password_confirmation','<span class="help-block">','</span>'); ?>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-12 ">
                                    <label for="email" class=" control-label">หนังสือเดินทาง/หมายเลขบัตรประชาชน</label>
                                    <input id="card_id" type="text" class="form-control" name="card_id" value="<?php echo !empty($user['card_id'])?$user['card_id']:''; ?>" required>
                                    <?php echo form_error('card_id','<span class="help-block"><strong>','</strong></span>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 ">
                                    <label for="email" class=" control-label">อายุ</label>
                                    <input id="year_old" type="munber" class="form-control" name="year_old" value="<?php echo !empty($user['year_old'])?$user['year_old']:''; ?>" required>
                                    <?php echo form_error('year_old','<span class="help-block"><strong>','</strong></span>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 ">
                                    <label for="email" class=" control-label">เพศ</label>
                                    <select class="form-control" name="sex" required>
                                        <option value="1">ชาย</option>
                                        <option value="1">หญิง</option>
                                    </select>
                                </div>
                            </div>

                            <br>
                            <div class="form-group" style="margin-top: 6px;">
                                <div class="col-md-12 ">
                                    <input type="submit" name="regisSubmit" class="btn btn-primary btn-block" value="สมัครสมาชิก"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <div class="text-center" style="margin-top: 20px;">สบายใจ หายห่วง เพราะเรา ไม่มีนโยบายเก็บหรือแชร์ข้อมูลส่วนตัวของคุณ</div>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>