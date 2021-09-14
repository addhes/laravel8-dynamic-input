<x-slot name="header">
    <h2 class=" font-semibold text-xl text-gray-800 leading-tight">Data Abouts</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
                <div class="bg-green-500 border-t-4 text-white px4 py-3 shadow-md my-3">
                    <div class="flex">
                        <div>
                            <p class=" text-sm text-bold pl-4 duration-300"> {{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

        <!-- Create Data -->
        <td class="p-3 px-5 flex justify-end"><button wire:click="create()" type="button" class="mr-3 text-lg bg-blue-500 hover:bg-blue-700 text-white py-3 px-3 rounded focus:outline-none focus:shadow-outline">Tambah</button>
        
        
        <div class="flex justify-between mt-4 mb-6">
            <div class="form-inline">
                Per Page: &nbsp;
                <select wire:model="perPage" class=" w-20">
                    <option>2</option>
                    <option>5</option>
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                    <option>100</option>
                </select>
            </div>

            <div class="col">
                <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Search Products ...">
            </div>
        </div>

        @if ($isModal)
            @include('livewire.karyawan.create');
        @endif
        
        <table class="border-collapse mt-8 w-full">
            <thead>
                <tr>
                    <th wire:click="sortBy('id')" class="p-3 text-sm font-medium uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell cursor-pointer">No</th>
                    <th wire:click="sortBy('name')" class="p-3 text-sm font-medium uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell cursor-pointer">
                        Nama
                        @include('livewire.sort-icon', ['field' => 'name'])
                    </th>
                    <th wire:click="sortBy('bonus')" class=" p-3 text-sm font-medium uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell cursor-pointer">
                        Bonus
                        @include('livewire.sort-icon', ['field' => 'bonus'])
                    </th>
                    <th class="p-3 text-sm font-medium uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell cursor-pointer">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($karyawans as $item => $hasil )
                <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                    <td class="w-full lg:w-1.5 p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">no</span>
                        {{ $item + $karyawans->firstitem() }}
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Nama</span>
                        <p>{{ $hasil->name }}</p>
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Jabatan</span>
                        <p>{{ $hasil->bonus }}</p>
                    </td>
                    <td class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                        <div class="flex item-center justify-center">
                            <button wire:click="edit({{ $hasil->id }})" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </button>
                            <button wire:click="openDeleteModal({{ $hasil->id }})" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <h1 class="text-gray-700 text-center">
                    Tidak ada data
                </h1>
                @endforelse
            </tbody>
        </table> <br>
        {{ $karyawans ?? ''->links() }}
    </div>
    </div>

            <!-- deleteCOnfirmation -->
@if ($deleteConfirmation)
<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

      <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
  
      <!-- This element is to trick the browser into centering the modal contents. -->
      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

      <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <form action="">
              <div class="">
                  <h1 class="font-bold text-center mb-4">Delete Confirmation</h1>
              </div>
              <div>
                  <div class="mb-2">
                      <label class="block text-gray-700 text-sm font-bold mb-2">Are you sure delete this?</label>
                  </div>
              </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button wire:click.prevent="delete({{ $deleteId }})" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
            Delete
          </button>
          <button wire:click="closeDeleteModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Cancel
          </button>
        </div>
      </form>
      </div>
    </div>
</div>
@endif
    
</div>

