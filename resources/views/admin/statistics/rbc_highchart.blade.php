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
        var RbcIn = {{ json_encode($rbc,JSON_NUMERIC_CHECK) }};
        var RbcRequests = {{ json_encode($rbc_requests,JSON_NUMERIC_CHECK) }};
        $('#highchart').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'RED BLOOD CELLS TRENDS'
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
                name: 'RED BLOOD CELLS IN',
                data: RbcIn
            }, {
                name: 'RED BLOOD CELLS REQUESTS',
                data: RbcRequests
            }]
        });
    });
</script>
@endsection
