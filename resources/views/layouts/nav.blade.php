<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
  }

  .menuProfile {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .menuProfile .profile-container {
    position: relative;
  }

  .menuProfile .profile-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
  }

  .menuProfile .dropdown {
    position: absolute;
    top: 50px;
    right: 0;
    width: 250px;
    background-color: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }

  .menuProfile .hidden {
    display: none;
  }

  .menuProfile .dropdown-header {
    padding: 15px;
    border-bottom: 1px solid #e0e0e0;
  }

  .menuProfile .name {
    font-size: 16px;
    font-weight: bold;
    margin: 0;
  }

  .menuProfile .badge {
    font-size: 12px;
    color: #fff;
    background-color: #4caf50;
    border-radius: 12px;
    padding: 2px 6px;
    margin-left: 5px;
  }

  .menuProfile .email {
    font-size: 14px;
    color: #757575;
    margin: 5px 0 0;
  }

  .menuProfile .dropdown-profile-menu {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .menuProfile .dropdown-profile-menu li {
    border-bottom: 1px solid #e0e0e0;
  }

  .menuProfile .dropdown-profile-menu li:last-child {
    border-bottom: none;
  }

  .menuProfile .dropdown-profile-menu a {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: #333;
    font-size: 14px;
  }

  .menuProfile .dropdown-profile-menu a:hover {
    background-color: #f5f5f5;
    color: #635bff;
  }

  .menuProfile .notification-badge {
    font-size: 12px;
    color: #fff;
    background-color: #f44336;
    border-radius: 12px;
    padding: 2px 6px;
    margin-left: 10px;
  }

  #btn-global-menu {
    cursor: pointer;
    font-size: 23px;
    color: #29343d;
    visibility: hidden;
  }

  @media (max-width: 720px) {
    #btn-global-menu {
      visibility: visible;
    }
  }
</style>
<nav>

  <div class="menuProfile">
    <i class='bx bx-menu' id="btn-global-menu"></i>
    <div class="profile-container">

      <img height="80" src="https://fakeimg.pl/250x250/" alt="Profile Avatar" class="profile-avatar"
        onclick="toggleDropdown()" />

      <div id="dropdown" class="dropdown hidden">
        <div class="dropdown-header d-flex justify-content-start align-items-center">
          <img height="80" src="https://fakeimg.pl/250x250/" alt="Profile Avatar" class="profile-avatar me-3" />
          <div>
            <p class="name">{{session('user')->nom}}<span class="badge">Pro</span></p>
            <p class="email">{{session('user')->email}}</p>
          </div>
        </div>
        <ul class="dropdown-profile-menu">
          <li><a href="#">My Profile</a></li>
          <li><a href="#">My Subscription</a></li>
          <li>
            <a href="#">
              My Invoice <span class="notification-badge">4</span>
            </a>
          </li>
          <li><a href="{{route('profile.index')}}">Account Settings</a></li>
          <li><a href="{{route('logout')}}">Sign Out</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
<script>
  function toggleDropdown() {
    const dropdown = document.getElementById("dropdown");
    dropdown.classList.toggle("hidden");
  }

  document.addEventListener("click", (event) => {
    const dropdown = document.getElementById("dropdown");
    const avatar = document.querySelector(".profile-avatar");

    if (!dropdown.contains(event.target) && event.target !== avatar) {
      dropdown.classList.add("hidden");
    }
  });

  const btn_global_menu = document.getElementById('btn-global-menu');
  btn_global_menu.addEventListener('click', () => {
    const sideBar = document.getElementById('sidebar').style.display = 'block';
    document.getElementById('btn').click();
  })

</script>