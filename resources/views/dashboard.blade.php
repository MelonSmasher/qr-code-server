<style>
    .btn-blue {
        background-color: #1F2937 !important;
        color: rgb(156 163 175) !important;
    }

    .btn-blue:hover {
        /*background-color: rgb(30 58 138) !important;*/
        color: rgb(209 213 219) !important;
    }

    tr {
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('PPSK Configurations') }}
            </h2>
            <div class="p-10 space-x-5">
                <button
                    class="font-semibold ring-blue-500 ring-2 rounded px-2 h-11 btn-blue transition-colors duration-300 ease-in-out"
                    onclick="location.href='{{ route('ppsk.new') }}'">+ New
                </button>
            </div>
        </div>
    </x-slot>


    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-6">
                <table class="min-w-full divide-y divide-gray-200 w-full">
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($ppsks as $item)
                        <tr>
                            <td class="px-6 py-1 whitespace-no-wrap">
                                <div class="text-sm leading-5 text-gray-900">{{ $item->name }}</div>
                            </td>
                            <td class="px-6 py-1 whitespace-no-wrap">
                                <div
                                    class="text-sm leading-5 text-gray-900">{{ $item->created_at->format('M jS y h:i A') }}</div>
                            </td>
                            <td class="px-6 py-1 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                <div class="flex justify-end">
                                    <div class="px-1">
                                        <a href="{{ route('ppsk.edit', $item->id) }}"
                                           class="text-indigo-600 hover:text-indigo-900">View</a>
                                    </div>
                                    <div class="px-1">
                                        <form action="{{ route('ppsk.destroy', $item->id) }}" method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure you want to delete {{'"'.$item->name.'"'}}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-5 py-4">
                    {{ $ppsks->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
