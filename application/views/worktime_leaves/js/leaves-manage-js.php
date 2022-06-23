<?php $check_user_access = $this->Main_model->check_user_access(); ?>

<script>

    $(document).ready(function () {

		
		// 1	Working	ทำงาน
		// 2	Not working	ยกเลิก
		// 3	Furlough	พักงาน
		get_auto_employees(1);

		// active,trash
		// get_select_driving_license_type(1,1)

		// active,trash
		get_select_leave_types(1,1)

		validate();
	
		action_function();
			
    });



	function action_function() 
	{ 

		$('#date_str_end').daterangepicker({
			// "singleDatePicker": true,
			// "showDropdowns": true,
			// "timePicker24Hour": true,
			// "timePickerIncrement": 0,
			// "timePickerSeconds": true,
			// "autoApply": true,
			// "autoUpdateInput": false,
			// "maxSpan": {
			// 	"days": 7
			// },
			// ranges: {
			// 	'วันนี้': [moment(), moment()],
			// 	'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			// 	'7 วันที่ผ่านมา': [moment().subtract(6, 'days'), moment()],
			// 	'30 วันที่ผ่านมา': [moment().subtract(29, 'days'), moment()],
			// 	'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
			// 	'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			// },
			"locale": {
				"format": "DD/MM/YYYY",
				"separator": " - ",
				"applyLabel": "ตกลง",
				"cancelLabel": "ยกเลิก",
				"fromLabel": "From",
				"toLabel": "To",
				"customRangeLabel": "กำหนดเอง",
				"weekLabel": "W",
				"daysOfWeek": [
					"อา",
					"จ",
					"อ",
					"พ",
					"พฤ",
					"ศ",
					"ส"
				],
				"monthNames": [
					"มกราคม",
					"กุมภาพันธ์",
					"มีนาคม",
					"เมษายน",
					"พฤษภาคม",
					"มิถุนายน",
					"กรกฎาคม",
					"สิงหาคม",
					"กันยายน",
					"ตุลาคม",
					"พฤศจิกายน",
					"ธันวาคม",
				],
				"firstDay": 0

			},
			"alwaysShowCalendars": true,
			// "startDate": "01/04/2022",
			// "endDate": "02/04/2022",
			"minDate": moment().format('DD/MM/YYYY'),
			// "maxDate": "10/04/2022",
			// "minuteStep": "10" ,
			"opens": "center",
			"drops": "auto",
			"applyButtonClasses": "btn btn-secondary",
			"buttonClasses" : "btn",
		});
	

	};

	function validate() 
	{
		
		$.validator.setDefaults({
			submitHandler: function () {

				get_data_input();

			}
		});
		$('#validate').validate({
			rules: {
				// password: {
				// 	required: true,
				// 	minlength: 5
				// },
				auto_employees: {
					required: true,
				},
				select_leave_types: {
					required: true,
				},
				date_str_end: {
					required: true,
				},
				point_out: {
					required: true,
				},
				point_in: {
					required: true,
				},
				other_details: {
					required: true,
				},
				contact_name: {
					required: true,
				},
				contact_type: {
					required: true,
				},
			},
			messages: {

				auto_employees: {
					required: "กรุณากรอกข้อมูล",
				},
				select_leave_types: {
					required: "กรุณากรอกข้อมูล",
				},
				date_str_end: {
					required: "กรุณากรอกข้อมูล",
				},
				point_out: {
					required: "กรุณากรอกข้อมูล",
				},
				point_in: {
					required: "กรุณากรอกข้อมูล",
				},
				other_details: {
					required: "กรุณากรอกข้อมูล",
					// minlength: "Your password must be at least 20 characters long"
				},
				contact_name: {
					required: "กรุณากรอกข้อมูล",
				},
				contact_type: {
					required: "กรุณากรอกข้อมูล",
				},
				// other_details: "Please accept our terms"
			},
			errorElement: 'span',
			errorPlacement: function (error, element) {
				error.addClass('text-warning');
				element.closest('.form-group').append(error);
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass('is-warning').removeClass('is-valid');
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).removeClass('is-warning').addClass('is-valid');
			}
		});
	};

	function get_data_input() 
	{

		// manage
		var lang = "<?= $lang ?>";
		var type = "<?= $type ?>";
		var id = "<?= $id ?>";

		// info
		// var employee_id = $('#auto_employees').val();
		// var organization_id = $('#info_organization_id').val();
		// var division_id = $('#info_division_id').val();
		// var position_id = $('#info_position_id').val();
		var info = {
			employee_id : $('#auto_employees').val(),
			organization_id : $('#info_organization_id').val(),
			division_id : $('#info_division_id').val(),
			position_id : $('#info_position_id').val(),
		}

		// detail
		// var select_leave_types = $('#select_leave_types').val();
		// var date_str_end = $('#date_str_end').data('daterangepicker').startDate.format('YYYY-MM-DD');
		// var date_str_end = $('#date_str_end').data('daterangepicker').endDate.format('YYYY-MM-DD');
		// var point_out = $('input[name=point_out]:checked').val();
		// var point_in = $('input[name=point_in]:checked').val();
		// var other_details = $('#other_details').val();
		// var contact_name = $('#contact_name').val();
		// var contact_type = $('#contact_type').val();

		// detail
		var detail = {
			select_leave_types : $('#select_leave_types').val(),
			date_str_end : $('#date_str_end').data('daterangepicker').startDate.format('YYYY-MM-DD'),
			date_str_end : $('#date_str_end').data('daterangepicker').endDate.format('YYYY-MM-DD'),
			point_out : $('input[name=point_out]:checked').val(),
			point_in : $('input[name=point_in]:checked').val(),
			other_details : $('#other_details').val(),
			contact_name : $('#contact_name').val(),
			contact_type : $('#contact_type').val(),
		}

	

		console.log(lang,type ,id, info,detail);
	

	};


	function leaves_manage(
		lang , type ,id, info,detail
	) 
	{ 
	
		if(type == 'add'){
			var url = '<?= site_url('Worktime_leaves/post_leaves')?>';
		}else if(type == 'edit'){
			var url = '<?= site_url('Worktime_leaves/put_leaves')?>';
		}

		$.ajax({
			type:'POST',
			url: url,
			dataType:'JSON',
			data:{
				lang : lang ,
				type : type ,

				fld_id : id,
				info : info,
				detail : detail,
			
			},
		}).done(function(data){

			Swal.fire({
				title: 'สำเร็จ',
				text: "บันทึกข้อมูล",
				backdrop: `rgba(49,53,56, 0.8)`,
				icon: 'success',
				allowOutsideClick: false,
				confirmButtonColor: '#3085d6',
			}).then((result) => {
				if (result.isConfirmed) {

					location.reload();
				
				}
			})
		
		}).fail(function(data){
		
			Swal.fire({
				icon: 'error',
				title: 'ผิดพลาด',
				text: 'อะไรบางอย่างผิดปกติ',
				backdrop: `rgba(49,53,56, 0.8)`,
				allowOutsideClick: false,
				confirmButtonText: 'ปิด',
				confirmButtonColor: '#3085d6'
			});
		
		});

	};


</script>
