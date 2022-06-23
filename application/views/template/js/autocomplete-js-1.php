<script>
    

   function get_auto_employees(employee_status) 
   {
		$('.auto_employees').select2({
            placeholder: 'ค้นหา',
			theme: "bootstrap4",
            ajax: {
				url: "<?= site_url('Tools_info/get_auto_employees')?>",
                dataType: 'json',
                delay: 250,
                data: function (data) {
                    return {
                        search_text: data.term ,
                        employee_status: employee_status ,
                    };
                },
                processResults: function (response) {

					// hidden value
					$('#info_position_id').val(response[0]['position_id']);
					$('#info_division_id').val(response[0]['division_id']);
					$('#info_organization_id').val(response[0]['organization_id']);
					// show value
					$('#info_fullname').html(response[0]['fullname']);
					$('#info_position_name').html(response[0]['position_name_th']);
					$('#info_card_id').html(response[0]['card_id']);
					$('#info_division_name').html(response[0]['division_name_th']);
					$('#info_organization_name').html(response[0]['organization_name_th']);

                    return {
                        results:response
                    };
                },
                cache: true
            }
        });
   };


</script>
