<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Content By Categories
        </h2>
    </x-slot>

    <div>
        <div class="max-w-full mx-auto py-10 sm:px-6 lg:px-8"> 
            <form method="get" id="category-form">
                <select name="category" id="category" class="form-input rounded-md shadow-sm mt-1 block w-full" onchange="document.getElementById('category-form').submit()">
                    <option>Select one</option>
                    <option>LOGO MBK</option>
                    <option>KUANTAN KINI</option>
                    <option>KUANTAN DAHULU</option>
                    <option>GAMBAR AGONG</option>
                    <option>KUANTAN AKAN DATANG</option>
                    <option>IKLAN</option>
                    <option>INFO MBK</option>
                    <option>E-PERKHIDMATAN</option>
                    <option>AKTIVITI MBK</option>
                    <option>PROJEK SEMASA</option>
                    <option>VIDEO KORPORAT & PROMOSI & PROJEK</option>
                </select>
            </form>

            <br>

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
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Media
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($videocategory as $videocategory)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $videocategory->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $videocategory->title }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $videocategory->category }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $videocategory->description }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @if (strpos($videocategory->name, 'jpg') !== false)
                                                <image src="/storage/{{ $videocategory->name }}" style="width:450px;height:250px;" />
                                            @elseif(strpos($videocategory->name, 'png') !== false)
                                                <image src="/storage/{{ $videocategory->name }}" style="width:450px;height:250px;" />
                                            @else
                                            <video width="450" height="250" controls>
                                                <source src="/storage/{{ $videocategory->name }}" type="video/mp4">
                                            </video>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($imagecategory as $imagecategory)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $imagecategory->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $imagecategory->title }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $imagecategory->category }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $imagecategory->description }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            @if (strpos($imagecategory->name, 'jpg') !== false)
                                                <image src="/storage/{{ $imagecategory->name }}" style="width:450px;height:250px;" />
                                            @elseif(strpos($imagecategory->name, 'png') !== false)
                                                <image src="/storage/{{ $videimagecategoryocategory->name }}" style="width:450px;height:250px;" />
                                            @else
                                            <video width="450" height="250" controls>
                                                <source src="/storage/{{ $imagecategory->name }}" type="video/mp4">
                                            </video>
                                            @endif
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