<div id="fullcalendar" ></div>

<script type="text/javascript" >
	$(document).ready(function(){

		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$("#fullcalendar").fullCalendar({
			editable: false,
			header: {
				left: "prev",
				center: "title",
				right: "next"
			}
			, events: {
						 url: 'reports/gen_calendar',
				         data: function() { // a function that returns an object
				            return {
				                monthParam : $('#calendar').fullCalendar( 'getDate' ).getMonth(),
				                yearParam : $('#calendar').fullCalendar( 'getDate' ).getFullYear(),
				            };
				         }
			},
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}
		});
		
	})
</script>