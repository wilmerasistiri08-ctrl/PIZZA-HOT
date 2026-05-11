<div class="fixed bottom-5 left-1/2 -translate-x-1/2 w-[95%] max-w-xl bg-black text-white rounded-3xl shadow-2xl p-5 z-50">

    <div class="flex items-center justify-between mb-4">

        <div>
            <div class="text-sm text-slate-300">
                Total del pedido
            </div>

            <div class="text-3xl font-extrabold">
                Bs <span id="total">0</span>
            </div>
        </div>

        <div class="bg-orange-500 w-14 h-14 rounded-2xl flex items-center justify-center text-2xl">
            🛒
        </div>

    </div>

    <button onclick="checkout()"
            class="w-full bg-orange-500 hover:bg-orange-600 transition py-4 rounded-2xl font-bold text-lg">
        Finalizar pedido
    </button>

</div>