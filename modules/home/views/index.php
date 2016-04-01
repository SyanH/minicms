<?php include $this->path('module.home@views/header.php');  ?>
<h1><?php echo $this->e($title); ?></h1>
<p><?php echo $this->e($content); ?></p>
<ul>
	<?php foreach($data as $item): ?>
	<li><?php echo $item['title']; ?></li>
	<?php endforeach;?>
</ul>
<div>
	<?php echo $this->render('module.home@views/aaa.php', ['title'=>$title]); ?>
</div>
<?php include $this->path('module.home@views/footer.php');  ?>