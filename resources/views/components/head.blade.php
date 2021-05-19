<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('dento/css/vendor/bootstrap.min-1.css') }}">
    <link rel="stylesheet" href="{{ asset('dento/css/styles.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('dento/css/dark.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('dento/css/vendor/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('dento/css/vendor/tiny-slider.css') }}">
    <link rel="icon" href="{{ asset('dento/img/icon.ico') }}">
    <livewire:styles />
    @yield('stylesheet')
    <style>
        .not-allow-input{
            background-color: #fff;
            border: 1px solid #dedeea;
            color: #3e3f5e;
            transition: border-color .2s ease-in-out;
            height: 48px;
            font-size: .875rem;
            width: 100%;;
            border-radius: 12px;
            font-weight: 700;
            padding-left: 15px;
            padding-top: 15px;
            cursor: not-allowed;
        }

        .other-input{
            background-color: #fff;
            border: 1px solid #dedeea;
            color: #3e3f5e;
            transition: border-color .2s ease-in-out;
            height: 53px !important;
            font-size: .875rem !important;
            border-radius: 12px;
            font-weight: 700;
            padding-left: 15px;
            width: 100%;
        }

        .menu-icons-img{
            width: 30px;
            height: 27px;
            position: absolute;
            top: 9px;
            left: 8px;
        }
        @media (max-width: 500px) {
            .header .header-actions.search-bar .header-search-dropdown{
                width: 69% !important;
            }
        }
    </style>
    <title>DentoPhilia | @yield('title')</title>
</head>
