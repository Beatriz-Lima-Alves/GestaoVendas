<x-app-layout>
    <div class="py-12 flex justify-center items-center">
        <div class="max-w-md w-full sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-gray-900 t-60-bold text-center">{{ __("Caixa Aberto") }}</h1>

                <form action="{{route('caixa.sale')}}" class="mt-4 text-black" method="post">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="cpf" :value="__('CPF')" class="text-black"/>
                        <x-text-input id="cpf" class="block mt-1 w-full text-black" type="text" name="cpf" :value="old('cpf')" required autofocus />
                        <x-input-error :messages="$errors->get('cpf')" class="mt-2 text-black" />
                    </div>

                    <div class="text-bold text-red">{{$msg}}</div>

                    <div class="flex justify-end">
                        <input type="submit" value="{{ __('Iniciar a venda') }}" class="inline-flex items-center px-4 py-2 bg-purple-btn border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 bg-purple-btn">
                    </div>
                </form>

                <script src="https://cdn.jsdelivr.net/npm/imask"></script>
                <script>
                    var cpfMask = IMask(document.getElementById('cpf'), {
                        mask: '000.000.000-00'
                    });
                </script>
            </div>
        </div>
    </div>
</x-app-layout>
