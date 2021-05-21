@extends('layouts.admin_dashboard')
@section('breadcrumb')
Trends
@endsection
@section('content')
<div id="highchart"></div>
@endsection
@section('javascript')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    $(function () {
        var PlasmaIn = {{ json_encode($plasma,JSON_NUMERIC_CHECK) }};
        var PlasmaRequests = {{ json_encode($plasma_requests,JSON_NUMERIC_CHECK) }};
        $('#highchart').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'PLASMA TRENDS'
            },
            xAxis: {
                categories: ['April','May','June','July', 'Aug']
            },
            yAxis: {
                title: {
                    text: 'Rate'
                }
            },
            plotOptions: {
                series: {
                 allowPointSelect: false
                }
            },
            series: [{
                name: 'PLASMA IN',
                data: PlasmaIn
            }, {
                name: 'PLASMA REQUESTS',
                data: PlasmaRequests
            }]
        });
    });
</script>
@endsection
