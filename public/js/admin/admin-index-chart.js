var lineChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: false,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: false,
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
};

var lineChartData = function(paramLabels, paramLabel, paramData)
{
    return {
        labels: paramLabels,
        datasets: [{
            label: paramLabel,
            fillColor: "rgba(60,141,188,0.9)",
            strokeColor: "rgba(60,141,188,0.8)",
            pointColor: "#3b8bba",
            pointStrokeColor: "rgba(60,141,188,1)",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(60,141,188,1)",
            data: paramData,
        }],
    };
}

var AdminStatisticsViewModel = function()
{
    var self = this;

    self.url = '/admin/json/getStaticstics';
    self.data = ko.observableArray([]);
   
    self.completeLoadData = function(data)
    {
        self.data(data);
        $('#indicator-statistic-chart').addClass('hide');
    }

    self.showChartData = function()
    {
        var canvas = document.getElementById('admin-sales-line-chart');
        var context = canvas.getContext('2d');
        context.clearRect(0, 0, canvas.width, canvas.height);
        context.beginPath();


        var data = self.data();
        var lineChartCanvas = $('#admin-sales-line-chart').get(0).getContext('2d');
        var lineChart = new Chart(lineChartCanvas);
        lineChart.Line(lineChartData(data.labels, data.label, data.data), lineChartOptions);
    }

    self.initData = function()
    {
        $('#indicator-statistic-chart').removeClass('hide');

        self.data({orders: {}});

        var params = {month: '6'};
        var request = $.ajax({method: "GET", url: self.url, data: params});
        request.done(function(data){
            self.completeLoadData(data);
            self.showChartData();
        });

        return self;
    }

    self.selectDistanceMonths = function(data, event)
    {
        $('#indicator-statistic-chart').removeClass('hide');

        //Remove old canvas and create new canvas
        var canvas = $('#admin-sales-line-chart');
        var parent = canvas.parent();
        canvas.remove();
        var newCanvas = document.createElement('canvas');
        newCanvas.setAttribute('id', 'admin-sales-line-chart');
        parent.prepend(newCanvas);

        // Get Data server
        var element = event.target;
        var paramDistance = element.getAttribute('data-value');

        var params = {month: paramDistance};
        var request = $.ajax({method: "GET", url: self.url, data: params});

        request.done(function(data){
            self.completeLoadData(data);
            self.showChartData();
        });

        $(element).parent().children().removeClass('active');
        $(element).addClass('active');
    }
}

ko.applyBindings(
    new AdminStatisticsViewModel().initData(),
    document.getElementById('admin-chart-statistics')
);
