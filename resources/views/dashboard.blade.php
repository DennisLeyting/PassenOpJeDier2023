@section('title')
{{"PassenOpJeDier | Dashboard"}}
@endsection

@extends('body')
@section('content')

<main class="content">
    <h1>
        Welcome {{ Auth::user()->name }}
    </h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-responsive-nav-link :href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-responsive-nav-link>
    </form>
    <h2>{{ Auth::user()->email }}</h2>

    <section id="js--addHuisdierBtn">
        <span>add</span>
    </section>

    @include('./components/non-breeze/add_huisdier_overlay')


</main>

@endsection