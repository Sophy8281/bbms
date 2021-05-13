<!doctype html>
<html>

<head>
    <title>Donations pdf report</title>

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

    <h3 style="color: red">Donations</h3>
    <table>
        <tr>
            <th>#Id</th>
            <th>Donor</th>
            <th>Bank</th>
            <th>Bag_SNo.</th>
            <th>B_Group</th>
            <th>status</th>
            <th>Created_on</th>
        </tr>
        @foreach($donations as $donation)
        <tr>
            <td>{{ $donation->id }}</td>
            <td>{{ $donation->donor->name }}</td>
            <td>{{ $donation->bank->name }}</td>
            <td>{{ $donation->bag_serial_number }}</td>
            @if ($donation->donation_id)
            <td>{{ $donation->donation->name }}</td>
            @else
            <td></td>
            @endif
            <td>{{ $donation->status  }}</td>
            <td>{{ date('F d, Y', strtotime($donation->created_at)) }}</td>
        </tr>
        @endforeach
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
