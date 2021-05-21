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
        var PlateletsIn = {{ json_encode($platelets,JSON_NUMERIC_CHECK) }};
        var PlateletsRequests = {{ json_encode($platelets_requests,JSON_NUMERIC_CHECK) }};
        $('#highchart').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'PLATELETS TRENDS'
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
                name: 'PLATELETS IN',
                data: PlateletsIn
            }, {
                name: 'PLATELETS REQUESTS',
                data: PlateletsRequests
            }]
        });
    });
</script>
@endsection
