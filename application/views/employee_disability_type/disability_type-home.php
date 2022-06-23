<?php $check_user_access = $this->Main_model->check_user_access();?>

<section class="content-header">

	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<!-- <h1><?=  $this->router->fetch_class(); ?></h1> -->
				<h1>ประเภทความพิการ</h1>
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

		<div class="row ">
			<div class="col-md-9">
				<div class="form-group">
				</div>
			</div>
			<div class="col-md-3">
				<?php if(isset($check_user_access[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/add"])) :?>
				<div class="form-group text-right">
					<button class="btn btn-info btn-sm " id="btn_add"><i class="fas fa-plus"></i> เพิ่ม</button>
				</div>
				<?php endif; ?>
			</div>

			<div class="col-md-9">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="ค้นหา" id="search_text">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<select class="form-control" id="search_active"></select>
				</div>
			</div>
		</div>

		<div class="row ">
			<div class="col-md-12 ">
				<div class="card card-secondary shadow ">
					<div class="card-header">
						<h3 class="card-title"><i class="fas fa-list"></i> รายการ</h3>
					</div>
					<div class="card-body p-0 table-responsive " style="white-space: normal;">
						<input type="hidden" id="pageNumber" value="0">
						<input type="hidden" id="PerPage" value="10">

						<table class="table table-hover " show-filter="true">
							<thead class="">
								<tr>
									<th class="text-center">ID</th>
									<th class="text-left">ชื่อ(ภาษาไทย)</th>
									<th class="text-left">ชื่อ(ภาษาอังกฤษ)</th>
									<th class="text-left">รายละเอียด</th>
									<th class="text-left">สถานะ</th>
									<th class="text-left">เครื่องมือ</th>
								</tr>
							</thead>
							<tbody id="data_disability_type">

							</tbody>
						</table>

					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<ul class="pagination pagination-sm m-0 float-left">

				</ul>
			</div>
		</div>

	</div>
</section>

<div class="modal fade" id="manageModal" role="dialog" data-toggle="modal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog" role="document">
		<div class="modal-content ">
			<div class="modal-header bg-light">
				<h4 class="modal-title"><b id="disability_type_title"></b></h4>
			</div>
			<div class="modal-body">

				<input type="hidden" id="disability_type_type">
				<input type="hidden" id="disability_type_id">

				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label><span class="badge badge-secondary ">1</span> ชื่อ(ภาษาไทย) </label>
							<input type="text" class="form-control" id="name_th"
								placeholder="กรุณากรอกข้อมูล ">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label><span class="badge badge-secondary ">2</span> ชื่อ(ภาษาอังกฤษ) </label>
							<input type="text" class="form-control" id="name_en"
								placeholder="กรุณากรอกข้อมูล ">
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label><span class="badge badge-secondary ">3</span> รายละเอียด </label>
							<textarea class="form-control" id="other_details" rows="4"
								placeholder="กรุณากรอกข้อมูล"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer bg-light">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"
					onclick="javascript:clear_data_manage()"><i class="fas fa-sign-out-alt"></i>
					ปิด</button>
				<button type="submit" class="btn btn-info" id="manage_submit"><i class="fas fa-save"></i>
					บันทึก</button>
			</div>
		</div>
	</div>
</div>
