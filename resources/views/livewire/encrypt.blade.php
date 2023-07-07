<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="submit">
                        <h5 class="card-title mb-0">Informasi Dasar</h5>
                        <div class="form-group my-2">
                            <label for="">Private Key</label>
                            <textarea wire:model="private_key" type="text" class="form-control" placeholder="Masukan Private Key"> </textarea>
                        </div>
                        <h5 class="card-title mb-0 mt-5">Auth</h5>
                        <div class="form-group my-2">
                            <label for="">Password</label>
                            <input wire:model="password" type="password" class="form-control" placeholder="Masukan Password">
                        </div>
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">

            <div class="card">
                <div class="card-header">
                    <div class="form-group">
                        <label for="">Password Decrypt</label>
                        <input type="password" wire:model.defer="password_decrypt" class="form-control" placeholder="Masukan Password">
                        <small class="text-muted">Masukan Password Sebelum klik tombol gembok</small>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-sm">
                        <thead>
                        <tr>
                            <th>Aksi</th>
                            <th>NO</th>
                            <th>Private</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($encrypts as $encrypt)
                            <tr>
                                <td>
                                    <button wire:click.prevent="decrypt({{$encrypt->id}})" class="btn btn-link ">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-key" width="40" height="40" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M14 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            <path d="M21 12a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z"></path>
                                            <path d="M12.5 11.5l-4 4l1.5 1.5"></path>
                                            <path d="M12 15l-1.5 -1.5"></path>
                                        </svg>
                                    </button>
                                </td>
                                <td>{{$encrypt->id}}</td>
                                <td class="text-truncate">{{$encrypt->private_key}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
