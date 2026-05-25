@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#faf8f5]">

    {{-- CONTENIDO PRINCIPAL SIN SIDEBAR --}}
    <main class="w-full">

        {{-- HEADER CON BOTÓN VOLVER --}}
        <header class="bg-white/80 backdrop-blur-sm border-b border-[#e8e4dd] px-8 py-6 sticky top-0 z-50 shadow-sm">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                {{-- LOGO Y TÍTULO --}}
                <div class="flex items-center gap-4">

                    <div class="relative w-16 h-16">
                        <div class="absolute inset-0 rounded-full border-2 border-[#d4c5b0] animate-spin-slow"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-4xl cursor-pointer" id="rotatingFoodIcon" style="filter: drop-shadow(0 0 10px rgba(180,160,130,0.3));">
                                🏢
                            </div>
                        </div>
                    </div>

                    <div>
                        <h1 class="text-3xl font-black text-[#4a3728]">
                            FoodLink
                        </h1>
                        <p class="text-[#a68a6b] text-sm">
                            Gestión de Productos por Negocios
                        </p>
                    </div>

                </div>

                {{-- BOTÓN VOLVER AL PANEL DE CONTROL --}}
                <a href="/admin/dashboard" 
                   class="bg-[#8b7355] hover:bg-[#6b5340] transition-all duration-300 text-white px-6 py-3 rounded-xl font-medium shadow-sm hover:shadow-md transform hover:scale-105 flex items-center gap-2 w-fit">

                    <span class="text-xl">⬅️</span> Volver al Panel de Control

                </a>

            </div>

        </header>

        {{-- CONTENIDO DE PRODUCTOS POR NEGOCIOS --}}
        <div class="p-8">

            {{-- TÍTULO DE LA SECCIÓN --}}
            <div class="mb-8 text-center">
                <h2 class="text-4xl font-black text-[#4a3728] flex items-center justify-center gap-3">
                    <span>🏢</span> Nuestros Negocios <span>📦</span>
                </h2>
                <p class="text-[#a68a6b] mt-2 font-medium">
                    Gestión de productos y servicios por negocio
                </p>
            </div>

            {{-- DEFINIR NEGOCIOS CON SUS PRODUCTOS --}}
            @php
                // Definir los 3 negocios con colores minimalistas
                $negocios = [
                    'Hamburguesas Pro' => [
                        'icon' => '🍔',
                        'color' => 'from-[#8b7355] to-[#6b5340]',
                        'bg' => 'bg-[#f5f0ea]',
                        'border' => 'border-[#e0d6cc]',
                        'productos' => []
                    ],
                    'Pizza House' => [
                        'icon' => '🍕',
                        'color' => 'from-[#7a6348] to-[#5c4935]',
                        'bg' => 'bg-[#f5f0ea]',
                        'border' => 'border-[#e0d6cc]',
                        'productos' => []
                    ],
                    'Sushi Roll' => [
                        'icon' => '🍱',
                        'color' => 'from-[#9b7b5c] to-[#7a5c42]',
                        'bg' => 'bg-[#f5f0ea]',
                        'border' => 'border-[#e0d6cc]',
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
                        (object)['id' => 1, 'name' => 'Producto Ejemplo 1', 'price' => 45, 'is_available' => true],
                        (object)['id' => 2, 'name' => 'Producto Ejemplo 2', 'price' => 65, 'is_available' => true],
                        (object)['id' => 3, 'name' => 'Producto Ejemplo 3', 'price' => 20, 'is_available' => false],
                        (object)['id' => 4, 'name' => 'Producto Ejemplo 4', 'price' => 90, 'is_available' => true],
                    ];
                }
                if (empty($negocios['Pizza House']['productos'])) {
                    $negocios['Pizza House']['productos'] = [
                        (object)['id' => 5, 'name' => 'Servicio Ejemplo 1', 'price' => 70, 'is_available' => true],
                        (object)['id' => 6, 'name' => 'Servicio Ejemplo 2', 'price' => 85, 'is_available' => true],
                        (object)['id' => 7, 'name' => 'Servicio Ejemplo 3', 'price' => 80, 'is_available' => false],
                        (object)['id' => 8, 'name' => 'Servicio Ejemplo 4', 'price' => 90, 'is_available' => true],
                    ];
                }
                if (empty($negocios['Sushi Roll']['productos'])) {
                    $negocios['Sushi Roll']['productos'] = [
                        (object)['id' => 9, 'name' => 'Item Ejemplo 1', 'price' => 60, 'is_available' => true],
                        (object)['id' => 10, 'name' => 'Item Ejemplo 2', 'price' => 75, 'is_available' => true],
                        (object)['id' => 11, 'name' => 'Item Ejemplo 3', 'price' => 80, 'is_available' => false],
                        (object)['id' => 12, 'name' => 'Item Ejemplo 4', 'price' => 65, 'is_available' => true],
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
                                <h3 class="text-3xl font-black text-[#4a3728] flex items-center gap-2">
                                    {{ $negocioNombre }}
                                    <span class="text-sm bg-[#e8e0d5] text-[#6b5340] px-3 py-1 rounded-full text-xs font-medium">
                                        🟢 Activo
                                    </span>
                                </h3>
                                <p class="text-[#a68a6b] text-sm">
                                    {{ count($negocio['productos']) }} producto(s) disponibles
                                </p>
                            </div>
                        </div>
                        
                        {{-- INDICADOR DESLIZABLE --}}
                        <div class="flex items-center gap-2 text-[#a68a6b] text-sm">
                            <span class="text-xl">👆</span>
                            <span>Desliza hacia la derecha →</span>
                        </div>
                    </div>

                    {{-- CARRUSEL DESLIZABLE HACIA LA DERECHA --}}
                    <div class="overflow-x-auto overflow-y-hidden pb-4 scroll-smooth" style="scrollbar-width: thin;">
                        <div class="flex gap-6" style="min-width: min-content;">
                            
                            @foreach($negocio['productos'] as $product)
                            {{-- CARD DE PRODUCTO MINIMALISTA --}}
                            <div class="w-80 flex-shrink-0 bg-white rounded-2xl shadow-sm overflow-hidden border {{ $product->is_available ? 'border-[#d4e2d4]' : 'border-[#e8d4d4]' }} transform transition-all duration-300 hover:scale-105 hover:shadow-md">
                                
                                {{-- CABECERA DEL PRODUCTO --}}
                                <div class="bg-gradient-to-r {{ $negocio['color'] }} px-4 py-3">
                                    <div class="flex items-center justify-between">
                                        <div class="text-4xl">
                                            {{ $negocio['icon'] }}
                                        </div>
                                        <div class="text-white/80 text-xs font-medium bg-white/20 px-2 py-1 rounded-full">
                                            #{{ $product->id }}
                                        </div>
                                    </div>
                                </div>

                                {{-- CUERPO --}}
                                <div class="p-5">

                                    <h3 class="text-xl font-bold text-[#4a3728] mb-2">
                                        {{ $product->name }}
                                    </h3>

                                    <div class="mb-4">
                                        <span class="text-3xl font-bold text-[#8b7355]">Bs {{ number_format($product->price, 2) }}</span>
                                        <span class="text-[#c4b5a0] text-sm">c/u</span>
                                    </div>

                                    {{-- INDICADOR DE ESTADO --}}
                                    <div class="mb-4 p-2 rounded-xl text-center font-medium text-sm {{ $product->is_available ? 'bg-[#e8f0e8] text-[#5a7a5a]' : 'bg-[#f0e8e8] text-[#b57a7a]' }}">
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
                                                    class="w-full px-3 py-3 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2
                                                    {{ $product->is_available ? 'bg-[#7a9a7a] text-white shadow-sm' : 'bg-[#f0ece8] text-[#a68a6b] hover:bg-[#7a9a7a] hover:text-white' }}">
                                                <span class="text-lg">✅</span> Disponible
                                            </button>
                                        </form>

                                        <form method="POST" action="/admin/products/{{ $product->id }}" class="flex-1">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_available" value="0">
                                            
                                            <button type="submit" 
                                                    class="w-full px-3 py-3 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 flex items-center justify-center gap-2
                                                    {{ !$product->is_available ? 'bg-[#b57a7a] text-white shadow-sm' : 'bg-[#f0ece8] text-[#a68a6b] hover:bg-[#b57a7a] hover:text-white' }}">
                                                <span class="text-lg">❌</span> Agotado
                                            </button>
                                        </form>

                                    </div>

                                </div>

                                {{-- PIE --}}
                                <div class="bg-[#faf8f5] px-5 py-3 border-t border-[#f0ece8]">
                                    <div class="flex justify-between text-xs text-[#c4b5a0]">
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
                        <button onclick="scrollCarousel(this, 'left')" class="bg-[#f0ece8] hover:bg-[#e8e0d5] text-[#a68a6b] p-2 rounded-full transition-all duration-300">
                            <span class="text-xl">◀</span>
                        </button>
                        <button onclick="scrollCarousel(this, 'right')" class="bg-[#f0ece8] hover:bg-[#e8e0d5] text-[#a68a6b] p-2 rounded-full transition-all duration-300">
                            <span class="text-xl">▶</span>
                        </button>
                    </div>

                </div>
                @endif
            @endforeach

            {{-- CONTADORES Y ESTADÍSTICAS GENERALES --}}
            <div class="mt-8 bg-white rounded-2xl p-6 shadow-sm border border-[#f0ece8]">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#4a3728]">{{ $products->count() }}</div>
                        <div class="text-[#a68a6b] font-medium">📦 Total Productos</div>
                    </div>

                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#7a9a7a]">{{ $products->where('is_available', true)->count() }}</div>
                        <div class="text-[#a68a6b] font-medium">✅ Disponibles</div>
                    </div>

                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#b57a7a]">{{ $products->where('is_available', false)->count() }}</div>
                        <div class="text-[#a68a6b] font-medium">❌ Agotados</div>
                    </div>

                    <div class="text-center">
                        <div class="text-4xl font-bold text-[#4a3728]">{{ count($negocios) }}</div>
                        <div class="text-[#a68a6b] font-medium">🏢 Negocios</div>
                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

{{-- SCRIPT PARA CARRUSEL Y EFECTO --}}
<script>
    function scrollCarousel(button, direction) {
        const carousel = button.closest('.mb-12').querySelector('.overflow-x-auto');
        const scrollAmount = 350;
        
        if (direction === 'left') {
            carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }

    const items = ['🏢', '📦', '⚙️'];
    let currentIndex = 0;
    const iconElement = document.getElementById('rotatingFoodIcon');

    function rotateIcon3D() {
        currentIndex = (currentIndex + 1) % items.length;
        
        iconElement.style.transform = 'rotateY(180deg) scale(0.5)';
        iconElement.style.opacity = '0';
        
        setTimeout(() => {
            iconElement.textContent = items[currentIndex];
            iconElement.style.transform = 'rotateY(360deg) scale(1.2)';
            iconElement.style.opacity = '1';
            
            setTimeout(() => {
                iconElement.style.transform = 'rotateY(0deg) scale(1)';
            }, 300);
        }, 200);
    }

    setInterval(rotateIcon3D, 2500);
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
        cursor: pointer;
    }

    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }

    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f0ece8;
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #d4c5b0;
        border-radius: 10px;
    }

    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #c4b5a0;
    }
</style>

@endsection