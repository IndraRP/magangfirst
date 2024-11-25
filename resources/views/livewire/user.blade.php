<div>
    <div class="container my-4">
        
@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif


        <h1 class="text-center mb-4">Kelola User</h1>          
        <button data-bs-toggle="modal" class="btn btn-primary mb-4" data-bs-target="#userModal">Create User</button>
        <!-- Table to display user items -->
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td class="text-center flex justify-center mt-2">
                            <!-- Edit Button -->
                            <button wire:click ="setUser({{ $user->id }})" type="button" class="text-gray-500 transition-colors duration-200 hover:text-red-500 focus:outline-none" data-bs-toggle="modal" data-bs-target="#editModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                  </svg>
                            </button>
                            <h1 class="mx-1"></h1>
                            <button wire:click ="deleteUser({{ $user->id }})" class="text-gray-500 transition-colors duration-200 hover:text-red-500 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <!-- Display pagination -->
        <div>{{ $users->links() }}</div>
    
         <!-- Modal untuk Create user -->
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-modal="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form wire:submit.prevent="storeUser">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama User</label>
                                <input type="text" class="form-control" id="name" wire:model="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" wire:model="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" wire:model="password" required>
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>                            

                            {{-- ROLE --}}
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <div>
                                    <input type="radio" id="role_admin" wire:model="role" value="admin">
                                    <label for="role_admin">Admin</label>
                                </div>
                                <div>
                                    <input type="radio" id="role_kasir" wire:model="role" value="kasir">
                                    <label for="role_kasir">Kasir</label>
                                </div>
                                @error('role') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>                            
                            
                            <button type="submit" class="btn btn-primary w-100">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

       <!-- Modal untuk Edit User -->
<div data-bs-target="#editModal" class="modal fade" id="editModal" tabindex="-1" aria-labelledby="userModalLabel" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Edit User</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" wire:model="name" required>
                </div>
        
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" wire:model="email" required>
                </div>
        
                <!-- Role -->
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" value="admin" id="admin" wire:model="role">
                        <label class="form-check-label" for="admin">Admin</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="role" value="kasir" id="kasir" wire:model="role">
                        <label class="form-check-label" for="kasir">Kasir</label>
                    </div>
                </div>
        
                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" wire:model="password" required>
                </div>
        
                <!-- Submit Button -->
                <button wire:click="updateUser()" class="btn btn-primary w-100">Simpan</button>
            </div>
        </div>
    </div>
</div>

        

</div>
</div>

       
@push('scripts')
<script>
    document.addEventListener('livewire:load', function () {
        // Event listener untuk membuka modal
        Livewire.on('openModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();

            // Fokus pada elemen pertama di dalam modal
            const firstFocusableElement = document.querySelector('#editModal input');
            firstFocusableElement.focus();
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        window.addEventListener('closeModal', (event) => {
        // Menutup modal edit
        const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
        if (editModal) {
            editModal.hide();
        }

        // Menutup modal user
        const userModal = bootstrap.Modal.getInstance(document.getElementById('userModal'));
        if (userModal) {
            userModal.hide();
        }
    });
});

setTimeout(() => {
    const alert = document.querySelector('.alert');
    if (alert) {
        alert.remove();
    }
}, 5000); // Hilang setelah 3 detik


</script>
@endpush