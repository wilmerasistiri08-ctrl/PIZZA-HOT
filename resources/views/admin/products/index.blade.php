@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-yellow-50">

    {{-- CONTENIDO PRINCIPAL SIN SIDEBAR --}}
    <main class="w-full">

        {{-- HEADER CON BOTÓN VOLVER --}}
        <header class="bg-white/95 backdrop-blur-md border-b-4 border-orange-500 px-8 py-6 shadow-lg sticky top-0 z-50">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                {{-- LOGO Y TÍTULO --}}
                <div class="flex items-center gap-4">

                    <div class="relative w-16 h-16">
                        <div class="absolute inset-0 rounded-full border-2 border-yellow-400/50 animate-spin-slow"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-4xl cursor-pointer" id="rotatingFoodIcon" style="filter: drop-shadow(0 0 10px rgba(255,215,0,0.5));">
                                🍕
                            </div>
                        </div>
                    </div>

                    <div>
                        <h1 class="text-3xl font-black bg-gradient-to-r from-red-600 to-orange-600 bg-clip-text text-transparent">
                            FoodLink
                        </h1>
                        <p class="text-gray-500 text-sm">
                            Gestión de Productos por Negocios
                        </p>
                    </div>

                </div>

                {{-- BOTÓN VOLVER AL PANEL DE CONTROL --}}
                <a href="/admin/dashboard" 
                   class="bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 transition-all duration-300 text-white px-6 py-3 rounded-xl font-bold shadow-lg transform hover:scale-105 flex items-center gap-2 w-fit">

                    <span class="text-xl">⬅️</span> Volver al Panel de Control

                </a>

            </div>

        </header>

        {{-- CONTENIDO DE PRODUCTOS POR NEGOCIOS --}}
        <div class="p-8">

            {{-- TÍTULO DE LA SECCIÓN --}}
            <div class="mb-8 text-center">
                <h2 class="text-4xl font-black text-gray-800 flex items-center justify-center gap-3">
                    <span>🏪</span> Nuestros Negocios <span>🍽️</span>
                </h2>
                <p class="text-gray-600 mt-2 font-medium">
                    
                </p>
            </div>

            {{-- DEFINIR NEGOCIOS CON SUS PRODUCTOS --}}
            @php
                // Definir los 3 negocios con sus colores e íconos
                $negocios = [
                    'Hamburguesas Pro' => [
                        'icon' => '🍔',
                        'color' => 'from-red-600 to-orange-600',
                        'bg' => 'bg-red-50',
                        'border' => 'border-red-400',
                        'productos' => []
                    ],
                    'Pizza House' => [
                        'icon' => '🍕',
                        'color' => 'from-red-500 to-yellow-500',
                        'bg' => 'bg-yellow-50',
                        'border' => 'border-yellow-400',
                        'productos' => []
                    ],
                    'Sushi Roll' => [
                        'icon' => '🍱',
                        'color' => 'from-orange-500 to-red-500',
                        'bg' => 'bg-orange-50',
                        'border' => 'border-orange-400',
                        'productos' => []
                    ],
                ];

                // Clasificar productos por negocio según su nombre
                foreach ($products as $product) {
                    if (str_contains(strtolower($product->name), 'hamburguesa') || 
                        str_contains(strtolower($product->name), 'burger') ||
                        str_contains(strtolower($product->name), 'papas') ||
                        str_contains(strtolower($product->name), 'combo')) {
                        $negocios['Hamburguesas Pro']['productos'][] = $product;
                    }
                    elseif (str_contains(strtolower($product->name), 'pizza')) {
                        $negocios['Pizza House']['productos'][] = $product;
                    }
                    elseif (str_contains(strtolower($product->name), 'sushi') ||
                            str_contains(strtolower($product->name), 'roll') ||
                            str_contains(strtolower($product->name), 'maki') ||
                            str_contains(strtolower($product->name), 'sashimi')) {
                        $negocios['Sushi Roll']['productos'][] = $product;
                    }
                }

                // Si no hay productos en algún negocio, agregar ejemplos
                if (empty($negocios['Hamburguesas Pro']['productos'])) {
                    $negocios['Hamburguesas Pro']['productos'] = [
                        (object)['id' => 1, 'name' => 'Hamburguesa Clásica', 'price' => 45, 'is_available' => true],
                        (object)['id' => 2, 'name' => 'Hamburguesa Doble', 'price' => 65, 'is_available' => true],
                        (object)['id' => 3, 'name' => 'Papas Fritas', 'price' => 20, 'is_available' => false],
                        (object)['id' => 4, 'name' => 'Combo Mega', 'price' => 90, 'is_available' => true],
                        (object)['id' => 5, 'name' => 'Hamburguesa BBQ', 'price' => 55, 'is_available' => true],
                        (object)['id' => 6, 'name' => 'Aros de Cebolla', 'price' => 25, 'is_available' => false],
                    ];
                }
                if (empty($negocios['Pizza House']['productos'])) {
                    $negocios['Pizza House']['productos'] = [
                        (object)['id' => 7, 'name' => 'Pizza Margherita', 'price' => 70, 'is_available' => true],
                        (object)['id' => 8, 'name' => 'Pizza Pepperoni', 'price' => 85, 'is_available' => true],
                        (object)['id' => 9, 'name' => 'Pizza Hawaiana', 'price' => 80, 'is_available' => false],
                        (object)['id' => 10, 'name' => 'Pizza 4 Quesos', 'price' => 90, 'is_available' => true],
                        (object)['id' => 11, 'name' => 'Pizza Vegetariana', 'price' => 75, 'is_available' => true],
                    ];
                }
                if (empty($negocios['Sushi Roll']['productos'])) {
                    $negocios['Sushi Roll']['productos'] = [
                        (object)['id' => 12, 'name' => 'Sushi Roll California', 'price' => 60, 'is_available' => true],
                        (object)['id' => 13, 'name' => 'Sushi Roll Philadelphia', 'price' => 75, 'is_available' => true],
                        (object)['id' => 14, 'name' => 'Sashimi Salmón', 'price' => 80, 'is_available' => false],
                        (object)['id' => 15, 'name' => 'Maki Spicy Tuna', 'price' => 65, 'is_available' => true],
                        (object)['id' => 16, 'name' => 'Temaki Especial', 'price' => 45, 'is_available' => true],
                        (object)['id' => 17, 'name' => 'Sushi Roll Dragon', 'price' => 95, 'is_available' => false],
                        (object)['id' => 18, 'name' => 'Nigiri Variado', 'price' => 70, 'is_available' => true],
                    ];
                }
            @endphp

            {{-- RECORRER CADA NEGOCIO --}}
            @foreach($negocios as $negocioNombre => $negocio)
                @if(count($negocio['productos']) > 0)
                <div class="mb-12">
                    
                    {{-- HEADER DEL NEGOCIO --}}
                    <div class="flex items-center justify-between mb-5 flex-wrap gap-4">
                        <div class="flex items-center gap-3">
                            <div class="text-6xl">
                                {{ $negocio['icon'] }}
                            </div>
                            <div>
                                <h3 class="text-3xl font-black text-gray-800 flex items-center gap-2">
                                    {{ $negocioNombre }}
                                    <span class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                        🟢 Abierto
                                    </span>
                                </h3>
                                <p class="text-gray-500 text-sm">
                                    {{ count($negocio['productos']) }} producto(s) disponibles
                                </p>
                            </div>
                        </div>
                        
                        {{-- INDICADOR DESLIZABLE --}}
                        <div class="flex items-center gap-2 text-gray-500 text-sm">
                            <span class="text-xl">👆</span>
                            <span>Desliza hacia la derecha →</span>
                        </div>
                    </div>

                    {{-- CARRUSEL DESLIZABLE HACIA LA DERECHA --}}
                    <div class="overflow-x-auto overflow-y-hidden pb-4 scroll-smooth" style="scrollbar-width: thin;">
                        <div class="flex gap-6" style="min-width: min-content;">
                            
                            @foreach($negocio['productos'] as $product)
                            {{-- CARD DE PRODUCTO --}}
                            <div class="w-80 flex-shrink-0 bg-white rounded-2xl shadow-xl overflow-hidden border-2 {{ $product->is_available ? 'border-green-400' : 'border-red-400' }} transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                                
                                {{-- CABECERA DEL PRODUCTO --}}
                                <div class="bg-gradient-to-r {{ $negocio['color'] }} px-4 py-3">
                                    <div class="flex items-center justify-between">
                                        <div class="text-4xl">
                                            {{ $negocio['icon'] }}
                                        </div>
                                        <div class="text-white text-xs font-bold bg-white/20 px-2 py-1 rounded-full">
                                            #{{ $product->id }}
                                        </div>
                                    </div>
                                </div>

                                {{-- CUERPO --}}
                                <div class="p-5">

                                    <h3 class="text-xl font-black text-gray-800 mb-2">
                                        {{ $product->name }}
                                    </h3>

                                    <div class="mb-4">
                                        <span class="text-3xl font-black text-red-600">Bs {{ number_format($product->price, 2) }}</span>
                                        <span class="text-gray-500 text-sm">c/u</span>
                                    </div>

                                    {{-- INDICADOR DE ESTADO --}}
                                    <div class="mb-4 p-2 rounded-xl text-center font-bold text-sm {{ $product->is_available ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        @if($product->is_available)
                                            ✅ Disponible actualmente
                                        @else
                                            ❌ Agotado actualmente
                                        @endif
                                    </div>

                                    {{-- BOTONES DE ESTADO --}}
                                    <div class="flex gap-3 mt-4">

                                        <form method="POST" action="/admin/products/{{ $product->id }}" class="flex-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_available" value="1">
                                            
                                            <button type="submit" 
                                                    class="w-full px-3 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2
                                                    {{ $product->is_available ? 'bg-green-500 text-white shadow-lg' : 'bg-gray-200 text-gray-500 hover:bg-green-400 hover:text-white' }}">
                                                <span class="text-lg">✅</span> Disponible
                                            </button>
                                        </form>

                                        <form method="POST" action="/admin/products/{{ $product->id }}" class="flex-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_available" value="0">
                                            
                                            <button type="submit" 
                                                    class="w-full px-3 py-3 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2
                                                    {{ !$product->is_available ? 'bg-red-500 text-white shadow-lg' : 'bg-gray-200 text-gray-500 hover:bg-red-400 hover:text-white' }}">
                                                <span class="text-lg">❌</span> Agotado
                                            </button>
                                        </form>

                                    </div>

                                </div>

                                {{-- PIE --}}
                                <div class="bg-{{ str_replace('from-', '', explode(' ', $negocio['color'])[1]) }}/10 px-5 py-3 border-t border-gray-100">
                                    <div class="flex justify-between text-xs text-gray-500">
                                        <span>🕒 Cambiar estado</span>
                                        <span>{{ $negocio['icon'] }} {{ $negocioNombre }}</span>
                                    </div>
                                </div>

                            </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- BOTONES DE NAVEGACIÓN DEL CARRUSEL --}}
                    <div class="flex justify-end gap-2 mt-3">
                        <button onclick="scrollCarousel(this, 'left')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full transition-all duration-300">
                            <span class="text-xl">◀</span>
                        </button>
                        <button onclick="scrollCarousel(this, 'right')" class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full transition-all duration-300">
                            <span class="text-xl">▶</span>
                        </button>
                    </div>

                </div>
                @endif
            @endforeach

            {{-- CONTADORES Y ESTADÍSTICAS GENERALES --}}
            <div class="mt-8 bg-white rounded-2xl p-6 shadow-xl border-2 border-orange-200">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <div class="text-center">
                        <div class="text-4xl font-black text-orange-600">{{ $products->count() }}</div>
                        <div class="text-gray-600 font-semibold">📦 Total Productos</div>
                    </div>

                    <div class="text-center">
                        <div class="text-4xl font-black text-green-600">{{ $products->where('is_available', true)->count() }}</div>
                        <div class="text-gray-600 font-semibold">✅ Disponibles</div>
                    </div>

                    <div class="text-center">
                        <div class="text-4xl font-black text-red-600">{{ $products->where('is_available', false)->count() }}</div>
                        <div class="text-gray-600 font-semibold">❌ Agotados</div>
                    </div>

                    <div class="text-center">
                        <div class="text-4xl font-black text-purple-600">{{ count($negocios) }}</div>
                        <div class="text-gray-600 font-semibold">🏪 Negocios</div>
                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

{{-- SCRIPT PARA CARRUSEL Y EFECTO 3D --}}
<script>
    // Función para desplazar el carrusel
    function scrollCarousel(button, direction) {
        const carousel = button.closest('.mb-12').querySelector('.overflow-x-auto');
        const scrollAmount = 350;
        
        if (direction === 'left') {
            carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }

    // Efecto 3D para el logo
    const foodItems = ['🍔', '🍕', '🍱'];
    let currentIndex = 0;
    const iconElement = document.getElementById('rotatingFoodIcon');

    function rotateFoodIcon3D() {
        currentIndex = (currentIndex + 1) % foodItems.length;
        
        iconElement.style.transform = 'rotateY(180deg) scale(0.5)';
        iconElement.style.opacity = '0';
        
        setTimeout(() => {
            let displayText = foodItems[currentIndex];
            if (currentIndex === 0) {
                iconElement.title = 'Hamburguesas Pro 🍔';
            } else if (currentIndex === 1) {
                iconElement.title = 'Pizza House 🍕';
            } else {
                iconElement.title = 'Sushi Roll 🍱';
            }
            
            iconElement.textContent = displayText;
            iconElement.style.transform = 'rotateY(360deg) scale(1.2)';
            iconElement.style.opacity = '1';
            iconElement.style.filter = 'drop-shadow(0 0 20px rgba(255,215,0,0.8))';
            
            setTimeout(() => {
                iconElement.style.transform = 'rotateY(0deg) scale(1)';
                iconElement.style.filter = 'drop-shadow(0 0 15px rgba(255,215,0,0.5))';
            }, 300);
        }, 200);
    }

    setInterval(rotateFoodIcon3D, 2500);
</script>

<style>
    #rotatingFoodIcon {
        transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        display: inline-block;
        transform-style: preserve-3d;
        backface-visibility: visible;
    }
    
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .animate-spin-slow {
        animation: spin-slow 4s linear infinite;
    }
    
    #rotatingFoodIcon:hover {
        transform: rotateY(180deg) scale(1.3) !important;
        filter: drop-shadow(0 0 25px rgba(255,215,0,0.9)) !important;
        cursor: pointer;
    }

    /* Scrollbar personalizado */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #f97316;
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #ea580c;
    }
</style>

@endsection