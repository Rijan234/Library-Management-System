<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <link rel="icon" href="{{ asset('photos/logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
  #sidebar {
    transition: width 0.5s;
    height: 100%;
  }

  #sidebar.collapsed {
    width: 64px;
    height: 100vh;
  }

  #sidebar.collapsed ul li span {
    display: none;
  }

  #main-content {
    transition: margin-left 0.3s;
    margin-left: 256px;
  }

  #sidebar.collapsed ~ #main-content {
    margin-left: 64px;
  }

</style>
</head>
<body>
  

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
          <span class="sr-only">Open sidebar</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
          </svg>
        </button>
        <svg id="toggle-sidebar" class="w-6 cursor-pointer mt-1 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
        </svg>
        <a href="{{ route('dashboard') }}" class="flex ms-2 md:me-24">
          <span class="self-center ms-2 text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Library Management System</span>
        </a>

      </div>
      <div class="flex items-center">
        <div class="flex items-center ms-3">
          <div>
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full" src="{{ asset('photos/1.png') }}" alt="user photo">
            </button>
          </div>
          <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown-user">
            <div class="px-4 py-3" role="none">
              <p class="text-sm text-gray-900 dark:text-white" role="none">
              {{ Auth::user()->name }}
              </p>
              <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
              {{ Auth::user()->email }}
              </p>
            </div>
            <ul class="py-1" role="none">
         
            <li>
                  <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Settings</a>
                </li>
                <li class="_Vb9igHms0hI1PQcvp_S b9aD6g2qw84oyZNsMO8j RZmKBZs1E1eXw8vkE6jY c8dCx6gnV43hTOLV6ks5 rYHHksRBEMl_guI3q0UQ _7KA5gD55t2lxf9Jkj20 EJIoL6514Ry8r7nh011L RzANcaqunVvlLrO6_tal dMTOiA3mf3FTjlHu6DqW m-0 p-0" role="menuitem">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                      onclick="event.preventDefault();
                                                this.closest('form').submit();">
                      {{ __('Log Out') }}
                    </x-dropdown-link>
                  </form>
                </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>



<aside id="sidebar-multi-level-sidebar " class="fixed top-0 left-0 z-20 mt-10 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
  <div class="h-full px-3 py-4 overflow-y-auto bg-gray-100 dark:bg-gray-800" id="sidebar">
    <ul class="space-y-2 font-medium">
      <li>
        <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
        <i class="fa-solid fa-house"></i>
          <span class="ms-3">Dashboard</span>
        </a>
      </li>
      <li>
        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
        <i class="fa-solid fa-book"></i>
          <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Book Management</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
          </svg>
        </button>
        <ul id="dropdown-example" class="hidden py-2 space-y-2">
          <li>
            <a href="{{ route('student-book.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Issue Book</a>
          </li>
          <li>
            <a href="{{ route('returnBooks') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Return Book</a>
          </li>
          <li>
            <a href="{{ route('book.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">View Books</a>
          </li>
        </ul>
      </li>
    
      <li>
  <button type="button" id="ecommerce-button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
  <i class="fa-solid fa-user"></i>
    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Student Management</span>
    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
  </button>
  <ul id="ecommerce-dropdown" class="hidden py-2 space-y-2">
    <li>
      <a href="{{ route('student.index') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Student List</a>
    </li>
    <li>
      <a href="{{ route('student.create') }}" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Add Student</a>
    </li>
  
  </ul>
</li>

      <li>
        <a href="{{ route('faculty.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
        <i class="fa-solid fa-graduation-cap"></i>
          <span class="flex-1 ms-3 whitespace-nowrap">Faculty</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
<div id="main-content" class="ml-64 mt-4 p-4">
 
  <main class="mt-8">
    {{ $slot }}
  </main>
</div>




</body>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
<script>
 document.getElementById("toggle-sidebar").addEventListener("click", function () {
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.getElementById("main-content");

    sidebar.classList.toggle("collapsed");

    if (sidebar.classList.contains("collapsed")) {
      mainContent.style.marginLeft = "64px";
    } else {
      mainContent.style.marginLeft = "256px";
    }
  });
  document.getElementById("ecommerce-button").addEventListener("click", function () {
  const dropdown = document.getElementById("ecommerce-dropdown");
  dropdown.classList.toggle("hidden");
});


</script>


</html>