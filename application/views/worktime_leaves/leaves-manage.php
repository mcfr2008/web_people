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
										<label for=""><span class="badge badge-secondary mr-1">1</span>ประเภท
											<span class="badge badge-light">การลาต้องมีการขอล่วงหน้าอย่างน้อย 3 วัน
												ยกเว้นลาป่วย</span>
										</label>
										<select name="select_leave_types" id="select_leave_types" 
											class="form-control"></select>

									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for=""><span class="badge badge-secondary mr-1">2</span>วันที่ <span
												class="badge badge-light">ระบุ ค.ศ</span></label>
										<input type="text"  id="date_str_end" name="date_str_end"
											class="form-control daterangepicker-between" placeholder="กรุณากรอกข้อมูล">

									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label for="inputEmail3" class="col-md-4 col-form-label"><span
												class="badge badge-secondary mr-1">3</span>ช่วงเวลาออก</label>
										<div class="col-md-8 mt-2">
											<div class="form-group ">
												<div class="icheck-info d-inline">
													<input type="radio" id="point_out1" name="point_out" value="1">
													<label for="point_out1">เต็มวัน
													</label>
												</div>
												<div class="icheck-info d-inline">
													<input type="radio" id="point_out2" name="point_out" value="2">
													<label for="point_out2">ช่วงเช้า
													</label>
												</div>
												<div class="icheck-info d-inline">
													<input type="radio" id="point_out3" name="point_out" value="3">
													<label for="point_out3">ช่วงบ่าย
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<label for="inputEmail3" class="col-md-4 col-form-label"><span
												class="badge badge-secondary mr-1">4</span>ช่วงเวลาเข้า</label>
										<div class="col-md-8 mt-2">
											<div class="form-group ">
												<div class="icheck-info d-inline">
													<input type="radio" id="point_in1" name="point_in" value="1">
													<label for="point_in1">เต็มวัน
													</label>
												</div>
												<div class="icheck-info d-inline">
													<input type="radio" id="point_in2" name="point_in" value="2">
													<label for="point_in2">ช่วงเช้า
													</label>
												</div>
												<div class="icheck-info d-inline">
													<input type="radio" id="point_in3" name="point_in" value="3">
													<label for="point_in3">ช่วงบ่าย
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for=""><span
												class="badge badge-secondary mr-1">5</span>รายละเอียด</label>
										<textarea type="text" name="other_details" id="other_details"
											class="form-control" rows="5" placeholder="กรุณากรอกข้อมูล"></textarea>

									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="card card-light">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for=""><span class="badge badge-secondary mr-1">6</span>ติดต่อ
											ชื่อ</label>
										<input type="text" id="contact_name" name="contact_name" class="form-control "
											placeholder="กรุณากรอกข้อมูล">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for=""><span class="badge badge-secondary mr-1">7</span>ติดต่อ เบอร์
											สื่อออนไลน์ อื่นๆ</label>
										<input type="text" id="contact_type" name="contact_type" class="form-control"
											placeholder="กรุณากรอกข้อมูล">
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

