@include('component.navigation.header')
<main class="py-4">
    <div class="container mt-2 mb-2">
        @include('component.success')
    </div>
    @yield('content')
</main>

@include('component.navigation.footer')
