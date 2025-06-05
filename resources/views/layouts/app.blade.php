<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman || {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    {{-- font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    {{-- akhir font --}}
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Load CSS & JS dari Vite --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- style --}}
    @livewireStyles
    {{-- akhir style --}}
</head>
<body class="@yield('body-class')" style="margin: 0">
        <div class="wrapper d-flex ">
            {{-- Sidebar --}}
            <div >
                @include('partials.sidebar')
            </div>
            {{-- Main Section (Navbar + Content) --}}
            <div class="main flex-grow-1">
                {{-- Navbar --}}
                <nav class="navbar navbar-dark bg-transparent   shadow-sm" id="topNavbar" style="border-bottom: 1px solid rgb(211, 211, 211);">
                    <div class="container-fluid">
                        <button class="btn btn-succes" id="toggleSidebar">
                            <i class="fas fa-bars text-success"></i>
                        </button>
                        <span class="navbar-brand ms-3 text-black">Sistem Prediksi Produksi</span>
                    </div>
                </nav>
    
                {{-- Konten --}}
                <div class="content p-4" id="mainContent">
                    @yield('content')
                </div>
            </div>
        </div>
    


        <script>
            const toggleBtn = document.getElementById('toggleSidebar');
            const sidebar = document.getElementById('sidebar');
            const main = document.querySelector('.main');
        
           
            window.addEventListener('DOMContentLoaded', () => {
                const status = localStorage.getItem('sidebarStatus');
                if (status === 'collapsed') {
                    sidebar.classList.add('collapsed');
                    main.classList.add('full');
                }
            });
        
            
            toggleBtn.addEventListener('click', () => {
                sidebar.classList.toggle('collapsed');
                main.classList.toggle('full');
        
                const isCollapsed = sidebar.classList.contains('collapsed');
                localStorage.setItem('sidebarStatus', isCollapsed ? 'collapsed' : 'expanded');
            });
        </script>
        
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

    @livewireScripts
    
  </body>
</html>