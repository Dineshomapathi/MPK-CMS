<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upload Video
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('videoupload.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Back to list</a>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{ route('videoupload.store') }}" method="POST" id="frm" enctype="multipart/form-data">
            @csrf
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <div>

                            <div class="col-span-3 sm:col-span-2">
                                <label for="title" class="block font-medium text-sm text-gray-700">Title</label>
                                <div class="mt-1">
                                <input type="text" name="title" id="title" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    value="{{ old('title', '') }}" />
                                @error('title')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                </div>
                            </div>

                            </br>

                            <div class="form-group">
                                <label for="category" class="block font-medium text-sm text-gray-700">Category:</label>
                                <div class="mt-1">
                                    <select class="form-input rounded-md shadow-sm mt-1 block w-full" name="category" id="category" value="{{ old('category', '') }}" onchange="subcatfun()">
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
                                        <option>SCREENSAVER</option>
                                    </select>
                                </div>
                            </div>

                            <div id="subcatinput" class="col-span-3 sm:col-span-2" style="display:none">
                            </br>
                                <label for="subcategory" class="block font-medium text-sm text-gray-700">Sub Category</label>
                                <div class="mt-1">
                                <input type="text" name="subcategory" id="subcategory" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    value="{{ old('subcategory', '') }}" />
                                @error('subcategory')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                </div>
                            </div>

                            </br>

                            <div class="form-group">
                                <label for="description" class="block font-medium text-sm text-gray-700">Description:</label>
                                <div class="mt-1">
                                    <textarea class="form-input rounded-md shadow-sm mt-1 block w-full" rows="5" name="description" id="description" value="{{ old('description', '') }}"></textarea>
                                    @error('description')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            </br>
                            
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <image id="image_preview_container" src="/images/imageholder.svg" height="200px" width="200px" style="margin-left:auto;margin-right:auto;margin-bottom:20px;"/>
                                    <div id="desc" style="justify-content: center;" class="flex text-sm text-gray-600">
                                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file-upload[]" type="file" class="sr-only" multiple="multiple">
                                        </label>
                                    </div>
                                    @error('file-upload')
                                        <p class="text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <p id="desc1" class="text-xs text-gray-500">
                                        MP4 up to 200MB
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="reset" onclick="myFunction()" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Clear
                        </button>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                        </button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    $(document).ready(function (e) {
        $('#file-upload').change(function(){      
                let reader = new FileReader();
                reader.onload = (e) => { 
                $('#image_preview_container').attr('src', "/images/success1.gif").css('width', '200px').css('height', '200px').css('margin-bottom', '20px');
                $('#desc').css('display', 'none');
                $('#desc1').css('display', 'none');
            }
            reader.readAsDataURL(this.files[0]);  
        });
    });

    function subcatfun(){
        var e = document.getElementById('category').value;

        if(e == "AKTIVITI MBK"){
            $('#subcatinput').css('display', 'block');
        }else{
            $('#subcatinput').css('display', 'none');
        }
    }

    function myFunction() {
        $('#image_preview_container').attr('src', "");
        $('#image_preview_container').attr('src', "/images/imageholder.svg").css('width', '200px').css('height', '200px').css('margin-bottom', '20px');
        $('#desc').css('display', 'flex');
        $('#desc1').css('display', 'block');
    }

    $("#frm").submit(function(event){
         var valDDL = $("#category").val();
         if(valDDL=="Select one"){
             event.preventDefault();
             alert("select dropdown option");
         } 
    });
</script>