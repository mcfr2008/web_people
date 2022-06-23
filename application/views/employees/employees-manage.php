<?php $check_user_access = $this->Main_model->check_user_access();?>

<section class="content-header">

	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>จัดการ</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= base_url('/')?>">Home</a> </li>
					<li class="breadcrumb-item active"><?= $this->router->fetch_class(); ?></li>
					<li class="breadcrumb-item active"><?=  $this->router->fetch_method(); ?></li>
				</ol>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-12">
				<div class="form-group">
					<button type="button" class="btn btn-secondary manage_close">ปิด</button>
					<button type="submit" class="btn btn-info float-right manage_submit" id="manage_submit"><i
							class="fas fa-save"></i>
						บันทึก</button>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title">ข้อมูลพนักงาน</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label for="">หมายเลขบัตร</label>
							<input type="text" id="card_id" class="form-control" value="" placeholder="กรุณากรอกข้อมูล">
						</div>
						<div class="form-group">
							<label for="">บาร์โค้ดบัตร</label>
							<input type="text" id="card_barcode" class="form-control" value=""
								placeholder="กรุณากรอกข้อมูล">
						</div>
						<div class="form-group">
							<label for="">สถานะ</label>
							<select id="employee_status" class="form-control custom-select">
								<option value="">เลือก</option>
								<option value="1">ทำงาน</option>
								<option value="0">ไม่ทำงาน</option>

							</select>
						</div>
						<div class="form-group">
							<label for="">องค์กร</label>
							<select id="organizations_id" class="form-control custom-select">

							</select>
						</div>
					</div>
				</div>

				<div class="card card-secondary">
					<div class="card-header">
						<h3 class="card-title">ข้อมูลส่วนตัว</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">หมายเลขบัตรประชาชน</label>
									<input type="text" id="card_id" class="form-control" value=""
										placeholder="กรุณากรอกข้อมูล">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">คำนำหน้า</label>
									<select id="prefix" class="form-control custom-select">
										<option value="">เลือก</option>
										<option value="นาย">นาย</option>
										<option value="นาง">นาง</option>
										<option value="นางสาว">นางสาว</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">ชื่อ</label>
									<input type="text" id="prefix" class="form-control" value=""
										placeholder="กรุณากรอกข้อมูล">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">ชื่อกลาง (ถ้ามี)</label>
									<input type="text" id="give_name" class="form-control" value="" placeholder="ถ้ามี">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">ชื่อสกุล</label>
									<input type="text" id="family_name" class="form-control" value=""
										placeholder="กรุณากรอกข้อมูล">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="">ชื่อเล่น</label>
									<input type="text" id="nick_name" class="form-control" value=""
										placeholder="กรุณากรอกข้อมูล">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">เพศ</label>
									<select id="gender" class="form-control custom-select">

									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">อื่นๆ เพศ (ถ้ามี)</label>
									<input type="text" id="gender_other" class="form-control" value=""
										placeholder="ถ้ามี">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">กรุ๊ปเลือด</label>
									<select id="blood_type" class="form-control custom-select">

									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">อื่นๆ กรุ๊ปเลือด (ถ้ามี)</label>
									<input type="text" id="blood_type_other" class="form-control" value=""
										placeholder="ถ้ามี">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">วันเกิด (ระบุ ค.ศ)</label>
									<input type="date" id="birthdate" class="form-control" value="" placeholder="">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">สถานที่เกิด</label>
									<input type="text" id="birth_jurisdiction_country_sub_division" class="form-control"
										value="" placeholder="ถ้ามี">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">สัญชาติ</label>
									<select id="nationality_id" class="form-control custom-select">
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">ศาสนา</label>
									<select id="religion_id" class="form-control custom-select">
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">ส่วนสูงล่าสุด</label>
									<input type="number" id="body_height" class="form-control" value=""
										placeholder="กรุณากรอกข้อมูล">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="">น้ำหนักล่าสุด</label>
									<input type="number" id="body_weight" class="form-control" value=""
										placeholder="กรุณากรอกข้อมูล">
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>

			<div class="col-md-6">


				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">ที่อยู่</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body p-0">
						<table class="table">
							<thead>
								<tr>
									<th> ...</th>
									<th> ...</th>
									<th></th>
								</tr>
							</thead>
							<tbody>

								<tr>
									<td>...</td>
									<td>...</td>
									<td class="text-right py-0 align-middle">
										<div class="btn-group btn-group-sm">
											<a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
											<a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
										</div>
									</td>
								</tr>

							</tbody>
						</table>
					</div>

				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-12">
				<div class="form-group">
					<button type="button" class="btn btn-secondary manage_close">ปิด</button>
					<button type="submit" class="btn btn-info float-right manage_submit" id="manage_submit"><i
							class="fas fa-save"></i>
						บันทึก</button>
				</div>
			</div>
		</div>

		<!-- <div class="row ">
			<div class="col-md-9">
				<div class="form-group">
				</div>
			</div>
			<div class="col-md-3">

				<div class="form-group text-right">
					<button class="btn btn-info btn-sm " id="btn_add"><i class="fas fa-plus"></i> Add new</button>
				</div>

			</div>

		</div> -->

		<!-- <div class="row">
			<div class="col-md-12">
				<div class="card card-secondary shadow">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-list"></i> List</h3>
					</div>
					<div class="card-body p-0 table-responsive">
						<input type="hidden" id="pageNumber" value="0">
						<input type="hidden" id="PerPage" value="10">

						<table class="table table-hover" show-filter="true">
							<thead class="">
								<tr>
									<th class="text-center">ID</th>
									<th class="text-left">Name</th>
									<th class="text-left">Username</th>
									<th class="text-left">Email</th>
									<th class="text-left">Status</th>
									<th class="text-left">Action</th>
								</tr>
							</thead>
							<tbody id="data_users">

							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div> -->

		<!-- <div class="row">
			<div class="col-md-12">
				<ul class="pagination pagination-sm m-0 float-left">

				</ul>
			</div>
		</div> -->

	</div>
</section>
