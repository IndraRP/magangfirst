<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <header class="bg-[#FCF8F1] bg-opacity-30">
        <div class="px-4 mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <div class="flex-shrink-0">
                    <a href="#" title="" class="flex">
                        <img class="w-auto h-8" src="https://cdn.rareblocks.xyz/collection/celebration/images/logo.svg" alt="Logo" />
                    </a>
                </div>
    
                <button type="button" class="inline-flex p-2 text-black transition-all duration-200 rounded-md lg:hidden focus:bg-gray-100 hover:bg-gray-100" id="hamburger-button">
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                    </svg>
    
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
    
                <!-- Menu links (hidden by default on mobile) -->
                <div class="hidden lg:flex lg:items-center lg:justify-center lg:space-x-10" id="menu-links">
                    <a href="#home" title="" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Dahsboard </a>
                    <a href="#demo" title="" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Demo </a>
                    <a href="#" title="" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Product </a>
                    <a href="#contact" title="" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Contact </a>
                </div>
    
                <a href="login" title="" class="hidden lg:inline-flex items-center justify-center px-5 py-2.5 text-base transition-all duration-200 hover:bg-yellow-300 hover:text-black focus:text-black focus:bg-yellow-300 font-semibold text-white bg-black rounded-full" role="button"> Login for Admin </a>
            </div>
        </div>
    </header>
    
    <!-- Mobile Menu (Hidden by default) -->
    <div id="mobile-menu" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex justify-end p-4">
            <button id="close-mobile-menu" class="text-white">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="flex flex-col items-center space-y-6 p-6">
            <a href="#home" title="" class="text-2xl text-white transition-all duration-200 hover:text-opacity-80"> Dashboard </a>
            <a href="#demo" title="" class="text-2xl text-white transition-all duration-200 hover:text-opacity-80"> Demo </a>
            <a href="#product" title="" class="text-2xl text-white transition-all duration-200 hover:text-opacity-80"> Product </a>
            <a href="#contact" title="" class="text-2xl text-white transition-all duration-200 hover:text-opacity-80"> Contact </a>
            <a href="login" title="" class="text-2xl text-white transition-all duration-200 hover:text-opacity-80"> Login for Admin </a>
        </div>
    </div>
    
    <script>
        // Ambil elemen-elemen yang diperlukan
        const hamburgerButton = document.getElementById('hamburger-button');
        const menuLinks = document.getElementById('menu-links');
        const closeIcon = hamburgerButton.querySelector('svg:nth-child(2)');
        const openIcon = hamburgerButton.querySelector('svg:nth-child(1)');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMobileMenu = document.getElementById('close-mobile-menu');
    
        // Tambahkan event listener untuk tombol hamburger
        hamburgerButton.addEventListener('click', () => {
            // Toggle visibility dari menu
            mobileMenu.classList.toggle('hidden');
            openIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
    
        // Event listener untuk menutup menu
        closeMobileMenu.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            openIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        });
    </script>
    
</body>
</html>