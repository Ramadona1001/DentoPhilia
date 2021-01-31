@if (Auth::user()->hasRole('Doctor') || Auth::user()->hasRole('Admin'))

    @can('show_cases_endo')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'endo']) }}" data-title="{{ transWord('Endo') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/endo.png') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

    @can('show_cases_pedo')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'pedo']) }}" data-title="{{ transWord('Pedo') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/pedo.png') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

    @can('show_cases_ortho')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'ortho']) }}" data-title="{{ transWord('Ortho') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/ortho.png') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

    @can('show_cases_surgery')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'surgery']) }}" data-title="{{ transWord('Surgery') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/surgery.jpg') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

    @can('show_cases_surgery')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'surgery']) }}" data-title="{{ transWord('Surgery') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/surgery.jpg') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

    @can('show_cases_surgery')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'surgery']) }}" data-title="{{ transWord('Surgery') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/surgery.jpg') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

    @can('show_cases_surgery')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'surgery']) }}" data-title="{{ transWord('Surgery') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/surgery.jpg') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

    @can('show_cases_surgery')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'surgery']) }}" data-title="{{ transWord('Surgery') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/surgery.jpg') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

    @can('show_cases_surgery')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'surgery']) }}" data-title="{{ transWord('Surgery') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/surgery.jpg') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

    @can('show_cases_surgery')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'surgery']) }}" data-title="{{ transWord('Surgery') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/surgery.jpg') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

    @can('show_cases_dental_designer')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'dentaldesigner']) }}" data-title="{{ transWord('Dental Designer') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/dental-designer.png') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

    @can('show_cases_dental_photography')
    <li class="menu-item">
    <a class="menu-item-link text-tooltip-tfr" href="{{ route('all_doctor_cases',['type'=>'dentalphotography']) }}" data-title="{{ transWord('Dental Photography') }}">
        <img class="menu-icons-img" src="{{ asset('dento/img/icons/black/camera.png') }}" alt="" srcset="">
    </a>
    </li>
    @endcan

@endif
