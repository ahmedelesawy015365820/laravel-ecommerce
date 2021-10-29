<!-- Title -->
<title> Elesawy -  point of sell </title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
@if (app()->getLocale() == 'ar')
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">
@else
    <!-- Sidemenu css -->
    <link rel="stylesheet" href="{{URL::asset('assets/css/sidemenu.css')}}">
@endif

@yield('css')

@if (app()->getLocale() == 'ar')
    <!--- Style css -->
    <link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
@else
    <!--- Style css -->
    <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">
    <!--- Dark-mode css -->
    <link href="{{URL::asset('assets/css/style-dark.css')}}" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="{{URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet">
@endif

<style>
    .new{
        position: relative;
    }
    .not-read{
        position: absolute;
        border-radius: 50%;
        line-height: 15px;
        width: 15px;
        height: 15px;
        color: #fff;
        background-color: #0162e8;
        font-size: 11px;
        top: 56%;
        left: 2px;
    }
    .notifyimg{
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
