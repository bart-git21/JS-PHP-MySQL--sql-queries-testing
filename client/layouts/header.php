<nav class="navbar navbar-expand-sm navbar-light bg-light">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1"><< Query sandbox >></span>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-sm-0">
        <li class="nav-item">
          <a class="nav-link" href="/client/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/client/pages/query.php">Queries testing</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script>
    $(".navbar").on("click", function(event) {
        if (event.target.classList.contains("nav-link")) {
            const links = document.querySelectorAll(".nav-link");
            links.forEach(e => {
                e.classList.remove("active");
                e.removeAttribute("aria-current");
            })
            event.target.classList.add("active");
            event.target.setAttribute("aria-current", "page");
        }
    })
</script>

<style>
    .nav-item {
        border-bottom: 1px solid transparent;
        transition: all 0.5s;
    }
    .nav-item:hover {
        border-bottom: 1px solid black;
        background-color: #aaa;
    }
    .nav-item:has(a.active) {
        border-bottom: 1px solid black;
    }
</style>