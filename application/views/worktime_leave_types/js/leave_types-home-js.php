<?php $check_user_access = $this->Main_model->check_user_access(); ?>

<script>

    $(document).ready(function () {
	
		action_function();

		get_leave_types_active_status();

		search_function_1();
      
    });

	function search_function_1() 
	{
		var search_text = '';
		var search_active = '';
		search_text = $('#search_text').val();
		search_active = $('#search_active').val();
		get_leave_types(search_text,search_active);
	};

	function search_function_2() 
	{
		var search_text = '';
		var search_active = '';
		search_text = $('#search_text').val();
		search_active = $('#search_active').val();
		$('#pageNumber').val(0);
		get_leave_types(search_text,search_active);
	};

	function action_function() 
	{ 

		// list
			
			$('#search_text').keyup(function (e) { 
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
				search_text = $('#search_text').val();
				search_active = $('#search_active').val();
				$('#pageNumber').val($(this).text()-1);
				get_leave_types(search_text,search_active);
			});

		// END list

		$('#btn_add').click(function () {
			clear_data_manage();
		
			$('#manageModal').modal('show');
			$('#leave_types_title').text('เพิ่ม');
			$('#leave_types_type').val('add');
		});

		$('#data_leave_types').on('click','.btn_edit',function(){ 
			
			clear_data_manage();
			$('#manageModal').modal('show');
			$('#leave_types_title').text('แก้ไข');
			$('#leave_types_type').val('edit');

			var id = $(this).closest('tr').find('.id').text();
			var order = $(this).closest('tr').find('.order').text();

			$('#leave_types_order_old').val(order);
			$('#leave_types_order_new').val(order);
			
			get_leave_types_byid(id,'manage');
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
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'ใช่ ,ฉัน ตกลง',
					cancelButtonText: 'ปิด',
				}).then((result) => {
					if (result.isConfirmed) {
						leave_types_manage();
					}
				})

			}

		});

		$('#data_leave_types').on('click','.btn_del',function(){ 

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

					delete_leave_types(id);

				}
			})
			
		});

		$('#data_leave_types').on('click','.btn_active_1',function(){ 
			
		
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
					put_leave_types_active(id,active);
				}
			})

		});

		$('#data_leave_types').on('click','.btn_active_0',function(){ 
			
		
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
					put_leave_types_active(id,active);
				}
			})

		});


	};

	function clear_data_manage()
	{ 
		$('#leave_types_type').val('');
		$('#leave_types_id').val('');
		
		$('#name_th').val('').removeClass( "is-warning is-valid" );
		$('#name_en').val('').removeClass( "is-warning is-valid" );
		$('#group').val('').removeClass( "is-warning is-valid" );
		$('#other_details').val('').removeClass( "is-warning is-valid" );

		$('#leave_types_order_old').val('');
		$('#leave_types_order_new').val('').removeClass( "is-warning is-valid" );

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

		if($("#group").val() == '' ){
			$( "#group" ).removeClass( "is-valid" ).addClass( "is-warning" );
			validate = 'false';
		}else if($('#group').val() != '' ){
			$( "#group" ).removeClass( "is-warning" ).addClass( "is-valid" );
		}

		if($("#leave_types_order_new").val() == '' ){
			$( "#leave_types_order_new" ).removeClass( "is-valid" ).addClass( "is-warning" );
			validate = 'false';
		}else if($('#leave_types_order_new').val() != '' ){
			$( "#leave_types_order_new" ).removeClass( "is-warning" ).addClass( "is-valid" );
		}

        return validate;
		
	};

	function get_leave_types(search_text,search_active) 
	{ 

		var PerPage = parseInt($('#PerPage').val());
		var pageNumber = $('#pageNumber').val();

		$.ajax({
		type: "POST",
		url: "<?= site_url('worktime_leave_types/get_leave_types')?>",
		data : {
			pageNumber : pageNumber ,
			PerPage : PerPage,
			search_text : search_text,
			search_active : search_active,
		},
		dataType: "JSON",
		success: function (data) {
		
			$('#data_leave_types').empty();
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

				
				$('#data_leave_types').append(
				'<tr>'+
					'<td class="text-center id">' + value['fld_id'] + '</td>'+
					'<td class="text-center order">' + value['fld_order'] + '</td>'+
					'<td class="text-center">' + value['fld_group'] + '</td>'+
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


	function get_leave_types_active_status() 
	{ 

		$.ajax({
		type: "POST",
		url: "<?= site_url('worktime_leave_types/get_leave_types_active_status')?>",
		dataType: "JSON",
		success: function (data) {
		
			$( "#search_active" ).select2({
				theme: "bootstrap4"
			}); 

			$('#search_active').empty();
			$('#search_active').append('<option value="">เลือก</option>');
			$.each(data,function(id,value){
				$('#search_active').append(
					'<option value="'+value['id']+'">'+value['name']+'</option>'
				);
			});

		}
		});

	};

	function get_leave_types_byid(id,type) 
	{ 
	
		$.ajax({
			type:'POST',
			url: "<?= site_url('worktime_leave_types/get_leave_types_byid')?>",
			dataType:'JSON',
			data:{
				fld_id : id
			},
		}).done(function(data){

			// console.log(data);

			if(type == 'manage'){

				$('#leave_types_id').val(id);
				$('#name_th').val(data['data']['fld_name_th']);
				$('#name_en').val(data['data']['fld_name_en']);
				$('#group').val(data['data']['fld_group']);
				$('#other_details').val(data['data']['fld_other_details']);

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

	function delete_leave_types(id) 
	{ 
	
		$.ajax({
			type:'POST',
			url: "<?= site_url('worktime_leave_types/delete_leave_types')?>",
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

	function leave_types_manage() 
	{ 
	
		if($('#leave_types_type').val() == 'add'){
			var url = '<?= site_url('worktime_leave_types/post_leave_types')?>';
		}else if($('#leave_types_type').val() == 'edit'){
			var url = '<?= site_url('worktime_leave_types/put_leave_types')?>';
		}

		$('#manageModal').modal('hide');
	
		$.ajax({
			type:'POST',
			url: url,
			dataType:'JSON',
			data:{
				fld_id : $('#leave_types_id').val(),
				fld_name_th : $('#name_th').val(),
				fld_name_en : $('#name_en').val(),
				fld_group : $('#group').val(),
				fld_other_details : $('#other_details').val(),
				order_old : $('#leave_types_order_old').val(),
				order_new : $('#leave_types_order_new').val()
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

	function put_leave_types_active(id,active) 
	{ 
	
		$.ajax({
			type:'POST',
			url: "<?= site_url('worktime_leave_types/put_leave_types_active')?>",
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
