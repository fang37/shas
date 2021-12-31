<nav class="navbar navbar-expand-lg navbar-dark bg-custom">
    <div class="container">
      <a class="navbar-brand" href="/">SHAS</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Dashboard") ? 'active' : ''}}" aria-current="page" href="/">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Attendance") ? 'active' : ''}}" href="/attendance">Attendance</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Time Work") ? 'active' : ''}}" href="/time-work">Time Work</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ ($title === "Employee Management") ? 'active' : ''}}" href="/employee">Employee Management</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>