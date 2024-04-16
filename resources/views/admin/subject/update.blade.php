@extends('layouts.admin')
@section('updateSubject')
<div class="p-4 h-screen sm:ml-64" style="background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('photos/school.jpg') }}') no-repeat center;background-size:cover">
    <div class="p-4  rounded-lg  mt-24">
        @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "{{ session('success') }}",
            });
        </script>
        @endif
        <div class="bg-gradient-to-r from-blue-100 via-blue-300 to-blue-500  py-8">
            <div class="w-full flex items-center justify-center">
                <div class="bg-gray-100 rounded-lg shadow-lg flex-col w-5/6 sm:max-w-2xl px-6">
                    <div class="px-5 py-3 mb-3 text-3xl font-medium text-gray-800 mt-6">
                        <div class="text-center font-mono font-bold text-blue">Update Subject : <span class="text-orange">{{$subject->name}}</span> </div>
                    </div>

                    <form action="{{ route('update.subject', ['id' => $subject->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <hr class="border-1 border-gray-300">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-8 mt-5">
                            <div class="grid grid-cols-1">
                                <label class="md:text-sm text-xs text-gray-600 text-light font-semibold">Nom</label>
                                <input type="text" value="{{ $subject->name }}" name="name" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                            </div>
                            <div class="grid grid-cols-1">
                                <label class="md:text-sm text-xs text-gray-600 text-light font-semibold">Statut</label>
                                <select name="statut" class="py-2 px-3 rounded-lg border-2 mt-1 focus:outline-none">
                                    <option value="activer">Activer</option>
                                    <option value="desactiver">Desactiver</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-center  my-6">
                            <button type="submit" class="font-mono font-bold py-2 px-8 bg-blue-900 rounded-full text-white  hover:bg-orange cursor-pointer">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
