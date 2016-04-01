<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->pathUrl('module.admin@assets/css/base.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->pathUrl('module.admin@assets/css/font-awesome.min.css'); ?>">
	<style type="text/css">
		body{
			background-color: #fdfdfd;
		}
		.login-wrap{
			padding:20px;
			margin-top: 170px;
		}
		.login-wrap h4{
			color:#5494af;
		}
		.name-error,.pass-error{
			display: none;
		}
		.login-icon{
			margin-right: 5px;
			display: none;
		}
		.login-error{
			display: none;
		}
	</style>
</head>
<body>
	<row centered>
		<column cols="3">
			<div class="login-wrap">
				<div class="forms">
				    <fieldset>
				        <legend><h4>登陆后台</h4></legend>
				        <div class="alert alert-error login-error">登录失败！，请输入正确的账号和密码</div>
				        <section>
				            <label>账号 <span class="error name-error">账号不能为空</span></label>
				            <input type="text" id="name" class="width-12"/>
				        </section>
				        <section>
				            <label>密码 <span class="error pass-error">密码不能为空</span></label>
				            <input type="password" id="password" class="width-12" />
				        </section>
				        <section>
				        	<div class="group">
					        	<label class="checkbox left"><input type="checkbox" id="rememberMe">记住密码</label>
					        	<button type="primary" class="right login-btn"><i class="fa fa-spinner fa-spin login-icon"></i>登陆</button>
				        	</div>
				        </section>
				    </fieldset>
				</div>
			</div>
		</column>
	</row>
	<script type="text/javascript" src="<?php echo $this->pathUrl('module.admin@assets/js/jquery-2.1.4.min.js'); ?>"></script>
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