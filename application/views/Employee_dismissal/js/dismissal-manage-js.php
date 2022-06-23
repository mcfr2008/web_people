<?php $check_user_access = $this->Main_model->check_user_access(); ?>

<script>

    $(document).ready(function () {

		
		// 1	Working	ทำงาน
		// 2	Not working	ยกเลิก
		// 3	Furlough	พักงาน
		get_auto_employees(1);

		validate();
	
		action_function();
			
    });

	function action_function() 
	{ 

		$('#date').change(function (e) { 
            e.preventDefault();
            var date = $('#date').val();
            var varDate = new Date(date);
            var today = new Date();

            if(varDate <= today) {

                $('#date').val("<?= date('Y-m-d') ?>");
                
            }

        });

		// $('#date').daterangepicker({
		// 	"singleDatePicker": true,
		// 	// "showDropdowns": true,
		// 	// "timePicker24Hour": true,
		// 	// "timePickerIncrement": 0,
		// 	// "timePickerSeconds": true,
		// 	// "autoApply": true,
		// 	"autoUpdateInput": false,
		// 	// "maxSpan": {
		// 	// 	"days": 7
		// 	// },
		// 	// ranges: {
		// 	// 	'วันนี้': [moment(), moment()],
		// 	// 	'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		// 	// 	'7 วันที่ผ่านมา': [moment().subtract(6, 'days'), moment()],
		// 	// 	'30 วันที่ผ่านมา': [moment().subtract(29, 'days'), moment()],
		// 	// 	'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
		// 	// 	'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		// 	// },
		// 	"locale": {
		// 		"format": "DD/MM/YYYY",
		// 		"separator": " - ",
		// 		"applyLabel": "ตกลง",
		// 		"cancelLabel": "ยกเลิก",
		// 		"fromLabel": "From",
		// 		"toLabel": "To",
		// 		"customRangeLabel": "กำหนดเอง",
		// 		"weekLabel": "W",
		// 		"daysOfWeek": [
		// 			"อา",
		// 			"จ",
		// 			"อ",
		// 			"พ",
		// 			"พฤ",
		// 			"ศ",
		// 			"ส"
		// 		],
		// 		"monthNames": [
		// 			"มกราคม",
		// 			"กุมภาพันธ์",
		// 			"มีนาคม",
		// 			"เมษายน",
		// 			"พฤษภาคม",
		// 			"มิถุนายน",
		// 			"กรกฎาคม",
		// 			"สิงหาคม",
		// 			"กันยายน",
		// 			"ตุลาคม",
		// 			"พฤศจิกายน",
		// 			"ธันวาคม",
		// 		],
		// 		"firstDay": 0 ,

		// 	},
		// 	"alwaysShowCalendars": true,
		// 	// "startDate": "01/04/2022",
		// 	// "endDate": "02/04/2022",
		// 	"minDate": moment().format('DD/MM/YYYY'),
		// 	// "maxDate": "10/04/2022",
		// 	// "minuteStep": "10" ,
		// 	"opens": "center",
		// 	"drops": "auto",
		// 	"applyButtonClasses": "btn btn-secondary",
		// 	"buttonClasses" : "btn",
		// });

		// $('#date').on('apply.daterangepicker', function(ev, picker) {
		// 	$(this).val(picker.startDate.format('DD/MM/YYYY'));
		// });

		// $('#date').data('daterangepicker').setStartDate('31/05/2022');
		// $('#date').daterangepicker({ startDate: '03/05/2005' });

		// $('#date').data('daterangepicker').setStartDate('03/01/2014');
		// $('#date').data('daterangepicker-between').setEndDate('03/31/2014');

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
				date: {
					required: true,
				},
			
				other_details: {
					required: true,
				},
			},
			messages: {

				auto_employees: {
					required: "กรุณากรอกข้อมูล",
				},
				
				date: {
					required: "กรุณากรอกข้อมูล",
				},
			
				other_details: {
					required: "กรุณากรอกข้อมูล",
					// minlength: "Your password must be at least 20 characters long"
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
		var info = {
			fld_employee_id : $('#auto_employees').val(),
			fld_organization_id : $('#info_organization_id').val(),
			fld_division_id : $('#info_division_id').val(),
			fld_position_id : $('#info_position_id').val(),
		}

		// detail
		var detail = {
			// fld_date : $('#date').data('daterangepicker').startDate.format('YYYY-MM-DD'),
			fld_date : $('#date').val(),
			fld_other_details : $('#other_details').val(),
			
		}

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
				dismissal_manage(
					lang , type, id, info, detail
				) 
			}
		});

	};


	function dismissal_manage(
		lang , type, id, info, detail
	) 
	{ 
	
		if(type == 'add'){
			var url = '<?= site_url('Employee_dismissal/post_dismissal')?>';
		}else if(type == 'edit'){
			var url = '<?= site_url('Employee_dismissal/put_dismissal')?>';
		}

		$.ajax({
			type:'POST',
			url: url,
			dataType:'JSON',
			data:
			{
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
				footer: data.statusText + ' ' + data.status,
				backdrop: `rgba(249, 186, 186, 0.8)`,
				allowOutsideClick: false,
				confirmButtonText: 'ปิด',
				confirmButtonColor: '#c72e2e'
			});
		
		});

	};


</script>
