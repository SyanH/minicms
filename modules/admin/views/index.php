<?php include $this->path('module.admin@views/layout/header.php');  ?>
<div class="page-head">
			<h3>系统设置</h3>
			<div class="state-information">
                <ol class="breadcrumb clearfix">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Form</a></li>
                    <li>Form Layout</li>
                </ol>
            </div>
		</div>
		<div class="main-content">
			<section class="panel">
                <header class="panel-head">
                    后台设置
                </header>
                <ul class="panel-tab clearfix">
                	<li><a class="active">选项1</a></li>
                	<li><a>选项2</a></li>
                	<li><a>选项3</a></li>
                </ul>
                <div class="panel-content">
                	<form method="post" action="test.php" autocomplete='off'>
                		<div class="tabbed testt grid">
							<div class="row row-center">
								<div class="col-8">
									<section>
								        <label>标题</label>
								        <input type="text" name="title" class="width-6" />
								    </section>
								    <fieldset>
								    	<legend>选择项</legend>
									    <section class="checkbox-list">
									        <label><input type="checkbox"> 马云</label>
									        <label><input type="checkbox"> 李彦宏</label>
									        <label><input type="checkbox"> 刘强东</label>
									        <label><input type="checkbox"> 不知道谁</label>
									    </section>
								    </fieldset>
                                    <section>
                                        <label>测试下拉</label>
                                        <select name="cars">
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="fiat" selected="selected">Fiat</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </section>
								    <button type="primary" onclick="show_message('您有新消息哦！', 'success');return false;" class="btn btn-info">弹出消息</button>
								    <button type="primary" onclick="show_alert('您有新消息哦！', '.testt', 'error');return false;" class="btn btn-success">弹出消息</button>
								    <p><a href="#test" rel="modal:open" class="btn btn-error">Open Modal</a></p>
								    <p><a href="http://cms.com/admin/ajaxModal" rel="modal:open" class="btn">Open Modal1</a></p>
								</div>
							</div>
					    </div>
					    <div class="tabbed">
					    	<table class="am-table am-table-striped am-table-hover am-table-compact">
								<thead>
									<tr>
										<th><input type="checkbox" class="table-all"></th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Points</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="checkbox" name="test[]" /></td>
										<td>Jill</td>
										<td>Smith</td>
										<td>50</td>
									</tr>
									<tr>
										<td><input type="checkbox" name="test[]" /></td>
										<td>Eve</td>
										<td>Jackson</td>
										<td>94</td>
									</tr>
								</tbody>
							</table>
							<button onClick="progressBar.start();return false;" class="btn">start</button>
							<button onClick="progressBar.stop();return false;" class="btn">stop</button>
							<button class="btn">Button</button>
					    </div>
					    <div class="tabbed">
					    	<div class="alert alert-primary"><p class="alert-close"><i class="fa fa-times"></i></p>Bender! <br />Ship! <br />Stop bickering or I'm going to <a href="#">come back</a> there and change your opinions manually!</div>
					    	<div class="alert alert-error"><p class="alert-close"><i class="fa fa-times"></i></p>Bender! Ship! Stop bickering or I'm going to <a href="#">come back</a> there and change your opinions manually!</div>
					    	<div class="alert alert-warning"><p class="alert-close"><i class="fa fa-times"></i></p>Bender! Ship! Stop bickering or I'm going to <a href="#">come back</a> there and change your opinions manually!</div>
					    	<div class="alert alert-success"><p class="alert-close"><i class="fa fa-times"></i></p>Bender! Ship! Stop bickering or I'm going to <a href="#">come back</a> there and change your opinions manually!</div>
					    	<blockquote>作为一个手无缚鸡之力、毫无家庭背景、<samp>远离家乡</samp>、上有老下有小的苦逼程序员，我只能举着患有腱鞘炎的一双手，在 HHKB Pro 键盘上敲打；<mark>僵着颈椎强直的脖子</mark>，在 4K 显示器前 review 代码；竖着椎间盘突出的腰，在人体工学座椅上坚持 18hx7d ；忍着挨饿的胃，分析饿了么和美团的商品推荐算法。 </blockquote>
							<button class="btn">Button</button>
							<button class="btn">Button</button>
							<button class="btn">Button</button>
						</div>
					</form>
                </div>
            </section>
		</div>
		<div class="hidden" id="test">
			<div class="modal-title">这是标题</div>
			<div class="modal-content">
				<blockquote>作为一个手无缚鸡之力、毫无家庭背景、<samp>远离家乡</samp>、上有老下有小的苦逼程序员，我只能举着患有腱鞘炎的一双手，在 HHKB Pro 键盘上敲打；<mark>僵着颈椎强直的脖子</mark>，在 4K 显示器前 review 代码；竖着椎间盘突出的腰，在人体工学座椅上坚持 18hx7d ；忍着挨饿的胃，分析饿了么和美团的商品推荐算法。 </blockquote>
			</div>
		</div>
<?php include $this->path('module.admin@views/layout/footer.php');  ?>