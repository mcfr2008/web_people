<?php $check_user_access = $this->Main_model->check_user_access(); ?>

<script>

    $(document).ready(function () {
	
		action_function();

		get_divisions_active_status();

		get_departments_all('search');

		search_function_1();
      
    });

	function search_function_1() 
	{
		var search_text = '';
		var search_active = '';
		var search_department = '';
		search_text = $('#search_text').val();
		search_active = $('#search_active').val();
		search_department = $('#search_department').val();
		get_divisions(search_text,search_active,search_department);
	};

	function search_function_2() 
	{
		var search_text = '';
		var search_active = '';
		var search_department = '';
		search_text = $('#search_text').val();
		search_active = $('#search_active').val();
		search_department = $('#search_department').val();
		$('#pageNumber').val(0);
		get_divisions(search_text,search_active,search_department);
	};

	function action_function() 
	{ 

		// list
			
			$('#search_text').keyup(function (e) { 
				e.preventDefault();
				search_function_1();
			});

			$('#search_department').change(function (e) { 
				e.preventDefault();
				search_function_1();
			});

			$('#search_active').change(function (e) { 
				e.preventDefault();
				search_function_1();
			});

			$(document).on('click','.pageNumber',function(){

				var search_text = '';
				var search_active = '';
				var search_department = '';
				search_text = $('#search_text').val();
				search_active = $('#search_active').val();
				search_department = $('#search_department').val();
				$('#pageNumber').val($(this).text()-1);
				get_divisions(search_text,search_active,search_department);
			});

		// END list

		$('#btn_add').click(function () {
			clear_data_manage();

			get_departments_all('manage');
		
			$('#manageModal').modal('show');
			$('#divisions_title').text('เพิ่ม');
			$('#divisions_type').val('add');
		});

		$('#data_divisions').on('click','.btn_edit',function(){ 
			
			clear_data_manage();

			get_departments_all('manage');

			$('#manageModal').modal('show');
			$('#divisions_title').text('แก้ไข');
			$('#divisions_type').val('edit');

			var id = $(this).closest('tr').find('.id').text();
			var order = $(this).closest('tr').find('.order').text();

			$('#divisions_order_old').val(order);
			$('#divisions_order_new').val(order);
			
			get_divisions_byid(id,'manage');
		});

		$('#manage_submit').click(function () { 
			

			var validate = validate_manage();

			if(validate == 'true' ){

				Swal.fire({
					title: 'คุณแน่ใจไหม',
					text: "บันทึกข้อมูล",
					showClass: {
						icon: 'animated heartBeat delay-1s'
					},
					backdrop: `rgba(49,53,56, 0.8)`,
					icon: 'question',
					allowOutsideClick: false,
					showCancelButton: true,
					confirmButtonColor: '#17a2b8',
					cancelButtonColor: '#d33',
					confirmButtonText: 'ใช่ ,ฉัน ตกลง',
					cancelButtonText: 'ปิด',
				}).then((result) => {
					if (result.isConfirmed) {
						divisions_manage();
					}
				})

			}

		});

		$('#data_divisions').on('click','.btn_del',function(){ 

			var id = $(this).closest('tr').find('.id').text();

			Swal.fire({
				title: 'คุณแน่ใจไหม',
				text: "ลบข้อมูล",
				showClass: {
					icon: 'animated heartBeat delay-1s'
				},
				backdrop: `rgba(49,53,56, 0.8)`,
				icon: 'question',
				allowOutsideClick: false,
				showCancelButton: true,
				confirmButtonColor: '#17a2b8',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ใช่ ,ฉัน ตกลง',
				cancelButtonText: 'ปิด',
			}).then((result) => {
				if (result.isConfirmed) {

					delete_divisions(id);

				}
			})
			
		});

		$('#data_divisions').on('click','.btn_active_1',function(){ 
			
		
			var id = $(this).closest('tr').find('.id').text();
			var active = 1;

			Swal.fire({
				title: 'คุณแน่ใจไหม',
				text: "เปิด",
				showClass: {
					icon: 'animated heartBeat delay-1s'
				},
				backdrop: `rgba(49,53,56, 0.8)`,
				icon: 'question',
				allowOutsideClick: false,
				showCancelButton: true,
				confirmButtonColor: '#17a2b8',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ใช่ ,ฉัน ตกลง',
				cancelButtonText: 'ปิด',
			}).then((result) => {
				if (result.isConfirmed) {
					put_divisions_active(id,active);
				}
			})

		});

		$('#data_divisions').on('click','.btn_active_0',function(){ 
			
		
			var id = $(this).closest('tr').find('.id').text();
			var active = 0;

			Swal.fire({
				title: 'คุณแน่ใจไหม',
				text: "ปิด",
				showClass: {
					icon: 'animated heartBeat delay-1s'
				},
				backdrop: `rgba(49,53,56, 0.8)`,
				icon: 'question',
				allowOutsideClick: false,
				showCancelButton: true,
				confirmButtonColor: '#17a2b8',
				cancelButtonColor: '#d33',
				confirmButtonText: 'ใช่ ,ฉัน ตกลง',
				cancelButtonText: 'ปิด',
			}).then((result) => {
				if (result.isConfirmed) {
					put_divisions_active(id,active);
				}
			})

		});


	};

	function clear_data_manage()
	{ 
		$('#divisions_type').val('');
		$('#divisions_id').val('');
		
		$('#name_th').val('').removeClass( "is-warning is-valid" );
		$('#name_en').val('').removeClass( "is-warning is-valid" );
		$('#other_details').val('').removeClass( "is-warning is-valid" );
		$('#department_id').val('').trigger('change').removeClass( "is-warning is-valid" );

		$('#divisions_order_old').val('');
		$('#divisions_order_new').val('').removeClass( "is-warning is-valid" );

	};

	function validate_manage() 
	{
		var validate = 'true';

		if($("#name_th").val() == '' ){
			$( "#name_th" ).removeClass( "is-valid" ).addClass( "is-warning" );
			validate = 'false';
		}else if($('#name_th').val() != '' ){
			$( "#name_th" ).removeClass( "is-warning" ).addClass( "is-valid" );
		}

		if($("#name_en").val() == '' ){
			$( "#name_en" ).removeClass( "is-valid" ).addClass( "is-warning" );
			validate = 'false';
		}else if($('#name_en').val() != '' ){
			$( "#name_en" ).removeClass( "is-warning" ).addClass( "is-valid" );
		}

		if($("#divisions_order_new").val() == '' ){
			$( "#divisions_order_new" ).removeClass( "is-valid" ).addClass( "is-warning" );
			validate = 'false';
		}else if($('#divisions_order_new').val() != '' ){
			$( "#divisions_order_new" ).removeClass( "is-warning" ).addClass( "is-valid" );
		}

		if($('#department_id').val() == '' ){
			$( "#department_id" ).removeClass( "is-valid" ).addClass( "is-warning" );
			validate = 'false';
		}else if($('#department_id').val() != '' ){
			$( "#department_id" ).removeClass( "is-warning" ).addClass( "is-valid" );
		}

        return validate;
		
	};

	function get_divisions(search_text,search_active,search_department) 
	{ 

		var PerPage = parseInt($('#PerPage').val());
		var pageNumber = $('#pageNumber').val();

		$.ajax({
		type: "POST",
		url: "<?= site_url('employee_divisions/get_divisions')?>",
		data : {
			pageNumber : pageNumber ,
			PerPage : PerPage,
			search_text : search_text,
			search_active : search_active,
			search_department : search_department
		},
		dataType: "JSON",
		success: function (data) {
		
			$('#data_divisions').empty();
			$.each(data['data'], function (id, value) { 

				var btn_edit = '';
				var btn_del = '';
				var btn_active = '';
			
				<?php if(isset($check_user_access[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/edit"])) :?>
				btn_edit = '<button class="btn btn-info btn-sm btn_edit"> <i class="fas fa-edit"></i> </button> ';
				<?php endif; ?>

				<?php if(isset($check_user_access[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/del"])) :?>
				btn_del = '<button class="btn btn-danger btn-sm btn_del" ><i class="fa fa-trash"></i> </button> ';
				<?php endif; ?>
				
				<?php if(isset($check_user_access[substr($_SERVER['PATH_INFO'],1)][substr($_SERVER['PATH_INFO'],1)."/active"])) :?>
				if(value['fld_active'] == 1){
					btn_active = '<button class="btn btn-light btn-sm btn_active_0" ><i class="fa fa-eye-slash"></i> ปิดใช้งาน</button> ';
				}else if(value['fld_active'] == 0){
					btn_active = '<button class="btn btn-primary btn-sm btn_active_1" ><i class="fa fa-eye"></i> เปิดใช้งาน</button> ';
				}
				<?php endif; ?>

				
				$('#data_divisions').append(
				'<tr>'+
					'<td class="text-center id">' + value['fld_id'] + '</td>'+
					'<td class="text-center order">' + value['fld_order'] + '</td>'+
					'<td class="text-left">' + checknull(value['fld_name_th']) + '</td>'+
					'<td class="text-left">' + checknull(value['fld_name_en']) + '</td>'+
					'<td class="text-left">' + checknull(value['fld_other_details']) + '</td>'+
					'<td class="text-left">' + value['html_active_status'] + '</td>'+
					'<td class="text-left">'+ btn_edit + btn_del + btn_active + '</td>'+
				'</tr>'
				);

			});

			// pagination
				var total = (Math.ceil(parseInt(data['total']) / parseInt(PerPage)));
				<?php $this->load->view('template/js/pagination-1-js'); ?>
			// END pagination


		}
		});

	};

	function get_departments_all(type) 
	{ 
	
		$.ajax({
			type:'POST',
			url: "<?= site_url('Employee_departments/get_departments_all')?>",
			dataType:'JSON',
		}).done(function(data){

			if(type == 'search'){
				$( "#search_department" ).select2({
					theme: "bootstrap4"
				}); 

				$('#search_department').empty();
				$('#search_department').append('<option value="">เลือกฝ่าย</option>');
				$.each(data['departments'],function(id,val){
					$('#search_department').append(
						'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
					);
				});
			}

			if(type == 'manage'){
				$( "#department_id" ).select2({
					theme: "bootstrap4"
				}); 

				$('#department_id').empty();
				$('#department_id').append('<option value="">เลือกฝ่าย</option>');
				$.each(data['departments'],function(id,val){
					$('#department_id').append(
						'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
					);
				});
			}
		
		}).fail(function(data){
		
			Swal.fire({
				icon: 'error',
				title: 'ผิดพลาด',
				text: 'อะไรบางอย่างผิดปกติ',
				footer: data.statusText + ' ' + data.status,
				backdrop: `rgba(249, 186, 186, 0.8)`,
				allowOutsideClick: false,
				confirmButtonText: 'ปิด',
				confirmButtonColor: '#c72e2e'
			});
		
		});

	};


	function get_divisions_active_status() 
	{ 

		$.ajax({
		type: "POST",
		url: "<?= site_url('employee_divisions/get_divisions_active_status')?>",
		dataType: "JSON",
		success: function (data) {
		
			$( "#search_active" ).select2({
				theme: "bootstrap4"
			}); 

			$('#search_active').empty();
			$('#search_active').append('<option value="">เลือกสถานะใช้งาน</option>');
			$.each(data,function(id,value){
				$('#search_active').append(
					'<option value="'+value['id']+'">'+value['name']+'</option>'
				);
			});

		}
		});

	};

	function get_divisions_byid(id,type) 
	{ 
	
		$.ajax({
			type:'POST',
			url: "<?= site_url('employee_divisions/get_divisions_byid')?>",
			dataType:'JSON',
			data:{
				fld_id : id
			},
		}).done(function(data){

			// console.log(data);

			if(type == 'manage'){

				$('#divisions_id').val(id);
				$('#name_th').val(data['data']['fld_name_th']);
				$('#name_en').val(data['data']['fld_name_en']);
				$('#other_details').val(data['data']['fld_other_details']);
				$('#department_id').val(data['data']['fld_department_id']).trigger('change');

			}
			

		
		
		}).fail(function(data){
		
			Swal.fire({
				icon: 'error',
				title: 'ผิดพลาด',
				text: 'อะไรบางอย่างผิดปกติ',
				footer: data.statusText + ' ' + data.status,
				backdrop: `rgba(249, 186, 186, 0.8)`,
				allowOutsideClick: false,
				confirmButtonText: 'ปิด',
				confirmButtonColor: '#c72e2e'
			});
		
		});

	};

	function delete_divisions(id) 
	{ 
	
		$.ajax({
			type:'POST',
			url: "<?= site_url('employee_divisions/delete_divisions')?>",
			dataType:'JSON',
			data:{
				fld_id : id
			},
		}).done(function(data){

			if(data == 'usedata'){

				Swal.fire({
					icon: 'warning',
					title: 'เตือน',
					text: 'ข้อมูลถูกนำไปใช้งาน',
					backdrop: `rgba(49,53,56, 0.8)`,
					showClass: {
						icon: 'animated heartBeat delay-1s'
					},
					allowOutsideClick: false,
					confirmButtonText: 'ปิด',
					confirmButtonColor: '#3085d6'
				});

			}else{
				Swal.fire({
					title: 'สำเร็จ',
					text: "ลบข้อมูล",
					backdrop: `rgba(49,53,56, 0.8)`,
					icon: 'success',
					allowOutsideClick: false,
					confirmButtonColor: '#3085d6',
				}).then((result) => {
					if (result.isConfirmed) {

						search_function_1();
						
					}
				})
			}

			
		
		}).fail(function(data){
		
			Swal.fire({
				icon: 'error',
				title: 'ผิดพลาด',
				text: 'อะไรบางอย่างผิดปกติ',
				footer: data.statusText + ' ' + data.status,
				backdrop: `rgba(249, 186, 186, 0.8)`,
				allowOutsideClick: false,
				confirmButtonText: 'ปิด',
				confirmButtonColor: '#c72e2e'
			});
		
		});

	};

	function divisions_manage() 
	{ 
	
		if($('#divisions_type').val() == 'add'){
			var url = '<?= site_url('employee_divisions/post_divisions')?>';
		}else if($('#divisions_type').val() == 'edit'){
			var url = '<?= site_url('employee_divisions/put_divisions')?>';
		}

		$('#manageModal').modal('hide');
	
		$.ajax({
			type:'POST',
			url: url,
			dataType:'JSON',
			data:{
				fld_id : $('#divisions_id').val(),
				fld_name_th : $('#name_th').val(),
				fld_name_en : $('#name_en').val(),
				fld_other_details : $('#other_details').val(),
				fld_department_id : $('#department_id').val(),
				order_old : $('#divisions_order_old').val(),
				order_new : $('#divisions_order_new').val(),
			},
		}).done(function(data){

			Swal.fire({
				title: 'สำเร็จ',
				text: "บันทึกข้อมูล",
				backdrop: `rgba(49,53,56, 0.8)`,
				icon: 'success',
				allowOutsideClick: false,
				confirmButtonText: 'ปิด',
				confirmButtonColor: '#d33',
			}).then((result) => {
				if (result.isConfirmed) {

					search_function_1();

			    	clear_data_manage();
				}
			})
		
		}).fail(function(data){
		
			Swal.fire({
				icon: 'error',
				title: 'ผิดพลาด',
				text: 'อะไรบางอย่างผิดปกติ',
				footer: data.statusText + ' ' + data.status,
				backdrop: `rgba(249, 186, 186, 0.8)`,
				allowOutsideClick: false,
				confirmButtonText: 'ปิด',
				confirmButtonColor: '#c72e2e'
			});
		
		});

	};

	function put_divisions_active(id,active) 
	{ 
	
		$.ajax({
			type:'POST',
			url: "<?= site_url('employee_divisions/put_divisions_active')?>",
			dataType:'JSON',
			data:{
				fld_id : id,
				fld_active : active,
			},
		}).done(function(data){
			
			Swal.fire({
				title: 'สำเร็จ',
				text: "บันทึกข้อมูล",
				backdrop: `rgba(49,53,56, 0.8)`,
				icon: 'success',
				allowOutsideClick: false,
				confirmButtonText: 'ปิด',
				confirmButtonColor: '#d33',
			}).then((result) => {
				if (result.isConfirmed) {

					search_function_1();
					
				}
			})
		
		}).fail(function(data){
		
			Swal.fire({
				icon: 'error',
				title: 'ผิดพลาด',
				text: 'อะไรบางอย่างผิดปกติ',
				footer: data.statusText + ' ' + data.status,
				backdrop: `rgba(249, 186, 186, 0.8)`,
				allowOutsideClick: false,
				confirmButtonText: 'ปิด',
				confirmButtonColor: '#c72e2e'
			});
		
		});

	};


</script>
