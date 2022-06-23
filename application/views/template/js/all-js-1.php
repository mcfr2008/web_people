<script>

	$(document).ready(function () {
		
		

		// $('.daterangepicker-between').daterangepicker({
		// 	// "singleDatePicker": true,
		// 	// "showDropdowns": true,
		// 	// "timePicker24Hour": true,
		// 	// "timePickerIncrement": 0,
		// 	// "timePickerSeconds": true,
		// 	// "autoApply": true,
		// 	// "autoUpdateInput": false,
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
		// 		"firstDay": 0

		// 	},
		// 	"alwaysShowCalendars": true,
		// 	// "startDate": "01/04/2022",
		// 	// "endDate": "02/04/2022",
		// 	// "minDate": "01/04/2022",
		// 	// "maxDate": "10/04/2022",
		// 	// "minuteStep": "10" ,
		// 	"opens": "center",
		// 	"drops": "auto",
		// 	"applyButtonClasses": "btn btn-secondary",
		// 	"buttonClasses" : "btn",
		// });

	});
    

    function date_full_thai(dateObject)
    {
        var thaimonth =["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม"]; 
        var thaiweek = ["วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัส","วันศุกร์","วันเสาร์"];

        var d = new Date(dateObject.replace(/\s/, 'T'));
        var day = [d.getDate()];
        var month = thaimonth[d.getMonth()] ;
        var year = d.getFullYear()+543;
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        var date = 'วัน' + 'ที่ ' + day + " เดือน " + month + " ปี " + year;

        return date;
    };

    function date(lang,data)
    {
		// lang = thai พ.ศ
		// lang = eng ค.ศ
		// data = date convert
		var year_in = 0;
		if(lang == 'thai'){
			year_in = 543;
		}else if(lang == 'eng'){
			year_in = 0;
		}

        var d = new Date(data.replace(/\s/, 'T'));
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear() + year_in;
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        var date = day + "/" + month + "/" + year;

        return date;
    };

    function time(data)
    {
        var t = new Date(data.replace(/\s/, 'T'));
        var Hour = t.getHours();
        var Minutes = t.getMinutes() ;
        var Seconds = t.getSeconds();

        var time = Hour + ":" + Minutes + ":" + Seconds;

        return time;
    };

	function checknull(data) 
    {

        if(data == '' || data == null){
            result = '';
        }else{
            result = data;
        }
        
        return result;
    };


</script>
