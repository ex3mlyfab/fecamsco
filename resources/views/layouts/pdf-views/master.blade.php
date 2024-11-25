<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')|Femcas</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }
        body {
            font-size: 14px;
            overflow-x: hidden;
            font-family: "Montserrat", sans-serif;
            color: #242934;
            line-height: 1.5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f1f1f1;

        }

        .container{
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: column;
            gap: 10px;
            margin-top:30px;
            margin-left:40px;
            margin-right:40px;

        }
        /* .header{
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            gap:10px;
            margin-top:20px;
        }
        .header-text{
            flex-grow: 1; */
        }
        table{
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- <div class="header">
            <img src="{{ asset('femcas-logo.png')}}" width="100" alt="femcas logo">
            <h5 style="font-size: 20px; font-weight: 700; text-transform:uppercase;" class="header-text">Federal Medical Centre, Abuja<br> Multi-purpose co-operative Society<br>
                (femcas)</h5>
        </div> --}}
        <table width="100%" style="border: 2px Solid #000; margin-bottom: 10px;">
            <thead>
                <th width="30%" ><img src="{{ asset('femcas-logo.png')}}" width="100" alt="femcas logo"></th>
                <th width="70%" center style="line-height: 1.0"> <h5 style="font-size: 20px; font-weight: 700; text-transform:uppercase;">Federal Medical Centre, Abuja<br> Multi-purpose co-operative Society<br>
                    (femcas)</h5> </th>
            </thead>
        </table>
            {{-- <div class="col-4 text-center">
                <img src="{{ asset('femcas-logo.png')}}" width="50" alt="femcas loo">
            </div>
            <div class="col-8 text-centertext-uppercase">
                <h5>Federal Medical Centre, Abuja<br> Multi-purpose coorpeative Society<br>
                (femcas)</h5>
            </div> --}}

        @yield('content')
    </div>
</body>
