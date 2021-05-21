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
        var BloodIn = {{ json_encode($blood,JSON_NUMERIC_CHECK) }};
        var BloodRequests = {{ json_encode($blood_requests,JSON_NUMERIC_CHECK) }};
        $('#highchart').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'BLOOD TRENDS'
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
                name: 'BLOOD IN',
                data: BloodIn
            }, {
                name: 'BLOOD REQUESTS',
                data: BloodRequests
            }]
        });
    });
</script>
@endsection
