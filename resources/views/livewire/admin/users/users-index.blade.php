<div>
    <div class="header flex items-center mb-10">
        <div class="title basis-3/5">
            <span class="title">{{ $title }}</span>
        </div>
        <div class="search flex justify-end gap-12 items-end basis-3/5">
            <div class="">
                <button wire:click="$dispatch('openModal', { component: 'admin.users.create-edit-user-modal'})"
                    class="btn-primary inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Agregar usuario
                </button>
            </div>
        </div>
    </div>
    <div class="data">
        <livewire:admin.users.user-table />
    </div>

    {{-- Modals --}}

    @livewire('wire-elements-modal')

    {{-- Alert message --}}
    @if (session('ok'))
        @push('scripts')
            <script>
                window.addEventListener("load", (event) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: "success",
                        title: "{{ session('ok') }}"
                    });
                });
            </script>
        @endpush
    @elseif (session('error'))
        @push('scripts')
            <script>
                window.addEventListener("load", (event) => {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: "error",
                        title: "{{ session('error') }}"
                    });
                });
            </script>
        @endpush
    @endif
</div>
