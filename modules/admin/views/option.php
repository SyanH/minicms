<?php include $this->path('module.admin@views/layout/header.php');  ?>
<!-- main content -->
<div class="main-content">
	<div class="box light-shadow">
		<div class="box-title">
			站点设置
		</div>
		<div class="box-content">
			<ul class="tab">
                <li class="tab-item active">
                    <a href="#a">系统设置</a>
                </li>
                <li class="tab-item">
                    <a href="#b">SEO设置</a>
                </li>
            </ul>
            <div class="tab-content">
            	<div class="tab-content-item active" id="a">
            		<form id="site-option">
		            	<div class="form-group">
		                    <label class="form-label" for="input-example-1">站点url</label>
		                    <input class="form-input" type="text" id="input-example-1" placeholder="不带最后斜杠">
		                </div>
		            </form>
            	</div>
            	<div class="tab-content-item" id="b">
            		
            	</div>
            </div>
		</div>
	</div>
</div>
<!-- main-content end -->
<?php include $this->path('module.admin@views/layout/footer.php');  ?>