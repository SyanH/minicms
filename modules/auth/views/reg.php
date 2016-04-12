<!DOCTYPE html>
<html>
<head>
	<title>用户注册</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/normalize.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/base.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/font-awesome.min.css'); ?>">
	<style type="text/css">
		body{
			background-color: #fdfdfd;
		}
		.reg-wrap{
			padding:20px;
			margin-top: 20px;
		}
		.error{
			display: none;
            color:red;
            font-size:13px;
		}
		.reg-icon{
			margin-right: 5px;
			display: none;
		}
		.reg-error{
			display: none;
		}
        .tabs{
            margin-bottom:20px;
        }
        .tabs p.reg-tab{
            background: #ddf0ed;
            padding:10px 0;
        }
        .tabs p.login-tab{
            background: #376956;
            padding:10px 0;
        }
        .tabs p.login-tab a{
            color:#fff;
            text-decoration: none;
            display:block;
        }
        .reg-btn{
        	width:100%;
        }
	</style>
</head>
<body>
	<div class="grid">
		<div class="row row-center">
			<div class="reg-wrap col-4">
                <h1 class="text-center"><a href="<?php echo $this['app.url']; ?>"><img src="<?php echo $this->assets('module.admin@assets/images/logo.gif'); ?>" /></a></h1>
				<div class="forms gutterless">
                    <div class="row tabs">
                        <div class="col-6 text-center"><p class="reg-tab">注册</p></div>
                        <div class="col-6 text-center"><p class="login-tab"><a href="<?php echo $this->urlFor('login'); ?>">登录</a></p></div>
                    </div>
                    <div class="alert alert-error reg-error">出错!请联系管理员</div>
                    <section>
                        <label>用户名 <span class="error name-error">账号不能为空</span></label>
                        <input type="text" id="name"/>
                    </section><br />
                    <section>
                        <label>邮箱 <span class="error email-error">邮箱不能为空</span></label>
                        <input type="email" id="email"/>
                    </section><br />
                    <section>
                        <label>密码 <span class="error pass-error">密码不能为空</span></label>
                        <input type="password" id="password"/>
                    </section><br />
                    <section>
                        <label>确认密码 <span class="error enpass-error">确认密码不能为空</span></label>
                        <input type="password" id="enpassword"/>
                    </section><br />
                    <section class="row row-center">
                    	<div class="col-4">
                        	<button type="primary" class="reg-btn btn"><i class="fa fa-spinner fa-spin reg-icon"></i>确认注册</button>
                    	</div>
                    </section>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo $this->assets('module.admin@assets/js/jquery-2.1.4.min.js'); ?>"></script>
	<script type="text/javascript">
		$(function(){
			$('.reg-btn').click(function(){
				var name = $.trim($('#name').val());
				var email = $.trim($('#email').val());
				var password = $.trim($('#password').val());
				var enpassword = $.trim($('#enpassword').val());
				if(name == ''){
					$('.name-error').show();
					return;
				}
				if(email == ''){
					$('.email-error').show();
					return;
				}
				if(password == ''){
					$('.pass-error').show();
					return;
				}
				if(enpassword == ''){
					$('.enpass-error').show();
					return;
				}
				$.ajax({
					type: "POST",
					url: "<?php echo $this->urlFor('reg'); ?>",
					data: {name:name, password:password, email:email, enpassword:enpassword},
					dataType: "json",
					beforeSend: function(){
						$('.reg-icon').show();
					},
					success: function(data){
						$('.reg-icon,.reg-error').hide();
						if (data.status == 1) {
							window.location.href = "<?php echo $this['app.url']; ?>";
						} else if(data.status == -1) {
                            $('.reg-error').text(data.msg);
                            $('.reg-error').show();
						} else {
                            $('.reg-error').text('木有错误');
                            $('.reg-error').show();
                        }
					}
				});
			});

		});
	</script>
</body>
</html>