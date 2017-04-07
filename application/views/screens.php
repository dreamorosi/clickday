<script type="text/javascript">
	window.role = "<?php echo $this->data['role'] = $this->session->userdata('role'); ?>";
	window.ID = "<?php echo $this->data['role'] = $this->session->userdata('ID'); ?>";
</script>
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include_once 'head_dash.php';
	echo '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/dashboard.css') . '"/>';
	echo '<link rel="stylesheet" type="text/css" href="' . base_url('assets/css/magnifier.css') . '"/>';
	echo '</head>';

	include_once 'header_dash.php';

	echo "<script>window.navActive = 'screenshots';</script>";
	include_once 'navbar_dash.php';

	echo "<script>window.screens = " . json_encode($screens) . ";</script>";
	echo "<script>window.pageSpan = " . $pageSpan . ";</script>";
	echo "<script>window.maxOffset = " . $maxOffset . ";</script>";
	if($role=='clickMaster'):
?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default screenWidget">
					<div class="panel-heading">Screenshots</div>
					<div class="panel-body table-responsive">
						<table class="table table-striped">
						<thead>
								<tr>
									<th>User</th>
									<th>Screenshot</th>
									<th>Zoom</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<? $k = 0;
								while(($k < $pageSpan)&&($k <count($screens))) :
							?>
							<tr class='screen-line'>
								<td><? echo $screens[$k]['name']?></td>
								<td>
									<div class="magnifier-thumb-wrapper">
										<img class="thumb" style="width: 298px;" src="<? echo base_url('assets/uploads/screenshots/thumbs').'/'.$screens[$k]['filename']; ?>"
										data-large-img-url="<? echo base_url('assets/uploads/screenshots/').'/'.$screens[$k]['filename']; ?>" data-large-img-wrapper="preview<? echo $screens[$k]['ID']; ?>"/>
									</div>
								</td>
								<td>
									<div class="magnifier-preview" id="preview<? echo $screens[$k]['ID']; ?>" style="width: 298px;"></div>
								</td>
								<td>
									<span class="label label-success" data-action="2" data-id="<? echo $screens[$k]['ID']; ?>" data-userid="<? echo $screens[$k]['userID']; ?>"><span class="glyphicon glyphicon-ok"></span></span>
									<span class="label label-danger" data-action="-1" data-id="<? echo $screens[$k]['ID']; ?>" data-userid="<? echo $screens[$k]['userID']; ?>"><span class="glyphicon glyphicon-remove"></span></span>
								</td>
							</tr>
							<?
							$k++;
							endwhile; ?>
							</tbody>
						</table>
					</div>
					<div class="panel-footer text-center">
						<nav>
							<ul class="pagination" id="scrPages">
								<li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
								<?
									echo '<li id="pag1" class="active" data-offset="0"><a href="#">1</a></li>';
									$k = 1;
									while($k < $pages):
										echo '<li id="pag'. ($k+1) .'" data-offset="'. $k*$pageSpan .'"><a href="#">'. ($k+1) .'</a></li>';
										$k++;
									endwhile;
								?>
								<li class="<? if($pages==1) echo 'disabled'; ?> ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
    </div>

<?
	//Admin section
	else:
?>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default screenWidget">
                        <div class="panel-heading">Screenshots</div>
                        <div class="panel-body table-responsive">
                            <table class="table table-striped">
                            <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Screenshot</th>
                                        <th>Zoom</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <? $k = 0;
                                    while(($k < $pageSpan)&&($k <count($screens))) :
                                ?>
                                <tr class='screen-line'>
                                    <td><? echo $screens[$k]['name']?></td>
                                    <td>
                                        <div class="magnifier-thumb-wrapper">
                                            <img class="thumb" style="width: 298px;" src="<? echo base_url('assets/uploads/screenshots/thumbs').'/'.$screens[$k]['filename']; ?>"
                                            data-large-img-url="<? echo base_url('assets/uploads/screenshots/').'/'.$screens[$k]['filename']; ?>" data-large-img-wrapper="preview<? echo $screens[$k]['ID']; ?>"/>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="magnifier-preview" id="preview<? echo $screens[$k]['ID']; ?>" style="width: 298px;"></div>
                                    </td>
                                    <td>
                                        <span class="label label-success" data-action="2" data-id="<? echo $screens[$k]['ID']; ?>" data-userid="<? echo $screens[$k]['userID']; ?>"><span class="glyphicon glyphicon-ok"></span></span>
                                        <span class="label label-danger" data-action="-1" data-id="<? echo $screens[$k]['ID']; ?>" data-userid="<? echo $screens[$k]['userID']; ?>"><span class="glyphicon glyphicon-remove"></span></span>
                                    </td>
                                </tr>
                                <?
                                $k++;
                                endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer text-center">
                            <nav>
                                <ul class="pagination" id="scrPages">
                                    <li class="disabled ext prev"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                                    <?
                                        echo '<li id="pag1" class="active" data-offset="0"><a href="#">1</a></li>';
                                        $k = 1;
                                        while($k < $pages):
                                            echo '<li id="pag'. ($k+1) .'" data-offset="'. $k*$pageSpan .'"><a href="#">'. ($k+1) .'</a></li>';
                                            $k++;
                                        endwhile;
                                    ?>
                                    <li class="<? if($pages==1) echo 'disabled'; ?> ext next"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?
	endif;
	include_once 'footer_dash.php';
	echo '</div>';
?>
	<script src="<? echo base_url('assets/js/Event.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/Magnifier.js'); ?>"></script>
	<script src="<? echo base_url('assets/js/screens.js'); ?>"></script>

</body>
</html>
