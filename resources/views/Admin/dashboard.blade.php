<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Add your CSS links etc. -->
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}"> <!-- Example CSS -->
</head>
<body>
    <div class="dashboard-container">
        <!-- Include a sidebar if you have one -->
        {{-- @include('Admin.shared.sidebar-menu') --}}

       

            <div class="dashboard-content">
                <h1>Welcome, {{ Auth::guard('admin')->user()->name }}!</h1>
                <p>This is the main Admin Dashboard.</p>
                
                <!-- Add your admin-specific widgets, stats, tables here -->

            </div>
        </div>
    </div>
    <!-- Add your JS scripts etc. -->
</body>
</html>
