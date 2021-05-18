<!doctype html>
<html>

<head>
    <title>Donors pdf report</title>

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

    <h3 style="color: red">Donors</h3>
    <table>
        <tr>
            <th>#Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>DoB</th>
            <th>Phone</th>
            <th>B_Group</th>
            <th>Residence</th>
            <th>Created_on</th>
            {{-- <th>Updated On</th> --}}
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->gender }}</td>
            {{-- <td>{{ $user->birth_date }}</td> --}}
            <td>{{ date('F d, Y', strtotime($user->birth_date)) }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->blood_group }}</td>
            <td>{{ $user->county }}</td>
            <td>{{ date('F d, Y h:m A', strtotime($user->created_at)) }}</td>
            {{-- <td>{{ date('F d, Y h:m A', strtotime($user->updated_at)) }}</td> --}}
        </tr>
        @endforeach
    </table>
    {{-- {{ $users->render() }} --}}
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
