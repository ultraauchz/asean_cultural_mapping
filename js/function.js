function empty(data) {
    if (typeof(data) == 'number' || typeof(data) == 'boolean') {
        return false;
    }
    if (typeof(data) == 'undefined' || data === null) {
        return true;
    }
    if (typeof(data.length) != 'undefined') {
        return data.length == 0;
    }
    var count = 0;
    for (var i in data) {
        if (data.hasOwnProperty(i)) {
            count++;
        }
    }
    return count == 0;
}

function isNumeric(evt) {
	var isNumber = (evt.which) ? evt.which : evt.keyCode;
	if(isNumber > 31 && (isNumber < 48 || isNumber > 57)) {
		return false;
	} else {
		return true;
	}
}
		
$(".num-format").keyup(function(){
	var x = $(this);
	var y= $(this).val();
	
	if(y.charAt(0)==0) {
		var tovalue = y.charAt(1)
		$(x).val(tovalue);
		y = $(this).val();
	}
	
	$(x).val(y.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
	caltotal();
})

function randomInteger(length) {
    var chars = '0123456789'.split('');

    if (! length) {
        length = Math.floor(Math.random() * chars.length);
    }

    var str = '';
    for (var i = 0; i < length; i++) {
        str += chars[Math.floor(Math.random() * chars.length)];
    }
    return str;
}

function randomString(length) {
    var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split('');

    if (! length) {
        length = Math.floor(Math.random() * chars.length);
    }

    var str = '';
    for (var i = 0; i < length; i++) {
        str += chars[Math.floor(Math.random() * chars.length)];
    }
    return str;
}