<?php

$data = [
	'nameTitle' => 'Home'
];

layout('header', 'client', $data);

	

// data slide

$jsonSlide = getOption('slides');

$allSlides = json_decode($jsonSlide, true);

?>

		<!-- Hero Area -->
		<section id="hero-area" class="hero-area">
			<!-- Slider -->
			<div class="slider-area">

<?php

if(!empty($allSlides)):
    foreach ($allSlides as $key => $value):

?>

				<!-- Single Slider -->
				<div class="single-slider" style="background-image:url('https://i.pinimg.com/originals/c2/6d/e1/c26de1ef5a9885a6a4c83039c8d09cd7.gif')">
					<div class="container">
						<div class="row">
							<div class="col-lg-7 col-md-6 col-12">
								<!-- Slider Text -->
								<div class="slider-text">
									<h1><?php echo $value['title']; ?></h1>
									<p><?php echo $value['description'] ?></p>
									<div class="button">
										<a href="?module=books&active=detail&id=<?php echo $value['id']; ?>" class="btn">Read now</a>
										<!-- <a href="https://www.youtube.com/watch?v=FZQPhrdKjow" class="btn video video-popup mfp-fade"><i class="fa fa-play"></i>Play Now</a> -->
									</div>
								</div>
								<!--/ End Slider Text -->
							</div>
							<div class="col-lg-5 col-md-6 col-12">
								<!-- Image Gallery -->
								<div class="image-gallery">
									<div class="single-image">
										<img src="<?php echo $value['image_slide_1']; ?>" alt="#">
									</div>
									<div class="single-image two">
										<img src="<?php echo $value['image_slide_2']; ?>" alt="#">
									</div>
								</div>
								<!--/ End Image Gallery -->
							</div>
						</div>
					</div>
				</div>
				<!--/ End Single Slider -->

<?php

    endforeach;
    endif;

?>
			

			</div>
			<!--/ End Slider -->
		</section>
		<!--/ End Hero Area -->


		<!-- Start Team -->
		<section id="team" class="team section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h1 id="erorr">Truyen B's Book</h1>
						</div>
					</div>
				</div>

<?php 

$msg = getFlashData('msg');
$type = getFlashData('type');

getAlert($msg, $type);

?>

				<div class="row">

<?php

$allBooks = getRows("SELECT b.*, a.fullname AS 'name_author' FROM book AS b LEFT JOIN author AS a ON b.id_author = a.id ORDER BY b.updateAt DESC");
$follwor_number = 0;
if(!empty($allBooks)):
	foreach ($allBooks as $key => $value):
		$bookId = $value['id'];
		$follwor_number = getCountRows("SELECT id FROM follwor WHERE id_book='$bookId'");

?>



					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Team -->
						<div class="single-team">
							<div class="t-head">
							<span class="light text-center d-block w-100 py-2 text-primary">Update: <?php echo getRealTime($value['updateAt']); ?></span>
								<div class="t-icon">
									<img src="<?php echo $value['image']; ?>" alt="erorr">
									<a href="?module=books&active=detail&id=<?php echo $value['id']; ?>">
										<i class="fa fa-eye mx-2"></i>
									</a>
								</div>
							</div>
							<div class="t-bottom">
								<p><?php echo $value['name_author']; ?></p>
								<h2><?php echo $value['title']; ?></h2>
								<ul class="t-social">
								<li class="text-primary"><?php echo formatInt($value['view_number']); ?><i class="fa mx-2 fa-eye"></i></li>
								<li class="text-danger"><?php echo $follwor_number; ?><i class="fa mx-2 fa-heart"></i></li>			
								</ul>
							</div>
						</div>
						<!-- End Single Team -->
					</div>	

<?php

	endforeach;
	endif;

?>

		
					</div>		
				</div>
			</div>
		</section>
		<!--/ End Team -->

		






<?php

layout('footer', 'client');

?>