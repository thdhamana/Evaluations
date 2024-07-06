@include('backend.personnal.partials.header') 

@include('backend.personnal.partials.topbar') 

@include('backend.personnal.partials.sidebar')

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

@include('backend.personnal.partials.footer') 
