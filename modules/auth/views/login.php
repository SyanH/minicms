<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/normalize.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/base.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/style.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->assets('module.admin@assets/css/font-awesome.min.css'); ?>">
	<style type="text/css">
		body{
			background-color: #fdfdfd;
		}
		.login-wrap{
			padding:20px;
			margin-top: 20px;
		}
		.login-wrap h4{
			color:#5494af;
		}
		.name-error,.pass-error{
			display: none;
            color:red;
            font-size:13px;
		}
		.login-icon{
			margin-right: 5px;
			display: none;
		}
		.login-error{
			display: none;
		}
        .tabs{
            margin-bottom:20px;
        }
        .tabs p.login-tab{
            background: #ddf0ed;
            padding:10px 0;
        }
        .tabs p.reg-tab{
            background: #376956;
            padding:10px 0;
        }
        .tabs p.reg-tab a{
            color:#fff;
            text-decoration: none;
            display:block;
        }
	</style>
</head>
<body>
	<div class="grid">
		<div class="row row-center">
			<div class="login-wrap col-4">
                <h1 class="text-center"><a href="<?php echo $this['app.url']; ?>"><img src="<?php echo $this->assets('module.admin@assets/images/logo.gif'); ?>" /></a></h1>
				<div class="forms gutterless">
                    <div class="row tabs">
                        <div class="col-6 text-center"><p class="login-tab">登录</p></div>
                        <div class="col-6 text-center"><p class="reg-tab"><a href="<?php echo $this->urlFor('reg'); ?>">注册</a></p></div>
                    </div>
                    <div class="alert alert-error login-error">登录失败！，请输入正确的账号和密码</div>
                    <section>
                        <label>账号 <span class="error name-error">账号不能为空</span></label>
                        <input type="text" id="name"/>
                    </section><br />
                    <section>
                        <label>密码 <span class="error pass-error">密码不能为空</span></label>
                        <input type="password" id="password"/>
                    </section><br />
                    <section>
                        <div class="clearfix">
                            <label class="checkbox float-left"><input type="checkbox" id="rememberMe">记住密码</label>
                            <button type="primary" class="float-right login-btn btn"><i class="fa fa-spinner fa-spin login-icon"></i>登陆</button>
                        </div>
                    </section>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo $this->assets('module.admin@assets/js/jquery-2.1.4.min.js'); ?>"></script>
	<script type="text/javascript">
		$(function(){
			$('.login-btn').click(function(){
				var name = $('#name').val();
				var password = $('#password').val();
				var rememberMe = $('#rememberMe').is(':checked') ? 1 : 0;
				if($.trim(name) == ''){
					$('.name-error').show();
					return;
				}
				if($.trim(password) == ''){
					$('.pass-error').show();
					return;
				}
                $('.error').hide();
				$.ajax({
					type: "POST",
					url: "<?php echo $this->urlFor('login'); ?>",
					data: {name:name, password:password, rememberMe:rememberMe},
					dataType: "json",
					beforeSend: function(){
						$('.login-icon').show();
					},
					success: function(data){
						$('.login-icon').hide();
						if (data.status == 1) {
							$('.login-error').hide();
							window.location.href = "<?php echo $this['app.url']; ?>";
						} else {
							$('.login-error').show();
						}
					}
				});
			});

			$("body").keyup(function () {  
                if (event.which == 13){  
					$(".login-btn").trigger("click");  
                }
            });
		});
	</script>
</body>
</html>