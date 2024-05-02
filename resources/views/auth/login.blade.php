@extends('welcome')

@section('title', 'Login')

@section('content')
    <!--  Application Details Start -->
    <div class="w-full bg-grey-500">
        <div class="container mx-auto py-8">
            <div class="w-96 mx-auto bg-white rounded shadow">

                <div class="mx-16 py-4 px-8 text-black text-xl font-bold border-b border-grey-500">Entre na sua conta
                </div>

                <form action="POST">
                    <div class="py-4 px-8">
                        <div class="mb-4">
                            <input class=" border rounded border-[#339CFF] w-full py-2 px-3 text-grey-darker" type="text"
                                name="email_login" id="email_login" placeholder="usuario@email.com">   
                        </div>
                        <div class="mb-4">
                            <input class=" border rounded border-[#339CFF] w-full py-2 px-3 text-grey-darker" type="password"
                            name="password_login" id="password_login" placeholder="Senha do usuário">                             
                        </div>
                        <div class="mb-4">
                            <input type="submit"
                                class="mb-2 mx-10 py-1 px-24 bg-[#0B3B60] text-[#fff] font-[700]" value="Enviar"
                            >
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection