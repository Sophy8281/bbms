<!doctype html>
<html>

<head>
    <title>Issued plasma pdf report</title>

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
<h3 style="color: red">Plasma Issued</h3>
<table class="table">

    <tr>
        <th>#Id</th>
        <th>Bank</th>
        <th>Issued By</th>
        <th>Freezer</th>
        <th>Bag SNo.</th>
        <th>Blood Group</th>
        <th>Donation</th>
        <th>Expiry</th>
        <th>Issued To</th>
        <th>Days Remaining</th>
    </tr>

    @forelse($plasma as $plasma)
    <tr>
        <td>{{ $plasma->id }}</td>
        <td>{{ $plasma->bank->name }}</td>
        <td>{{ $plasma->staff->name }}</td>
        <td>{{ $plasma->freezer->name}}</td>
        <td>{{ $plasma->bag_serial_number }}</td>
        <td>{{ $plasma->group->name }}</td>
        <td>{{ $plasma->donation_date }}</td>
        <td>{{ $plasma->expiry_date }}</td>
        <td>{{ $plasma->hospital->name }}</td>
        <td>{{ Carbon\Carbon::create($plasma->expiry_date)->diffInDays($plasma->donation_date)}}</td>
    </tr>

    @empty
    <tr>
        <td colspan="4">No Plasma issued.</td>
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
