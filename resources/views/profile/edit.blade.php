@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Pengaturan Profil 👤</h2>
    <p class="text-gray-500 mt-1 text-sm">Perbarui informasi profil, alamat email, dan kata sandi Anda.</p>
</div>

<div class="space-y-6 max-w-4xl">
    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-2xl border border-gray-100">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-2xl border border-gray-100">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow-sm sm:rounded-2xl border border-gray-100">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
