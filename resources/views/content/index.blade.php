<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Content
        </h2>
    </x-slot>

    <div>
        <div class="max-w-full mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('content.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Content</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Content
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($content as $content)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $loop->iteration }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $content->title }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $content->description }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $content->content }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('content.show', $content->id) }}" class="bg-blue-600 hover:bg-blue-900 text-white font-bold mb-2 mr-2 py-1 px-2 rounded">View</a>
                                            <a href="{{ route('content.edit', $content->id) }}" class="bg-yellow-300 hover:bg-yellow-900 text-white font-bold mb-2 mr-2 py-1 px-2 rounded">Edit</a>
                                            @can('user_access')
                                            <form class="inline-block" action="{{ route('content.destroy', $content->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="bg-red-600 hover:bg-red-900 text-white font-bold mb-2 mr-2 py-1 px-2 rounded" value="Delete">
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>