<!doctype html>
<html>

<head>
    <title>Discarded Whole-Blood pdf report</title>

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
<h3 style="color: red">Whole-Blood Discarded</h3>
<table class="table">

    <tr>
        <th>#Id</th>
        <th>Donation_Id</th>
        <th>Bank</th>
        <th>Discarded By</th>
        <th>Bag SNo.</th>
        <th>B_Group</th>
        <th>Donation_Date</th>
        <th>Expiry</th>
        <th>Days_Remaining</th>
    </tr>

    @forelse($blood as $blood)
    <tr>
        <td>{{ $blood->id }}</td>
        <td>{{ $blood->donation_id }}</td>
        @if ($blood->bank_id)
        <td>{{ $blood->bank->name }}</td>
        @endif
        <td>{{ $blood->staff->name }}</td>
        <td>{{ $blood->bag_serial_number }}</td>
        <td>{{ $blood->group->name }}</td>
        <td>{{ $blood->donation_date }}</td>
        <td>{{ $blood->expiry_date }}</td>
        <td>{{ Carbon\Carbon::create($blood->expiry_date)->diffInDays($blood->donation_date)}}</td>
    </tr>

    @empty
    <tr>
        <td colspan="4">No Blood Discarded.</td>
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
