<html>
    <head>
        <title>{{ $title }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>
    <body>
        <style>
            * {
                font-family: sans-serif;
                font-size: 11px;
            }
            .page-break {
                page-break-after: always;
            }
            table {
                width: 100%;
                padding: 3px;
                spacing: 0px;
                border: 0px;
            }
            tr > td {
                border-bottom: 1px dotted;
            }
            tr.head > td {
                font-weight: bold;
                text-align: center;
                background-color: #E3E3E3;
                border: 0px;
            }
            tr.noborder > td {
                border: 0px;
            }
            .ttd {
                height: 80px;
            }
            .center {
                text-align: center;
            }
            .left {
                text-align: left !important;
            }
            .right {
                text-align: right !important;
            }
            .success {
               color: green;
            }
            .danger {
               color: red;
            }
            .label {
                width: 70px;
            }
            .small {
                width: 60px;
            }
            .bold {
                font-weight: bold;
            }
            .title {
                font-size: 16px;
            }
            .title2 {
                font-size: 14px;
            }
            .quarter {
                width: 25%;
            }
            .vtop {
                vertical-align: top;
            }
            .space {
            height: 20px;
        }
        </style>

        <div class="title bold center">
            Data Users
        </div>
        {{-- <div class="title2 bold center">
            JJPromotion
        </div> --}}

        <div class="space"></div>

        <table class="quarter">
            <tr>
                <td class="label">Tanggal </td>
                <td class="bold">: {{ Carbon\Carbon::now()->format('d/m/Y')  }}</td>
            </tr>
        </table>

        <table>

            <tr class="head">
                <td class="small">No.</td>
                <td class="small">ID</td>
                <td>Nama</td>
                <td>Role</td>
                <td>Status</td>
            </tr>

            @foreach ($data as $user)
            <tr>
                <td class="center vtop">{{ $loop->iteration }}</td>
                <td class="center vtop">{{ $user->id }}</td>
                <td class="vtop">{{ $user->name }}</td>
                <td class="center vtop">{{ $user->currentTeam->name }}</td>
                <td class="center vtop">
                    @if ($user->active == 1)
                        <div class="success">Active</div>
                    @else
                        <div class="danger">Non Active</div>
                    @endif
                </td>
            </tr>
            @endforeach

            <tr class="head">
                <td colspan="4" class="center bold">TOTAL</td>
                <td class="center bold">{{$data->count()}}</td>
            </tr>

        </table>

        <div class="space"></div>

        <table>
            <tr class="noborder">
                <td></td>
                <td class="center quarter">{{ Carbon\Carbon::now()->format('d F Y')  }}</td>
            </tr>
            <tr class="noborder">
                <td></td>
                <td class="center">
                    <img src="data:image/png;base64, {{base64_encode(QrCode::size(60)->generate($ttd))}}">
                </td>
            </tr>
            <tr class="noborder">
                <td></td>
                <td class="center bold">{{Auth::user()->name}}</td>
            </tr>
        </table>
    </body>
</html>
