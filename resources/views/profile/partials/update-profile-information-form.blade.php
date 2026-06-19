<section>
    <header class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-2">
            <svg class="w-6 h-6 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            Informasi Profil
        </h2>
        <p class="mt-2 text-sm text-gray-500">
            Perbarui informasi akun Anda dan alamat email.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Avatar Upload with Preview -->
        <div x-data="{ photoName: null, photoPreview: null }">
            <input id="avatar" name="avatar" type="file" accept="image/png, image/jpeg, image/jpg, image/gif" class="hidden" x-ref="photo" x-on:change="
                photoName = $refs.photo.files[0].name;
                const reader = new FileReader();
                reader.onload = (e) => {
                    photoPreview = e.target.result;
                };
                reader.readAsDataURL($refs.photo.files[0]);
            " />

            <x-input-label :value="__('Foto Profil')" class="mb-3 font-semibold text-gray-700" />

            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <!-- Current Avatar or Preview -->
                <div class="shrink-0">
                    <div x-show="!photoPreview" class="w-28 h-28 rounded-full overflow-hidden border-4 border-white shadow-lg bg-gray-100 ring-1 ring-gray-200">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 text-primary-700 flex items-center justify-center font-black text-4xl">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div x-show="photoPreview" style="display: none;" class="w-28 h-28 rounded-full overflow-hidden border-4 border-white shadow-lg bg-gray-100 ring-2 ring-primary-500">
                        <span class="block w-full h-full bg-cover bg-no-repeat bg-center" x-bind:style="'background-image: url(\'' + photoPreview + '\');'"></span>
                    </div>
                </div>

                <!-- Upload Box (Matching User Image) -->
                <label for="avatar" class="flex-1 w-full cursor-pointer group">
                    <div class="border-2 border-dashed border-gray-300 hover:border-primary-400 rounded-3xl p-6 text-center transition-all duration-300 bg-gray-50 hover:bg-primary-50/50">
                        <div class="mx-auto w-14 h-14 bg-white shadow-sm border border-gray-100 group-hover:border-primary-200 rounded-full flex items-center justify-center mb-4 transition-all duration-300">
                            <svg class="w-6 h-6 text-gray-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        </div>
                        <h4 class="text-base font-bold text-gray-800 group-hover:text-primary-700 transition-colors mb-1">Pilih File Gambar Baru</h4>
                        <p class="text-sm text-gray-500 mb-4" x-text="photoName ? 'File terpilih: ' + photoName : 'Anda dapat memilih satu file gambar'"></p>
                        
                        <div class="inline-block bg-white shadow-sm border border-gray-200 text-gray-600 rounded-full px-4 py-1.5 text-xs font-semibold">
                            JPG, PNG (Maks. 2MB)
                        </div>
                    </div>
                </label>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" :value="__('Nama Lengkap')" class="mb-2 font-semibold text-gray-700" />
                <x-text-input id="name" name="name" type="text" class="block w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 shadow-sm transition-colors" :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="Masukkan nama Anda" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Alamat Email')" class="mb-2 font-semibold text-gray-700" />
                <x-text-input id="email" name="email" type="email" class="block w-full rounded-xl border-gray-200 focus:border-primary-500 focus:ring-primary-500 shadow-sm transition-colors" :value="old('email', $user->email)" required autocomplete="username" placeholder="Masukkan email aktif" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
            <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-700 hover:to-primary-600 text-white font-bold rounded-xl shadow-lg shadow-primary-500/30 transition-all focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-4"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm font-semibold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg flex items-center gap-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Berhasil disimpan.
                </p>
            @endif
        </div>
    </form>
</section>
