<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden  shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class=" space-y-4">

                            <div>
                                <x-label for="image" :value="__('Image')" />
                                <x-input id="image"
                                    class="mt-1 form-control block w-full px-3 py-1.5 text-bases font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                    type="file" name="image" />
                            </div>

                            <div>
                                <x-label for="title" :value="__('Title')" />
                                <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                    :value="old('title')" />
                            </div>

                            <div>
                                <x-label for="Text" :value="__('Text')" />
                                {{-- Change to component --}}
                                <textarea id="text"
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    rows="5" type="text" name="text" :value="old('text')"></textarea>
                            </div>

                            <div>
                                <x-label for="Category" :value="__('Category')" />
                                <select id="category_id"
                                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="category_id" :value="old('category_id')">
                                    <option disabled selected>Select a option</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <x-label for="Tag" :value="__('Tags')" />
                            <div class="grid grid-cols-4 gap-4">
                                @foreach ($tags as $tag)
                                    <span class="flex-wrap space-x-1 items-center">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                            class="shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                        <label for="{{ $tag->title }}"
                                            class="font-medium text-sm text-gray-700">{{ $tag->title }}</label>
                                    </span>
                                @endforeach
                            </div>

                            <button class="bg-purple-500 px-4 py-2 rounded text-white" type="submit">Add</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
