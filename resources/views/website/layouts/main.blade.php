<!DOCTYPE html>
<html lang="en">
    @include('website.layouts.head')
<body>
    <section class="py-md-4 px-md-5 py-2 px-3">
        <div class="container-xxl m-auto">
          @include('website.layouts.header')
            <div class="row main-content radius-12px">
                <div class="main-content-wrapper">
                    @yield('section')
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
