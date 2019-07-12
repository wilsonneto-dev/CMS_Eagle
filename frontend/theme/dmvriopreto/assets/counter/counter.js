
var counter = {
	
	elements : { days: null, hours: null, minutes: null, seconds: null },
	date_to : null,

	init : function(_el_days, _el_hours, _el_minutes, _el_seconds, _date_to)
	{
		this.elements.days = _el_days;
		this.elements.hours = _el_hours;
		this.elements.minutes = _el_minutes;
		this.elements.seconds = _el_seconds;

		this.date_to = _date_to;

		var that = this;

		setInterval(function(){ that.update_elements() }, 1000);
	},

	update_elements : function()
	{
		var date_from = new Date();
		var timeDiff = (this.date_to.getTime() - date_from.getTime());
		this.elements.days.innerHTML = Math.ceil(timeDiff / 86400000); 
		this.elements.hours.innerHTML = Math.ceil((timeDiff % 86400000) / 3600000 ); 
		this.elements.minutes.innerHTML = Math.ceil((timeDiff%3600000) / 60000); 
		this.elements.seconds.innerHTML = Math.ceil((timeDiff%60000) / 1000); 
	}

}