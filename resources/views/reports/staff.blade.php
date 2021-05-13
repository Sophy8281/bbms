<!doctype html>
<html>

<head>
    <title>Banks staff pdf report</title>

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
<h3 style="color: red">Banks Staff</h3>

<table>
    <tr>
        <th>#Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Bank</th>
        <th>Created On</th>
        {{-- <th>Updated On</th> --}}
    </tr>
    @foreach($staff as $staff)
    <tr>
        <td>{{ $staff->id }}</td>
        <td>{{ $staff->name }}</td>
        <td>{{ $staff->email }}</td>
        @if ($staff->bank_id)
        <td>{{ $staff->bank->name }}</td>
        @else
        <td></td>
        @endif
        <td>{{ date('F d, Y h:mA', strtotime($staff->created_at)) }}</td>
        {{-- <td>{{ date('F d, Y h:m A', strtotime($staff->updated_at)) }}</td> --}}
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
