<nav class="bg-dark text-white vh-100 p-3" style="width: 250px;">
    <h4 class="text-white mb-4">Sistem Prediksi Produksi</h4>
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a class="nav-link text-white" href="/dashboard">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link text-white" href="/profile">
                <i class="fas fa-history me-2"></i> Data historis
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link text-white" href="/settings">
                <i class="fas fa-cog me-2"></i> Settings
            </a>
        </li>
        <li class="nav-item mt-4">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</nav>


