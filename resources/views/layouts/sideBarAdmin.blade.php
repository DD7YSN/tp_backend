<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
  }

  .sidebar {
    position: fixed;
    left: 0;
    top: 0;
    height: 100%;
    width: 78px;
    background: #f4f7fb;
    padding: 6px 14px;
    z-index: 99;
    transition: all 0.5s ease;
  }

  .sidebar.open {
    width: 300px;
  }

  .sidebar .logo-details {
    height: 60px;
    display: flex;
    align-items: center;
    position: relative;
  }


  .sidebar .logo-details .icon {
    opacity: 0;
    transition: all 0.5s ease;
  }
  .sidebar .logo-details .icon::before {
    color: var(--bs-primary);
  }

  .sidebar .logo-details .logo_name {
    display: inline-block;
    white-space: nowrap;
    color: var(--bs-primary);
    font-size: 20px;
    font-weight: 600;
    opacity: 0;
    transition: all 0.5s ease;
  }

  .sidebar.open .logo-details .icon,
  .sidebar.open .logo-details .logo_name {
    opacity: 1;
  }

  .sidebar .logo-details #btn {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    font-size: 22px;
    transition: all 0.4s ease;
    font-size: 23px;
    text-align: center;
    cursor: pointer;
    transition: all 0.5s ease;
  }

  .sidebar.open .logo-details #btn {
    text-align: right;
  }

  .sidebar i {
    color: #fff;
    height: 60px;
    min-width: 50px;
    font-size: 28px;
    text-align: center;
    line-height: 60px;
  }

  .sidebar .nav-list {
    margin-top: 20px;
    height: 100%;
  }

  .sidebar li {
    position: relative;
    margin: 8px 0;
    list-style: none;
  }

  .sidebar li .tooltip {
    position: absolute;
    top: -20px;
    left: calc(100% + 15px);
    z-index: 3;
    background: #fff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
    padding: 6px 12px;
    border-radius: 4px;
    font-size: 15px;
    font-weight: 400;
    opacity: 0;
    white-space: nowrap;
    pointer-events: none;
    transition: 0s;
  }

  .sidebar li a:hover~.tooltip {
    opacity: 1;
    pointer-events: auto;
    transition: all 0.4s ease;
    top: 50%;
    transform: translateY(-50%);
  }

  .sidebar.open li .tooltip {
    display: none;
  }

  .sidebar li a {
    display: flex;
    height: 100%;
    width: 100%;
    border-radius: 12px;
    align-items: center;
    text-decoration: none;
    transition: all 0.4s ease;
    background: #f4f7fb;
  }

  .sidebar li a:hover {
    background: #dddbff;
  }

  .sidebar i::before,
  .sidebar li i::before {
    color: #29343d;
  }

  .sidebar li a:hover i::before {
    color: #635bff;

  }

  .sidebar li a .links_name {
    color: #29343d;
    font-size: 15px;
    font-weight: 400;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: 0.4s;
  }

  .sidebar.open li a .links_name {
    opacity: 1;
    pointer-events: auto;
  }

  .sidebar li a:hover .links_name,
  .sidebar li a:hover i {
    transition: all 0.5s ease;
    color: #635bff;
  }

  .sidebar li i {
    height: 50px;
    line-height: 50px;
    font-size: 18px;
    border-radius: 12px;
  }

  /* Add  dropdown */
  .sidebar .dropdown {
    position: relative;
  }

  .sidebar .dropdown .dropdown-btn {
    display: flex;
    height: 100%;
    width: 100%;
    border-radius: 12px;
    align-items: center;
    text-decoration: none;
    transition: all 0.4s ease;
  }

  .sidebar .dropdown .dropdown-btn:hover {
    background: #dddbff;
  }

  .sidebar .dropdown .dropdown-content {
    display: none;
    min-width: 200px;
    border-radius: 8px;
    z-index: 1;
  }

  .sidebar .dropdown .dropdown-content a {
    color: #fff;
    padding: 12px;
    text-decoration: none;
    display: block;
    font-size: 14px;
  }

  .sidebar .dropdown .dropdown-content a:hover {
    background: #dddbff;
    color: #635bff;
  }

  .sidebar .dropdown .show {
    display: block;
  }

  .sidebar .dropdown .show a {
    color: #29343d;
  }

  /* End dropdown */
  .sidebar li.profile {
    position: fixed;
    height: 60px;
    width: 78px;
    left: 0;
    bottom: -8px;
    padding: 0 14px;
    background: #f4f7fb;
    transition: all 0.5s ease;
    overflow: hidden;
  }

  .sidebar.open li.profile {
    width: 300px;
  }

  .sidebar li .profile-details {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
  }

  .sidebar li.profile .name,
  .sidebar li.profile .job {
    font-size: 15px;
    font-weight: 400;
    color: #29343d;
    white-space: nowrap;
  }

  .sidebar li.profile .job {
    font-size: 12px;
  }

  .sidebar .profile #icon-log_out {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    background: #f4f7fb;
    width: 100%;
    height: 60px;
    line-height: 60px;
    border-radius: 0px;
    transition: all 0.5s ease;
  }

  .sidebar.open .profile #icon-log_out {
    width: 50px;
    background: none;
  }

  .main {
    position: relative;
    background: #e4e9f7;
    min-height: 100vh;
    top: 0;
    left: 78px;
    width: calc(100% - 78px);
    transition: all 0.5s ease;
    z-index: 2;
  }

  .sidebar.open~.main {
    left: 300px;
    width: calc(100% - 300px);
  }

  #log-out .profile-details,
  #icon-log_out::before {
    cursor: pointer;
  }

  /* OnClick in Dropdown */
  .selectedDrop {
    background: #635bff !important;
  }

  .selectedDrop .links_name,
  .selectedDrop i::before {
    color: #dddbff !important;
  }

  @media (max-width: 720px) {

    .sidebar,
    .sidebar li.profile {
      z-index: 3;
      left: -80px;
    }

    .open,
    .open li.profile {
      left: 0;
    }

    .sidebar~.main {
      width: 100%;
      left: 0;
    }

    .sidebar li .tooltip {
      display: none;
    }

    .home {
      width: 100%;
      overflow-x: hidden
    }

    .sidebar.open~.main {
      left: 0;
      width: 100%;
    }

  }

  .open .logo-details i::before {
    color: var(--bs-primary) !important;
  }

  @media (max-width: 420px) {
    .sidebar li .tooltip {
      display: none;
    }
  }
</style>
{{-- ******************************************************** --}}

<div id="sidebar" class="sidebar">
  <div class="logo-details">
    <i class='bx bxl-codepen icon'></i>
    <div class="logo_name">App | Livraison</div>
    <i class='bx bx-menu' id="btn"></i>
  </div>
  <ul class="nav-list">
    <li>
      <a href="#">
        <i class='bx bx-grid-alt'></i>
        <span class="links_name">Dashboard</span>
      </a>
      <span class="tooltip">Dashboard</span>
    </li>
    {{-- Start dropdown --}}
    <!-- <li class="dropdown">
      <a href="#" class="dropdown-btn">
        <i class='bx bxs-package'></i>
        <span class="links_name">Colis</span>
      </a>
      <div class="dropdown-content">
        <a href="{{route('colis.create')}}">Nouveau coli</a>
        <a href="{{route('colis.listeColis')}}">Liste colis</a>
        <a href="{{route('colis.colisAttenderRamassage')}}">Colis pour ramasage</a>
        <a href="{{route('colis.colisNonExpedies')}}">Colis non expedies</a>
      </div>
      <span class="tooltip">Colis</span>
    </li> -->

    <!-- <li class="dropdown">
      <a href="#" class="dropdown-btn">
        <i class='bx bxs-buildings'></i>
        <span class="links_name">Gestion d'inventaire</span>
      </a>
      <div class="dropdown-content">
        <a href="{{ route('clients.produit.create') }}">Ajouter produit</a>
        <a href="{{ route('clients.produit.index') }}">Inventaire</a>
      </div>
      <span class="tooltip">Gestion d'inventaire</span>
    </li> -->

    <li class="dropdown">
      <a href="#" class="dropdown-btn">
        <i class='bx bxs-user'></i>
        <span class="links_name">Utilisateur</span>
      </a>
      <div class="dropdown-content">
        <a href="{{route('utilisateur.index')}}">touts</a>
        <a href="{{route('utilisateur.role', 'client')}}">Client</a>
        <a href="{{route('utilisateur.role', 'moderateur')}}">Moderateur</a>
        <a href="{{route('utilisateur.role', 'livreur')}}">Liverur</a>
        <a href="{{route('utilisateur.role', 'admin')}}">Administrateur</a>
        <a href="{{route('utilisateur.attendeActivation')}}">En attende d'activation</a>
      </div>
      <span class="tooltip">Utilisateur</span>
    </li>

    <li class="dropdown">
      <a href="#" class="dropdown-btn">
        <i class='bx bx-globe'></i>
        <span class="links_name">Parametres general</span>
      </a>
      <div class="dropdown-content">
        <a href="{{route('general.index')}}">general</a>
        <a href="{{route('villes.index')}}">villes</a>
        <a href="{{route('zones.index')}}">zones</a>
        <a href="#">options</a>
        <a href="#">SMS</a>
        <a href="#">E-mail</a>
      </div>
      <span class="tooltip">Parametres general</span>
    </li>

    {{-- End dropdown --}}
    <li>
      <a href="#">
        <i class='bx bx-support'></i>
        <span class="links_name">Supports</span>
      </a>
      <span class="tooltip">Supports</span>
    </li>

    <li>
      <a href="{{route('profile.index')}}">
        <i class='bx bx-cog'></i>
        <span class="links_name">Settings</span>
      </a>
      <span class="tooltip">Settings</span>
    </li>
    <li id="log-out" class="profile">
      <div class="profile-details">
        <i class='bx bx-export'></i>
        <div class="name_job">
          <div class="name">Logout</div>
        </div>
      </div>
      <i class='bx bx-log-out' id="icon-log_out"></i>
    </li>
  </ul>
</div>

{{-- **************************************************************** --}}

<script>
  const sidebar = document.querySelector(".sidebar");
  const closeBtn = document.querySelector("#btn");
  const logOut = document.getElementById("log-out");

  closeBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    menuBtnChange();
  });

  // Stert toggle dropdown
  document.querySelectorAll('.dropdown-btn').forEach(function (button) {
    button.addEventListener('click', function (e) {
      const dropdownContent = this.nextElementSibling;
      const selectedDrops = document.querySelectorAll('.selectedDrop');
      selectedDrops.forEach(selectedDrop => {
        if (!selectedDrop.contains(e.target)) {
          selectedDrop.classList.remove('selectedDrop');
        }
      });
      button.closest('a').classList.add('selectedDrop');

      // Close all other dropdowns
      document.querySelectorAll('.dropdown-content').forEach(function (dropdown) {
        if (dropdown !== dropdownContent) {
          dropdown.classList.remove('show');
        }
      });
      // Toggle the 'show' class for the clicked dropdown
      dropdownContent.classList.toggle('show');
      // Prevent the event from bubbling up and closing the dropdown immediately
      e.stopPropagation();
    });
  });
  // Close dropdown
  document.addEventListener('click', function (e) {
    const dropdowns = document.querySelectorAll('.dropdown-content');
    const selectedDrops = document.querySelectorAll('.selectedDrop');
    selectedDrops.forEach(selectedDrop => {
      if (!selectedDrop.contains(e.target)) {
        selectedDrop.classList.remove('selectedDrop');
      }
    });
    dropdowns.forEach(dropdown => {
      if (!dropdown.contains(e.target) && !e.target.classList.contains('dropdown-btn')) {
        dropdown.classList.remove('show');
      }
    });
  });
  // End toggle dropdown



  function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
      closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else {
      closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
  }
  logOut.addEventListener("click", () => {
    fetch('{{route("logout")}}')
      .then(response => {
        if (response.ok) {
          window.location.href = '{{ route("login") }}';
        } else {
          console.log("Logout failed");
        }
      })
      .catch(error => {
        console.log("Error logging out:", error);
      });
  });


</script>