<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman || {{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    {{-- style --}}
    <style>
        .poppins{
            font-family: 'Poppins', sans-serif;
        }
        body {
            margin: 0;
        }
        .sidebar {
            width: 250px;
            transition: margin-left 0.3s ease;
        }
        .sidebar.collapsed {
            margin-left: -250px;
        } 
        .main {
            transition: margin-left 0.3s ease;
            width: 100%;
        }
    
        .main.full {
            margin-left: 0;
        }
    
        .main:not(.full) {
            margin-left: 250px;
        }    
        .navbar {
            border-bottom: 1px solid #ccc;
        }

        .text-gradient{
            background: linear-gradient(90deg, #1698e9, #1655e9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            
        }

        .skyblue-custoom{
            background-color: #C8E8FF;
        }
        .skyblue-custoom:hover{
            background-color: #C8E8FF;
            border: 1px solid #C8E8FF; 
        }
        /* Tambahkan di file CSS Anda */
        .pagination .page-link {
            color: #28a745; /* Warna hijau Bootstrap */
        }

        .pagination .page-item.active .page-link {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .pagination .page-link:hover {
            color: #218838; /* Hijau gelap saat hover */
            background-color: #e9ecef;
        }
    </style>
    
    {{-- akhir style --}}
</head>
<body>
    
    <body>
        <div class="wrapper d-flex">
            {{-- Sidebar --}}
            @include('partials.sidebar')
    
            {{-- Main Section (Navbar + Content) --}}
            <div class="main flex-grow-1">
                {{-- Navbar --}}
                <nav class="navbar navbar-dark bg-white  shadow-sm" id="topNavbar" style="border-bottom: 1px solid rgb(211, 211, 211);">
                    <div class="container-fluid">
                        <button class="btn btn-light" id="toggleSidebar">
                            <i class="fas fa-bars"></i>
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

    

  </body>
</body>
</html>