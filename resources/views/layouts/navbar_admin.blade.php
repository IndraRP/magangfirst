<div>
<nav class="navbar bg-gray-800 d-flex justify-content-center">
    <a class="text-white py-3 font-xl font-bold">Admin Page</a>
</nav>

<!-- Sidebar -->
<div class="sidebar bg-gray-800 mt-10 px-4">
    <a href="{{ url('/user') }}">User</a>
    <a href="{{ url('/clothing') }}">Clothing</a>

    <form action="{{ route('logout.submit') }}" method="POST">
        @csrf
        <button class="bg-red-500 rounded-md px-4 py-2 mt-3 font-semibold text-white" type="submit">Logout</button>
    </form>
    </div>
</div>