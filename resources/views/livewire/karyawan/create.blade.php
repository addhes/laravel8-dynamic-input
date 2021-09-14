<!-- This example requires Tailwind CSS v2.0+ -->
<div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all w-full sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-14 pt-5 pb-4 sm:p-6 sm:pb-4">
                <form action="">
                    <div class="">
                        <h1 class="font-bold text-center mb-4">Create Karyawan</h1>
                    </div>
                    <div>
                        <input type="number" >
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-2">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                <input type="text" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="name.0">
                                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="bonus" class="block text-gray-700 text-sm font-bold mb-2">Bonus</label>
                                <input type="text" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="bonus.0">
                                @error('bonus') <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <button class="bg-indigo-500 hover:bg-indigo-400 px-3 mt-4 mb-3 text-white rounded" wire:click.prevent="add({{ $i }})">Add+</button>
                        </div>
                    </div>

                    @foreach ($input as $key => $values )
                        <div>
                        <div class="mb-4 md:flex md:justify-between">
                            <div class="mb-2">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                                <input type="text" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="name.{{ $values }}">
                                @error('name. ' . $values) <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-2">
                                <label for="bonus" class="block text-gray-700 text-sm font-bold mb-2">Bonus</label>
                                <input type="text" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" wire:model="bonus.{{ $values }}">
                                @error('bonus. ' . $values) <span class="text-red-500">{{ $message }}</span> @enderror
                            </div>
                            <button class="bg-red-500 hover:bg-red-400 px-3 mt-4 mb-3 text-white rounded" wire:click.prevent="remove({{ $key }})">Remove</button>
                        </div>
                    </div>
                    @endforeach
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button wire:click.prevent="store()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Save
                </button>
                <button wire:click="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
