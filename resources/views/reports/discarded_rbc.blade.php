<!doctype html>
<html>

<head>
    <title>Discarded red blood cells pdf report</title>

    <!-- Styles -->
    <style>
        .information {
            background-color: #f70909;
            color: #FFF;
        }
        /* .information .logo {
            margin: 5px;
        } */
        /* .information table {
            padding: 2px;
        } */
    </style>

</head>

<body>
    <div class="information">
        <table width="100%">
            <tr>

                {{-- <td align="center">
                    <img src="/path/to/logo.png" alt="Logo" width="64" class="logo"/>
                </td> --}}
                <td>
                    <pre>
                        Blood Bank Management System
                        {{ config('app.url') }}
                        232 Adam Street, Nairobi, N 00001
                    </pre>
                </td>
            </tr>
        </table>
    </div>
<h3 style="color: red">Red Blood Cells Discarded</h3>
<table class="table">

    <tr>
        <th>#Id</th>
        <th>Bank</th>
        <th>Discarded By</th>
        <th>Refrigerator</th>
        <th>Bag SNo.</th>
        <th>Blood Group</th>
        <th>Donation</th>
        <th>Expiry</th>
        <th>Days Remaining</th>


    </tr>

    @forelse($rbc as $rbc)
    <tr>
        <td>{{ $rbc->id }}</td>
        <td>{{ $rbc->bank->name }}</td>
        <td>{{ $rbc->staff->name }}</td>
        <td>{{ $rbc->refrigerator->name}}</td>
        <td>{{ $rbc->bag_serial_number }}</td>
        <td>{{ $rbc->group->name }}</td>
        <td>{{ $rbc->donation_date }}</td>
        <td>{{ $rbc->expiry_date }}</td>
        @if ($rbc->expiry_date == Carbon\Carbon::today()|$rbc->expiry_date < Carbon\Carbon::today())
            <td>
                <a href="" class="btn btn-warning">EXPIRED</a>
            </td>

        @else
            <td>{{ Carbon\Carbon::create($rbc->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>

        @endif
    </tr>
    @empty
    <tr>
        <td colspan="4">No red blood cells discarded.</td>
    </tr>
@endforelse
</table>
<div class="information" style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
            </td>
            <td style="width: 50%;">
                Donate a pint and save a life.
            </td>
        </tr>

    </table>
</div>
</body>

</html>
