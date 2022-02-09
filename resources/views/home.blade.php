<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @forelse ($articles as $article)
                        <h3>{{ $article->title }}</h3>
                    @empty
                        <h3>No articles.</h3>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
