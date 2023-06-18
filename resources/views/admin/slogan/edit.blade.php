<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Edit Slogan') }}
        </h2>
        <a
            href="{{ route('admin.slogan.index') }}"
            class="rounded-lg border border-gray-200 bg-white py-2.5 px-5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700"
        >Kembali</a>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6">
                    <form
                        action="{{ route('admin.slogan.update', $slogan->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        novalidate
                    >
                        @method('patch')
                        @csrf
                        <div class="mb-6">
                            <label
                                for="slogan"
                                class="mb-2 block text-sm font-medium text-gray-900"
                            >
                                Slogan
                            </label>
                            <input
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                type="text"
                                id="slogan"
                                name="slogan"
                                placeholder="Masukkan slogan"
                                value="{{ old('slogan', $slogan->slogan) }}"
                                required
                            >
                            @error('slogan')
                                <x-input-error-message>
                                    {{ $message }}
                                </x-input-error-message>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label
                                for="deskripsi"
                                class="mb-2 block text-sm font-medium text-gray-900"
                            >Deskripsi</label>
                            <textarea
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                id="deskripsi"
                                name="deskripsi"
                                placeholder="Masukkan deskripsi ..."
                                rows="4"
                            >{{ old('deskripsi', $slogan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <x-input-error-message>
                                    {{ $message }}
                                </x-input-error-message>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <div>
                                <label
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                    for="gambar"
                                >
                                    Gambar
                                </label>
                                <img
                                    class="mb-2 aspect-square rounded-lg object-cover md:max-w-[50%]"
                                    src="{{ LinkImageHelper::check($slogan->gambar) }}"
                                    alt=""
                                    data-img-preview
                                >
                                <input
                                    class="block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400"
                                    id="gambar"
                                    name="gambar"
                                    type="file"
                                    data-input-img
                                >
                                @error('gambar')
                                    <x-input-error-message>
                                        {{ $message }}
                                    </x-input-error-message>
                                @enderror
                            </div>
                        </div>
                        <button
                            type="submit"
                            class="mr-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <x-toast-success message="{{ session()->get('success') }}" />
    @endif

    @if ($errors->any())
        <x-toast-danger message="Gagal Menyimpan!" />
    @endif

    @push('scripts')
        <script>
            (function() {
                const imgPreview = document.querySelector('[data-img-preview]'),
                    inputImg = document.querySelector('[data-input-img]')

                inputImg.onchange = evt => {
                    const [file] = inputImg.files
                    if (file) {
                        imgPreview.src = URL.createObjectURL(file)
                        inputImg.onload = function() {
                            URL.revokeObjectURL(inputImg.src) // free memory
                        }
                    }
                }
            })()
        </script>
    @endpush

</x-app-layout>
