  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="{{route('personnal.home')}}">
          <i class="fa fa-home me-2"></i>
          <span>Tableau de bord</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading divide-gray-300"></li>

      <li class="nav-item">
        <a class="nav-link collapsed d-flex gap-2" href="{{route('personnal.referentiel')}}">
          <i class="fa-solid fa-layer-group"></i>
          <span>Référentiels</span>
        </a>
      </li><!-- End Login Page Nav -->
  
      <li class="nav-item">
        <a class="nav-link collapsed d-flex gap-2" href="{{route('personnal.domaine')}}">
          <i class="fa fa-folder"></i>
          <span>Domaines</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed d-flex gap-2" href="{{route('personnal.evaluer.index')}}">
          <i class="fa fa-book"></i>
          <span>Se faire evaluer</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed d-flex gap-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fa-solid fa-right-from-bracket"></i>
            <span>Déconnexion</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </li><!-- End Error 404 Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->