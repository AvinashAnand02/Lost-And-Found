<style>
  .sidebar-nav .nav-content a i {
    font-size: .9rem;
}
</style>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link <?= $page != 'home' ? 'collapsed' : '' ?>" href="<?= base_url.'admin' ?>">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <a class="nav-link <?= !in_array($page, ['services', 'services/manage_service', 'services/view_service']) ? 'collapsed' : '' ?>" data-bs-target="#services-nav" data-bs-toggle="collapse" href="#" data-bs-collapse="<?= in_array($page, ['services', 'services/manage_service', 'services/view_service']) ? 'true' : 'false' ?>">
      <i class="bi bi-menu-button-wide"></i><span>Services</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="services-nav" class="nav-content collapse <?= in_array($page, ['services', 'services/manage_service', 'services/view_service']) ? 'show' : '' ?> " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= base_url.'admin/?page=services/manage_service' ?>" class="<?= $page == 'services/manage_service' ? 'active' : '' ?>">
          <i class="bi bi-plus-lg" style="font-size:.9rem"></i><span>Add New</span>
        </a>
      </li>
      <li>
        <a href="<?= base_url.'admin/?page=services' ?>" class="<?= $page == 'services' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>List</span>
        </a>
      </li>
    </ul>
  </li><!-- End Components Nav -->
  <li class="nav-item">
    <a class="nav-link <?= !in_array($page, ['pages', 'pages/welcome_page', 'pages/about_page']) ? 'collapsed' : '' ?>" data-bs-target="#pages-nav" data-bs-toggle="collapse" href="#" data-bs-collapse="<?= in_array($page, ['pages', 'pages/welcome_page', 'pages/about_page']) ? 'true' : 'false' ?>">
      <i class="bi bi-window-sidebar"></i><span>Pages</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="pages-nav" class="nav-content collapse <?= in_array($page, ['pages', 'pages/welcome_page', 'pages/about_page']) ? 'show' : '' ?> " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= base_url.'admin/?page=pages/welcome_page' ?>" class="<?= $page == 'welcome_page' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>Welcome Page</span>
        </a>
      </li>
      <li>
        <a href="<?= base_url.'admin/?page=pages/about_page' ?>" class="<?= $page == 'about_page' ? 'active' : '' ?>">
          <i class="bi bi-circle"></i><span>About Page</span>
        </a>
      </li>
    </ul>
  </li>
  <li class="nav-heading">Maintenance</li>

  <li class="nav-item">
    <a class="nav-link <?= $page != 'user/list' ? 'collapsed' : '' ?> nav-users" href="<?= base_url."admin?page=user/list" ?>">
      <i class="bi bi-people"></i>
      <span>Users</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link <?= $page != 'system_info' ? 'collapsed' : '' ?>  nav-system_info" href="<?= base_url."admin?page=system_info" ?>">
      <i class="bi bi-gear"></i>
      <span>System Information</span>
    </a>
  </li>

</ul>

</aside><!-- End Sidebar-->