<script>

   function get_select_driving_license_type(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Driving_license_type/get_driving_license_type_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_driving_license_type" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_driving_license_type').empty();
			$('#select_driving_license_type').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_driving_license_type').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_blood_types(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Employee_blood_types/get_blood_types_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_blood_types" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_blood_types').empty();
			$('#select_blood_types').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_blood_types').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_departments(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Employee_departments/get_departments_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_departments" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_departments').empty();
			$('#select_departments').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_departments').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_disability_type(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Employee_disability_type/get_disability_type_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_disability_type" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_disability_type').empty();
			$('#select_disability_type').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_disability_type').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_divisions_type(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Employee_divisions_type/get_divisions_type_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_divisions_type" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_divisions_type').empty();
			$('#select_divisions_type').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_divisions_type').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_genders(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Employee_genders/get_genders_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_genders" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_genders').empty();
			$('#select_genders').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_genders').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_nationalities(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Employee_nationalities/get_nationalities_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_nationalities" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_nationalities').empty();
			$('#select_nationalities').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_nationalities').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_organizations(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Employee_organizations/get_organizations_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_organizations" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_organizations').empty();
			$('#select_organizations').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_organizations').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_positions(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Employee_positions/get_positions_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_positions" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_positions').empty();
			$('#select_positions').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_positions').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_prefix(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Employee_prefix/get_prefix_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_prefix" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_prefix').empty();
			$('#select_prefix').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_prefix').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_religions(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Employee_religions/get_religions_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_religions" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_religions').empty();
			$('#select_religions').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_religions').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_status(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Employee_status/get_status_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_status" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_status').empty();
			$('#select_status').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_status').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_vaccine_covid_19_type(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Vaccine_covid_19_type/get_vaccine_covid_19_type_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_vaccine_covid_19_type" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_vaccine_covid_19_type').empty();
			$('#select_vaccine_covid_19_type').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_vaccine_covid_19_type').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_holiday_dates_type_stop_working_status(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Worktime_holiday_dates/get_holiday_dates_type_stop_working_status_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_holiday_dates_type_stop_working_status" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_holiday_dates_type_stop_working_status').empty();
			$('#select_holiday_dates_type_stop_working_status').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_holiday_dates_type_stop_working_status').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };

   function get_select_leave_types(active,trash) 
   {

	$.ajax({
		type: "POST",
		url: "<?= site_url('Worktime_leave_types/get_leave_types_all')?>",
		data : {
			active : active ,
			trash : trash,
		},
		dataType: "JSON",
		success: function (data) {

			$( "#select_leave_types" ).select2({
				theme: "bootstrap4"
			}); 

			$('#select_leave_types').empty();
			$('#select_leave_types').append('<option value="">เลือก</option>');
			$.each(data['data'],function(id,val){
				$('#select_leave_types').append(
					'<option value="'+val['fld_id']+'">'+val['fld_name_th'] + ' / ' + val['fld_name_en'] +'</option>'
				);
			});


		} , error: function (data) {

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

		}
		});
   };


</script>
