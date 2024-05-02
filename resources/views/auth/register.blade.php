@extends('welcome')

@section('title', 'Cadastro')

@section('content')
    <div class="w-full h-full p-3 grid place-items-center">
        <form class="bg-white w-[600px] h-[500px] shadow-xl p-3 flex flex-col items-center gap-14" method="POST">
            @csrf
            <h1 class="text-4xl font-semibold">Crie uma conta</h1>
            <div class="h-full flex flex-col gap-[30px] items-center text-lg">
                <div
                    class="w-[386px] border-[1.5px] border-transparent-70 border-solid border-[#0B3B60] h-10 flex items-center">
                    <div
                        class="h-[80%] w-9 grid place-items-center border-r-[1.5px] border-transparent-70 border-solid border-r-[#0B3B60]">
                        <iconify-icon icon="ic:round-email" class="text-[#0B3B60]" width="26"
                            height="22"></iconify-icon>
                    </div>
                    <input type="email" name="" id=""
                        class="w-full border-transparent h-full outline-none px-2" placeholder="usuario@email.com">
                </div>
                <div
                    class="w-[386px] border-[1.5px] border-transparent-70 border-solid border-[#0B3B60] h-10 flex items-center">
                    <div
                        class="h-[80%] w-9 grid place-items-center border-r-[1.5px] border-transparent-70 border-solid border-r-[#0B3B60]">
                        <iconify-icon icon="material-symbols:id-card" class="text-[#0B3B60]" width="26"
                            height="22"></iconify-icon>
                    </div>
                    <input type="text" name="" id=""
                        class="w-full border-transparent h-full outline-none px-2" placeholder="CPF do usuário">
                </div>
                <div
                    class="w-[386px] border-[1.5px] border-transparent-70 border-solid border-[#0B3B60] h-10 flex items-center relative">
                    <div
                        class="h-[80%] w-9 grid place-items-center border-r-[1.5px] border-transparent-70 border-solid border-r-[#0B3B60]">
                        <iconify-icon icon="ri:lock-password-fill" class="text-[#0B3B60]" width="26"
                            height="22"></iconify-icon>
                    </div>
                    <input type="password" name="" id=""
                        class="w-full border-transparent h-full outline-none px-2" placeholder="Senha do usuário">
                    <iconify-icon icon="fluent:eye-28-filled" width="32" height="24"
                        class="absolute top-2 right-2 text-[#0B3B60]"></iconify-icon>
                </div>
                <button class="bg-[#0B3B60] text-lg font-bold text-white w-48 h-10">Fazer cadastro</button>
            </div>
            <span class="text-base mb-3">
                Já possui uma conta?
                <a href="/auth" class="bg-[#0B3B60] font-semibold text-white px-3 py-1">Ir para tela de login</a>
            </span>
        </form>

    </div>
@endsection
