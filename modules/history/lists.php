<?php

$data = [
	'nameTitle' => 'History',
	'namePage' => 'History'
];

layout('header', 'client', $data);

layout('breadcrumb', 'client', $data);

	


?>



		<!-- Start Team -->
		<section id="team" class="team section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h1 id="erorr">Your history</h1>
							<p>History book will be remove after <?php echo _TIME_HISTORY; ?> days if read chap</p>
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

$userId = _MY_DATA['id'];

$allBooks = getRows("SELECT b.*, a.fullname AS 'name_author', h.lastActivity AS 'last_time' FROM book AS b INNER JOIN history AS h ON b.id = h.id_book LEFT JOIN author AS a ON b.id_author = a.id WHERE id_user='$userId' ORDER BY h.lastActivity DESC");

if(!empty($allBooks)):
	foreach ($allBooks as $key => $value):
		$bookId = $value['id'];
		$follwor_number = getCountRows("SELECT id FROM follwor WHERE id_book='$bookId'");
?>



					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Team -->
						<div class="single-team">
							<div class="t-head">
								<span class="light text-center d-block w-100 py-2 text-primary">Read: <?php echo getRealTime($value['last_time']); ?></span>
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
								<li class="text-primary"><?php echo $value['view_number']; ?><i class="fa mx-2 fa-eye"></i></li>
								<li class="text-danger"><?php echo $follwor_number ?><i class="fa mx-2 fa-heart"></i></li>			
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