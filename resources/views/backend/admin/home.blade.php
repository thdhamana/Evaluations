@include('backend.admin.partials.header') 

@include('backend.admin.partials.topbar') 

@include('backend.admin.partials.sidebar')

    <main id="main" class="main ">
        <div class="content">
        <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    @yield('content')
                </div>
            </div> 
        </div>
    </main><!-- End #main -->
</div>

@include('backend.admin.partials.footer') 
