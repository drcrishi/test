var wd = $(window).width();

if(wd > 767){
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable(chartData);

        var options = {
            legend: {position: 'none'},    
            tooltip : {
                trigger: 'none'
            },      
            height: '500',
            hAxis: {
                title: "",
                slantedText: true,
                slantedTextAngle: 90
            },
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
} else {
    google.charts.load('current', {'packages': ['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable(chartData);

    var options = {
        legend: {position: 'none'},    
        tooltip : {
            trigger: 'none'
        },
       fontSize: '40',       
       //width: '800',
       hAxis:{
           title: "",
           textStyle:{
             fontSize: '8',  
           },
       },
       height: '500',
    };
    
    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
}
}



$({someValue: 0}).animate({someValue: $(".yestCountEnq").data('value')}, {
    duration: 3000,
    easing: 'swing', // can be anything
    step: function () { // called on every step
        // Update the element's text with rounded-up value:
        $('.yestCountEnq').text(commaSeparateNumber(Math.round(this.someValue)));
    }
});
$({someValue: 0}).animate({someValue: $(".todayCountEnq").data('value')}, {
    duration: 3000,
    easing: 'swing', // can be anything
    step: function () { // called on every step
        // Update the element's text with rounded-up value:
        $('.todayCountEnq').text(commaSeparateNumber(Math.round(this.someValue)));
    }
});
$({someValue: 0}).animate({someValue: $(".yestCountBook").data('value')}, {
    duration: 3000,
    easing: 'swing', // can be anything
    step: function () { // called on every step
        // Update the element's text with rounded-up value:
        $('.yestCountBook').text(commaSeparateNumber(Math.round(this.someValue)));
    }
});
$({someValue: 0}).animate({someValue: $(".todayCountBook").data('value')}, {
    duration: 3000,
    easing: 'swing', // can be anything
    step: function () { // called on every step
        // Update the element's text with rounded-up value:
        $('.todayCountBook').text(commaSeparateNumber(Math.round(this.someValue)));
    }
});
$({someValue: 0}).animate({someValue: $(".tomorrowCountBook").data('value')}, {
    duration: 3000,
    easing: 'swing', // can be anything
    step: function () { // called on every step
        // Update the element's text with rounded-up value:
        $('.tomorrowCountBook').text(commaSeparateNumber(Math.round(this.someValue)));
    }
});

$({someValue: 0}).animate({someValue: $(".thismonthCountBook").data('value')}, {
    duration: 3000,
    easing: 'swing', // can be anything
    step: function () { // called on every step
        // Update the element's text with rounded-up value:
        $('.thismonthCountBook').text(commaSeparateNumber(Math.round(this.someValue)));
    }
});


function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }
    return val;
}


var lastWidth = $(window).width();

$(window).resize(function () {
    if ($(window).width() != lastWidth) {
        drawChart();
        lastWidth = $(window).width();
    }
});