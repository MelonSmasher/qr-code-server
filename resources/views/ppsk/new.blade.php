<style>
    .btn-blue {
        background-color: #1F2937 !important;
        color: rgb(156 163 175) !important;
    }

    .btn-blue:hover {
        /*background-color: rgb(30 58 138) !important;*/
        color: rgb(209 213 219) !important;
    }

    input[type="text"] {
        border-radius: 5px;
    }

    #webhook {
        background-color: #f0f0f0; /* light gray */
        outline: none;
        font-family: 'Courier New', monospace;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create PPSK Configuration') }}
            </h2>
            <div class="p-10 space-x-5">

            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">
                <form action="{{ route('ppsk.new') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-4">
                        <label class="text-xl text-gray-600" for="name">Name</label>
                        <input type="text" class="border-2 border-gray-300 p-2 w-full" name="name" id="name" required/>
                    </div>
                    <button role="submit" id="saveButton"
                            class="font-semibold ring-blue-500 ring-2 rounded px-2 h-11 btn-blue transition-colors duration-300 ease-in-out">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('saveButton').addEventListener('click', function () {
        /* Change the button text */
        var saveButton = document.getElementById('saveButton');
        var originalButtonText = saveButton.textContent;
        saveButton.textContent = "Sending...";

        /* Change the button text back after 2 seconds */
        setTimeout(function () {
            saveButton.textContent = originalButtonText;
        }, 2000);
    });
</script>
