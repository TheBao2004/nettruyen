		<!-- Breadcrumbs -->
		<section class="breadcrumbs" style="">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- <h2><i class="fa fa-pencil"></i><?php echo $data['namePage']; ?></h2> -->
						<ul>
							<li><a href="<?php echo _WEB_HOST_ROOT; ?>"><i class="fa fa-home"></i>Home</a></li>
							<li class=""><a href="<?php echo !empty($_GET['module'])?'?module='.$_GET['module']:''; ?>"><i class="fa fa-clone"></i><?php echo shortStr($data['namePage'], 15); ?></a></li>
							<?php echo !empty($data['nameBook'])?'<li class=""><a href=""><i class="fa fa-clone"></i>'.shortStr($data['nameBook'], 15).'</a></li>':''; ?>
							<?php echo !empty($data['nameChap'])?'<li class=""><a href=""><i class="fa fa-clone"></i>'.shortStr($data['nameChap'], 15).'</a></li>':''; ?>
						</ul>
					</div>
				</div>  
			</div>
		</section>
		<!--/ End Breadcrumbs -->