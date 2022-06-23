<?php $check_user_access = $this->Main_model->check_user_access();?>

<section class="content-header">

	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<!-- <h1><?=  $this->router->fetch_class(); ?></h1> -->
				<h1><?= $type_name?></h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url('/')?>">Home</a> </li>
					<li class="breadcrumb-item active"><a href="<?= base_url( $this->router->fetch_class() )?>"><?= $this->router->fetch_class(); ?></a></li>
					<li class="breadcrumb-item active"><?=  $this->router->fetch_method(); ?></li>
				</ol>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="container-fluid">

		<form id="validate">

			<div class="row">
				<div class="col-md-4">
				
				<?php $this->load->view('template/autocomplete_employees'); ?>

				<?php $this->load->view('template/info_employees'); ?>
				
				</div>
				<div class="col-md-8">
					<div class="card card-light">
						<div class="card-header">
							<h3 class="card-title">รายละเอียด</h3>
						</div>
						<div class="card-body">
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for=""><span class="badge badge-secondary mr-1">1</span>วันที่ <span
												class="badge badge-light">ระบุ ค.ศ</span></label>
										<input type="date"  id="date" name="date" onkeydown="return false"
											class="form-control daterangepicker-between" placeholder="กรุณากรอกข้อมูล">

									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for=""><span
												class="badge badge-secondary mr-1">2</span>รายละเอียด</label>
										<textarea type="text" name="other_details" id="other_details"
											class="form-control" rows="15" placeholder="กรุณากรอกข้อมูล"></textarea>

									</div>
								</div>
							</div>

						</div>
					</div>

					
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<button type="button" class="btn btn-secondary" data-dismiss="modal"
						onclick="javascript:location.reload();"><i class="fas fa-sync"></i>
						ล้าง</button>
					<button type="submit" class="btn btn-info float-right" id="manage_submit"><i
							class="fas fa-save"></i>
						บันทึก</button>
				</div>
			</div>

		</form>

	</div>


</section>

