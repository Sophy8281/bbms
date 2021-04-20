<!doctype html>
<html>

<head>
    <title>Available platelets pdf report</title>

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
<h3 style="color: red">Platelets Available</h3>
<table class="table">

    <tr>
        <th>#Id</th>
        <th>Bank</th>
        <th>Stored By</th>
        <th>Agitator</th>
        <th>Bag SNo.</th>
        <th>Blood Group</th>
        <th>Donation</th>
        <th>Expiry</th>
        <th>Days Remaining</th>



    </tr>

    @forelse($platelets as $platelet)
    <tr>
        <td>{{ $platelet->id }}</td>
        <td>{{ $platelet->bank->name }}</td>
        <td>{{ $platelet->staff->name }}</td>
        <td>{{ $platelet->agitator->name}}</td>
        <td>{{ $platelet->bag_serial_number }}</td>
        <td>{{ $platelet->group->name }}</td>
        <td>{{ $platelet->donation_date }}</td>
        <td>{{ $platelet->expiry_date }}</td>
        @if ($platelet->expiry_date == Carbon\Carbon::today()|$platelet->expiry_date < Carbon\Carbon::today())
            <td>
                <a href="" class="btn btn-warning"> EXPIRED</a>
            </td>

        @else
            <td>{{ Carbon\Carbon::create($platelet->expiry_date)->diffInDays(Carbon\Carbon::today())}}</td>


        @endif
    </tr>
    @empty
    <tr>
        <td colspan="4">No Platelets found.</td>
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
