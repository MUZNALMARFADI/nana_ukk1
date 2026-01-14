<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - SPP Management</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fef9e7 0%, #d5f4e6 50%, #abebc6 100%);
            color: #2c3e50;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: linear-gradient(135deg, #52be80 0%, #f9e79f 100%);
            color: white;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(82, 190, 128, 0.2);
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            text-align: center;
        }

        .sidebar-logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: white;
        }

        .sidebar-header h2 {
            font-size: 22px;
            margin-bottom: 5px;
        }

        .sidebar-header p {
            font-size: 12px;
            opacity: 0.9;
        }

        .sidebar-menu {
            padding: 20px 0;
            flex: 1;
            overflow-y: auto;
        }

        /* Custom Scrollbar untuk Sidebar */
        .sidebar-menu::-webkit-scrollbar {
            width: 8px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px 25px;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .menu-item i {
            font-size: 18px;
            width: 24px;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.15);
            border-left-color: white;
            padding-left: 30px;
        }

        .menu-item.active {
            background: rgba(255,255,255,0.25);
            border-left-color: white;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: auto;
        }

        /* Logout Button in Sidebar */
        .logout-btn {
            padding: 12px 20px;
            background: rgba(231, 76, 60, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            cursor: pointer;
            width: 100%;
        }

        .logout-btn:hover {
            background: rgba(231, 76, 60, 0.4);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(82, 190, 128, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #d5f4e6;
        }

        .header h1 {
            font-size: 24px;
            color: #27ae60;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #52be80 0%, #f9e79f 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .user-details {
            text-align: right;
        }

        .user-details strong {
            display: block;
            color: #27ae60;
            font-size: 14px;
        }

        .user-details small {
            font-size: 12px;
            color: #7f8c8d;
        }

        /* Content */
        .content {
            padding: 30px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .content-header h1 {
            font-size: 28px;
            color: #27ae60;
        }

        /* Cards */
        .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(82, 190, 128, 0.1);
            overflow: hidden;
            border: 2px solid #d5f4e6;
        }

        .card-body {
            padding: 25px;
        }

        /* Buttons */
        .btn-primary, .btn-add, .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: linear-gradient(135deg, #52be80 0%, #f9e79f 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover, .btn-add:hover, .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(82, 190, 128, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        }

        .btn-success {
            background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
        }

        /* Tables */
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .table thead {
            background: linear-gradient(135deg, #d5f4e6 0%, #fef9e7 100%);
        }

        .table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #27ae60;
            border-bottom: 2px solid #abebc6;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #d5f4e6;
        }

        .table tbody tr:hover {
            background: #fef9e7;
        }

        /* Forms */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #27ae60;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #d5f4e6;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #52be80;
            box-shadow: 0 0 0 3px rgba(82, 190, 128, 0.1);
        }

        .required {
            color: #e74c3c;
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: #e74c3c;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-view, .btn-edit, .btn-delete {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-view {
            background: #3498db;
            color: white;
        }

        .btn-edit {
            background: #f39c12;
            color: white;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        /* Alerts */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: #d5f4e6;
            color: #1e8449;
            border: 1px solid #abebc6;
        }

        .alert-error {
            background: #fadbd8;
            color: #922b21;
            border: 1px solid #f5b7b1;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }
        }

        .row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table th, .detail-table td {
            padding: 12px;
            border: 1px solid #d5f4e6;
            text-align: left;
        }

        .detail-table th {
            background: linear-gradient(135deg, #d5f4e6 0%, #fef9e7 100%);
            font-weight: 600;
            color: #27ae60;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-primary {
            background: #52be80;
            color: white;
        }

        .badge-success {
            background: #27ae60;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-wallet"></i>
            </div>
            <h2>SPP System</h2>
            <p>Management Dashboard</p>
        </div>
        
        <div class="sidebar-menu">
            <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i> Dashboard
            </a>
            <a href="{{ route('siswa.index') }}" class="menu-item {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Data Siswa
            </a>
            <a href="{{ route('kelas.index') }}" class="menu-item {{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                <i class="fas fa-school"></i> Data Kelas
            </a>
            <a href="{{ route('spp.index') }}" class="menu-item {{ request()->routeIs('spp.*') ? 'active' : '' }}">
                <i class="fas fa-coins"></i> Data SPP
            </a>
            <a href="{{ route('pembayaran.index') }}" class="menu-item {{ request()->routeIs('pembayaran.*') ? 'active' : '' }}">
                <i class="fas fa-file-invoice-dollar"></i> Pembayaran
            </a>
            
            @if(session('petugas')->level == 'admin')
            <a href="{{ route('laporan.index') }}" class="menu-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i> Laporan
            </a>
            <a href="{{ route('petugas.index') }}" class="menu-item {{ request()->routeIs('petugas.*') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i> Data Petugas
            </a>
            @endif
        </div>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>
                <i class="fas fa-tachometer-alt"></i> @yield('title', 'Dashboard')
            </h1>
            <div class="user-info">
                <div class="user-details">
                    <strong>{{ session('petugas')->nama_petugas ?? 'Admin' }}</strong>
                    <small><i class="fas fa-circle" style="color: #27ae60; font-size: 8px;"></i> {{ ucfirst(session('petugas')->level ?? 'admin') }}</small>
                </div>
                <div class="user-avatar">
                    {{ strtoupper(substr(session('petugas')->nama_petugas ?? 'A', 0, 1)) }}
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>