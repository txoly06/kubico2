<!-- resources/views/layouts/header.blade.php -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo KUBICO Centralizado -->
            <div class="flex-shrink-0 flex items-center justify-center w-full">
                <a href="{{ url('/') }}" class="flex items-center space-x-2 group">
                    <svg class="h-8 w-8 text-indigo-600 group-hover:text-indigo-700 transition-colors" 
                         fill="none" 
                         viewBox="0 0 24 24" 
                         stroke="currentColor">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        <text x="50%" 
                              y="65%" 
                              text-anchor="middle" 
                              class="text-[5px] font-bold fill-indigo-600 group-hover:fill-indigo-700 transition-colors"
                              style="font-family: Arial, sans-serif; font-weight: bold;">
                            KUBICO
                        </text>
                    </svg>
                    <span class="hidden md:block text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                        KUBICO
                    </span>
                </a>
            </div>

            <!-- Menu Desktop -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('properties.index') }}" 
                   class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">
                    Imóveis
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" 
                       class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" 
                       class="text-gray-600 hover:text-indigo-600 transition-colors font-medium">
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>
</header>

<style>
    /* Efeito de escala suave no hover */
    nav a svg {
        transition: transform 0.3s ease;
    }
    nav a:hover svg {
        transform: scale(1.1);
    }
    
    /* Melhoria na legibilidade do texto SVG */
    text {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        font-weight: 700;
        letter-spacing: 0.05em;
    }
</style>