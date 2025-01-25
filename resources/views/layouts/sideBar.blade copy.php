
<style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&display=swap");
::after,
::before {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

a {
  text-decoration: none;
}

li {
  list-style: none;
}
/* body {
  font-family: "Roboto", sans-serif;
} */


#sidebar {
  background-color: #000;
  display: flex;
  flex-direction: column;
  min-width: 70px;
  transition: all 0.25s ease-in-out;
  width: 70px;
  z-index: 1000;
}

#sidebar.expand {
  min-width: 260px;
  width: 260px;
}

.toggle-btn {
  background-color: transparent;
  border: 0;
  cursor: pointer;
  padding: 1rem 1.5rem;
}

.toggle-btn i {
  color: #fff;
  font-size: 1.5rem;
}

.sidebar-logo {
  margin: auto 0;
  text-wrap: nowrap;
}

.sidebar-logo a {
  color: #fff;
  font-size: 1.15rem;
  font-weight: 600;
}

#sidebar:not(.expand) .sidebar-logo,
#sidebar:not(.expand) a.sidebar-link span {
  display: none;
}

.sidebar-nav {
  flex: 1 1 auto;
  padding: 2rem 0;
}

a.sidebar-link {
  border-left: 3px solid transparent;
  color: #fff;
  display: block;
  font-size: 0.9rem;
  padding: 0.625rem 1.625rem;
  white-space: nowrap;
}

.sidebar-link i {
  font-size: 1.1rem;
  margin-right: 0.75rem;
}

a.sidebar-link:hover {
  background-color: rgba(255, 255, 255, 0.075);
  border-left: 3px solid #3b7ddd;
}

.sidebar-item {
  position: relative;
}

#sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
  background-color: #0e2238;
  display: none;
  left: 70px;
  min-width: 15rem;
  padding: 0;
  position: absolute;
  top: 0;
}

#sidebar:not(.expand) .sidebar-item:hover .has-dropdown + .sidebar-dropdown {
  display: block;
  max-height: 15em;
  opacity: 1;
  width: 100%;
}

#sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
  border-width: 0 0.075rem 0.075rem 0;
  border: solid;
  content: "";
  display: inline-block;
  padding: 2px;
  position: absolute;
  right: 1.5rem;
  top: 1.4rem;
  transform: rotate(-135deg);
  transition: all 0.2s ease-out;
}

#sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
  transform: rotate(45deg);
  transition: all 0.2s ease-out;
}

</style>

        <!-- Sidebar Start -->
            <aside id="sidebar">
                <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Sidebar Menu</a>
                </div>
                </div>
                <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                    <i class="lni lni-user"></i>
                    <span>Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                    <i class="lni lni-agenda"></i>
                    <span>Task</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="lni lni-protection"></i>
                    <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Login</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">Register</a>
                    </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#multi" aria-expanded="false" aria-controls="multi">
                    <i class="lni lni-layout"></i>
                    <span>Multi Level</span>
                    </a>
                    <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                        Two Links
                        </a>
                        <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Link 1</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Link 2</a>
                        </li>
                        </ul>
                    </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                    <i class="lni lni-popup"></i>
                    <span>Notification</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                    <i class="lni lni-cog"></i>
                    <span>Setting</span>
                    </a>
                </li>
                </ul>
                <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
                </div>
            </aside>
        <!--  Sidebar End -->


<script>
    const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

</script>
