@include('admin.layouts.home')
<body class="bg-gray-100">

    <div class="min-h-screen flex">
@include('admin.layouts.navbar')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-4">Profile</h1>
        <!-- Profile content goes here -->
    </div>
@endsection

@include('admin.layouts.footer')
</div>
</body>
