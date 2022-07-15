<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100">
            <x-panel>

                <h1 class="text-center font-bold text-xl">Login!</h1>

                <form method="POST" action="/login" class="mt-10">
                    @csrf

                    <x-form.input name="email" type="email" autocomplete="username" />
                    <x-form.input name="password" type="password" autocomplete="new-password" />

                    <x-form.button>Login</x-form.button>

                    @error('erorrlogin')
                        <p class="w-4/8 m-auto text-center mt-4 text-red-500">{{ $message }}</p>
                    @enderror

                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
