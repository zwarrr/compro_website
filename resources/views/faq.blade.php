<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - PT. Technology Multi System</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo_tms.png') }}">
    
    <!-- CSS External -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Font Import */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        * { 
            font-family: 'Poppins', sans-serif; 
        }
        
        html { 
            scroll-behavior: smooth; 
        }
    </style>
</head>
<body class="bg-white">
    <!-- Header -->
    @include('partials.header')
    
    <!-- Main Content with padding for fixed header -->
    <main class="pt-20">
        @include('sections.faq')
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
</body>
</html>
